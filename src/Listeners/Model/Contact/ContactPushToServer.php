<?php

namespace HyveMobileTest\Listeners\Model\Contact;

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use HyveMobileTest\Events\Model\Contact\ContactFullfilledEvent;
use Resque\Exception\Cancel;

require_once(__DIR__.'./../../../../boot.php');

class ContactPushToServer
{
    /**
     * @var
     */
    protected $contact;

    /**
     * @var
     */
    protected $domain;

    /**
     * Event Handler
     *
     *
     * @param \HyveMobileTest\Events\Model\Contact\ContactFullfilledEvent $event
     */
    public function handle(ContactFullfilledEvent $event)
    {
        $this->contact = $event->getContact();

        $httpClient = new Client();

        $res = $httpClient->request('GET', $this->getPushUrl(), [
            RequestOptions::JSON => ['contact' => $this->contact->toArray()],
        ]);

        $this->contact->setRemoteServerResponse($res->getStatusCode());
    }

    /**
     * Get Push Url
     * Required due to getenv failure during worker process
     *
     * @return mixed
     * @throws \Resque\Exception\Cancel
     */
    private function getPushUrl()
    {
        $content = file(__DIR__.'./../../../../.env', FILE_IGNORE_NEW_LINES);

        $pushUrl = null;

        foreach ($content as $element) {
            strpos($element, 'CONTACT_PUSH_URL') !== false ? $pushUrl = $element : false;
        }

        $split = explode('=', $pushUrl);

        $result = array_pop($split);

        if (! $result) {
            throw new Cancel('CONTACT_PUSH_URL is not defined');
        }

        return $result;
    }
}

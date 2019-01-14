<?php

namespace HyveMobileTest\Jobs;

use HyveMobileTest\Contracts\Jobs\JobContract;
use HyveMobileTest\Models\Contact;

require_once(__DIR__.'./../../boot.php');

class EmailDomainVerifyJob implements JobContract
{
    /**
     * Job Config
     */
    public function setUp()
    {

    }

    /**
     * Job Executor
     *
     * @param $contact
     */
    public function perform($contact)
    {
        $contact = Contact::findOrFail($contact['contact_id']);

        $domain = $this->getDomainFromEmail($contact->email);



        $domainIp = $this->getIPbyDomainName($domain);
        
        if ($domainIp) {
            $contact->setDomain($domainIp);
        }
    }

    /**
     * Substract domain name from email
     *
     * @param string $email
     * @return mixed
     */
    private function getDomainFromEmail(string $email)
    {
        $split = explode('@', $email);

        return array_pop($split);
    }

    /**
     * Locate IP for domain
     *
     * @param $domain
     * @return bool|string
     */
    private function getIPbyDomainName($domain)
    {
        $ip = gethostbyname($domain);

        return filter_var($ip, FILTER_VALIDATE_IP) ? $ip : false;
    }

    /**
     *
     */
    public function tearDown()
    {
        // Remove environment for this job
    }
}

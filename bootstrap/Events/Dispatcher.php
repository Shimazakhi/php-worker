<?php

namespace Bootstrap\Events;

use HyveMobileTest\Events\ImportContactsEvent;
use HyveMobileTest\Events\Model\Contact\ContactCreatedEvent;
use HyveMobileTest\Events\Model\Contact\ContactFullfilledEvent;
use HyveMobileTest\Listeners\ImportCSVContacts;
use HyveMobileTest\Listeners\Model\Contact\ContactCardGenerate;
use HyveMobileTest\Listeners\Model\Contact\ContactEmailDomainVerify;
use HyveMobileTest\Listeners\Model\Contact\ContactPushToServer;

/**
 * Class Dispatcher
 * Application dispatcher bootstrapping
 *
 * @package Bootstrap\Events
 */
class Dispatcher extends \Illuminate\Events\Dispatcher
{
    /**
     * Application Events & Listeners Scheme
     *
     * @var array
     */
    protected $listen = [
        ContactCreatedEvent::class => [
            ContactCardGenerate::class,
            ContactEmailDomainVerify::class,
        ],
        ImportContactsEvent::class => [ImportCSVContacts::class],
        ContactFullfilledEvent::class => [ContactPushToServer::class],

    ];

    /**
     * Dispatcher constructor.
     */
    public function __construct($container = null)
    {
        parent::__construct();


        $this->registerApplicationEvents();
    }

    /**
     *  Events & Listeners registration
     */
    private function registerApplicationEvents(): void
    {
        foreach ($this->listens() as $event => $listeners) {
            foreach ($listeners as $listener) {
                self::listen($event, $listener);
            }
        }

    }

    /**
     * Get the events and handlers.
     *
     * @return array
     */
    public function listens()
    {
        return $this->listen;
    }
}

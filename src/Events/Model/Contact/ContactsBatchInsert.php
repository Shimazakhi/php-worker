<?php

namespace HyveMobileTest\Events\Model\Contact;

use Bootstrap\Events\Dispatcher;
use HyveMobileTest\Models\Contact;

class ContactsBatchInsert
{
    /**
     * ContactsBatchInsert constructor.
     *
     * @param array $contacts
     * @throws \Exception
     */
    public function __construct(Array $contacts)
    {
        $dispatcher = new Dispatcher();

        foreach ($contacts as $contact) {
            $dispatcher->fire(new ContactCreatedEvent(new Contact($contact)));
        }
    }
}

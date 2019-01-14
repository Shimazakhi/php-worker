<?php

namespace HyveMobileTest\Events\Model\Contact;

use HyveMobileTest\Models\Contact;

class ContactCreatedEvent
{
    protected $contact;

    /**
     * ImportContactsEvent constructor.
     *
     * @throws \Exception
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    public function getContact()
    {
        return $this->contact;
    }
}

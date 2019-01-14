<?php

namespace HyveMobileTest\Events\Model\Contact;

use HyveMobileTest\Models\Contact;
use Illuminate\Http\Request;

class ContactFullfilledEvent
{
    /**
     * @var \HyveMobileTest\Models\Contact
     */
    protected $contact;

    /**
     * ContactFullfilledEvent constructor.
     *
     * @param \HyveMobileTest\Models\Contact $contact
     */
    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
    }

    /**
     * Getter
     *
     * @return \HyveMobileTest\Models\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }
}

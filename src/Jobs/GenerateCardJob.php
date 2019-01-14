<?php

namespace HyveMobileTest\Jobs;

use HyveMobileTest\Contracts\Jobs\JobContract;
use HyveMobileTest\Lib\ContactCardGenerator;
use HyveMobileTest\Models\Contact;

require_once(__DIR__.'./../../boot.php');

class GenerateCardJob implements JobContract
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

        $contactCardPath = (new ContactCardGenerator($contact))->generate()->getPath() ?? false;

        if ($contactCardPath) {
            $contact->setCardPath($contactCardPath);
        }
    }

    /**
     *
     */
    public function tearDown()
    {

    }
}

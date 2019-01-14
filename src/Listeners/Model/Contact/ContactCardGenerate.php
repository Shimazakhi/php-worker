<?php

namespace HyveMobileTest\Listeners\Model\Contact;

use HyveMobileTest\Events\Model\Contact\ContactCreatedEvent;
use HyveMobileTest\Jobs\GenerateCardJob;
use Resque;


class ContactCardGenerate
{
    /**
     * Event Handler
     *
     * @param \HyveMobileTest\Events\Model\Contact\ContactCreatedEvent $event
     */
    public function handle(ContactCreatedEvent $event)
    {
        $job = Resque::push(GenerateCardJob::class, ['contact_id' => $event->getContact()->id], 'test');
    }
}

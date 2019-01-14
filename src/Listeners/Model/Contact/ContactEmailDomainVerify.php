<?php

namespace HyveMobileTest\Listeners\Model\Contact;

use HyveMobileTest\Events\Model\Contact\ContactCreatedEvent;
use HyveMobileTest\Jobs\EmailDomainVerifyJob;
use Resque;

class ContactEmailDomainVerify
{
    /**
     * Handle Event
     *
     * @param \HyveMobileTest\Events\Model\Contact\ContactCreatedEvent $event
     */
    public function handle(ContactCreatedEvent $event)
    {
        $job = Resque::push(EmailDomainVerifyJob::class, ['contact_id' => $event->getContact()->id], 'test');
    }
}

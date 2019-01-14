<?php

namespace HyveMobileTest\Listeners;

use HyveMobileTest\Events\ImportContactsEvent;
use HyveMobileTest\Services\ContactsService;
use League\Csv\Reader;

class ImportCSVContacts
{
    /**
     * @var
     */
    protected $contactsFileCSV;

    /**
     * @var
     */
    protected $csvSource;

    /**
     * @param \HyveMobileTest\Events\ImportContactsEvent $event
     * @throws \Exception
     */
    public function handle(ImportContactsEvent $event)
    {
        $this->contactsFileCSV = $event->getExportedFilePath();

        $this->parseCSV();

        $this->processEntries();
    }

    /**
     * @throws \League\Csv\Exception
     */
    private function parseCSV()
    {
        $this->csvSource = Reader::createFromPath($this->contactsFileCSV, 'r');
        $this->csvSource->setHeaderOffset(0);
    }

    /**
     * @throws \Exception
     */
    private function processEntries()
    {
        $records = $this->csvSource->jsonSerialize() ?? null;

        if ($records) {
            $service = new ContactsService();
            $service->massInsert($records);
        } else {
            throw new \Exception('No records found');
        }
    }
}

<?php

namespace HyveMobileTest\Events;

use VIPSoft\Unzip\Unzip;

class ImportContactsEvent
{
    /**
     * Default contact zip file path
     */
    CONST DEFAULT_FILE_PATH = BASEPATH.'resources/data.csv.zip';

    /**
     * Export path
     */
    CONST DEFAULT_EXPORT_PATH = BASEPATH.'resources/extracted';

    /**
     * Export filename
     */
    CONST DEFAULT_FILENAME = 'MOCK_DATA.csv';

    /**
     * Zip export Dir
     *
     * @var string
     */
    private $exportFilePath = null;

    /**
     * Unzip
     *
     * @var \VIPSoft\Unzip\Unzip
     */
    protected $unZipper;

    /**
     * ImportContactsEvent constructor.
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->unZipper = new Unzip();

        $this->unzipContactsArchive();
    }

    /**
     * Unzip Archived Contacts
     *
     * @throws \Exception
     */
    public function unzipContactsArchive() : void
    {
        try {
            $filenames = $this->unZipper->extract(self::DEFAULT_FILE_PATH, self::DEFAULT_EXPORT_PATH);

            if (in_array(self::DEFAULT_FILENAME, $filenames)) {
                $this->setExportedFilePath(self::DEFAULT_FILENAME);
            } else {
                throw new \Exception(self::DEFAULT_FILENAME.' not found');
            }
        } catch (\Exception $exception) {
            throw new \Exception(self::DEFAULT_FILE_PATH.' not found');
        }
    }

    /**
     * ExportedFilePath Setter
     *
     * @param $path
     */
    private function setExportedFilePath($path): void
    {
        $this->exportFilePath = self::DEFAULT_EXPORT_PATH.'/'.$path;
    }

    /**
     * ExportedFilePath Getter
     *
     * @return mixed
     */
    public function getExportedFilePath(): ? string
    {
        return $this->exportFilePath;
    }
}

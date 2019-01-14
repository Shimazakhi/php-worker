<?php

namespace HyveMobileTest\Services;

use Bootstrap\Events\Dispatcher;
use HyveMobileTest\Events\Model\Contact\ContactsBatchInsert;
use HyveMobileTest\Models\Contact;
use HyveMobileTest\Transformers\ContactSaveTransformer;
use League\Fractal\Manager;
use Spatie\Fractal\Fractal;

class ContactsService
{
    /**
     * Batch import
     *
     * @param $data
     */
    public function massInsert($data)
    {
        try {
            $dispatcher = new Dispatcher();

            $prepared = (new Fractal(new Manager()))->collection($data)->transformWith(new ContactSaveTransformer());

            $data = $prepared->toArray()['data'];

            if (Contact::insert($data)) {
                $dispatcher->fire(new ContactsBatchInsert($data));
            }
        } catch (\Exception $exception) {

            dd($exception->getMessage());
        }
    }
}

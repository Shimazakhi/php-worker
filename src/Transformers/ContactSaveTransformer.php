<?php

namespace HyveMobileTest\Transformers;

use Carbon\Carbon;

use HyveMobileTest\Models\Contact;
use League\Fractal\TransformerAbstract;

/**
 * Data formatter
 *
 * Class ContactSaveTransformer
 *
 * @package App\Transformers
 */
class ContactSaveTransformer extends TransformerAbstract
{
    /**
     * Transform
     *
     * @param $customer

     */
    public function transform($contact)
    {
        $contact = (object) $contact;

        $data = [
            'id' => (int) $contact->id,
            'email' => (string) $contact->email,
            'first_name' => (string) $contact->first_name,
            'last_name' => (string) $contact->last_name,
            'note' => (string) $contact->note,
            'title' => (string) $contact->title,
            'dt_utc' => $this->getDTZ($contact->date, $contact->time, $contact->tz),
            'original_tz' => (string) $contact->tz,
        ];


        return $data;
    }

    /**
     * Get DateTime String
     *
     * @param $day
     * @param $time
     * @param $tz
     * @return string
     */
    private function getDTZ($day, $time, $tz)
    {
        return Carbon::createFromFormat('d-M-Y H:i:s', $day.' '.$time, $tz)->setTimezone('UTC')->toDateTimeString();
    }
}

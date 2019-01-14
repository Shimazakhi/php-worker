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
    public function transform($timezone, $contacts)
    {

        $data = [
            'timezone' => (string) $timezone,
            'total_contact' => (int) count($contacts),
            'contacts' => (array) $contacts,
        ];

        return $data;
    }
}

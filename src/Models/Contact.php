<?php

namespace HyveMobileTest\Models;

use Bootstrap\Events\Dispatcher;
use HyveMobileTest\Events\Model\Contact\ContactFullfilledEvent;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Contact extends Model
{
    use HasEvents;

    /**
     * Contacts Table name
     *
     * @var string
     */
    protected $table = 'contacts';

    /**
     * Disable timstamps
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Fillables
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'email',
        'first_name',
        'last_name',
        'note',
        'title',
        'dt_utc',
        'original_tz',
    ];

    /**
     * Dates
     *
     * @var array
     */
    protected $dates = ['dttz'];

    /**
     * Hidden
     *
     * @var array
     */
    protected $hidden = ['email_domain_verified'];
    

    /**
     *
     */
    public static function boot()
    {
        parent::boot();
    }

    /**
     * Set domain
     *
     * @param $value
     */
    public function setDomain($value)
    {
        $this->ip = $value;
        $this->email_domain_verified = true;

        $this->save();

        $this->fireFullfilledEvent();
    }

    /**
     * Set generated image path
     *
     * @param string $value
     */
    public function setCardPath(string $value)
    {
        $this->card_path = $value;

        $this->save();

        $this->fireFullfilledEvent();
    }

    /**
     * Set Remote Server response status
     *
     * @param $value
     */
    public function setRemoteServerResponse($value)
    {
        $this->remote_server_response = $value;

        $this->save();
    }

    /**
     * Fire Fullfilled Event
     *
     */
    private function fireFullfilledEvent()
    {
        if ($this->card_path && $this->email_domain_verified) {
            $dispatcher = new Dispatcher();
            $dispatcher->fire(new ContactFullfilledEvent($this));
        }
    }
}

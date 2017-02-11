<?php

namespace App\Listeners;

use App\Event\Status;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class StatusNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Status  $event
     * @return void
     */
    public function handle(Status $status)
    {
        foreach ($status as $a)
        {
            if($a)
            {
                explode(',',$a->status);
            }
        }
    }
}

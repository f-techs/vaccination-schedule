<?php

namespace App\Listeners;

use App\Events\VaccineAlertEvent;
use App\Mail\VaccineAlertEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class VaccineAlertListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */

    public function handle(VaccineAlertEvent $event): void
    {
        $parent = $event->parent;
        $message=$event->message;
        Mail::to($parent->email)->send(new VaccineAlertEmail($parent, $message));
    }
}

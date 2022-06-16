<?php

namespace App\Listeners;

use App\Events\newOfferCreatedEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class OfferCreatedFollowerNotifyListener
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
     * @param  newOfferCreatedEvent  $event
     * @return void
     */
    public function handle(newOfferCreatedEvent $event)
    {

        //send email to all folloers
        mail::to($event->followers)->send(new \App\Mail\newOffer($event->offerData));
    }
}

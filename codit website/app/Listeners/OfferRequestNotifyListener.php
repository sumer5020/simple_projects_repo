<?php

namespace App\Listeners;

use App\Providers\newApplyToOfferEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class OfferRequestNotifyListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  newApplyToOfferEvent  $event
     * @return void
     */
    public function handle(newApplyToOfferEvent $event)
    {
        //send email to spesific customer
        mail::to($event->applyData['customer_email'])->send(new \App\Mail\offerRequestCustomerFead($event->applyData));
    }
}

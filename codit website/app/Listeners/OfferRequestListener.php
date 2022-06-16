<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class OfferRequestListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        //send email to spesific admins
        //mail::to(email or emailarray)->cc(email or emailarray)->bcc(email or emailarray)->replyTo(email or emailarray)->send(mail instance));
        mail::to($event->applyData['admin_email'])->bcc('sumer5020@gmail.com')->send(new \App\Mail\offerRequest($event->applyData));
    }
}

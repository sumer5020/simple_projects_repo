<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class offerRequest extends Mailable
{
    use Queueable, SerializesModels;
    public $applyData;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($applyData)
    {
        $this->applyData=$applyData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.offerRequest')->subject('Codit - New offer request');
    }
}

<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class newOfferCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $followers,
    $offerData;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($followers, $offerData)
    {
        $this->followers=$followers;
        $this->offerData=$offerData;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}

<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatMessage extends Event implements ShouldBroadcast
{
    use SerializesModels;
    public $room;
    public $message;
    /*
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($payload)
    {
        //
        $this->room=$payload['room'];
        $this->message=$payload['message'];
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return ['chat_channel'];
    }
}

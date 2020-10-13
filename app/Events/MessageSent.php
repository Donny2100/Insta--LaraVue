<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class MessageSent implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The message.
     *
     * @var Message
     */
    public $message;

    /**
     * Constructor.
     *
     * @param Message $message
     */
    public function __construct(Message $message) {
        $this->message = $message;

        $this->message->conversation->unarchive();
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return PrivateChannel
     */
    public function broadcastOn() {
        return new PresenceChannel('conversation.'.$this->message->conversation->id);
    }

    /**
     * The event's broadcast name.
     *
     * @return string
     */
    public function broadcastAs() {
        return 'message.posted';
    }

    public function broadcastWith() {
        return [
            'message' => $this->message->content,
            'sender'  => [
                'id'      => $this->message->sender->id,
                'name'    => $this->message->sender->name,
                'isOwner' => $this->message->conversation->owner->id === $this->message->sender->id
            ],
            'place'  => $this->message->conversation->owner->place->name,
            'sentAt' => $this->message->created_at
        ];
    }
}

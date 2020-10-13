<?php

namespace App\Models;

use App\Events\MessageSent;
use App\Models\User;
use App\Models\Conversation;
use Illuminate\Database\Eloquent\Model;

class Message extends Model {
    protected $dispatchesEvents = [
        'created' => MessageSent::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'conversation_id',
        'user_id',
        'content',
    ];

    protected $touches = ['conversation'];

    /**
     * Conversation associated to this message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conversation() {
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    /**
     * Sender of the message.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sender() {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model {

    protected $fillable = [
        'owner_id',
        'user_id',
        'place_id',
    ];

    public function unarchive() {
        if (!!$this->archived_at) {
            $this->archived_at = null;

            $this->save();
        }
    }

    /**
     * Users associated to this conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo(User::class, 'owner_id');
    }

    /**
     * Place associated to this conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function place() {
        return $this->belongsTo(Place::class, 'place_id');
    }

    /**
     * Users associated to this conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Messages in this conversation.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function messages() {
        return $this->hasMany(Message::class);
    }
}

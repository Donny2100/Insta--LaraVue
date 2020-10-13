<?php

namespace App\Broadcasting;

use App\Models\Conversation;
use App\Models\User;

class ConversationChannel {
    /**
     * Authenticate the user's access to the channel.
     *
     * @param User         $user
     * @param Conversation $conversation
     *
     * @return array|bool
     */
    public function join(User $user, Conversation $conversation) {
        if ($user->id === $conversation->user->id)
            return $user;

        if ($user->id === $conversation->owner->id)
            return $conversation->owner;

        return false;
    }
}

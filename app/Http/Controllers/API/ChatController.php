<?php

namespace App\Http\Controllers\API;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Place;

class ChatController extends Controller {
    public function archiveChannel($channellId) {
        $conversation = Conversation::with('place')->find($channellId);

        $conversation->archived_at = \Carbon\Carbon::now();

        $conversation->save();

        return ['status' => 'Channel archived!'];
    }

    public function getMessages($channellId) {
        $conversation = Conversation::with('place')->find($channellId);

        $messages = Message::where('conversation_id', $channellId)
                           ->with('sender')
                           ->latest()
                           ->limit(10)
                           ->get();

        return array_map(function($message) use ($conversation) {
            return [
                'place'   => $conversation['place']['name'],
                'message' => $message['content'],
                'sentAt'  => $message['created_at'],
                'sender'  => [
                    'id'      => $message['sender']['id'],
                    'name'    => $message['sender']['name'],
                    'isOwner' => $conversation['owner_id'] === $message['sender']['id']
                ]
            ];
        }, $messages->toArray());
    }

    public function getChannels($placeId, Request $request) {
        $place = Place::find($placeId);

        if ($request->user()->id === $place->owner->id) {
            return [
                'isOwner'     => $request->user()->id === $place->owner->id,
                'channelList' => Conversation::where('place_id', $placeId)
                                          ->whereNull('archived_at')
                                          ->with(['user', 'owner'])
                                          ->latest('updated_at')
                                          ->get(),
                'channel'    => null
            ];
        } else {
            $conversation = Conversation::with('user', 'owner')->firstOrCreate([
                'user_id'  => $request->user()->id,
                'place_id' => $placeId,
                'owner_id' => $place->owner->id
            ]);

            return [
                'isOwner'     => $request->user()->id === $place->owner->id,
                'channelList' => null,
                'channel'     => $conversation
            ];
        }
    }

    public function createChannel($placeId, Request $request) {
        $place = Place::find($placeId);

        $conversation = Conversation::firstOrCreate(
            [
                'user_id' => $request->user()->id,
                'place_id' => $placeId,
                'owner_id' => $place->owner->id
            ]
        );

        return $conversation;
    }

    public function listChannels($placeId) {
        $conversations = Conversation::where('place_id', $placeId)
                                     ->whereNull('archived_at')
                                     ->with('user')
                                     ->latest('updated_at')
                                     ->get();

        return $conversations;
    }

    /**
     * Persist message to database
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage($channelId, Request $request) {
        Message::create([
            'user_id' => $request->user()->id,
            'conversation_id' => $channelId,
            'content' => $request->message
        ]);

        return ['status' => 'Message Sent!'];
    }
}

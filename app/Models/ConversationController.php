<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function createConversation(Request $request)
    {
        // Create a new conversation
        $conversation = Conversation::create([
            'user_id' => $request->user_id,
            'nutritionist_id' => $request->nutritionist_id,
        ]);

        return response()->json($conversation, 201);
    }

    public function getConversation($conversationId)
    {
        // Get messages in a conversation
        $conversation = Conversation::with('messages.sender')->findOrFail($conversationId);
        return response()->json($conversation);
    }

    public function sendMessage(Request $request, $conversationId)
    {
        // Send a message in a conversation
        $message = Message::create([
            'conversation_id' => $conversationId,
            'sender_id' => $request->sender_id,
            'message' => $request->message,
        ]);

        return response()->json($message, 201);
    }
}
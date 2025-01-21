<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{

    public function index(Request $request)
{
    // Ensure conversation_id is passed and is valid
    $conversationId = $request->query('conversation_id');
    
    if (!$conversationId) {
        return response()->json(['error' => 'Conversation ID is required'], 400);
    }

    // Get messages for the specified conversation
    $messages = Message::with(['conversation', 'sender', 'receiver'])
                       ->where('conversation_id', $conversationId) // Filter by conversation_id
                       ->get();

    return response()->json($messages);
}


   
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'conversation_id' => 'required|exists:conversations,id',
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string|max:5000',
        ]);

        // Create a new message
        $message = Message::create($validated);

        return response()->json($message, 201); // 201 Created
    }

  
    public function show(Message $message)
    {
        // Return the specified message with conversation and user details
        return response()->json($message->load(['conversation', 'sender', 'receiver']));
    }

    
    public function update(Request $request, Message $message)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'content' => 'sometimes|string|max:5000',
            'is_read' => 'sometimes|boolean',
        ]);

        // Update the message
        $message->update($validated);

        return response()->json($message);
    }



    public function markAsRead(Message $message)
    {
        $message->markAsRead();
        return response()->json(['message' => 'Message marked as read']);
    }

    /**
     * Mark a message as unread.
     */
    public function markAsUnread(Message $message)
    {
        $message->markAsUnread();
        return response()->json(['message' => 'Message marked as unread']);
    }


     
    public function destroy(Message $message)
    {
        // Delete the message
        $message->delete();

        return response()->json(['message' => 'Message deleted successfully']);
    }
}

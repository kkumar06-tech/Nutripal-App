<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Message;

class MessageController extends Controller
{

    public function index(){
return Message::all();

    }

    public function show(int $id){
 // Find the specific Message by ID
 $message = Message::findOrFail($id);

 // Return the found Message
 return response()->json($message, 200);
        
            } 

    // retrieve all messages for a user /either sent or received
    public function getUserMessages($userId)
    {
        $messages = Message::where('send_from_id', $userId)
                            ->orWhere('send_to_id', $userId)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return response()->json($messages);
    }

    // send  new message
    public function sendMessage(Request $request)
    {
        $request->validate([
            'send_from_id' => 'required|integer',
            'send_to_id' => 'required|integer',
            'content' => 'required|string|max:1000',
        ]);

        $message = Message::create([
            'send_from_id' => $request->input('send_from_id'),
            'send_to_id' => $request->input('send_to_id'),
            'content' => $request->input('content'),
        ]);

        return response()->json($message, 201);
    }

    // delete message through id
    public function deleteMessage($messageId)
    {
        $message = Message::findOrFail($messageId);
        $message->delete();

        return response()->json(['message' => 'Message deleted successfully']);
    }
}

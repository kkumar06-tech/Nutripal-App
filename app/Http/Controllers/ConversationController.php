<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;

class ConversationController extends Controller
{


public function index(){
$conversations= Conversation::with(['userProfile','nutritionist'])->get();
return response()->json($conversations);

}

public function store(Request $request)
    {
        $validated = $request->validate([
            'user_profile_id' => 'required|exists:user_profiles,id',
            'nutritionist_id' => 'required|exists:nutritionist_profiles,id',
        ]);

        $conversation = Conversation::create($validated);

        return response()->json($conversation, 201); // 201 Created
    }


    public function show(Conversation $conversation)
    {
        // Return the specified conversation as JSON
        return response()->json($conversation->load(['userProfile', 'nutritionist']));
    }



    public function update(Request $request, Conversation $conversation)
    {
        $validated = $request->validate([
            'user_profile_id' => 'sometimes|exists:user_profiles,id',
            'nutritionist_id' => 'sometimes|exists:nutritionist_profiles,id',
        ]);

        $conversation->update($validated);

        return response()->json($conversation);
    }


    public function destroy(Conversation $conversation)
    {
        $conversation->delete();

        return response()->json(['message' => 'Conversation deleted successfully']);
    }
   
}
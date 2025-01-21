<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Message;
use App\Models\UserProfile;
use App\Models\Conversation;
use App\Models\NutritionistProfile;

use Illuminate\Http\Request;
use App\Models\NutritionistProfile;

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

    public function show(string $id)
    {
        $conversation = Conversation::with(['nutritionist', 'userProfile'])->find($id);

        if (!$conversation) {
            return response()->json(['message' => 'Conversation not found'], 404);
        }

        return response()->json($conversation);
    }



    
    public function nutriconv(string $id)
    {
       $nutriProfile = NutritionistProfile::where('user_id', $id)->first();

        // Check if the user profile exists
        if (!$nutriProfile) {
            return response()->json(['message' => 'User profile not found'], 404);
        }
    
        $conversations = Conversation::with(['nutritionist', 'userProfile'])
        ->with(['messages' => function($query) {
            $query->latest()->limit(1); // Get the latest message for each conversation
        }])
        ->where('nutritionist_id', $nutriProfile->id)
        ->get();
    
        // Check if any conversations are found
        if ($conversations->isEmpty()) {
            return response()->json(['message' => 'No conversations found for this user'], 404);
        }
    
        return response()->json($conversations);
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
   
    public function getConversationByUserAndNutritionist($userId, $nutritionistId)
    {
        // First, validate if the user and nutritionist exist
        $user = UserProfile::find($userId);
        $nutritionist = NutritionistProfile::find($nutritionistId);

        // Check if both user and nutritionist exist
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        if (!$nutritionist) {
            return response()->json(['message' => 'Nutritionist not found'], 404);
        }

        // Try to fetch the conversation
        $conversation = Conversation::with(['nutritionist', 'userProfile'])
            ->where('user_profile_id', $userId)
            ->where('nutritionist_id', $nutritionistId)
            ->first();

        // If no conversation found, create a new one
        if (!$conversation) {
            try {
                $conversation = Conversation::create([
                    'user_profile_id' => $userId,
                    'nutritionist_id' => $nutritionistId,
                ]);
            } catch (\Exception $e) {
                // Log error and return an appropriate response
                \Log::error("Failed to create conversation: " . $e->getMessage());
                return response()->json(['message' => 'Error creating conversation'], 500);
            }
        }

        // Return the conversation data
        return response()->json($conversation);
    }

}
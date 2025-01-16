<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notifications = Notification::all();
    
        return response()->json($notifications);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_profile_id' => 'required|exists:user_profiles,id',
            'nutritionist_id' => 'required|exists:nutritionist_profiles,id',
            'message' => 'required|string',
            'type' => 'required|string',
        ]);

        $notification = Notification::create($validated);
        return response()->json($notification, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id){
        $nutritionistId = $request->input('nutritionist_id');

        if (!$nutritionistId) {
            return response()->json(['message' => 'Nutritionist ID is required'], 400);
        }
        $notifications = Notification::where('nutritionist_id', $nutritionistId)->get();

        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No notifications found for the provided nutritionist ID'], 404);
        }

        return response()->json($notifications);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_profile_id' => 'sometimes|exists:user_profiles,id',
            'nutritionist_id' => 'sometimes|exists:nutritionist_profiles,id',
            'message' => 'sometimes|string',
            'type' => 'sometimes|string',
        ]);

        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->update($validated);
        return response()->json($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $notification = Notification::find($id);

        if (!$notification) {
            return response()->json(['message' => 'Notification not found'], 404);
        }

        $notification->delete();
        return response()->json(['message' => 'Notification deleted successfully']);
    }
}


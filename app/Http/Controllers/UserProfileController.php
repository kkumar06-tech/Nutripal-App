<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserProfile::all();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'user_id' => ['required', 'exists:users,id'], 
            'name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'gender' => ['required', 'in:male,female,other'],
            'fitness_goal' => ['required', 'in:maintenance,weight_loss,muscle_building'],
            'weekly_exercise_frequency' => ['required', 'in:0 days,1-2 days,3-4 days,5-6 days,7 days'],
            'daily_goal_ml' => ['required', 'integer'],
            'daily_goal_calories' => ['required', 'integer']
        ]);

        $profile=UserProfile::create($incomingFields);

        return response()->json($profile, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $profile =  UserProfile::findOrFail($id);

        return response()->json($profile);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $incomingFields = $request->validate([
            'user_id' => ['nullable', 'exists:users,id'], 
            'name' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'weight' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'gender' => ['nullable', 'in:male,female,other'],
            'fitness_goal' => ['nullable', 'in:maintenance,weight_loss,muscle_building'],
            'weekly_exercise_frequency' => ['nullable', 'in:0 days,1-2 days,3-4 days,5-6 days,7 days'],
            'daily_goal_ml' => ['nullable', 'integer'],
            'daily_goal_calories' => ['nullable', 'integer'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            $profile->profile_image = $profileImagePath; 
        }

        $profile = UserProfile::findOrFail($id);

        $profile->update($incomingFields);

        return response()->json($profile);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profile = UserProfile::findOrFail($id);

        $profile->delete();

        return response()->noContent(); //no message
    }
}

<?php

namespace App\Http\Controllers;
use App\Models\UserStat;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use Carbon\Carbon;

class UserStatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all user stats
        $userStats = UserStat::all();
        return response()->json($userStats, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'user_id' => ['required', 'exists:user_profiles,id'], // Ensure the user exists in user_profiles table
            'calories' => ['required', 'integer'],
            'protein' => ['required', 'integer'],
            'fat' => ['nullable', 'integer'],
            'carbs' => ['nullable', 'integer'],
            'liquid_intake' => ['nullable', 'integer'],
        ]);
        $userProfile = UserProfile::where('user_id', $validated['user_id'])->first();

        if (!$userProfile) {
            return response()->json(['message' => 'UserProfile not found'], 404);
        }
    
        $existingStat = UserStat::where('user_profile_id', $userProfile->id) ->where('date', $validated['date']) ->first();
    
        if ($existingStat) {
            return response()->json(['message' => 'Record already exists for this date'], 400);
        }
    
        // Add the user_profile_id to the validated data
        $validated['user_profile_id'] = $userProfile->id;
    
        // Create a new UserStat record
        $userStat = UserStat::create($validated);
    
        // Return the created UserStat
        return response()->json($userStat, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show( $userId)
    {
         $userProfile = UserProfile::where('user_id', $userId)->first();

        if (!$userProfile) {
            return response()->json(['message' => 'UserProfile not found'], 404);
        }
    
        $today = Carbon::today();

        // Check if stats already exist for today
        $userStat = UserStat::where('user_id', $userProfile->id)
                            ->where('date', $today)
                            ->first();

        // If no stats exist for today, create a new entry
        if (!$userStat) {
            // Optionally, set default values or use request data to create the stat
            $userStat = UserStat::create([
                'user_id' => $userProfile->id,
               'date' => $today->format('Y-m-d'),
                'calories' => 0, // Default values, can be adjusted
                'protein' => 0,
                'fat' => 0,
                'carbs' => 0,
                'liquid_intake' => 0,
            ]);
        }

        // Return the stats (either existing or newly created)
        return response()->json($userStat, 200);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'user_id' => ['required', 'exists:user_profiles,id'], // Ensure the user exists in user_profiles table
            'calories' => ['required', 'integer'],
            'protein' => ['required', 'integer'],
            'fat' => ['nullable', 'integer'],
            'carbs' => ['nullable', 'integer'],
            'liquid_intake' => ['nullable', 'integer'],
        ]);

        // Find the UserStat record by ID
        $userStat = UserStat::findOrFail($id);

        // Update the UserStat record with new values
        $userStat->update($validated);

        // Return the updated UserStat
        return response()->json($userStat, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // Find the UserStat record by ID
        $userStat = UserStat::findOrFail($id);

        // Delete the UserStat record
        $userStat->delete();

        // Return success message
        return response()->json(['message' => 'UserStat deleted successfully'], 200);
    }
    

    public function allstats($id) {
        $userProfile = UserProfile::where('user_id', $id)->first();
    
        if (!$userProfile) {
            return response()->json(['message' => 'UserProfile not found'], 404);
        }
    
        $userStats = UserStat::where('user_id', $userProfile->id)->get();
    
        return response()->json($userStats);
    }




}

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
        $userStats = UserStat::all();
        return response()->json($userStats, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:user_profiles,id'], 
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

        $validated['user_profile_id'] = $userProfile->id;

        $userStat = UserStat::create($validated);
    
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

        $userStat = UserStat::where('user_id', $userProfile->id)
                            ->where('date', $today)
                            ->first();

        if (!$userStat) {
            
            $userStat = UserStat::create([
                'user_id' => $userProfile->id,
               'date' => $today->format('Y-m-d'),
                'calories' => 0, 
                'protein' => 0,
                'fat' => 0,
                'carbs' => 0,
                'liquid_intake' => 0,
            ]);
        }

        return response()->json($userStat, 200);
    }


    public function getstatbydate( $userId,$date)
    {
       
    if (!Carbon::hasFormat($date, 'Y-m-d')) {
        return response()->json(['message' => 'Invalid date format. Use YYYY-MM-DD.'], 400);
    }

   
    $userProfile = UserProfile::where('user_id', $userId)->first();

    if (!$userProfile) {
        return response()->json(['message' => 'User profile not found'], 404);
    }

    
    $userStat = UserStat::where('user_id', $userProfile->id)
                        ->where('date', $date)
                        ->first();

    if (!$userStat) {
        $userStat = UserStat::create([
            'user_id' => $userProfile->id,
            'date' => $date,
            'calories' => 0, 
            'protein' => 0,
            'fat' => 0,
            'carbs' => 0,
            'liquid_intake' => 0,
        ]);
    }

   
    return response()->json($userStat, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
       
        $validated = $request->validate([
            'user_id' => ['required', 'exists:user_profiles,id'], 
            'calories' => ['required', 'integer'],
            'protein' => ['required', 'integer'],
            'fat' => ['nullable', 'integer'],
            'carbs' => ['nullable', 'integer'],
            'liquid_intake' => ['nullable', 'integer'],
        ]);

      
        $userStat = UserStat::findOrFail($id);
        $userStat->update($validated);

        return response()->json($userStat, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $userStat = UserStat::findOrFail($id);

        $userStat->delete();

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

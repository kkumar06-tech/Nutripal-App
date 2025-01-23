<?php

namespace App\Http\Controllers;
use App\Models\UserStat;
use Illuminate\Http\Request;
use App\Models\UserProfile;
use Carbon\Carbon;

class UserStatController extends Controller
{
    /*
      Display a listing of the resource.
     */
    public function index()
    {
        $userStats = UserStat::all();
        return response()->json($userStats, 200);
    }

    /*
     find userprofile and make userstat 
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

    /*
      find userprofile using user_id and show today's userstat
     if not exist create one
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


    //get user stat according to particular date

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


    /*
      Update the userstat.
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

    /*
     Remove the specified userstat entry.
     */
    
     public function destroy(int $id)
    {
        $userStat = UserStat::findOrFail($id);

        $userStat->delete();

        return response()->json(['message' => 'UserStat deleted successfully'], 200);
    }
    
//return all the userstat particular to a user using (user_id)

    public function allstats($id) {
        $userProfile = UserProfile::where('user_id', $id)->first();
    
        if (!$userProfile) {
            return response()->json(['message' => 'UserProfile not found'], 404);
        }
    
        $userStats = UserStat::where('user_id', $userProfile->id)->get();
    
        return response()->json($userStats);
    }




}

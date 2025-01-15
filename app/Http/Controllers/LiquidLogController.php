<?php

namespace App\Http\Controllers;

use App\Models\LiquidLog;
use App\Models\UserProfile;
use App\Models\Liquid;
use App\Models\UserStat;
use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class LiquidLogController extends Controller
{
    public function index()
    {


        // Fetch liquid logs with their related liquids and user profile
        $liquidLogs = LiquidLog::with('liquids', 'userProfile')->get();
        return response()->json($liquidLogs);
    }

    /**
     * Store a newly created liquid log in storage.
     */
    public function store(Request $request)
    {

        \Log::info('Request data:', $request->all());

        $validatedData = $request->validate([
            'user_id' => ['required', 'exists:user_profiles,user_id'], 
            'liquid_id' => 'required|exists:liquids,id',
            'total_amount_ml' => 'required|integer|min:1',
        ]);

        $userProfile = UserProfile::where('user_id', $validatedData['user_id'])->first();

        if (!$userProfile) {
            return response()->json(['message' => 'UserProfile not found'], 404);
        }
    
        $liquidLog = LiquidLog::create([
            'user_profile_id' => $userProfile->id,
            'total_amount_ml' => $validatedData['total_amount_ml'], 
        ]);

        $liquidLog->liquids()->attach($validatedData['liquid_id']); 
        $liquid = Liquid::find($validatedData['liquid_id']);
    
        if (!$liquid) {
            return response()->json(['message' => 'Liquid not found'], 404);
        }

        // Update or create user stats
        $userStats = UserStat::where('user_id', $userProfile->id)->first();

        if (!$userStats) {
            // Create new stats entry if not exists
            $userStats = new UserStat();
            $userStats->user_id = $userProfile->id;
            $userStats->liquid_intake = $validatedData['total_amount_ml']; // Set initial liquid intake
            $userStats->save();
        } else {
            // Update existing stats with the new liquid intake
            $userStats->liquid_intake += $validatedData['total_amount_ml'];
            $userStats->save();
        }

        return response()->json(['message' => 'Liquid log created successfully.', 'data' => $liquidLog]);
    }
    

    public function show($user_id)
    {
        $userProfile = UserProfile::where('user_id', $user_id)->first();
    
        if (!$userProfile) {
            return response()->json(['message' => 'UserProfile not found'], 404);
        }
    
        $liquidLog = LiquidLog::with('liquids')->where('user_profile_id', $userProfile->id)->get();
    
        if ($liquidLog->isEmpty()) {
            return response()->json(['message' => 'No food logs found for this user'], 404);
        }
    
        return response()->json($liquidLog);
    }

    /**
     * Update the specified liquid log in storage.
     */
    public function update(Request $request, $id)
    {
        $liquidLog = LiquidLog::findOrFail($id);

        $validatedData = $request->validate([
            'liquid_id' => 'required|exists:liquids,id', 
            'total_amount_ml' => 'required|integer|min:1', 
        ]);

        // Update the liquid log with new values
        $liquidLog->total_amount_ml = $validatedData['total_amount_ml'];
        $liquidLog->save();

        // Update the pivot table (liquid_log_liquid) with the liquid
        $liquidLog->liquids()->sync([$validatedData['liquid_id']]); // Sync with the new liquid

        // Update the user stats
        $userStats = UserStat::where('user_id', $liquidLog->user_profile_id)->first();
        if ($userStats) {
            $userStats->liquid_intake += $validatedData['total_amount_ml'];
            $userStats->save();
        }

        return response()->json(['message' => 'Liquid log updated successfully.', 'data' => $liquidLog]);

    }

    /**
     * Remove the specified liquid log.
     */
    public function destroy($id)
    {
        $liquidLog = LiquidLog::findOrFail($id);

        $amountMl = $liquidLog->total_amount_ml;

        $liquidLog->liquids()->detach(); 
        $liquidLog->delete();

        // Update user stats by removing the liquid amount
        $userStats = UserStat::where('user_id', $liquidLog->user_profile_id)->first();
        if ($userStats) {
            $userStats->liquid_intake -= $amountMl;
            $userStats->save();
        }

    }
}
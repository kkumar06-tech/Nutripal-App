<?php


namespace App\Http\Controllers;
use App\Models\FoodLog;
use App\Models\UserProfile;
use App\Models\Food;
use Illuminate\Support\Facades\Log;
use App\Models\UserStat;

use Illuminate\Http\Request;

class FoodLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all food logs
        $foodLogs = FoodLog::with('foods')->get();

        return response()->json($foodLogs);
    }

    /**
     * Store a newly created food log in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:user_profiles,user_id'], 
            'foods' => ['required', 'array'], // Expecting an array of food IDs
            'foods.*' => ['required', 'exists:foods,id'], // Validate each food ID
        ]);

       
        // Find the user profile by user_id
        $userProfile = UserProfile::where('user_id', $validated['user_id'])->first();
    
        if (!$userProfile) {
            return response()->json(['message' => 'UserProfile not found'], 404);
        }
    
        // Initialize variables for total nutritional values
        $totalCalories = 0;
        $totalProtein = 0;
        $totalFat = 0;
        $totalCarbs = 0;
    
        // Store food logs
        $foodLogs = [];
    
        // Iterate through the foods array and create separate logs for each food
        foreach ($validated['foods'] as $foodId) {
            // Create a new food log record
            $foodLog = FoodLog::create([
                'user_profile_id' => $userProfile->id,
            ]);
    
            // Attach the food to the food log
            $foodLog->foods()->attach($foodId);
    
            // Fetch the food details
            $food = Food::find($foodId);
    
            if ($food) {
                // Accumulate stats for this food
                $totalCalories += $food->calories;
                $totalProtein += $food->protein;
                $totalFat += $food->fat;
                $totalCarbs += $food->carbs;
            }
    
            // Store the food log in the array
            $foodLogs[] = $foodLog;
        }
    
        // Update or create user stats
        $userStats = UserStat::where('user_id', $userProfile->id)->first();
    
        if (!$userStats) {
            // Create new stats entry
            $userStats = new UserStat();
            $userStats->user_id = $userProfile->id;
            $userStats->calories = $totalCalories;
            $userStats->protein = $totalProtein;
            $userStats->fat = $totalFat;
            $userStats->carbs = $totalCarbs;
            $userStats->save();
        } else {
            // Update existing stats
            $userStats->calories += $totalCalories;
            $userStats->protein += $totalProtein;
            $userStats->fat += $totalFat;
            $userStats->carbs += $totalCarbs;
            $userStats->save();
        }
    
        // Return the newly created food logs and a success message
        return response()->json([
            'message' => 'Foods logged successfully',
            'foodLogs' => $foodLogs,
        ], 201);
    }



    public function show($user_id)
    {
        $userProfile = UserProfile::where('user_id', $user_id)->first();
    
        if (!$userProfile) {
            return response()->json(['message' => 'UserProfile not found'], 404);
        }
    
        $foodLog = FoodLog::with('foods')->where('user_profile_id', $userProfile->id)->get();
    
        if ($foodLog->isEmpty()) {
            return response()->json(['message' => 'No food logs found for this user'], 404);
        }
    
        return response()->json($foodLog);
    }


    /**
     * Update the specified food log in storage.
     */
    public function update(Request $request, $id)
    {
              // Validate incoming request data
              $validated = $request->validate([
                'foods' => ['required', 'array'],  // Expecting an array of food IDs
                'foods.*' => ['required', 'exists:foods,id'], // Validate each food ID
            ]);
    
            // Find the food log by ID or fail
            $foodLog = FoodLog::findOrFail($id);
    
            // Detach old foods and attach new ones
            $foodLog->foods()->detach();
            $foodLog->foods()->attach($validated['foods']);
    
            // Recalculate nutritional stats
            $totalCalories = 0;
            $totalProtein = 0;
            $totalFat = 0;
            $totalCarbs = 0;
    
            foreach ($validated['foods'] as $foodId) {
                $food = Food::find($foodId);
                if ($food) {
                    $totalCalories += $food->calories;
                    $totalProtein += $food->protein;
                    $totalFat += $food->fat;
                    $totalCarbs += $food->carbs;
                }
            }
    
            // Update user stats
            $userStats = UserStat::where('user_id', $foodLog->user_profile_id)->first();
            if ($userStats) {
                $userStats->calories += $totalCalories;
                $userStats->protein += $totalProtein;
                $userStats->fat += $totalFat;
                $userStats->carbs += $totalCarbs;
                $userStats->save();
            }
    
            // Return the updated food log
            return response()->json([
                'message' => 'Food log updated successfully',
                'foodLog' => $foodLog,
              ]);
    }

    /**
     * Remove the specified food log from storage.
     */
    public function destroy($id)
    {
      $foodLog = FoodLog::findOrFail($id);

      $foodLog->delete();

      return response()->json(['message' => 'Food log deleted successfully'], 200);
    }
}

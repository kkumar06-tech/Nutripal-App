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
        return response()->json(UserProfile::all());

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingFields = $request->validate([ 
            'name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date'],
            'weight' => ['required', 'numeric'],
            'height' => ['required', 'numeric'],
            'gender' => ['required', 'in:male,female,other'],
            'fitness_goal' => ['required', 'in:maintenance,weight_loss,build_muscle'],
            'weekly_exercise_frequency' => ['required', 'in:sedentary,highly_active,moderately_active,very_active,lightly_active'],
        ]);

      
        // Calculate BMR based on gender
        $age = \Carbon\Carbon::parse($incomingFields['date_of_birth'])->age;
        $weight =  $incomingFields['weight']; // in kg
        $height =  $incomingFields['height']; // in cm
        $gender = $incomingFields['gender'];
        $activityFactor = $this->getActivityFactor($incomingFields['weekly_exercise_frequency']); // Use the updated activity factor
        
        if ($gender == 'male') {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age + 5;
        } else {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age - 161;
        }

        // Calculate TDEE (Total Daily Energy Expenditure)
        $tdee = $bmr * $activityFactor;

        // Calculate hydration goal (30-35 ml per kg)
        $hydrationGoal = $weight * 30; // 30 ml per kg of body weight

        // Adjust the TDEE based on the fitness goal
        $caloriesRange = $this->calculateCaloriesRange($tdee, $incomingFields['fitness_goal']);

        $user_id = auth()->id();
        // Save the data to the database
        $userData = UserProfile::create([
            'user_id' => $user_id,
            'name' =>$incomingFields['name'],
            'date_of_birth' => $incomingFields['date_of_birth'],
            'weight' => $incomingFields['weight'],
            'height' => $incomingFields['height'],
            'gender' => $incomingFields['gender'],
            'fitness_goal' => $incomingFields['fitness_goal'],
            'weekly_exercise_frequency' => $incomingFields['weekly_exercise_frequency'],
            'daily_goal_ml' => $hydrationGoal,
            'daily_goal_calories' => $caloriesRange,
            'profile_image' => $validatedData['profile_image'] ?? null,
        ]);

        return response()->json(['message' => 'User data saved successfully', 'data' => $userData], 201);
    }

    // Function to return activity factor based on exercise level (word)
    private function getActivityFactor($exerciseLevel)
    {
        $activityFactors = [
            'sedentary' => 1.2,
            'lightly_active' => 1.375,
            'moderately_active' => 1.55,
            'very_active' => 1.725,
            'extremely_active' => 1.9,
        ];

        // Default to 1.2 (sedentary) if the exercise level is not recognized
        return $activityFactors[strtolower($exerciseLevel)] ?? 1.2;
    }

    // Function to calculate the calorie range based on fitness goal
    private function calculateCaloriesRange($tdee, $fitnessGoal)
    {
        switch ($fitnessGoal) {
            case 'weight loss':
                return $tdee - ($tdee * 0.2);  // Reduce 20% for weight loss
            case 'maintenance':
                return $tdee;  // No change for maintenance
            case 'weight gain':
                return $tdee + ($tdee * 0.2);  // Add 20% for weight gain
            default:
                return $tdee;  // Default to maintenance if goal is unclear
        }
    }
    


    /**
     * Display the specified resource.
     */
    public function show(string $userId)
    {
        $profile = UserProfile::where('user_id', $userId)->firstOrFail();

        $maxCalories = $profile->daily_goal_calories;

    // calculations (in grams):
        // Protein: 20% of calories, 
        // Fats: 25% of calories,
        // Carbs: Remaining calories (55%)
    
        $proteinCalories = $maxCalories * 0.20; // 20% for protein
        $fatCalories = $maxCalories * 0.25;    // 25% for fats
        $carbCalories = $maxCalories * 0.55;   // Remaining 55% for carbs
    
        $maxProtein = $proteinCalories / 4;  // 1g protein = 4 calories
        $maxFats = $fatCalories / 9;          // 1g fat = 9 calories
        $maxCarbs = $carbCalories / 4;   


        return response()->json([
            'profile' => $profile,
          'calories'=>$maxCalories,
                'protein' => intval($maxProtein), 
                'fat' =>intval($maxFats, 2),
                'carbs' => intval($maxCarbs, 2),
          ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $incomingFields = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'date_of_birth' => ['nullable', 'date'],
            'weight' => ['nullable', 'numeric'],
            'height' => ['nullable', 'numeric'],
            'gender' => ['nullable', 'in:male,female,other'],
            'fitness_goal' => ['nullable', 'in:maintenance,weight_loss,build_muscle'],
            'weekly_exercise_frequency' => ['in:sedentary,highly_active,moderately_active,very_active,lightly_active'],
            'daily_goal_ml' => ['nullable', 'integer'],
            'daily_goal_calories' => ['nullable', 'integer'],
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
        ]);

        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            $profile->profile_image = $profileImagePath; 
        }

        $profile = UserProfile::findOrFail($id);
        
        if ($profile->user_id !== Auth::id()) {
            return response()->json(['message' => 'You cannot update another user\'s profile.'], 403);
        }

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

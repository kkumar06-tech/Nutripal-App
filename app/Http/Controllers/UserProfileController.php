<?php

namespace App\Http\Controllers;

use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\UserStat;
use App\Models\User;
use Carbon\Carbon;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(UserProfile::all());

    }

    public function getUserProfiles(Request $request)
    {
        $userProfileIds = $request->input('user_profile_ids');
    
        if (empty($userProfileIds)) {
            return response()->json(['message' => 'No user profile IDs provided'], 400);
        }
    
        $userProfiles = UserProfile::whereIn('id', $userProfileIds)->get(); 
    
        if ($userProfiles->isEmpty()) {
            return response()->json(['message' => 'No user profiles found'], 404);
        }
    
        $defaultImage = asset('storage/default_images/default.jpg'); 

        $formattedProfiles = $userProfiles->map(function ($profile) use ($defaultImage) {
            $imageUrl = $profile->profile_image 
                ? asset($profile->profile_image) 
                : $defaultImage; 
    
            return [
                'id' => $profile->id,
                'name' => $profile->name,
                'focus' => $profile->fitness_goal,
                'image' => $imageUrl, 
            ];
        });
    
        return response()->json($formattedProfiles);
    }



    public function getProfile($id)
    {
        $profile = UserProfile::where('id', $id)->firstOrFail();
      
        $userStat = UserStat::where('user_id', $id)
        ->where('date', Carbon::today())
        ->first();


        $dateOfBirth= $profile->date_of_birth;
        $age = \Carbon\Carbon::parse($dateOfBirth)->age;
        

        $defaultImage = asset('storage/default_images/default.jpg'); 

        $imageUrl = $profile->profile_image 
        ? asset($profile->profile_image) 
        : $defaultImage;

        
        $formattedProfile = [
            'name' => $profile->name,
            'Image' => $imageUrl,
            'gender' => $profile->gender,
            'age' => $age,
            'username' => $profile->name,
            'height' => $profile->height,
            'weight' => $profile->weight,
            'goal' => $profile->fitness_goal, // Assuming this maps to 'goal'
            'totalCaloriesIntake' => $userStat->calories, // Assuming this is the field name
            'frequency' => $profile->weekly_exercise_frequency, // Assuming this is the field name
        'goalcal'=>$profile->daily_goal_calories
        ];

        return response()->json($formattedProfile); 
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
            'fitness_goal' => ['required', 'in:maintainance,weight_loss,build_muscle'],
            'weekly_exercise_frequency' => ['required', 'in:sedentary,highly_active,moderately_active,very_active,lightly_active'],
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

      
        // Calculate BMR based on gender
        $age = \Carbon\Carbon::parse($incomingFields['date_of_birth'])->age;
        $weight =  $incomingFields['weight']; 
        $height =  $incomingFields['height']; 
        $gender = $incomingFields['gender'];
        $activityFactor = $this->getActivityFactor($incomingFields['weekly_exercise_frequency']); 
        
        if ($gender == 'male') {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age + 5;
        } else {
            $bmr = 10 * $weight + 6.25 * $height - 5 * $age - 161;
        }

        $tdee = $bmr * $activityFactor;

        // Calculate hydration goal (30-35 ml per kg)
        $hydrationGoal = $weight * 30; 

        // Adjust the TDEE based on the fitness goal
        $caloriesRange = $this->calculateCaloriesRange($tdee, $incomingFields['fitness_goal']);
      
        $profileImage = $incomingFields['profile_image'] ?? null;

        if (!$profileImage) {
            $profileImage = 'default_images/default.jpg'; 
        } else {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
        }

        $user_id = auth()->id();
        
        $userData = UserProfile::create([
            'user_id' => $incomingFields['user_id'],
            'name' =>$incomingFields['name'],
            'date_of_birth' => $incomingFields['date_of_birth'],
            'weight' => $incomingFields['weight'],
            'height' => $incomingFields['height'],
            'gender' => $incomingFields['gender'],
            'fitness_goal' => $incomingFields['fitness_goal'],
            'weekly_exercise_frequency' => $incomingFields['weekly_exercise_frequency'],
            'daily_goal_ml' => $hydrationGoal,
            'daily_goal_calories' => $caloriesRange,
            'profile_image' => $profileImage,
        ]);

        return response()->json(['message' => 'User data saved successfully', 'data' => $userData], 201);
    }

    private function getActivityFactor($exerciseLevel)
    {
        $activityFactors = [
            'sedentary' => 1.2,
            'lightly_active' => 1.375,
            'moderately_active' => 1.55,
            'very_active' => 1.725,
            'extremely_active' => 1.9,
        ];
        return $activityFactors[strtolower($exerciseLevel)] ?? 1.2;
    }

  
    private function calculateCaloriesRange($tdee, $fitnessGoal)
    {
        switch ($fitnessGoal) {
            case 'weight loss':
                return $tdee - ($tdee * 0.2);  
            case 'maintenance':
                return $tdee;  
            case 'weight gain':
                return $tdee + ($tdee * 0.2);  
            default:
                return $tdee;  
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $userId)
    {
        $profile = UserProfile::where('user_id', $userId)->firstOrFail();


        $defaultImage = asset('storage/default_images/default.jpg'); 

        $imageUrl = $profile->profile_image 
            ? asset($profile->profile_image) 
            : $defaultImage;


        $maxCalories = $profile->daily_goal_calories;

    
        $proteinCalories = $maxCalories * 0.20; 
        $fatCalories = $maxCalories * 0.25;    
        $carbCalories = $maxCalories * 0.55;  
    
        $maxProtein = $proteinCalories / 4;  
        $maxFats = $fatCalories / 9;          
        $maxCarbs = $carbCalories / 4;   


        return response()->json([
                'profile' => $profile,
                'profile_image_url'=>$imageUrl,
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

        return response()->noContent(); 
    }

    public function getUserProfileById($id)
    {
        $profile = UserProfile::where('id', $id)->firstOrFail();

        return response()->json($profile);
    }
}

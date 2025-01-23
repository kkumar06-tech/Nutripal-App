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


    //return the userprofiles according to an array of ids provided in request
    //used in nutritionist section for patient page

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


//get the userprofile using the (userProfile id)
//used in nutritionist showing patient daily progress

    public function getProfile($id)
{
    $profile = UserProfile::where('id', $id)->first();

    if (!$profile) {
        return response()->json(['error' => 'Profile not found'], 404);
    }

    $userStat = UserStat::where('user_id', $id)
        ->where('date', Carbon::today())
        ->first();

    $dateOfBirth = $profile->date_of_birth ?? '1970-01-01';
    $age = \Carbon\Carbon::parse($dateOfBirth)->age;

    $defaultImage = asset('storage/default_images/default.jpg');
    $imageUrl = $profile->profile_image 
        ? asset($profile->profile_image) 
        : $defaultImage;

    $formattedProfile = [
        'name' => $profile->name, 
        'Image' => $imageUrl, 
        'gender' => $profile->gender ?? 'Unknown', 
        'age' => $age, 
        'username' => $profile->name, 
        'height' => $profile->height ?? 0, 
        'weight' => $profile->weight ?? 0, 
        'goal' => $profile->fitness_goal ?? 'Unknown', 
        'totalCaloriesIntake' => $userStat->calories ?? 0, 
        'frequency' => $profile->weekly_exercise_frequency ?? 0, 
        'goalcal' => $profile->daily_goal_calories ?? 0, 
    ];

    
    return response()->json($formattedProfile);
}



    /**
     * Store a newly created userProfile and calculate the GOAL CALORIES and GOAL LIQUID intake acc to QUIZ DATA
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
            'fitness_goal' => ['required', 'in:maintenance,weight_loss,build_muscle'],
            'weekly_exercise_frequency' => ['required', 'in:sedentary,lightly_active,moderately_active,very_active,extremely_active'],
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

        $caloriesRange = round($caloriesRange, 1);
      
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
     *
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

    //get userProfile using (userProfileId)
    public function getUserProfileById($id)
    {
        $profile = UserProfile::where('id', $id)->firstOrFail();

        return response()->json($profile);
    }
}

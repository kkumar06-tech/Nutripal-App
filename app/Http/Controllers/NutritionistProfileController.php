<?php

namespace App\Http\Controllers;
use App\Models\NutritionistProfile;
use Illuminate\Http\Request;


class NutritionistProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nutriProfiles= NutritionistProfile::all();
        $nutriProfiles->transform(function ($profile) {
            $profile->profile_image_url = $profile->profile_image ? asset('storage/' . $profile->profile_image) : null;
            return $profile;
        });


        return response()->json($nutriProfiles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingFields = $request->validate([ 
            'user_id' => ['required', 'exists:users,id'],
            'name' => ['required', 'string', 'max:255'],
            'credentials' => ['required', 'string'],
            'certificate_image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'] ,
            'profile_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'bio_description'=> ['nullable', 'string', 'max:255'],
        ]);

        if($request->hasFile('certificate_image')){
            $certificatePath = $request->file('certificate_image')->store('certificates','public');

            $incomingFields['certificate_image'] = $certificatePath;
            $user_id = auth()->id();
           
            $nutri = NutritionistProfile::create([
                'user_id' =>$incomingFields['user_id'],
                'name' =>$incomingFields['name'],
                'certificate_image'=>$incomingFields['certificate_image'], 
                'credentials'=>$incomingFields['credentials'],
                'profile_image'=>$incomingFields['profile_image'] ?? null, 
                'bio_description'=>$incomingFields['bio_description'] ?? null
            ]);

            return response()->json($nutri, 201);
        }
        //if no file is uploaded
        return response()->json(['message' => 'No file uploaded.'], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $nutri = NutritionistProfile::findOrFail($id);
       
        $nutri->profile_image_url = $nutri->profile_image
        ? asset($nutri->profile_image)
        : null;
       
        return $nutri;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $incomingFields = $request->validate([
            'profile_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'bio_description' => ['nullable', 'string']
        ]);
        $nutri = NutritionistProfile::findOrFail($id);

        if ($nutri->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if ($request->hasFile('profile_image')) {
            $profileImagePath = $request->file('profile_image')->store('profile_images', 'public');
            $incomingFields['profile_image'] = $profileImagePath;
        }

        $nutri->update($incomingFields);

        return response()->json($nutri, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nutri = NutritionistProfile::findOrFail($id);

        $nutri->delete();

        return response()->noContent();
    }

    public function getProfileByUserId($user_id)
    {
        
        $nutritionistProfile = NutritionistProfile::where('user_id', $user_id)->first();

        if (!$nutritionistProfile) {
            return response()->json(['message' => 'Nutritionist profile not found'], 404);
        }

        return response()->json($nutritionistProfile);
    }




    public function getNutriProfiles(Request $request)
    {
        $nutriProfileIds = $request->input('nutri_profile_ids'); // Get the array of IDs
    
        if (empty($nutriProfileIds)) {
            return response()->json(['message' => 'No user profile IDs provided'], 400);
        }
    
        $nutriProfiles = NutritionistProfile::whereIn('id', $nutriProfileIds)->get(); // Fetch profiles based on IDs
    
        if ($nutriProfiles->isEmpty()) {
            return response()->json(['message' => 'No user profiles found'], 404);
        }
    
        $defaultImage = asset('default_images/default.jpg'); 

        $formattedProfiles = $nutriProfiles->map(function ($profile) use ($defaultImage) {
            $imageUrl = $profile->profile_image 
                ? asset($profile->profile_image) 
                : $defaultImage; 
    
            return [
                'id' => $profile->id,
                'name' => $profile->name,
                'title' => $profile->credentials,
                'image' => $imageUrl,
                'rating' => $rating, 
                'total_ratings' => $totalRatings,
            ];
        });
    
        return response()->json($formattedProfiles); 
    }


}

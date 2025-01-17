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
            'credentials' => ['required', 'string'],
            'certificate_image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'] 
        ]);

        if($request->hasFile('certificate_image')){
            $certificatePath = $request->file('certificate_image')->store('certificates','public');

            $incomingFields['certificate_image'] = $certificatePath;
            $incomingFields['user_id'] = Auth::id();

            $nutri = NutritionistProfile::create($incomingFields);

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
        ? asset('storage/' . $nutri->profile_image)
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
}

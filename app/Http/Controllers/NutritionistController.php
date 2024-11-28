<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NutritionistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Nutritionist::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'user_id' => ['required', 'exists:users,id'], 
            'credentials' => ['required', 'string'],
            'certificate_image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:2048'] 
        ]);

        if($request->hasFile('certificate_image')){
            $certificatePath = $request->file('certificate_image')->store('certificates','public');

            $nutri = Nutritionist::create($incomingFields);

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
        $nutri = Nutritionist::findOrFail($id);

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
        $nutri = Nutritionist::findOrFail($id);

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
        $nutri = Nutritionist::findOrFail($id);

        $nutri->delete();

        return response()->noContent();
    }
}

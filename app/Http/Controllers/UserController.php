<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use App\Models\NutritionistProfile;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(User::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $incomingFields = $request->validate( [
        'username' => ['required', 'min:3'],
        'email' => ['required', 'email'],
        'password'=>['required', 'min:8'],
        'role' => ['required', 'in:user,nutritionist']
        ]);

        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $user = User::create($incomingFields);

        return $user;
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $user = User::findOrFail($id);

       return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $incomingFields = $request->validate([
            'username' =>['required', 'min:3'],
            'email' => ['required', 'email'],
            'password' => ['nullable', 'min:8'],
            'role' => ['required', 'in:user,nutritionist']
            
        ]);

        $user=User::findOrFail($id);

        if($request->has('password')){
            $incomingFields['password'] = bcrypt($incomingFields['password']);
        }

        $user->update($incomingFields);

        return response()->json($user);;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json(['message'=> 'User Account Deleted.'], 200);
    }

      /**
     * Get Nutritionist Profile by User ID.
     */
    public function getNutritionistProfile($user_id)
    {
        $nutritionistProfile = NutritionistProfile::where('user_id', $user_id)->first();

        if ($nutritionistProfile) {
            return response()->json($nutritionistProfile);
        }

        return response()->json(['message' => 'Nutritionist profile not found.'], 404);
    }

    /**
     * Get User Profile by User ID.
     */
    public function getUserProfile($user_id)
    {
        $userProfile = UserProfile::where('user_id', $user_id)->first();

        if ($userProfile) {
            return response()->json($userProfile);
        }

        return response()->json(['message' => 'User profile not found.'], 404);
    }
}

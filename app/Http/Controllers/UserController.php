<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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

       return reponse()->json($user);
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
}

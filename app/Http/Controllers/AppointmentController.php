<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\UserProfile;
use App\Models\NutritionistProfile;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        // Fetch all appointments
        $appointments = Appointment::all();

        return response()->json($appointments, 200);
    }





 public function nutriAppointments($id)  {
    $nutritionistProfile = NutritionistProfile::where('user_id', $id)->first();

    if (!$nutritionistProfile) {
        return response()->json(['message' => 'Nutritionist profile not found for this user.'], 404);
    }

    // Fetch appointments for the given nutritionist profile
    $appointments = Appointment::where('nutritionist_profile_id', $nutritionistProfile->id)->get();

    // Check if there are no appointments for the nutritionist
    if ($appointments->isEmpty()) {
        return response()->json(['message' => 'No appointments found for this nutritionist.'], 404);
    }

    return response()->json($appointments, 200);
}

public function userAppointments($id)  {
    $userProfile = UserProfile::where('user_id', $id)->first();

    if (!$userProfile) {
        return response()->json(['message' => 'User profile not found for this user.'], 404);
    }

    // Fetch appointments for the given nutritionist profile
    $appointments = Appointment::where('user_profile_id', $userProfile->id)->get();

    // Check if there are no appointments for the nutritionist
    if ($appointments->isEmpty()) {
        return response()->json(['message' => 'No appointments found for this nutritionist.'], 404);
    }

    return response()->json($appointments, 200);
}




    /**
     * Store a newly created appointment.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'nutritionist_profile_id' => ['required', 'exists:nutritionist_profiles,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
        ]);

        $userProfile = UserProfile::where('user_id', $validated['user_id'])->first();

        if (!$userProfile) {
            return response()->json(['error' => 'User profile not found for the given user ID'], 404);
        }
    
        // Add the user_profile_id to the validated data
        $validated['user_profile_id'] = $userProfile->id;
    
        // Remove user_id as it's not needed for appointment creation
        unset($validated['user_id']);
        
        $appointment = Appointment::create($validated);

        return response()->json($appointment, 201);
    }

    /**
     * Display the specified appointment.
     */
    public function show(string $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        return response()->json($appointment, 200);
    }

    /**
     * Update the specified appointment.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_profile_id' => ['required', 'exists:user_profiles,id'],
            'nutritionist_profile_id' => ['required', 'exists:nutritionist_profiles,id'],
            'date' => ['required', 'date', 'after_or_equal:today'],
            'time' => ['required', 'date_format:H:i'],
        ]);

        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->update($validated);

        return response()->json($appointment, 200);
    }

    /**
     * Remove the specified appointment.
     */
    public function destroy(string $id)
    {
        $appointment = Appointment::find($id);

        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted successfully'], 200);
    }
}
   
   
   
   
    /*
   
   
   //   Display a listing of the resource.
     
    public function index()
    {

        // Fetch all user stats
        $userStats = Appointment::all();
        return response()->json($userStats, 200);

       /* $user = auth()->user(); 

        // display the list of appointment of user or nutritionist

        if($user->role == "user"){
            $appointments = $user->userProfile->userAppointments()->get();
        } elseif ($user->role == 'nutritionist'){
            $appointments = $user->nutritionistProfile->nutritionistAppointments()->get();
        }
        return response()->json($appointments) ;


    }

    
     // Store a newly created resource in storage.
     
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_profile_id' => ['required', 'exists:user_profiles,id'],
            'nutritionist_id'  => ['required','exists:user_profiles,id'],
            'date' => ['required','after_or_equal:today'],
            'time' => ['required','date','date_format:H:i'],
        ]);
        $appointment = Appointment::create($validated);
        return response()->json($appointment,201) ;
    }

    
    //  Display the specified resource.
     
    public function show(string $id)
    {
        $user = auth()->user(); 


        if($user->role == "user"){

            // Retrieve the appointment from the user's appointments to ensure it belongs to the current user
            $appointments = $user->userProfile->userAppointments()->find( $id );

        } elseif ($user->role == 'nutritionist'){

            // Retrieve the appointment from the nutritionist's appointments to ensure it belongs to the current nutritionist
            $appointments = $user->nutritionistProfile->nutritionistAppointments()->find( $id );

        }
        return response()->json($appointments) ;

    }

    
    //  Update the specified resource in storage.
     
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'user_profile_id' => ['required', 'exists:user_profiles,id'],
            'nutritionist_id'  => ['required','exists:user_profiles,id'],
            'date' => ['required','after_or_equal:today'],
            'time' => ['required','date_format:H:i'],
        ]);
        $appointment = Appointment::find($id);
        $appointment->update($validated);
        return response()->json($appointment,200);
    }

    
    //  Remove the specified resource from storage.
     
    public function destroy(string $id)
    {
        $user = auth()->user(); 


        if($user->role == "user"){

            // Retrieve the appointment from the user's appointments to ensure it belongs to the current user
            $appointments = $user->userProfile->userAppointments()->find( $id );
            $appointments = $appointments->delete();

        } elseif ($user->role == 'nutritionist'){

            // Retrieve the Appointment from the nutritionist's appointments to ensure it belongs to the current nutritionist
            $appointments = $user->nutritionistProfile->nutritionistAppointments()->find( $id );
            $appointments = $appointments->delete();

        }
        return response()->json(['message' => 'Appointment deleted successfully']);

    }
}*/

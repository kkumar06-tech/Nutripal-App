<?php

namespace App\Http\Controllers;

use App\Models\Liquid;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user(); 

        // display the list of appointment of user or nutritionist

        if($user->role == "user"){
            $appointments = $user->userProfile->userAppointments()->get();
        } elseif ($user->role == 'nutritionist'){
            $appointments = $user->nutritionistProfile->nutritionistAppointments()->get();
        }
        return response()->json($appointments) ;


    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
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

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
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
}

<?php

namespace App\Http\Controllers;

use App\Models\MealPlan;
use Illuminate\Http\Request;

class MealPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Retrieve all meal plans
        $mealPlans = MealPlan::all();
        
        // Return the list of meal plans as a JSON response
        return response()->json($mealPlans);
    }

    /**
     * Store a newly created meal plan in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:user_profiles,id',  // Ensure user_id exists in user_profiles table
            'recipe_id' => 'required|exists:recipes,id',  // Ensure recipe_id exists in recipes table
            'date' => 'required|date',  // Ensure the date is in a valid format
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);  // Return errors if validation fails
        }

        // Create a new meal plan
        $mealPlan = MealPlan::create([
            'user_id' => $request->user_id,
            'recipe_id' => $request->recipe_id,
            'date' => $request->date,
        ]);

        return response()->json($mealPlan, 201);  // Return the created meal plan with a 201 status code
    }

    /**
     * Display the specified meal plan.
     */
    public function show($id)
    {
        // Find the meal plan by ID
        $mealPlan = MealPlan::find($id);

        if (!$mealPlan) {
            return response()->json(['message' => 'Meal Plan not found'], 404);  // Return 404 if meal plan is not found
        }

        return response()->json($mealPlan);  // Return the meal plan as a JSON response
    }

    /**
     * Update the specified meal plan in storage.
     */
    public function update(Request $request, $id)
    {
        // Find the meal plan by ID
        $mealPlan = MealPlan::find($id);

        if (!$mealPlan) {
            return response()->json(['message' => 'Meal Plan not found'], 404);  // Return 404 if meal plan is not found
        }

        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|exists:user_profiles,id',
            'recipe_id' => 'required|exists:recipes,id',
            'date' => 'required|date',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Update the meal plan
        $mealPlan->update([
            'user_id' => $request->user_id,
            'recipe_id' => $request->recipe_id,
            'date' => $request->date,
        ]);

        return response()->json($mealPlan);  // Return the updated meal plan as a JSON response
    }

    /**
     * Remove the specified meal plan from storage.
     */
    public function destroy($id)
    {
        // Find the meal plan by ID
        $mealPlan = MealPlan::find($id);

        if (!$mealPlan) {
            return response()->json(['message' => 'Meal Plan not found'], 404);  // Return 404 if meal plan is not found
        }

        // Delete the meal plan
        $mealPlan->delete();

        return response()->json(['message' => 'Meal Plan deleted successfully']);  // Return success message
    }


}

        /*
    public function index()
    {
        $mealPlans = MealPlan::all(); // Fetch all meal plans from the database
    
    return response()->json($mealPlans);

       // $plans = auth()->user()->userProfile->mealPlans()->get();
        //return response()->json($plans);

    }

    
    // Store a newly created resource in storage.
     
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_profile_id' => ['required', 'exists:user_profiles,id'],
            'recipe_id' => ['required','exists:recipe,id'],
            'date' => ['required','date']
        ]);
        $plans = MealPlan::create($validated);
        return response()->json($plans);

    }

    
     // Display the specified resource.
     
    public function show(string $id)
    {
        // to show a specific mealplan with specific id plan for specific user
        $plan = auth()->user()->userProfile->mealPlans()->findOrFail($id);
        return response()->json($plan);
        
    }

    
     // Update the specified resource in storage.
     
    public function update(Request $request, string $id)
    {
        $plan = auth()->user()->userProfile->mealPlans()->findOrFail($id);

        $validated = $request->validate([
            'user_profile_id' => ['required', 'exists:user_profiles,id'],
            'recipe_id' => ['required','exists:recipe,id'],
            'date' => ['required','date']
        ]);
        $plan->update($validated);
        return response()->json($plan,200);

    }

    
    //  Remove the specified resource from storage.
     
    public function destroy(string $id)
    {
        $plan = auth()->user()->userProfile->mealPlans()->findOrFail($id);
        $plan->delete();
        return response()->json(['message' => 'MealPlan of this user deleted successfully']);

    }*/


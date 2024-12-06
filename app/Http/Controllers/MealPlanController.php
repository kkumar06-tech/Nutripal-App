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
        $mealPlans = MealPlan::with('recipes')->get();
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
        
        $mealPlan = MealPlan::with('recipes')->find($id);
    
  
        if (!$mealPlan) {
            return response()->json(['message' => 'Meal Plan not found'], 404);
        }
    
        
        return response()->json($mealPlan);
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




  public function usermealplan($userId)
     {
         // Get paginated meal plans for the specific user
         $mealPlans = MealPlan::where('user_id', $userId)
                              ->with('recipes')
                              ->paginate(10);  // Paginate, 10 results per page
     
         if ($mealPlans->isEmpty()) {
             return response()->json(['message' => 'No meal plans found for this user'], 404);
         }
     
         return response()->json($mealPlans);  // Return paginated meal plans with recipes
     }

}

     
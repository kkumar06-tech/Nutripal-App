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
        //Display the list of meal plan of user
        $plans = auth()->user()->userProfile->mealPlans()->get();
        return response()->json($plans);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // to show a specific mealplan with specific id plan for specific user
        $plan = auth()->user()->userProfile->mealPlans()->findOrFail($id);
        return response()->json($plan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {   
        $plan = auth()->user()->userProfile->mealPlans()->findOrFail($id);
        $plan->delete();
        return response()->json(['message' => 'MealPlan of this user deleted successfully']);
    }
}

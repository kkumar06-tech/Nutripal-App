<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $foods = Food::all(); // Retrieve all foods
        $foods->transform(function ($food) {
            $food->food_image_url = $food->food_image ? asset('storage/' . $food->food_image) : null;
            return $food;
        });
        return response()->json($foods);
    }

    /**
     * Store a newly created food in the database.
     */
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'meal_type'=>['required','in:Breakfast,Lunch,Snack,Dinner'],
            'calories' => 'required|integer',
            'protein' => 'required|integer',
            'carbs' => 'required|integer',
            'fat' => 'required|integer',
            'portion' => 'required|integer',
            'food_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048'],
            'cuisine_type' => 'nullable|string|max:255',        
            'cooking_time' => 'nullable|integer',        
            'dietary_preferences' => 'nullable|string|max:255',
        ]);

        try {

            if ($request->hasFile('food_image')) {

                if ($food->food_image) {
                    Storage::disk('public')->delete($food->food_image);
                }
                
                $validated['food_image'] = $request->file('food_image')->store('food_images', 'public');
            }

            // Create a new food item
            $food = Food::create($validated);
    
            return response()->json($food, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to create food item'], 500);
        }
    }

    /**
     * Display the specified food.
     */
    public function show($id)
    {
        $food = Food::findOrFail($id); // Find the food by id or fail if not found
        $food->food_image_url = $food->food_image ? asset('storage/' . $food->food_image) : null;
        return response()->json($food);
    }

    /**
     * Update the specified food in the database.
     */
    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id); // Find the food by id or fail if not found

       /* 
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'calories' => 'required|integer',
            'protein' => 'required|integer',
            'carbs' => 'required|integer',
            'fat' => 'required|integer',
            'portion' => 'required|integer',
        ]);*/


        $food->update($request->all());

        return response()->json($food);
    }

    /**
     * Remove the specified food from the database.
     */
    public function destroy($id)
    {
        $food = Food::findOrFail($id); 
        $food->delete(); // Delete the food

        return response()->json(['message' => 'Food deleted successfully'],200);
    }



    public function suggest($mealtype)
    {
        try {
            // Retrieve a random food item based on meal type
            $food = Food::where('meal_type', $mealtype)->inRandomOrder()->first(); // Corrected reference to $mealtype
    
            if ($food) {
            
                return response()->json($food);
            } else {
                return response()->json(['message' => 'No food found for the specified meal type'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unable to fetch food suggestion'], 500);
        }

    }

    public function applyFilters(Request $request)
{
    $calorieRange = $request->input('calorieRange');
    $selectedCuisines = $request->input('selectedCuisines');
    $selectedTime = $request->input('selectedTime');
    $selectedDietary = $request->input('selectedDietary');
    $selectedMeals = $request->input('selectedMeals');

    $foods = Food::query();

    if ($calorieRange && count($calorieRange) == 2) {
        $foods->whereBetween('calories', $calorieRange);
    }

    if ($selectedCuisines && count($selectedCuisines) > 0) {
        $foods->whereIn('cuisine_type', $selectedCuisines);
    }
    if ($selectedTime) {
       
        $timeRange = explode('-', $selectedTime); 
        
        if (count($timeRange) == 2) {
            $minTime = trim($timeRange[0]); // Get the min time
            $maxTime = trim($timeRange[1]); // Get the max time

            $foods->whereBetween('cooking_time', [(int)$minTime, (int)$maxTime]);
        }
    }

    if ($selectedDietary && count($selectedDietary) > 0) {
        $foods->whereIn('dietary_preferences', $selectedDietary);  // Make sure your DB column matches
    }

    if ($selectedMeals && count($selectedMeals) > 0) {
        $foods->whereIn('meal_type', $selectedMeals);
    }

    $foods = $foods->get();

    return response()->json($foods);
}

}
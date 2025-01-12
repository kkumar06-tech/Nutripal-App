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
            'meal_type'=>['required','in:breakfast,lunch,snack,dinner'],
            'calories' => 'required|integer',
            'protein' => 'required|integer',
            'carbs' => 'required|integer',
            'fat' => 'required|integer',
            'portion' => 'required|integer',
            'food_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:2048']
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
}

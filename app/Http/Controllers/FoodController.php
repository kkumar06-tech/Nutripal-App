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
            'calories' => 'required|integer',
            'protein' => 'required|integer',
            'carbs' => 'required|integer',
            'fat' => 'required|integer',
            'portion' => 'required|integer',
        ]);

        // Create a new food item
        $food = Food::create($validated);

        return response()->json($food, 201); // Return the created food
    }

    /**
     * Display the specified food.
     */
    public function show($id)
    {
        $food = Food::findOrFail($id); // Find the food by id or fail if not found
        return response()->json($food);
    }

    /**
     * Update the specified food in the database.
     */
    public function update(Request $request, $id)
    {
        $food = Food::findOrFail($id); // Find the food by id or fail if not found

        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'calories' => 'required|integer',
            'protein' => 'required|integer',
            'carbs' => 'required|integer',
            'fat' => 'required|integer',
            'portion' => 'required|integer',
        ]);


        $food->update($validated);

        return response()->json($food);
    }

    /**
     * Remove the specified food from the database.
     */
    public function destroy($id)
    {
        $food = Food::findOrFail($id); 
        $food->delete(); // Delete the food

        return response()->json(['message' => 'Food deleted successfully']);
    }
}

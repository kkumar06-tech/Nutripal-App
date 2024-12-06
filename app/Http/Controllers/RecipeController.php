<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of recipes.
     */
    public function index()
    {
        $recipes = Recipe::all();
        return response()->json($recipes, 200);
    }

    /**
     * Store a newly created recipe in storage.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|string',
            'cooking_time' => 'required|integer',
            'difficulty' => 'required|string|max:50',
            'cuisine_type' => 'required|string|max:100',
            'meal_type' => 'required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Create the recipe
        $recipe = Recipe::create($validator->validated());

        return response()->json(['message' => 'Recipe created successfully', 'recipe' => $recipe], 201);
    }

    /**
     * Display the specified recipe.
     */
    public function show($id)
    {
        $recipe = Recipe::find($id);

        if (!$recipe) {
            return response()->json(['message' => 'Recipe not found'], 404);
        }

        return response()->json($recipe, 200);
    }

    /**
     * Update the specified recipe in storage.
     */
    public function update(Request $request, $id)
    {
        $recipe = Recipe::find($id);

        if (!$recipe) {
            return response()->json(['message' => 'Recipe not found'], 404);
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image' => 'sometimes|required|string',
            'cooking_time' => 'sometimes|required|integer',
            'difficulty' => 'sometimes|required|string|max:50',
            'cuisine_type' => 'sometimes|required|string|max:100',
            'meal_type' => 'sometimes|required|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Update the recipe
        $recipe->update($validator->validated());

        return response()->json(['message' => 'Recipe updated successfully', 'recipe' => $recipe], 200);
    }

    /**
     * Remove the specified recipe from storage.
     */
    public function destroy($id)
    {
        $recipe = Recipe::find($id);

        if (!$recipe) {
            return response()->json(['message' => 'Recipe not found'], 404);
        }

        $recipe->delete();

        return response()->json(['message' => 'Recipe deleted successfully'], 200);
    }
}
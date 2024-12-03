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
        $recipes = Recipe::with(['ingredients', 'filters'])->get();
        return response()->json($recipes);
    }

    /**
     * Show the form for creating a new recipe.
     */
    public function create()
    {
        return view('recipes.create');
    }

    /**
     * Store a newly created recipe in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'cooking_time' => 'required|integer',
            'difficulty' => 'required|string',
            'cuisine_type' => 'required|string',
            'meal_type' => 'required|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images/recipes', 'public');
        }

        $recipe = Recipe::create($validatedData);

        // Attach ingredients (if provided)
        if ($request->has('ingredients')) {
            foreach ($request->ingredients as $ingredientData) {
                $recipe->ingredients()->create($ingredientData);
            }
        }

        return response()->json(['message' => 'Recipe created successfully!', 'recipe' => $recipe], 201);
    }

    /**
     * Display the specified recipe.
     */
    public function show($id)
    {
        $recipe = Recipe::with(['ingredients', 'filters', 'likedByUsers', 'mealPlans'])->findOrFail($id);
        return response()->json($recipe);
    }

    /**
     * Show the form for editing the specified recipe.
     */
    public function edit($id)
    {
        $recipe = Recipe::findOrFail($id);
        return view('recipes.edit', compact('recipe'));
    }

    /**
     * Update the specified recipe in storage.
     */
    public function update(Request $request, $id)
    {
        $recipe = Recipe::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
            'cooking_time' => 'required|integer',
            'difficulty' => 'required|string',
            'cuisine_type' => 'required|string',
            'meal_type' => 'required|string',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('images/recipes', 'public');
        }

        $recipe->update($validatedData);

        return response()->json(['message' => 'Recipe updated successfully!', 'recipe' => $recipe]);
    }

    /**
     * Remove the specified recipe from storage.
     */
    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);
        $recipe->delete();

        return response()->json(['message' => 'Recipe deleted successfully!']);
    }
}

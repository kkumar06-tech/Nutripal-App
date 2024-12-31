<?php

namespace App\Http\Controllers;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return response()->json($ingredients);
    }

    /**
     * Store a newly created ingredient in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:ingredients,name',
        ]);

        $ingredient = Ingredient::create($validatedData);

        return response()->json(['message' => 'Ingredient created successfully.', 'data' => $ingredient]);
    }

    /**
     * Display the specified ingredient.
     */
    public function show($id)
    {
        $ingredient = Ingredient::findOrFail($id);
        return response()->json($ingredient);
    }

    /**
     * Update the specified ingredient in storage.
     */
    public function update(Request $request, $id)
    {
        $ingredient = Ingredient::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:ingredients,name,' . $ingredient->id,
        ]);

        $ingredient->update($validatedData);

        return response()->json(['message' => 'Ingredient updated successfully.', 'data' => $ingredient]);
    }

    /**
     * Remove the specified ingredient from storage.
     */
    public function destroy($id)
    {
        $ingredient = Ingredient::findOrFail($id);

        // Detach ingredient from all recipes
        $ingredient->recipes()->detach();

        $ingredient->delete();

        return response()->json(['message' => 'Ingredient deleted successfully.']);
    }

}

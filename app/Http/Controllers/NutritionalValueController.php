<?php

namespace App\Http\Controllers;
use App\Models\NutritionalValue;
use Illuminate\Http\Request;

class NutritionalValueController extends Controller
{
    public function index()
    {
        $nutritionalValues = NutritionalValue::with('recipe')->get();
        return response()->json($nutritionalValues);
    }

    /**
     * Store a newly created nutritional value in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'recipe_id' => 'required|exists:recipes,id',
            'calories' => 'required|integer|min:0',
            'carbohydrates' => 'required|integer|min:0',
            'protein' => 'required|integer|min:0',
            'fat' => 'required|integer|min:0',
        ]);

        $nutritionalValue = NutritionalValue::create($validatedData);

        return response()->json(['message' => 'Nutritional value created successfully.', 'data' => $nutritionalValue]);
    }

    /**
     * Display the specified nutritional value.
     */
    public function show($id)
    {
        $nutritionalValue = NutritionalValue::with('recipe')->findOrFail($id);
        return response()->json($nutritionalValue);
    }

    /**
     * Update the specified nutritional value in storage.
     */
    public function update(Request $request, $id)
    {
        $nutritionalValue = NutritionalValue::findOrFail($id);

        $validatedData = $request->validate([
            'calories' => 'required|integer|min:0',
            'carbohydrates' => 'required|integer|min:0',
            'protein' => 'required|integer|min:0',
            'fat' => 'required|integer|min:0',
        ]);

        $nutritionalValue->update($validatedData);

        return response()->json(['message' => 'Nutritional value updated successfully.', 'data' => $nutritionalValue]);
    }

    /**
     * Remove the specified nutritional value from storage.
     */
    public function destroy($id)
    {
        $nutritionalValue = NutritionalValue::findOrFail($id);
        $nutritionalValue->delete();

        return response()->json(['message' => 'Nutritional value deleted successfully.']);
    }
}

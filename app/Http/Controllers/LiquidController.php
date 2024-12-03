<?php

namespace App\Http\Controllers;

use App\Models\Liquid;
use Illuminate\Http\Request;

class LiquidController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $liquid = Liquid::all();
        return response()->json($liquid);

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validated = $request->validate([
            "name"=> "reqired",'required|string|max:255',
            'calories' => 'required|integer'
        ]);
        $liquid = Liquid::create($validated);
        return response()->json($liquid);
    }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $liquid = Liquid::find($id);
        return response()->json($liquid);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $liquid = Liquid::find($id);
        $validated = $request->validate([
            "name"=> "reqired",'required|string|max:255',
            'calories' => 'required|integer'
        ]);
        $liquid->update($validated);
        return response()->json($liquid,200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $liquid = Liquid::find($id);
        $liquid->delete();
        return response()->json(['message' => 'Liquid deleted successfully']);

    }
}

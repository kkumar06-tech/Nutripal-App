<?php

namespace App\Http\Controllers;

use App\Models\LiquidLog;
use Illuminate\Http\Request;

class LiquidLogController extends Controller
{
    public function index()
    {
        // Fetch liquid logs with their related liquids and user profile
        $liquidLogs = LiquidLog::with('liquids', 'userProfile')->get();
        return response()->json($liquidLogs);
    }

    /**
     * Store a newly created liquid log in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'user_profile_id' => 'required|exists:user_profiles,id',
            'date' => 'required|date',
            'liquid_id' => 'required|exists:liquids,id',
            'amount_ml' => 'required|integer|min:1',
        ]);

        // Create or find an existing liquid log for the user and date
        $liquidLog = LiquidLog::firstOrCreate(
            [
                'user_profile_id' => $validatedData['user_profile_id'],
                'date' => $validatedData['date'],
            ]
        );

        // Store the liquid log with the liquid and the amount_ml directly in the LiquidLog model
        $liquidLog->liquids()->attach($validatedData['liquid_id'], ['amount_ml' => $validatedData['amount_ml']]);

        // Optionally update the total amount in the log
        $liquidLog->updateTotalAmount();

        return response()->json(['message' => 'Liquid log created successfully.', 'data' => $liquidLog]);
    }

    /**
     * Display the specified liquid log.
     */
    public function show($id)
    {
        // Fetch specific liquid log with liquids and user profile
        $liquidLog = LiquidLog::with('liquids', 'userProfile')->findOrFail($id);
        return response()->json($liquidLog);
    }

    /**
     * Update the specified liquid log in storage.
     */
    public function update(Request $request, $id)
    {
        $liquidLog = LiquidLog::findOrFail($id);

        $validatedData = $request->validate([
            'liquid_id' => 'required|exists:liquids,id',
            'amount_ml' => 'required|integer|min:1',
        ]);

        // Update the pivot table with new liquid and amount_ml
        $liquidLog->liquids()->syncWithoutDetaching([
            $validatedData['liquid_id'] => ['amount_ml' => $validatedData['amount_ml']]
        ]);

        // Recalculate and update total amount
        $liquidLog->updateTotalAmount();

        return response()->json(['message' => 'Liquid log updated successfully.', 'data' => $liquidLog]);
    }

    /**
     * Remove the specified liquid log.
     */
    public function destroy($id)
    {
        $liquidLog = LiquidLog::findOrFail($id);

        // Detach all liquids and delete the liquid log
        $liquidLog->liquids()->detach();  // Detach all liquids
        $liquidLog->delete();

        return response()->json(['message' => 'Liquid log deleted successfully.']);
    }
}
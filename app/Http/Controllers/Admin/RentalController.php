<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rental;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    // Show all rentals
    public function index()
    {
        $rentals = Rental::with('car', 'user')->orderBy('id', 'desc')->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    // Show form to create a new rental (optional, can be done in frontend)
    public function create()
    {
        // logic for creating rentals
    }

    // Show form to edit a rental
    public function edit($id)
    {
        $rental = Rental::findOrFail($id);
        return view('admin.rentals.edit', compact('rental'));
    }

    // Update rental details
    public function update(Request $request, $id)
    {
        
        $rental = Rental::findOrFail($id);

        $validated = $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'total_days' => 'required|integer',
            'per_day_cost' => 'required|numeric',
            'total_cost' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $rental->update($validated);


        return redirect()->route('admin.rentals.index')->with('success', 'Rental updated successfully.');
    }

    // Delete a rental
    public function destroy($id)
    {
        $rental = Rental::findOrFail($id);
        $rental->delete();

        return redirect()->route('admin.rentals.index')->with('success', 'Rental deleted successfully.');
    }
}

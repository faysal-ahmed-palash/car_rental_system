<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    // Show all available cars
    public function index(Request $request)
    {
        // Fetch available cars with optional filters
        $query = Car::query();
        
        if ($request->filled('car_type')) {
            $query->where('car_type', $request->car_type);
        }

        if ($request->filled('brand')) {
            $query->where('brand', 'like', '%' . $request->brand . '%');
        }

        $cars = $query->where('status', 'active')->get();

        return view('frontend.cars.index', compact('cars'));
    }

    // Show car details
    public function show(Car $car)
    {
        return view('frontend.cars.show', compact('car'));
    }

    // Book a car
    public function book(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $validated = $request->validate([
            'rental_period' => 'required|integer|min:1',
        ]);

        $rental = new Rental();
        $rental->user_id = Auth::id();
        $rental->car_id = $car->id;
        $rental->start_date = now();
        $rental->end_date = now()->addDays($validated['rental_period']);
        $rental->total_cost = $car->daily_rent_price * $validated['rental_period'];
        $rental->save();

        // Send email logic can go here

        return redirect()->route('frontend.rentals.index')->with('success', 'Car booked successfully.');
    }
}

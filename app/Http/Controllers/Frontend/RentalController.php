<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\Rental;
use App\Mail\UserBookingConfirmation;
use App\Mail\AdminBookingConfirmation;
use Illuminate\Support\Facades\Mail;


class RentalController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'user_id' => 'required|exists:users,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'total_cost' => 'required|numeric',
        ]);
    
        // Retrieve the car information (including daily rent price)
        $car = Car::findOrFail($request->car_id);

        // Calculate the total rental cost based on the dates and daily rent price
        $start_date = new \DateTime($request->start_date);
        $end_date = new \DateTime($request->end_date);
        $interval = $start_date->diff($end_date);
        $days = $interval->days + 1; // Including both start and end date
    
        // Calculate total cost
        $totalCost = $days * $car->daily_rent_price;
    
        // Check if the total cost from the form matches the calculated total cost
        if ($totalCost != $request->total_cost) {
            return back()->withErrors(['total_cost' => 'The total cost is incorrect.']);
        }
    
        // Store the rental data in the 'rentals' table
        $rental = new Rental();
        $rental->user_id = $request->user_id;
        $rental->car_id = $request->car_id;
        $rental->start_date = $request->start_date;
        $rental->end_date = $request->end_date;
        $rental->total_days = $days;
        $rental->per_day_cost = $car->daily_rent_price;
        $rental->total_cost = $totalCost;
        $rental->save();





    // Send confirmation email to user
    Mail::to($request->user()->email)->send(new UserBookingConfirmation($rental));

    // Send confirmation email to admin
    $adminEmail = 'palash884@gmail.com'; // Or fetch admin email from your settings
    Mail::to($adminEmail)->send(new AdminBookingConfirmation($rental));

        // Redirect the user back with a success message
        return redirect()->back()->with('success', 'Car rented successfully!');
    }
    

// need public function for update
public function update(Request $request, $id)
{
    $rental = Rental::findOrFail($id);

    // Set the rental status to canceled
    $rental->status = 'canceled';
    $rental->save();

    return redirect()->back()->with('success', 'Booking canceled successfully.');
}





}
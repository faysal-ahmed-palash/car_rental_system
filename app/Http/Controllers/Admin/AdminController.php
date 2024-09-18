<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    // Show the admin dashboard with statistics
    
    public function showLoginForm()
    {
        return view('admin.login');
    }
    



    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && $user->isAdmin()) {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->intended('/admin/dashboard');
            } else {
                return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
            }
        }

        return redirect()->back()->withErrors(['error' => 'Unauthorized: Only admins can log in']);
    }
    
    
    
    
public function dashboard()
{
    // total user
    $totalUsers = User::where('role', 'customer')->count();
    $totalCars = Car::count();

    $start_date= now()->format('Y-m-d');
    $end_date = now()->format('Y-m-d');
    $todays_total_availableCars = Car::whereDoesntHave('rentals', function ($query) use ($start_date, $end_date) {
        $query->where(function ($q) use ($start_date, $end_date) {
            $q->whereBetween('start_date', [$start_date, $end_date])
              ->orWhereBetween('end_date', [$start_date, $end_date])
              ->orWhere(function($q) use ($start_date, $end_date) {
                  $q->where('start_date', '<=', $start_date)
                    ->where('end_date', '>=', $end_date);
              });
            })->where('status', 'Ongoing');
        })->count();
    
        $totalRentals = Rental::count();
    $totalEarnings = Rental::whereIn('status', ['Ongoing', 'Completed'])->sum('total_cost');

    $rentals = Rental::where('status', 'Ongoing')->get();
    $availablecars = Car::whereDoesntHave('rentals', function ($query) use ($start_date, $end_date) {
        $query->where(function ($q) use ($start_date, $end_date) {
            $q->whereBetween('start_date', [$start_date, $end_date])
              ->orWhereBetween('end_date', [$start_date, $end_date])
              ->orWhere(function($q) use ($start_date, $end_date) {
                  $q->where('start_date', '<=', $start_date)
                    ->where('end_date', '>=', $end_date);
              });
            })->where('status', 'Ongoing');
        })->get();


        $car_services = Rental::select('car_id', 
        \DB::raw('SUM(total_days) as total_days'), 
        \DB::raw('SUM(total_cost) as total_cost'))
        ->whereIn('status', ['Ongoing', 'Completed'])
        ->groupBy('car_id')
        ->get();

    return view('admin.dashboard', compact('totalUsers', 'totalCars', 'todays_total_availableCars', 'totalRentals', 'totalEarnings', 'rentals', 'availablecars', 'car_services'));
}

    // Show the list of all cars
    public function carsIndex()
    {
        $cars = Car::all();
        return view('admin.cars.index', compact('cars'));
    }

    // Show the form to create a new car
    public function carsCreate()
    {
        return view('admin.cars.create');
    }

    // Store a newly created car
    public function carsStore(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('car_images', 'public');
            $validated['image'] = $imagePath;
        }

        Car::create($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Car added successfully');
    }

    // Show the form to edit a car
    public function carsEdit($id)
    {
        $car = Car::findOrFail($id);
        return view('admin.cars.edit', compact('car'));
    }

    // Update the car details
    public function carsUpdate(Request $request, $id)
    {
        $car = Car::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'car_type' => 'required|string|max:255',
            'daily_rent_price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($car->image && file_exists(storage_path('app/public/' . $car->image))) {
                unlink(storage_path('app/public/' . $car->image));
            }

            $imagePath = $request->file('image')->store('car_images', 'public');
            $validated['image'] = $imagePath;
        }

        $car->update($validated);

        return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully');
    }

    // Delete a car
    public function carsDestroy($id)
    {
        $car = Car::findOrFail($id);

        // Delete the image file if exists
        if ($car->image && file_exists(storage_path('app/public/' . $car->image))) {
            unlink(storage_path('app/public/' . $car->image));
        }

        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully');
    }

    // Show the list of all rentals
    public function rentalsIndex()
    {
        $rentals = Rental::with('car', 'user')->get();
        return view('admin.rentals.index', compact('rentals'));
    }

    // Show the list of all customers
    public function customersIndex()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customers.index', compact('customers'));
    }
}

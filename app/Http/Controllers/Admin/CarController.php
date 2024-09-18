<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    // Show all cars
    public function index()
    {
        $cars = Car::all();
        return view('admin.cars.index', compact('cars'));
    }

    // Show form to create a new car
    public function create()
    {
        return view('admin.cars.create');
    }

    // Store new car in the database
    public function store(Request $request)
{
    // Validate incoming request
    $validated = $request->validate([
        'name' => 'required|string',
        'brand' => 'required|string',
        'model' => 'required|string',
        'year' => 'required|integer',
        'car_type' => 'required|string',
        'daily_rent_price' => 'required|numeric',
        'image' => 'required|image',
    ]);

    // Initialize the $imagePath variable
    $imagePath = null;

    // Check if the request has an image file
    if ($request->hasFile('image')) {
        // Get the uploaded file
        $file = $request->file('image');
    
        // Create a custom filename using the current Unix time and original extension
        $customFileName = time() . '.' . $file->getClientOriginalExtension();
    
        // Store the file in the 'cars' directory in public storage
        $imagePath = $file->storeAs('cars', $customFileName, 'public');
    }

    // Create the new car record with the validated data and the image path
    Car::create([
        'name' => $validated['name'],
        'brand' => $validated['brand'],
        'model' => $validated['model'],
        'year' => $validated['year'],
        'car_type' => $validated['car_type'],
        'daily_rent_price' => $validated['daily_rent_price'],
        'image' => $customFileName, // Store the image path in the database
    ]);

    // Redirect back to the car list page with a success message
    return redirect()->route('admin.cars.index')->with('success', 'Car added successfully.');
}






    // Show form to edit a car
    public function edit($id)
    {
        $car = Car::findOrFail($id);
        return view('admin.cars.edit', compact('car'));
    }

    // Update car details in the database
    public function update(Request $request, $id)
{
    $car = Car::findOrFail($id);

    // Validate the request inputs except the image, which will be handled separately
    $validated = $request->validate([
        'name' => 'required|string',
        'brand' => 'required|string',
        'model' => 'required|string',
        'year' => 'required|integer',
        'car_type' => 'required|string',
        'daily_rent_price' => 'required|numeric',
        'image' => 'nullable|image', // The image field is still validated here
    ]);

    // Handle the image upload if a new file is provided
    if ($request->hasFile('image')) {
        // Get the uploaded file
        $file = $request->file('image');

        // Create a custom filename with the current Unix time and the original extension
        $customFileName = time() . '.' . $file->getClientOriginalExtension();

        // Store the file in the 'cars' directory under public storage
        $imagePath = $file->storeAs('cars', $customFileName, 'public');

        // Update the car object with the new image path
        $car->image = $customFileName;
    }

    // Update car details (without the 'image' field)
    $car->update([
        'name' => $validated['name'],
        'brand' => $validated['brand'],
        'model' => $validated['model'],
        'year' => $validated['year'],
        'car_type' => $validated['car_type'],
        'daily_rent_price' => $validated['daily_rent_price'],
    ]);

    return redirect()->route('admin.cars.index')->with('success', 'Car updated successfully.');
}









    // Delete a car
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('admin.cars.index')->with('success', 'Car deleted successfully.');
    }
}

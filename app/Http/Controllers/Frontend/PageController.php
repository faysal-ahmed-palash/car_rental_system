<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PageController extends Controller
{
    

    public function search(Request $request)
    {
        $start_date = $request->input('start_date', now()->format('Y-m-d'));
        $end_date = $request->input('end_date', now()->format('Y-m-d'));
    
        // Add your logic to fetch available cars here
        $availableCars = Car::whereDoesntHave('rentals', function ($query) use ($start_date, $end_date) {
            $query->where(function ($q) use ($start_date, $end_date) {
                $q->whereBetween('start_date', [$start_date, $end_date])
                  ->orWhereBetween('end_date', [$start_date, $end_date])
                  ->orWhere(function($q) use ($start_date, $end_date) {
                      $q->where('start_date', '<=', $start_date)
                        ->where('end_date', '>=', $end_date);
                  });
            })->where('status', 'Ongoing');
        })->get();
    
        return view('frontend.home', compact('availableCars', 'start_date', 'end_date'));
    }
    
    





    public function showLoginForm()
    {
        return view('frontend.customer_login');
    }
    
    public function login(Request $request)
    {
        // Validate the login form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Retrieve user by email
        $user = User::where('email', $request->email)->first();
    
        // Check if user exists and is a customer
        if ($user && $user->isCustomer()) {
            // Attempt to log in with provided credentials
            $credentials = $request->only('email', 'password');
    
            if (Auth::attempt($credentials)) {
                // Authentication successful, redirect to the user website
                return redirect()->intended('/');
            } else {
                // Invalid credentials
                return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
            }
        }
    
        // If the user is not a customer or does not exist, return error
        return redirect()->back()->withErrors(['error' => 'Unauthorized: Only customers can log in']);
    }
    
    
    public function home() {
        //return view('frontend.home');
        $cars = Car::where('status', 'active')->get();
        return view('frontend.home', compact('cars'));
    }

    public function about() {
        return view('frontend.about');
    }

    public function contact() {
        return view('frontend.contact');
    }

    public function rental() {
        $rentals = Rental::where('user_id', Auth::user()->id)
                    ->with('car')
                    ->get();
    
        return view('frontend.rental', compact('rentals'));
    }







}

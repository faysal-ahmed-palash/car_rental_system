<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // Show all customers
    public function index()
    {
        $customers = User::where('role', 'customer')->get();
        return view('admin.customers.index', compact('customers'));
    }

    // Show form to edit customer details
    public function edit($id)
    {
        $customer = User::findOrFail($id);
        return view('admin.customers.edit', compact('customer'));
    }

    // Update customer details
    public function update(Request $request, $id)
    {
        $customer = User::findOrFail($id);

        // Validate the incoming request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $customer->id,
            'mobile_no' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'password' => 'nullable|min:8',
        ]);

        // Update customer details
        $customer->name = $validated['name'];
        $customer->email = $validated['email'];
        $customer->mobile_no = $validated['mobile_no'];
        $customer->address = $validated['address'];

        // Check if password is provided, then hash it
        if ($request->filled('password')) {
            $customer->password = Hash::make($request->password);
        }

        $customer->save();

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully.');
    }

    // Delete a customer
    public function destroy($id)
    {
        $customer = User::findOrFail($id);
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully.');
    }
}

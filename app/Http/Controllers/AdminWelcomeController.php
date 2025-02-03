<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminWelcomeController extends Controller
{
    // Show the admin setup page
    public function showAdminSetup()
    {
        // Check if there's an existing admin user
        if (User::where('isAdmin', 1)->exists()) {
            return redirect('/admin'); // Redirect to admin page if already an admin exists
        }

        return view('admin.setup'); // Show the setup page if no admin exists
    }

    // Store the admin credentials
 
public function storeAdminCredentials(Request $request)
{
    // Validate the request
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
    ]);

    // Create the admin user
    User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'isAdmin' => 1, // Mark the user as admin
    ]);

    // Redirect to the admin dashboard after setup
    return redirect('/login')->with('success', 'Admin account created successfully.');
}

}

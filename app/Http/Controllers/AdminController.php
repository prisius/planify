<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function users()
    {
        $users = User::get();
        return view('admin.users', ['users' => $users]);
    }

    public function update(Request $request)
    {
        // Validate the incoming data
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $request->user_id,
        ]);

        // Find the user by ID and update their information
        $user = User::findOrFail($request->user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Redirect back to the users page with a success message
        return redirect()->route('admin.users')->with('success', 'User updated successfully.');
    }

    public function delete(Request $request)
    {

        // Find the user by ID and update their information
        $user = User::findOrFail($request->user_id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User deleted successfully.');
    }
}

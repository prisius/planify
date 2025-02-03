<?php



namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TasksController extends Controller
{
    public function index()
    {

        $tasks = Tasks::all()->sortBy(function ($task) {
            // Assign a numeric value to each priority to help with sorting
            $priorityOrder = [
                'High' => 1,
                'Medium' => 2,
                'Low' => 3,
            ];

            // Return the numeric value based on the task's priority
            return $priorityOrder[$task->priority] ?? 4;  // Default to 4 if priority is not set or invalid
        });

        return view('dashboard', ['tasks' => $tasks]); // Pass tasks to the dashboard view
    }

    public function create(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'task' => 'required|string|max:128',
            'description' => 'required|string|max:255',
            'priority' => 'required|string|in:Low,Medium,High', // Ensure priority is one of these strings
        ]);

        // Create a new task in the database
        $task = new Tasks();
        $task->task = $validatedData['task'];
        $task->description = $validatedData['description'];
        $task->priority = $validatedData['priority']; // Store the string value
        $task->save();

        // Optionally, redirect back to the task list or show a success message
        return redirect()->route('dashboard')->with('success', 'Task created successfully!');


        return redirect('/dashboard');
    }


    // app/Http/Controllers/TaskController.php


    public function assignUser(Request $request, Tasks $task)
    {
        // Validate the request
        $request->validate([
            'user_id' => 'required|array', // Ensure user_id is an array
            'user_id.*' => 'exists:users,id' // Each selected user must exist
        ]);

        // Sync users (assign users to the task)
        $task->users()->sync($request->user_id);

        return redirect()->route('tasks.index', $task->id)->with('success', 'Users assigned successfully!');
    }
    // app/Http/Controllers/TaskController.php

    public function assignForm($taskId)
    {
        $task = Tasks::findOrFail($taskId);
        $users = User::all(); // Get all users
        return view('tasks.assign', compact('task', 'users'));
    }


    public function delete(Request $id)
    {

        Log::info('Delete method activated for task ID: ' . $id);
        $task = Tasks::findOrFail($id);
        $task->delete();
        return redirect('/dashboard');
    }
}

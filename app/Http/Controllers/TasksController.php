<?php



namespace App\Http\Controllers;

use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class TasksController extends Controller
{



    public function index(Request $request)
    {
        $query = Tasks::query();

        // Apply priority filter
        if ($request->has('priority') && !empty($request->priority)) {
            $query->where('priority', $request->priority);
        }

        // Apply ultimatum (filter all tasks up until the selected date)
        if ($request->has('ultimatum') && !empty($request->ultimatum)) {
            $query->whereDate('ultimatum', '<=', $request->ultimatum);
        }

        // Order tasks by priority and due date
        $tasks = $query->orderByRaw("
        CASE 
            WHEN priority = 'High' THEN 1
            WHEN priority = 'Medium' THEN 2
            WHEN priority = 'Low' THEN 3
            ELSE 4
        END
    ")->orderBy('ultimatum', 'asc')->get(); // Order by closest due date first

        return view('dashboard', ['tasks' => $tasks]);
    }




    public function create(Request $request)
    {
        // Validate the input
        $validatedData = $request->validate([
            'task' => 'required|string|max:128',
            'description' => 'required|string|max:255',
            'priority' => 'required|string|in:Low,Medium,High', // Ensure priority is one of these strings
            'ultimatum' => 'nullable|date|after:today',
        ]);

        // Create a new task in the database
        $task = new Tasks();
        $task->task = $validatedData['task'];
        $task->description = $validatedData['description'];
        $task->priority = $validatedData['priority']; // Store the string value
        $task->ultimatum = $validatedData['ultimatum'];
        $task->save();

        // Optionally, redirect back to the task list or show a success message
        return redirect()->route('dashboard')->with('success', 'Task created successfully!');
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

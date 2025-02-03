<?php

namespace App\Http\Controllers;

use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaskDetailController extends Controller
{
    public function index($id) // Add the task id as a parameter
    {
        // Fetch task by id
        $task = Tasks::findOrFail($id); // If the task is not found, it will throw a 404 error

        // Pass the task to the view
        return view('task-detail', ['task' => $task]);
    }

    public function edit(Request $request, $id)
    {
        $task = Tasks::findOrFail($id);
        $task->task = $request->input('task');
        $task->description = $request->input('description');
        $task->priority = $request->input('priority'); // On met à jour la priorité
        $task->save();

        return redirect()->route('dashboard'); // Ou une autre redirection
    }

    public function delete($id)
    {
        // Fetch the task by ID
        $task = Tasks::findOrFail($id);

        // Delete the task
        $task->delete();

        // Redirect back to the dashboard
        return redirect()->route('dashboard');
    }
}

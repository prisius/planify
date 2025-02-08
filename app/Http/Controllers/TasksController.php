<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Task;
use App\Models\Tasks;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class TasksController extends Controller
{



public function index(Request $request, $board_id = null)
{
    $query = Tasks::query();

    if ($board_id) {
        $board = Board::findOrFail($board_id);

        // Check if the user is a member of the board
        if ($board->members && !in_array(Auth::id(), $board->members->pluck('id')->toArray())) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $query->where('board_id', $board_id);
    }

    // Fetch tasks sorted by priority and ultimatum date
    $tasks = $query->orderByRaw("CASE WHEN priority = 'High' THEN 1 WHEN priority = 'Medium' THEN 2 WHEN priority = 'Low' THEN 3 ELSE 4 END")
                    ->orderBy('ultimatum', 'asc')
                    ->get();

    // Pass tasks and board_id to the view
    return view('dashboard', ['tasks' => $tasks, 'board_id' => $board_id]);
}




public function store(Request $request, $board_id)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'priority' => 'required|in:Low,Medium,High',
        'ultimatum' => 'nullable|date|after:today',
        'color' => 'nullable|string',
    ]);

    $board = Board::findOrFail($board_id);

    // Ensure the user is the board owner
    if ($board->user_id !== Auth::id()) {
        return redirect()->back()->with('error', 'Unauthorized action!');
    }

    Tasks::create([
        'board_id' => $board->id,
        'title' => $request->title,
        'description' => $request->description,
        'priority' => $request->priority,
        'ultimatum' => $request->ultimatum,
        'color' => $request->color,
    ]);

    return redirect()->route('tasks.index', ['board_id' => $board->id])->with('success', 'Task added successfully!');
}



public function update(Request $request, $task_id)
{
    $task = Tasks::findOrFail($task_id);
    $board = $task->board;

    // Ensure the user is in the board's members
    if ($board->members && !in_array(Auth::id(), $board->members->pluck('id')->toArray())) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $task->update($request->only([
        'title', 'description', 'priority', 'ultimatum', 'color', 'tags', 'status', 'assigned_to'
    ]));

    return response()->json(['message' => 'Task updated successfully', 'task' => $task]);
}


public function destroy($task_id)
{
    $task = Tasks::findOrFail($task_id);
    $board = $task->board;

    // Ensure the user is in the board's members
    if ($board->members && !in_array(Auth::id(), $board->members->pluck('id')->toArray())) {
        return response()->json(['error' => 'Unauthorized'], 403);
    }

    $task->delete();

    return redirect()->route('tasks.index', ['board_id' => $board->id])->with('success', 'Task deleted successfully!');
}



public function assignUser(Request $request, Tasks $task)
{
    $request->validate([
        'user_id' => 'required|array',
        'user_id.*' => 'exists:users,id'
    ]);

    // Sync users to the task
    $task->users()->sync($request->user_id);

    return redirect()->route('tasks.index', ['board_id' => $task->board_id])->with('success', 'Users assigned successfully!');
}

public function assignForm($taskId)
{
    $task = Tasks::findOrFail($taskId);
    $users = User::all();
    return view('tasks.assign', compact('task', 'users'));
}
}
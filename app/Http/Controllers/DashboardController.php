<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Tasks;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index() {
 $boards = Board::with('tasks')->get(); // Fetch all boards with tasks
    $tasks = Tasks::all(); // Fetch all tasks (or filter as needed)

    return view('dashboard', compact('boards', 'tasks'));       
    }
    
}

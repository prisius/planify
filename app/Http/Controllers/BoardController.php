<?php
namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    public function index()
    {
        $boards = Board::all();  // Fetch all boards
        return view('boards', compact('boards'));
    }

public function show($board_id)
{
    // Retrieve the board using the board_id
    $board = Board::with('tasks')->get();

    return view('dashboard', [
        'boards' => $board, // Pass the board and its tasks to the view
        'board_id' => $board_id, // You can still use board_id if needed in the view
    ]);
}

    

public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:1000',
    ]);

    $board = Board::create([
        'name' => $request->name,
        'description' => $request->description,
        'user_id' => Auth::id(),
    ]);

    return redirect()->route('boards.show', [$board->id])->with('success', 'Board created successfully.');
}


}


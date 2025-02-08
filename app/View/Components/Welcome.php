<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Welcome extends Component
{
    public $boards;
    public $tasks;

    public function __construct($boards, $tasks)
    {
        $this->boards = $boards;
        $this->tasks = $tasks;
    }

    public function render()
    {
        return view('components.welcome');
    }
}

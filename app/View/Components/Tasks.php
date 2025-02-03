<?php


namespace App\View\Components;

use Illuminate\View\Component;

class Tasks extends Component
{
    public $tasks;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $tasks
     * @return void
     */
    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.tasks'); // Ensure this view exists
    }
}

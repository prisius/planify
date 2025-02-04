
<div class="w-full">
    <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Tasks List</h3>
    <ul>
        @foreach($tasks as $task)
        <a href="/tasks/{{$task->id}}">

<li style="background-color: {{ $task->color }};" class="mb-2 p-3 overflow-auto text-white">
    {{ $task->task }} (Priority: {{ $task->priority }})
</li>
        </a>
        @endforeach
    </ul>
</div>

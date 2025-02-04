
<div class="w-full">
    <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Tasks List</h3>
    <ul>
        @foreach($tasks as $task)
        <a href="/tasks/{{$task->id}}">
        <li class="{{$task->priority == "High" ? 'bg-red-400' : 'bg-gray-200'}}  mb-2 p-3 overflow-auto">{{ $task->task }} (Priority: {{ $task->priority }})

            </li>
        </a>
        @endforeach
    </ul>
</div>

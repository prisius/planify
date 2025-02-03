
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Task Details') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Task Details -->
                <div class="mb-4">
                    <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Task: {{ $task->task }}</h3>
                    <p class="text-gray-600 dark:text-gray-400 mt-2">Description: {{ $task->description }}</p>
                    <p class="text-gray-600 dark:text-gray-400">Priority: <span class="font-semibold">{{ $task->priority }}</span></p>
                    <p class="text-gray-600 dark:text-gray-400">Created At: {{ $task->created_at->format('M d, Y') }}</p>
                    <p class="text-gray-600 dark:text-gray-400">Updated At: {{ $task->updated_at->format('M d, Y') }}</p>

@if($task->users->isNotEmpty())
    <ul>
        <p>Assigned Users :</p>
        @foreach($task->users as $user)
            <li>{{ $user->name }}</li>
        @endforeach
    </ul>
@else
    <p>No users assigned to this task.</p>
@endif

</p>
                </div>

                <!-- Edit and Delete Buttons -->
                <div class="flex justify-end mt-4">
                    <!-- Edit Button -->
                    <a href="{{route('dashboard')}}">
<button  class="px-4 py-2 bg-gray-500 text-white ">
Retour
                        </button>

                    </a>
                    <a href="{{route('tasks.assignForm', $task)}}">
                    <button class="px-4 py-2 bg-yellow-500 text-black ">Assign User</button>
                    </a>
 
                    
                    <button @click="open = true" class="px-4 py-2 bg-blue-500 text-white ">Edit task</button>
                    <!-- Delete Button -->
                    <form action="{{ route('tasks.delete', $task->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this task?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white ">
                            Delete Task
                        </button>
                    </form>
                </div>
                
                

                <!-- Modal -->

                <div 
                    x-show="open" 
                    x-transition 
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
                    style="display: none;"
                >
                    <div class="bg-white rounded-lg shadow-xl p-6 w-1/3">
                        <h2 class="text-lg font-bold mb-4">Edit Task</h2>

                        <!-- Task Creation Form -->

                    <form action="{{ route('tasks.edit', $task->id) }}" method="POST" @submit="open = false">
                           @csrf
                            @method('PUT')

<!-- Task Name -->
<div class="mb-4">
    <label for="task" class="block text-sm font-medium text-gray-700">Task</label>
    <input 
        type="text" 
        name="task" 
        id="task" 
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
        value="{{ $task->task }}" 
        required
    >
</div>

<!-- Task Description -->
<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
    <textarea 
        name="description" 
        id="description" 
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
        required
    >{{ $task->description }}</textarea>
</div>

<!-- Priority -->
<div class="mb-4">
    <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
    <select 
        name="priority" 
        id="priority" 
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
        required
    >
        <option value="Low" {{ $task->priority === 'Low' ? 'selected' : '' }}>Low</option>
        <option value="Medium" {{ $task->priority === 'Medium' ? 'selected' : '' }}>Medium</option>
        <option value="High" {{ $task->priority === 'High' ? 'selected' : '' }}>High</option>
    </select>
</div>

                            <!-- Submit Button -->
                            <div class="flex justify-end">
                                <button 
                                    type="button" 
                                    @click="open = false" 
                                    class="mr-2 px-4 py-2 bg-gray-300 rounded"
                                >
                                    Cancel
                                </button>
                                <button 
                                    type="submit" 
                                    class="px-4 py-2 bg-blue-500 text-white rounded"
                                >
                                   Update task 
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Alpine.js modal handling
    document.addEventListener('alpine:init', () => {
        Alpine.data('taskModal', () => ({
            open: false,
            openModal() {
                this.open = true;
            },
            closeModal() {
                this.open = false;
            }
        }));
    });
</script>
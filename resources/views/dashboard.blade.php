
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Button to open the modal -->
                <button 
                    @click="open = true" 
                    class="bg-blue-500 text-white px-4 py-2 rounded mt-4"
                >
                    Create Task
                </button>

                <!-- Task List Component (assuming x-welcome displays tasks) -->
                <x-welcome :$tasks/>

                <!-- Modal -->
                <div 
                    x-show="open" 
                    x-transition 
                    class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
                    style="display: none;"
                >
                    <div class="bg-white rounded-lg shadow-xl p-6 w-1/3">
                        <h2 class="text-lg font-bold mb-4">Create New Task</h2>

                        <!-- Task Creation Form -->
                        <form action="{{ route('tasks.create') }}" method="POST">
                            @csrf

                            <!-- Task Name -->
                            <div class="mb-4">
                                <label for="task" class="block text-sm font-medium text-gray-700">Task</label>
                                <input 
                                    type="text" 
                                    class="p-3 border-2 w-full"
                                    name="task" 
                                    id="task" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                    required
                                >
                            </div>
                            <!-- Task Description -->

<!-- Task Description -->
<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
    <textarea 
        class="p-3 w-full border-2"
        name="description" 
        id="description" 
        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
        placeholder="Enter task description here..." 
        required
    ></textarea>
</div>
                            <!-- Priority -->
                            <div class="mb-4">
                                <label for="priority" class="block text-sm font-medium text-gray-700">Priority</label>
                                <select 
                                class="h-6 w-full"
                                    name="priority" 
                                    id="priority" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm" 
                                    required
                                >
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            
                                            <div class="flex flex-col">
                    <label for="ultimatum" name="ultimatum">Due date</label>
                    <input class="w-48 border-2" type="date" name="ultimatum">
                                            </div>

                             
                                            <div class="flex flex-col">
                    <label for="color" name="color">Choose color</label>
                    <input class="w-10" class="w-48" type="color" name="color">
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
                                    Create Task
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
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $board->name }} - Tasks
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Create Task Button -->
                <button 
                    @click="openModal()" 
                    class="bg-blue-500 text-white px-4 py-2 rounded mt-4"
                >
                    Create Task
                </button>

                <!-- Task List -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                    @foreach($board->tasks as $task)
                        <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded-lg shadow-md">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $task->name }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ $task->description }}</p>
                            <span class="text-xs font-bold text-white px-2 py-1 rounded mt-2" style="background: {{ $task->color }};">
                                {{ $task->priority }}
                            </span>
                        </div>
                    @endforeach
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>

<script>
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

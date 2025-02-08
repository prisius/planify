<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Boards') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ open: false }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Button to open the modal -->
            <button 
                @click="open = true" 
                class="bg-blue-500 text-white px-4 py-2 rounded mb-4"
            >
                + Create Board
            </button>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($boards as $board)
                    <a href="{{ route('boards.show', $board->id) }}" class="block bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:bg-gray-100 dark:hover:bg-gray-700 transition">
                        <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $board->name }}</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">{{ $board->description }}</p>
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Modal -->
        <div 
            x-show="open" 
            x-transition 
            class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50"
            style="display: none;"
        >
            <div class="bg-white dark:bg-gray-800 p-6 w-1/3 rounded-lg shadow-xl">
                <h2 class="text-xl font-bold mb-4">Create New Board</h2>
                
                <!-- Board Creation Form -->
                <form action="{{ route('boards.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Board Name</label>
                        <input 
                            type="text" 
                            name="name" 
                            id="name" 
                            class="p-3 border-2 w-full rounded-md focus:border-blue-500 focus:ring-blue-500" 
                            required
                        >
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Description</label>
                        <textarea 
                            name="description" 
                            id="description" 
                            class="p-3 w-full border-2 rounded-md focus:border-blue-500 focus:ring-blue-500" 
                            placeholder="Enter board description..." 
                            required
                        ></textarea>
                    </div>

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
                            Create Board
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    // Alpine.js modal handling (you can leave this if you want a reusable function)
    document.addEventListener('alpine:init', () => {
        Alpine.data('boardModal', () => ({
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
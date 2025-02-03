@extends('layouts.admin')

@section('title', 'Users')

@section('content')
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-2xl font-bold">Users</h2>
    <p class="mt-4">Manage your users from this page.</p>
    <table class="table-auto w-full mt-6 border-collapse border border-gray-200">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Name</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- Loop through the users -->
            @foreach ($users as $user)
            <tr>
                <td class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                <td class="border border-gray-300 px-4 py-2">
                    <!-- Edit Button, triggers Modal -->
                    <button 
                        class="bg-blue-500 text-white px-2 py-1 rounded"
                        onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}')">
                        Edit
                    </button>

                    <!-- Delete Button, sends DELETE request -->
                    <form action="{{ route('admin.users.delete') }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-96">
            <h2 class="text-xl font-bold mb-4">Edit User</h2>
            <form id="editForm" method="POST" action="{{ route('admin.users.update') }}">
                @csrf
                @method('PUT')
                <input type="hidden" id="editUserId" name="user_id" value="">
                <div class="mb-4">
                    <label for="editUserName" class="block text-gray-700">Name</label>
                    <input type="text" id="editUserName" name="name" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="editUserEmail" class="block text-gray-700">Email</label>
                    <input type="email" id="editUserEmail" name="email" class="mt-1 block w-full p-2 border border-gray-300 rounded" required>
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded ml-2">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(id, name, email) {
        // Set values in the modal form fields
        document.getElementById('editUserId').value = id;
        document.getElementById('editUserName').value = name;
        document.getElementById('editUserEmail').value = email;

        // Show the modal
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeEditModal() {
        // Close the modal
        document.getElementById('editModal').classList.add('hidden');
    }
</script>
@endsection
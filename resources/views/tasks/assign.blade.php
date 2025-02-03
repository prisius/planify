
<form action="{{ route('tasks.assignUser', $task->id) }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="user_id" class="block text-sm font-medium text-gray-700">Assign Users</label>
        <select name="user_id[]" id="user_id" multiple 
            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ $task->users->contains($user->id) ? 'selected' : '' }}>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded">Assign User(s)</button>
    </div>
</form>

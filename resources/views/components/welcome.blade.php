<div class="flex p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
    <h1 class="mt-8 text-2xl font-medium text-gray-900 dark:text-white">
        Welcome to your Dashboard !
    </h1>
    
<!--TODO: make another migration and controller and make relations for tags !-->

<div class="ml-auto">

<form class="flex flex-col" method="GET" action="{{ route('dashboard') }}" id="filter-form">
    <label class="text-gray-900 dark:text-white" for="priority">Filter by Priority:</label>
    <select class="p-3" name="priority" id="priority">
        <option value="">All</option>
        <option value="High" {{ request('priority') == 'High' ? 'selected' : '' }}>High</option>
        <option value="Medium" {{ request('priority') == 'Medium' ? 'selected' : '' }}>Medium</option>
        <option value="Low" {{ request('priority') == 'Low' ? 'selected' : '' }}>Low</option>
    </select>

 <!-- Ultimatum (Date) Filter -->
    <label class="text-gray-900 dark:text-white" for="ultimatum">Filter by Due Date:</label>
    <input class="p-3" type="date" name="ultimatum" id="ultimatum" value="{{ request('ultimatum') }}">
</form>

<script>
document.querySelectorAll('#priority, #ultimatum').forEach(select => {
    select.addEventListener('change', function() {
        document.getElementById('filter-form').submit();
    });
});
</script>
</div>
<script>
document.querySelectorAll('#priority, #ultimatum').forEach(select => {
    select.addEventListener('change', function() {
        document.getElementById('filter-form').submit();
    });
});
</script>


</div>

<div class="bg-gray-200 dark:bg-gray-800 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
    <div>
        <div class="flex items-center">


<x-tasks :$tasks/>
       


    <div>
        <div class="flex items-center">
     
        </div>

       
    </div>
</div>

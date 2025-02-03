<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-800 text-gray-200 flex flex-col">
            <div class="p-4 text-center text-lg font-bold bg-gray-900">Admin Panel</div>
            <nav class="flex-1">
                <ul>
                    <li class="hover:bg-gray-700">
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 px-4">Dashboard</a>
                    </li>
                    <li class="hover:bg-gray-700">
                        <a href="{{ route('admin.users') }}" class="block py-2 px-4">Users</a>
                    </li>
                </ul>
            </nav>
            <div class="p-4">
                <a href="{{ route('logout') }}" class="text-sm text-gray-200 hover:underline">Logout</a>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <div class="bg-white shadow p-4">
                <h1 class="text-xl font-semibold">@yield('title')</h1>
            </div>
            <!-- Page Content -->
            <div class="p-6">
                @yield('content')
            </div>
        </div>
    </div>
</body>
</html>
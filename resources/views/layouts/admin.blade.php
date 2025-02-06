
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

            <div class="flex p-4 text-center text-lg font-bold bg-gray-900">
                
        <a class="text-2xl mr-4" href="{{route('dashboard')}}"><svg class="mt-1" fill="gray" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2025 Fonticons, Inc.--><path d="M459.5 440.6c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-320c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4L288 214.3l0 41.7 0 41.7L459.5 440.6zM256 352l0-96 0-128 0-32c0-12.4-7.2-23.7-18.4-29s-24.5-3.6-34.1 4.4l-192 160C4.2 237.5 0 246.5 0 256s4.2 18.5 11.5 24.6l192 160c9.5 7.9 22.8 9.7 34.1 4.4s18.4-16.6 18.4-29l0-64z"/></svg></a>
                Admin Panel</div>

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
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit" class="underline  bg-white w-full text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 h-24 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ">

                        {{ __('Log Out') }}
                    </button>
                </form>
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
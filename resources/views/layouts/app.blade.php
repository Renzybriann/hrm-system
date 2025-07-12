<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('icons/logo.png') }}" type="image/x-icon">
     {{-- DYNAMIC TITLE --}}
    <title>
        @if (request()->routeIs('dashboard'))
            Dashboard - HRM
        @elseif (request()->routeIs('hr.jobs.*'))
            Manage Jobs - HRM
        @elseif (request()->routeIs('hr.users.index'))
            Manage Users - HRM
        @elseif (request()->routeIs('hr.users.verify.list'))
            Verify Users - HRM
        @elseif (request()->routeIs('hr.applicants.index'))
            View Applicants - HRM
        @elseif (request()->routeIs('jobs'))
            Job Opportunities - HRM
        @elseif (request()->routeIs('my.applications'))
            My Applications - HRM
        @elseif (request()->routeIs('profile.view'))
            View Profile - HRM
        @elseif (request()->routeIs('profile.edit-page'))
            Edit Profile - HRM
        @else
            HRM System
        @endif
    </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">

    <div class="flex h-screen overflow-x-hidden">
        <!-- Sidebar -->
        <aside id="sidebar" class="bg-white text-gray-800 w-64 flex-shrink-0 transition-all duration-300 ease-in-out z-40">
            <div class="flex items-center justify-center px-6 py-4">
                <div class="flex items-center">
                    <img src="{{ asset('icons/logo.png') }}" class="h-8 w-8 mr-2">
                    <span class="text-2xl font-bold text-gray-800">HRM</span>
                </div>
            </div>

        <!-- Navigation Links -->
        <nav class="mt-10">
            <a class="flex items-center px-6 py-3 mt-4 {{ request()->routeIs('dashboard') ? 'text-gray-700 bg-gray-200' : 'text-gray-500 hover:bg-gray-200 hover:text-gray-700' }}" href="{{ route('dashboard') }}">
                <i class="fas fa-tachometer-alt w-6 h-6"></i>
                <span class="mx-3">Dashboard</span>
            </a>

            <!-- HR ONLY LINKS -->
            @if(trim(Auth::user()->role) === 'hr')
                <a class="flex items-center px-6 py-3 mt-4 {{ request()->routeIs('hr.jobs.*') ? 'text-gray-700 bg-gray-200' : 'text-gray-500 hover:bg-gray-200 hover:text-gray-700' }}" href="{{ route('hr.jobs.index') }}">
                    <i class="fas fa-tasks w-6 h-6"></i>
                    <span class="mx-3">Manage Jobs</span>
                </a>
                <a class="flex items-center px-6 py-3 mt-4 {{ request()->routeIs('hr.users.index') ? 'text-gray-700 bg-gray-200' : 'text-gray-500 hover:bg-gray-200 hover:text-gray-700' }}" href="{{ route('hr.users.index') }}">
                    <i class="fas fa-users-cog w-6 h-6"></i>
                    <span class="mx-3">Manage Users</span>
                </a>
                <a class="flex items-center px-6 py-3 mt-4 {{ request()->routeIs('hr.applicants.index') ? 'text-gray-700 bg-gray-200' : 'text-gray-500 hover:bg-gray-200 hover:text-gray-700' }}" href="{{ route('hr.applicants.index') }}">
                    <i class="fas fa-user-friends w-6 h-6"></i>
                    <span class="mx-3">View Applicants</span>
                </a>
                <a class="flex items-center px-6 py-3 mt-4 {{ request()->routeIs('hr.users.verify.list') ? 'text-gray-700 bg-gray-200' : 'text-gray-500 hover:bg-gray-200 hover:text-gray-700' }}" href="{{ route('hr.users.verify.list') }}">
                    <i class="fas fa-user-check w-6 h-6"></i>
                    <span class="mx-3">Verify Users</span>
                </a>
            @endif

            <!-- REGULAR USER ONLY LINKS -->
            @if(trim(Auth::user()->role) === 'user')
                <a class="flex items-center px-6 py-3 mt-4 {{ request()->routeIs('jobs') ? 'text-gray-700 bg-gray-200' : 'text-gray-500 hover:bg-gray-200 hover:text-gray-700' }}" href="{{ route('jobs') }}">
                    <i class="fas fa-briefcase w-6 h-6"></i>
                    <span class="mx-3">Job Opportunities</span>
                </a>
                <a class="flex items-center px-6 py-3 mt-4 {{ request()->routeIs('my.applications') ? 'text-gray-700 bg-gray-200' : 'text-gray-500 hover:bg-gray-200 hover:text-gray-700' }}" href="{{ route('my.applications') }}">
                    <i class="fas fa-inbox w-6 h-6"></i>
                    <span class="mx-3">My Applications</span>
                </a>
            @endif

            <!-- LINKS FOR ALL USERS -->
            <a class="flex items-center px-6 py-3 mt-4 {{ request()->routeIs('profile.view') ? 'text-gray-700 bg-gray-200' : 'text-gray-500 hover:bg-gray-200 hover:text-gray-700' }}" href="{{ route('profile.view') }}">
                <i class="fas fa-user w-6 h-6"></i>
                <span class="mx-3">View Profile</span>
            </a>
            <a class="flex items-center px-6 py-3 mt-4 {{ request()->routeIs('profile.edit-page') ? 'text-gray-700 bg-gray-200' : 'text-gray-500 hover:bg-gray-200 hover:text-gray-700' }}" href="{{ route('profile.edit-page') }}">
                <i class="fas fa-user-edit w-6 h-6"></i>
                <span class="mx-3">Edit Profile</span>
            </a>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="flex items-center px-6 py-3 mt-4 text-gray-500 hover:bg-gray-200 hover:text-gray-700" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                this.closest('form').submit();">
                    <i class="fas fa-sign-out-alt w-6 h-6"></i>
                    <span class="mx-3">Logout</span>
                </a>
            </form>
        </nav>
        </aside>

        <!-- Main content area -->
        <div class="flex-1 flex flex-col">
            <!-- Header -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b-4 border-indigo-600 shadow-md z-30">
                <!-- menu button -->
                <div class="flex items-center">
                    <button id="sidebar-toggle" class="text-gray-500 focus:outline-none">
                        <i class="fas fa-bars w-6 h-6"></i>
                    </button>
                </div>

                <div class="flex items-center">
                    <div class="relative">
                        <span class="font-semibold">Welcome, {{ Auth::user()->name }}!</span>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Plain JavaScript to control the sidebar -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.getElementById('sidebar-toggle');
            // Start with the sidebar open on large screens
            let isSidebarOpen = window.innerWidth >= 768;

            function applySidebarState() {
                // When closed, give the sidebar a negative margin to pull it off-screen
                // This allows the main content to expand and fill the space
                if (isSidebarOpen) {
                    sidebar.style.marginLeft = '0';
                } else {
                    sidebar.style.marginLeft = '-16rem'; // Corresponds to w-64
                }
            }

            // Set the initial state when the page loads
            applySidebarState();

            // Toggle the state when the button is clicked
            toggleButton.addEventListener('click', function () {
                isSidebarOpen = !isSidebarOpen;
                applySidebarState();
            });

            // Reset the state when the window is resized
            window.addEventListener('resize', function () {
                isSidebarOpen = window.innerWidth >= 768;
                applySidebarState();
            });
        });
    </script>
</body>
</html>
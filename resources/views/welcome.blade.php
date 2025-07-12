<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="https://raw.githubusercontent.com/Renzybriann/hrm-assets/main/logo.png" type="image/x-icon">
    <title>HRM</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" xintegrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800">
    <div class="relative flex flex-col items-center justify-center min-h-screen">
        <!-- Header -->
        <header class="w-full absolute top-0 left-0 px-6 py-4">
            <nav class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center">
                    <img src="https://raw.githubusercontent.com/Renzybriann/hrm-assets/main/logo.png" class="h-10 w-10 mr-2">
                    <span class="text-xl font-bold text-gray-800">HRM</span>
                </div>
                <!-- Auth Links -->
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="rounded-md px-3 py-2 text-gray-700 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="rounded-md px-3 py-2 text-gray-700 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                Log in
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="rounded-md px-3 py-2 text-gray-700 ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </nav>
        </header>

        <!-- Main Content -->
        <main class="flex-grow flex items-center justify-center text-center">
            <div class="max-w-2xl mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                    Streamline Your HR Processes
                </h1>
                <p class="mt-4 text-lg text-gray-600">
                    Welcome to the Human Resource Management System. A centralized platform to manage employees, opportunities, and profiles with efficiency and ease.
                </p>
                <div class="mt-8 flex justify-center items-center space-x-4">
                    <a href="{{ route('login') }}" class="inline-block px-8 py-3 text-lg font-semibold text-white bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 transition-colors duration-300">
                        Get Started
                    </a>
                    <a href="{{ route('register') }}" class="inline-block px-8 py-3 text-lg font-semibold text-indigo-700 bg-indigo-100 rounded-lg hover:bg-indigo-200 transition-colors duration-300">
                        Sign Up
                    </a>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="w-full text-center text-sm text-gray-500 py-4">
            <p>Developed by: Renz Brian Matias</p>
            Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
        </footer>
    </div>
</body>
</html>

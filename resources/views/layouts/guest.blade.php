<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="{{ asset('icons/logo.png') }}" type="image/x-icon">
        {{-- DYNAMIC TITLE --}}
        <title>
            @if (request()->routeIs('login'))
                Login - HRM System
            @elseif (request()->routeIs('register'))
                Register - HRM System
            @else
                HRM System
            @endif
        </title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <div class="flex items-center justify-center">
                        {{-- FINAL BALANCED SOLUTION --}}
                        {{-- This uses a custom size of 26px for the image --}}
                        <img  src="https://raw.githubusercontent.com/Renzybriann/hrm-assets/main/logo.png" class="h-12 w-12 mr-2">
                        <span class="text-5xl font-bold text-gray-700">HRM</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-10 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
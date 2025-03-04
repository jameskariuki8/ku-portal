<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js (For Dropdown) -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="font-sans antialiased bg-gray-100 dark:bg-gray-900">

    <!-- Navigation Bar -->
    <nav class="bg-white shadow-md dark:bg-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center py-4">
                
                <!-- Logo -->
                <a href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-10">
                </a>

                <!-- Navigation Links -->
                <div class="space-x-6">
                    <a href="{{ url('/') }}" class="text-gray-700 dark:text-gray-300 font-medium hover:text-blue-500">Home</a>
                    
                    @auth
                        <a href="{{ url('/courses') }}" class="text-gray-700 dark:text-gray-300 font-medium hover:text-blue-500">Courses</a>
                    @else
                        <span class="text-gray-400 cursor-not-allowed">Courses</span> 
                    @endauth
                </div>

                <!-- Authentication Links -->
                <div class="relative" x-data="{ open: false }">
                    @auth
                        <!-- User Button with Dropdown -->
                        <button class="flex items-center space-x-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none"
                                @click="open = !open" @mouseover="open = true">
                            <span>{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @mouseleave="open = false"
                             class="absolute right-0 mt-2 w-40 bg-white dark:bg-gray-700 rounded-md shadow-lg z-50 transition-opacity duration-200"
                             x-cloak>
                            <a href="{{ route('profile.show') }}" class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-600">
                                View Profile
                            </a>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-500 hover:bg-gray-100 dark:hover:bg-gray-600">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="bg-blue-500 text-white px-3 py-1 rounded-md hover:bg-blue-700">Login</a>
                        <a href="{{ route('register') }}" class="ml-2 bg-green-500 text-white px-3 py-1 rounded-md hover:bg-green-700">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Heading -->
    @isset($header)
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <!-- Page Content -->
    <main class="max-w-7xl mx-auto mt-6 p-4">
        @yield('content')
    </main>

</body>
</html>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dallas Fried Chicken</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('storage/images/logo2.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="flex items-center justify-center h-screen bg-gray-100">
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden flex">
            <!-- Left Side: Background Image and Logo -->
            <div class="w-1/2 bg-cover bg-center relative" style="background-image: url('storage/images/banner4.jpg');">
                <div class="absolute inset-0 bg-black opacity-30"></div>
                <div class="relative flex items-center justify-center h-full">
                    <div class="text-center">
                        <img src="storage/images/logo.png" alt="Logo" class="mx-auto mb-4 w-50 h-50">
                    </div>
                </div>
            </div>

            <!-- Right Side: Login Form -->
            <div class="w-1/2 p-10">
                <h2 class="text-2xl font-semibold text-green-700 mb-4">Login</h2>
                <p class="text-gray-600 mb-8">Don't have an account? <a href="{{ route('register') }}" class="text-green-700 font-medium">Create an account</a></p>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" id="loginForm">
                    @csrf

                    <!-- User Type Selection -->
                    

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" class="rounded border-lime-700 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                            <span class="ms-2 text-sm text-lime-700">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <!-- Login Button and Forgot Password Link -->
                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-lime-700 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-primary-button class="ms-3 bg-lime-700 hover:bg-lime-800 text-white font-semibold px-4 py-2 rounded-md">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
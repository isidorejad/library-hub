<!-- resources/views/welcome.blade.php -->
@extends('layouts.<i class="fa fa-home" aria-hidden="true"></i>')

@section('content')
    <!-- Logo -->
    <div class="flex items-center justify-center w-full transition-opacity opacity-100 duration-750 starting:opacity-0 slide-in">
        <img src="{{ asset('logo.png') }}" alt="Library Hub Logo" class="max-w-xs mb-4">
    </div>

    <!-- Welcome Text and Subtext -->
    <div class="text-center slide-in">
        <h1 class="text-4xl font-semibold">Welcome to Library Hub!</h1>
        <p class="text-lg mt-2">
            Your ultimate platform to borrow, read, and share amazing stories.
            Discover a world of knowledge, connect with fellow readers, and explore endless possibilities—one book at a time.
        </p>
    </div>

    <!-- Login and Register Buttons -->
    @if (Route::has('login'))
        <nav class="nav-wrapper slide-in">
            @auth
                <a href="{{ route('dashboard') }}" class="inline-block px-6 py-2 text-white border border-gray-600 hover:border-gray-400 rounded-full text-sm leading-normal">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-block px-6 py-2 text-white border border-gray-600 hover:border-gray-400 rounded-full text-sm leading-normal">
                    Log in
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="inline-block px-6 py-2 text-white border border-gray-600 hover:border-gray-400 rounded-full text-sm leading-normal">
                        Register
                    </a>
                @endif
            @endauth
        </nav>
    @endif
@endsection

@extends('layouts.auth')

@section('title', 'Reset Password')
@section('auth-title', 'Reset your password')

@section('auth-content')
<form class="space-y-6" action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class='bx bx-envelope text-gray-400'></i>
            </div>
            <input id="email" name="email" type="email" autocomplete="email" required
                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary-600"
                   placeholder="your@email.com" value="{{ old('email', $request->email) }}">
        </div>
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    <div>
        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password *</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class='bx bx-lock-alt text-gray-400'></i>
            </div>
            <input id="password" name="password" type="password" autocomplete="new-password" required
                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary-600"
                   placeholder="••••••••">
        </div>
        @error('password')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password *</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class='bx bx-lock text-gray-400'></i>
            </div>
            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary-600"
                   placeholder="••••••••">
        </div>
    </div>
    
    <div>
        <button type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Reset Password
        </button>
    </div>
</form>
@endsection

@section('auth-footer')
Remember your password?
<a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500">
    Sign in here
</a>
@endsection
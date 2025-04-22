<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>

@extends('layouts.auth')

@section('title', 'Forgot Password')
@section('auth-title', 'Reset your password')

@section('auth-content')
<form class="space-y-6" action="{{ route('password.email') }}" method="POST">
    @csrf
    
    <div class="mb-4 text-sm text-gray-600">
        Forgot your password? No problem. Just let us know your email address and we will email you a password reset link.
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <i class='bx bx-envelope text-gray-400'></i>
            </div>
            <input id="email" name="email" type="email" autocomplete="email" required
                   class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary-600"
                   placeholder="your@email.com" value="{{ old('email') }}">
        </div>
        @error('email')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    
    <div>
        <button type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Email Password Reset Link
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
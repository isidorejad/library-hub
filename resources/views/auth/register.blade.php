@extends('layouts.auth')

@section('title', 'Register')
@section('auth-title', 'Create your account')

@section('auth-content')
<form class="space-y-6" action="{{ route('register') }}" method="POST">
    @csrf
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- First Row -->
        <div>
            <label for="username" class="block text-sm font-medium text-white mb-1">Username *</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class='bx bx-user text-gray-400'></i>
                </div>
                <input id="username" name="username" type="text" autocomplete="username" required
                       class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary-600"
                       placeholder="johndoe" value="{{ old('username') }}">
            </div>
            @error('username')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="email" class="block text-sm font-medium text-white mb-1">Email *</label>
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
        
        <!-- Second Row -->
        <div>
            <label for="password" class="block text-sm font-medium text-white mb-1">Password *</label>
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
            <label for="password_confirmation" class="block text-sm font-medium text-white mb-1">Confirm Password *</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class='bx bx-lock text-gray-400'></i>
                </div>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                       class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary-600"
                       placeholder="••••••••">
            </div>
        </div>
        
        <!-- Third Row -->
        <div>
            <label for="secret_question" class="block text-sm font-medium text-white mb-1">Security Question *</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class='bx bx-shield-quarter text-gray-400'></i>
                </div>
                <select id="secret_question" name="secret_question" required
                        class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary-600 appearance-none">
                    <option value="">Select a security question</option>
                    <option value="What is your mother's maiden name?" {{ old('secret_question') == "What is your mother's maiden name?" ? 'selected' : '' }}>What is your mother's maiden name?</option>
                    <option value="What was your first pet's name?" {{ old('secret_question') == "What was your first pet's name?" ? 'selected' : '' }}>What was your first pet's name?</option>
                    <option value="What city were you born in?" {{ old('secret_question') == "What city were you born in?" ? 'selected' : '' }}>What city were you born in?</option>
                    <option value="What was your high school mascot?" {{ old('secret_question') == "What was your high school mascot?" ? 'selected' : '' }}>What was your high school mascot?</option>
                </select>
            </div>
            @error('secret_question')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
        
        <div>
            <label for="secret_answer" class="block text-sm font-medium text-white mb-1">Security Answer *</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class='bx bx-key text-gray-400'></i>
                </div>
                <input id="secret_answer" name="secret_answer" type="text" required
                       class="pl-10 w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-primary-600"
                       placeholder="Your answer" value="{{ old('secret_answer') }}">
            </div>
            @error('secret_answer')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
    
    <!-- Submit Button (Full width below the grid) -->
    <div>
        <button type="submit"
                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
            Create Account
        </button>
    </div>
</form>
@endsection

@section('auth-footer')
Already have an account?
<a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500">
    Sign in here
</a>
@endsection
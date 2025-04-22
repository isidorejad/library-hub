@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-900">My Profile</h1>
            <a href="{{ route('users.edit') }}" class="px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700">
                Edit Profile
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <p class="text-sm font-medium text-gray-500">Username</p>
                <p class="text-gray-900">{{ $user->username }}</p>
            </div>
            <div>
                <p class="text-sm font-medium text-gray-500">Email</p>
                <p class="text-gray-900">{{ $user->email }}</p>
            </div>
        </div>

        <div class="mb-6">
            <p class="text-sm font-medium text-gray-500">Security Question</p>
            <p class="text-gray-900">{{ $user->secret_question }}</p>
        </div>

        <div class="border-t border-gray-200 pt-6">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Account Statistics</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Books Borrowed</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $user->loans()->count() }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Reviews Written</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $user->reviews()->count() }}</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm font-medium text-gray-500">Member Since</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $user->created_at->format('M Y') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
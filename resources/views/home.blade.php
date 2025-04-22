<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Library Hub</title>
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            600: '#dc2626',
                        },
                        gray: {
                            50: '#f9fafb',
                            100: '#f3f4f6',
                            200: '#e5e7eb',
                            300: '#d1d5db',
                            400: '#9ca3af',
                            500: '#6b7280',
                            600: '#4b5563',
                            700: '#374151',
                            800: '#1f2937',
                            900: '#111827',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');
        
        body {
            font-family: 'Inter', sans-serif;
            background-color:black;
        }
        
        .btn-primary {
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(220, 38, 38, 0.2), 0 2px 4px -1px rgba(220, 38, 38, 0.1);
        }
        
        .btn-outline {
            transition: all 0.3s ease;
        }
        
        .btn-outline:hover {
            color:white;
            background-color:red;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4">
    <div class="max-w-4xl mx-auto px-4 py-12 text-center">
        <div class="flex justify-center mb-2 w-300">
            <img src="{{ asset('logo.png') }}" alt="Library Hub Logo" class="w-300 h-110 ">
        </div>
        <!-- Welcome Text -->
        <h1 class="text-4xl font-bold text-white mb-4">Welcome to Library Hub</h1>
        <p class="text-lg text-white max-w-2xl mx-auto mb-12">
            Your ultimate platform to borrow, read, and share amazing stories.
            Discover a world of knowledge, connect with fellow readers, and explore endless possibilities—one book at a time.
        </p>
        
        <!-- Auth Buttons -->
        <div class="flex justify-center space-x-4">
            @auth
                <a href="{{ route('dashboard') }}" 
                   class="btn-primary px-6 py-3 bg-primary-600 text-white rounded-lg text-sm font-medium">
                    Go to Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" 
                   class="btn-primary px-6 py-3 bg-primary-600 text-white rounded-lg text-sm font-medium">
                    Log In
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" 
                       class="btn-outline px-6 py-3 border border-primary-600 text-primary-600 rounded-lg text-sm font-medium">
                        Register
                    </a>
                @endif
            @endauth
        </div>
    </div>
</body>
</html>
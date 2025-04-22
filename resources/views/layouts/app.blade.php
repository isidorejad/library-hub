<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Hub | @yield('title')</title>
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

          <!-- Favicons & Manifest -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('favicons/android-icon-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('manifest.json') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicons/ms-icon-144x144.png') }}">
    <meta name="theme-color" content="#ffffff">


    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: '#ff3131', // Red-600
                            50: '#fef2f2',
                            100: '#fee2e2',
                            200: '#fecaca',
                            300: '#fca5a5',
                            400: '#f87171',
                            500: '#ef4444',
                            600: '#dc2626',
                            700: '#b91c1c',
                            800: '#991b1b',
                            900: '#7f1d1d',
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
        }
        
        .sidebar-item.active {
            background-color: #fee2e2; /* Red-100 */
            border-right: 3px solid #ff3131; /* Red-600 */
            color #ff3131; /* Red-600 */
        }
        
        .sidebar-item.active i {
            color: #ff3131; /* Red-600 */
        }
        
        .sidebar-item:hover:not(.active) {
            background-color: #f5f5f5;
        }
        
        .nav-shadow {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="h-full">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="hidden lg:flex lg:flex-shrink-0">
            <div class="flex flex-col w-64 border-r border-gray-200 bg-white">
                <!-- Logo -->
                <div class="flex items-center h-20 px-6 bg-black border-b border-gray-200">
                    <div class="flex items-center p-2">
                    <img src="{{ asset('logo.png') }}" alt="Library Hub Logo" class="w-500 h-110 ">
                    </div>
                </div>
                
                <!-- Navigation -->
                <div class="flex flex-col flex-grow px-4 py-8 overflow-y-auto">
                    <nav class="flex-1 space-y-1">
                        <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'active' : 'text-gray-700 hover:text-gray-900' }}">
                            <i class='bx bx-grid-alt text-2xl mr-3'></i>
                            Dashboard
                        </a>
                        <a href="{{ route('books.index') }}" class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('books*') ? 'active' : 'text-gray-700 hover:text-gray-900' }}">
                            <i class='bx bx-book text-2xl mr-3'></i>
                            Books
                        </a>
                        <a href="{{ route('categories.index') }}" class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('categories*') ? 'active' : 'text-gray-700 hover:text-gray-900' }}">
                            <i class='bx bx-category text-2xl mr-3'></i>
                            Categories
                        </a>
                        <a href="{{ route('tags.index') }}" class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('tags*') ? 'active' : 'text-gray-700 hover:text-gray-900' }}">
                            <i class='bx bx-hash text-2xl mr-3'></i>
                            Tags
                        </a>
                        <a href="{{ route('loans.index') }}" class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('loans*') ? 'active' : 'text-gray-700 hover:text-gray-900' }}">
                            <i class='bx bx-transfer text-2xl mr-3'></i>
                            Loans
                        </a>
                    </nav>
                    
                    <!-- User section -->
                    <div class="mt-auto pt-6 border-t border-gray-200">
                        <div class="flex items-center px-4 py-3">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-primary-100 flex items-center justify-center">
                                    <i class='bx bx-user text-primary-600 text-xl'></i>
                                </div>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->username }}</p>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-xs text-gray-500 hover:text-primary-600">
                                    Sign out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mobile sidebar -->
        <div class="lg:hidden fixed inset-0 z-40" id="mobile-menu" style="display: none;">
            <div class="fixed inset-0 bg-gray-600 bg-opacity-75" onclick="toggleMobileMenu()"></div>
            <div class="relative flex flex-col w-80 max-w-xs bg-white h-full">
                <div class="flex items-center h-16 px-6 border-b border-gray-200">
                    <div class="flex items-center">
                        <i class='bx bx-book-open text-3xl text-primary-600'></i>
                        <span class="ml-3 text-xl font-bold text-black">Library Hub</span>
                    </div>
                    <button type="button" class="ml-auto -mr-4 p-2 rounded-md text-gray-400 hover:text-gray-500" onclick="toggleMobileMenu()">
                        <i class='bx bx-x text-2xl'></i>
                    </button>
                </div>
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    <nav class="flex-1 space-y-1">
                        <a href="{{ route('dashboard') }}" class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('dashboard') ? 'active' : 'text-gray-700 hover:text-gray-900' }}">
                            <i class='bx bx-grid-alt text-2xl mr-3'></i>
                            Dashboard
                        </a>
                        <a href="{{ route('books.index') }}" class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('books*') ? 'active' : 'text-gray-700 hover:text-gray-900' }}">
                            <i class='bx bx-book text-2xl mr-3'></i>
                            Books
                        </a>
                        <a href="{{ route('categories.index') }}" class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('categories*') ? 'active' : 'text-gray-700 hover:text-gray-900' }}">
                            <i class='bx bx-category text-2xl mr-3'></i>
                            Categories
                        </a>
                        <a href="{{ route('tags.index') }}" class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('tags*') ? 'active' : 'text-gray-700 hover:text-gray-900' }}">
                            <i class='bx bx-hash text-2xl mr-3'></i>
                            Tags
                        </a>
                        <a href="{{ route('loans.index') }}" class="sidebar-item flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all duration-200 {{ request()->routeIs('loans*') ? 'active' : 'text-gray-700 hover:text-gray-900' }}">
                            <i class='bx bx-transfer text-2xl mr-3'></i>
                            Loans
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top navigation -->
            <header class="bg-white nav-shadow">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center">
                        <button class="lg:hidden text-gray-500 focus:outline-none" onclick="toggleMobileMenu()">
                            <i class='bx bx-menu text-2xl'></i>
                        </button>
                        <h1 class="ml-4 text-xl font-semibold text-gray-900">@yield('title')</h1>
                    </div>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                            <i class='bx bx-bell text-xl'></i>
                        </button>
                        <div class="relative">
                            <button class="flex items-center text-gray-500 hover:text-gray-700 focus:outline-none" onclick="toggleUserDropdown()">
                                <div class="w-8 h-8 rounded-full bg-primary-100 flex items-center justify-center">
                                    <i class='bx bx-user text-primary-600'></i>
                                </div>
                                <span class="ml-2 text-sm font-medium text-gray-700 hidden md:inline">{{ Auth::user()->username }}</span>
                                <i class='bx bx-chevron-down ml-1 text-gray-400'></i>
                            </button>
                            <!-- User dropdown -->
                            <div id="user-dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 border border-gray-200">
                                <a href="{{ route('users.show') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class='bx bx-user mr-2'></i> Profile
                                </a>
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class='bx bx-cog mr-2'></i> Settings
                                </a>
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <i class='bx bx-log-out mr-2'></i> Sign out
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="flex-1 overflow-y-auto bg-gray-50 p-6">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.style.display = mobileMenu.style.display === 'none' ? 'block' : 'none';
        }
        
        function toggleUserDropdown() {
            const dropdown = document.getElementById('user-dropdown');
            dropdown.classList.toggle('hidden');
        }
        
        // Close dropdowns when clicking outside
        document.addEventListener('click', function(event) {
            const userDropdown = document.getElementById('user-dropdown');
            const userButton = document.querySelector('[onclick="toggleUserDropdown()"]');
            
            if (userDropdown && !userDropdown.contains(event.target) && !userButton.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
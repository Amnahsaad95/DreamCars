<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Draem Cars Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	
	<link rel="stylesheet" href="{{ asset('font/stylesheet.css') }}" >
	<script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#C289A8',
                        pending: '#f59e0b',
                        published: '#10b981',
                        rejected: '#ef4444',
                    }
                }
            }
        }
    </script>
    <style>
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
        .tab-button.active {
            border-bottom: 3px solid #3b82f6;
            color: #3b82f6;
            font-weight: 600;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100 font-sans">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <div class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-indigo-800 text-white">
                <div class="flex items-center justify-center h-16 px-4 bg-indigo-900">
                    <a href="{{ url('/') }}"><span class="logo text-xl font-bold">Draem Cars</span></a>
                </div>
                <div class="flex flex-col flex-grow px-4 py-4 overflow-y-auto">
                    <nav class="flex-1 space-y-2">
                        <a href="{{route('dashboard')}}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg bg-indigo-700 text-white">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            Dashboard
                        </a>
                        <a href="{{ route('carlists') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-indigo-200 hover:bg-indigo-700 hover:text-white">
                            <i class="fas fa-car-alt mr-3"></i>
                            Cars
                        </a>
						@if(Auth::user()->Role == 1)
							<a href="{{ route('ComplaintSuggestionManagement') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-indigo-200 hover:bg-indigo-700 hover:text-white">
								<i class="fas fa-comment-dots mr-3"></i>
								Complaint/Suggestion
							</a>
							<a href="{{ route('UsersManagement') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-indigo-200 hover:bg-indigo-700 hover:text-white">
								<i class="fas fa-users mr-3"></i>
								Users
							</a>
							<a href="{{ route('AdsManagement') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-indigo-200 hover:bg-indigo-700 hover:text-white">
								<i class="fas fa-tag mr-3"></i>
								Ads
							</a>
						@endif
                        <a href="{{ route('Settings') }}" class="flex items-center px-4 py-2 text-sm font-medium rounded-lg text-indigo-200 hover:bg-indigo-700 hover:text-white">
                            <i class="fas fa-cog mr-3"></i>
                            Settings
                        </a>
                    </nav>
                    <div class="mt-auto pb-4">
                        <div class="flex items-center px-4 py-3 bg-indigo-700 rounded-lg">
                            <img class="h-8 w-8 rounded-full" src="{{ asset('storage/' . Auth::user()->profile_Image) }}" alt="User avatar">
                            <div class="ml-3">
                                <p class="text-sm font-medium">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-indigo-200">Admin</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex flex-col flex-1 overflow-hidden">
            <!-- Top Navigation -->
            <header class="flex items-center justify-between px-6 py-4 bg-white border-b">
                <div class="flex items-center">
                    <button class="md:hidden text-gray-500 focus:outline-none">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="relative mx-4">
                        <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                        <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                   <!-- <button class="text-gray-500 focus:outline-none">
                        <i class="fas fa-bell"></i>
                    </button>
                    <button class="text-gray-500 focus:outline-none">
                        <i class="fas fa-envelope"></i>
                    </button>-->
                    <div class="flex items-center">
                        <img class="h-8 w-8 rounded-full" src="{{ asset('storage/' . Auth::user()->profile_Image) }}" alt="User avatar">
                        <a href="{{route('logout')}}"><span class="ml-2 text-sm font-medium">Logout</span></a>
                    </div>
                </div>
            </header>

           {{ $slot }}
        </div>
    </div>

</body>
</html>
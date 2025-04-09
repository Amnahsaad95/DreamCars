<!DOCTYPE html>
<html lang="en" x-data="{ 
    isArabic: false,
    currentSlide: 0,
    
    navOpen: false,
    profileDropdown: false,
    
    banners: [
        'Special financing available!',
        'Free inspection with every purchase',
        'Limited-time trade-in bonus'
    ],
    currentBanner: 0,
    init() {
        setInterval(() => {
            this.currentSlide = (this.currentSlide + 1) % 3;
        }, 5000);
        setInterval(() => {
            this.currentBanner = (this.currentBanner + 1) % this.banners.length;
        }, 8000);
    }
 }" x-init="init()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <title>{{$settings->site_name}} - Find Your Dream Car</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!--<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link rel="stylesheet" href="{{ asset('font/stylesheet.css') }}" >
	<link rel="shortcut icon" sizes="114x114" href="{{ asset('storage/' . $settings->site_icon) }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3b82f6',
                        secondary: '#1e40af',
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans bg-gray-50" :dir="isArabic ? 'rtl' : 'ltr'">
    <!-- 1. Navigation Bar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <!--<img src="https://via.placeholder.com/50" alt="AutoMarket Logo" class="h-10 mr-3">-->
                <span class="logo text-xl font-bold text-primary">{{$settings->site_name}}</span>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="navOpen = !navOpen" class="text-gray-700">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-6" :class="{ 'space-x-reverse': isArabic }">
                <a href="{{ url('/') }}" class="text-gray-700 hover:text-primary">Home</a>
                <a href="{{ route('AllCar') }}" class="text-gray-700 hover:text-primary">Cars</a>
                <a href="{{ route('aboutUs') }}" class="text-gray-700 hover:text-primary">About Us</a>
                <a href="{{ route('ComplaintSuggestionForm') }}" class="text-gray-700 hover:text-primary">Contact</a>
				
                @auth
					<!-- Profile Dropdown -->
					<div class="relative">
						<button @click="profileDropdown = !profileDropdown" class="flex items-center">
							<img src="{{ asset('storage/' . Auth::user()->profile_Image) }}" alt="Profile" class="w-8 h-8 rounded-full">
						</button>
						<div x-show="profileDropdown" @click.away="profileDropdown = false" 
							 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 border border-gray-200"
							 :class="{ 'right-auto left-0': isArabic }">
							<a href="{{route('dashboard')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Dashboard</a>
							<a href="{{ route('carlists') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">My Cars</a>
							<a href="{{route('Settings')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
							<a href="{{route('logout')}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</a>
						</div>
					</div>
                @else						
					<a href="{{ route('login') }}" class="text-gray-700 hover:text-primary">Login</a>
					<a href="{{ route('register') }}" class="text-gray-700 hover:text-primary">SignUp</a>
				@endauth	
                <!-- Language Toggle -->
                <button @click="isArabic = !isArabic" class="px-3 py-1 bg-gray-100 rounded-full text-sm">
                    <span x-show="!isArabic">العربية</span>
                    <span x-show="isArabic">English</span>
                </button>
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div x-show="navOpen" class="md:hidden bg-white py-2 px-4 border-t">
            <a href="{{ url('/') }}" class="block py-2 text-gray-700">Home</a>
            <a href="{{ route('AllCar') }}" class="block py-2 text-gray-700">Cars</a>
            <a href="{{ route('aboutUs') }}" class="block py-2 text-gray-700">About Us</a>
            <a href="{{ route('ComplaintSuggestionForm') }}" class="block py-2 text-gray-700">Contact</a>
            <div class="pt-2 border-t mt-2">
                <button @click="isArabic = !isArabic" class="px-3 py-1 bg-gray-100 rounded-full text-sm">
                    <span x-show="!isArabic">العربية</span>
                    <span x-show="isArabic">English</span>
                </button>
            </div>
        </div>
    </nav>

    <!-- 2. Carousel -->
    <div class="relative h-96 overflow-hidden">
        <div class="absolute inset-0 flex transition-transform duration-1000" 
             :style="`transform: translateX(-${currentSlide * 100}%)`">
            <div class="w-full flex-shrink-0 bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white">
                <div class="text-center px-8">
                    <h2 class="text-4xl font-bold mb-4">{{$settings->intro_title_1}}</h2>
                    <p class="text-xl mb-6">{{$settings->intro_text_1}}</p>
                    <button onclick="scrollToSearchSection()" class="bg-white text-primary px-6 py-2 rounded-full font-semibold hover:bg-gray-100">
                        Start Searching
                    </button>
                </div>
            </div>
            <div class="w-full flex-shrink-0 bg-gradient-to-r from-secondary to-primary flex items-center justify-center text-white">
                <div class="text-center px-8">
                    <h2 class="text-4xl font-bold mb-4">{{$settings->intro_title_2}}</h2>
                    <p class="text-xl mb-6">{{$settings->intro_text_2}}</p>
                    <button class="bg-white text-primary px-6 py-2 rounded-full font-semibold hover:bg-gray-100">
                        Explore Cars
                    </button>
                </div>
            </div>
            <div class="w-full flex-shrink-0 bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white">
                <div class="text-center px-8">
                    <h2 class="text-4xl font-bold mb-4">{{$settings->intro_title_3}}</h2>
                    <p class="text-xl mb-6">{{$settings->intro_text_3}}</p>
                    <button onclick="window.location.href='{{ url('/addNewAds') }}'" class="bg-white text-primary px-6 py-2 rounded-full font-semibold hover:bg-gray-100">
                       Post Your Ad Now
                    </button>
                </div>
            </div>
        </div>
        <div class="absolute bottom-4 left-0 right-0 flex justify-center space-x-2">
            <template x-for="i in 3" :key="i">
                <button @click="currentSlide = i - 1" 
                        class="w-3 h-3 rounded-full" 
                        :class="currentSlide === i - 1 ? 'bg-white' : 'bg-white/50'"></button>
            </template>
        </div>
    </div>

    
	
	{{ $slot }}

    

    <!-- 9. Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="logo text-xl font-bold mb-4">{{$settings->site_name}}</h3>
                    <p class="text-gray-400">{{$settings->siteDescription}}</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="{{ route('AllCar') }}" class="text-gray-400 hover:text-white">Browse Cars</a></li>
                        <li><a href="{{ route('aboutUs') }}" class="text-gray-400 hover:text-white">About us</li>
                        <li><a href="{ route('ComplaintSuggestionForm') }}" class="text-gray-400 hover:text-white">Contact us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact Us</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center"><i class="fas fa-phone-alt mr-2"></i>{{$settings->whatsapp_number}}</li>
                        <li class="flex items-center"><i class="fas fa-envelope mr-2"></i> {{$settings->sitemail}}</li>
                        <li class="flex items-center"><i class="fas fa-map-marker-alt mr-2"></i> {{$settings->site_location}}</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Connect With Us</h4>
                    <div class="flex space-x-4">
                        <a href="{{$settings->facebook_url}}" class="text-gray-400 hover:text-white"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="https://wa.me/{{ $settings->whatsapp_number }}" class="text-gray-400 hover:text-white"><i class="fab fa-whatsapp text-xl"></i></a>
                        <a href="{{$settings->instagram_url}}" class="text-gray-400 hover:text-white"><i class="fab fa-instagram text-xl"></i></a>
                    </div>
                    <div class="mt-4">
                        <button @click="isArabic = !isArabic" class="px-4 py-2 bg-gray-700 rounded-md text-sm">
                            <span x-show="!isArabic">العربية</span>
                            <span x-show="isArabic">English</span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 {{$settings->site_name}} . All rights reserved.</p>
            </div>
        </div>
    </footer>
	<script>
	function scrollToSearchSection() {
	   // Scroll to the search section
	   document.getElementById('search-section').scrollIntoView({
		  behavior: 'smooth'
	   });
	}
	</script>
</body>
</html>

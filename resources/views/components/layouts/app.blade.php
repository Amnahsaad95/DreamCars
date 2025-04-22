<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" x-data="{ 
    isArabic: true,
    currentSlide: 0,
    
    navOpen: false,
    profileDropdown: false,
    isRtl: {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
    currentBanner: 0,
    init() {
        setInterval(() => {
            this.currentSlide = (this.currentSlide + 1) % 3;
        }, 5000);
        setInterval(() => {
            this.currentBanner = (this.currentBanner + 1) % 3;
        }, 8000);
    }
	,
	
 }" x-init="init()">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	
    <title>{{$settings->site_name}} - Find Your Dream Car</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <!--<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@700;800;900&display=swap" rel="stylesheet">
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
	<style>
        .auth-dropdown {
            opacity: 0;
            transform: translateY(-10px);
            visibility: hidden;
            transition: all 0.3s ease;
        }
        .auth-dropdown.open {
            opacity: 1;
            transform: translateY(0);
            visibility: visible;
        }
    </style>
</head>
<body class="font-sans bg-gray-50 {{ app()->getLocale() == 'ar' ? 'font-arabic' : 'font-sans' }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}" >
     <nav class="bg-white shadow-md">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <!-- Logo -->
            <div class="flex items-center">
                <!--<img src="https://via.placeholder.com/50" alt="AutoMarket Logo" class="h-10 mr-3">-->
                <span class="logo text-xl font-bold text-primary">{{app()->getLocale() == 'ar' ? $settings->site_name_Ar : $settings->site_name}}</span>
            </div>
            
            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="navOpen = !navOpen" class="text-gray-700">
                    <i class="fas fa-bars text-2xl"></i>
                </button>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-6" :class="{ 'space-x-reverse': isArabic }">
                <a href="{{ route('Home',['locale' => app()->getLocale()]) }}" class="text-gray-700 hover:text-primary">{{ __('messages.Home') }}</a>
                <a href="#" class="text-gray-700 hover:text-primary"></a>
                <a href="{{ route('AllCar',['locale' => app()->getLocale()]) }}" class="text-gray-700 hover:text-primary">{{ __('messages.Cars') }}</a>
                <a href="{{ route('aboutUs',['locale' => app()->getLocale()]) }}" class="text-gray-700 hover:text-primary">{{ __('messages.AboutUs') }}</a>
                <a href="{{ route('ComplaintSuggestionForm',['locale' => app()->getLocale()]) }}" class="text-gray-700 hover:text-primary">{{ __('messages.ContactUs') }}</a>
				
                @auth
					<!-- Profile Dropdown -->
					<div class="relative">
						<button @click="profileDropdown = !profileDropdown" class="flex items-center">
							<img src="{{ asset('storage/' . Auth::user()->profile_Image) }}" alt="Profile" class="w-8 h-8 rounded-full">
						</button>
						<div x-show="profileDropdown" @click.away="profileDropdown = false" 
							 class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-10 border border-gray-200"
							 :class="{ 'right-auto left-0': isArabic }">
							<a href="{{route('dashboard',['locale' => app()->getLocale()])}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('dashboard.dashboard') }} </a>
							<a href="{{ route('carlists',['locale' => app()->getLocale()]) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('dashboard.Cars') }}</a>
							<a href="{{route('Settings',['locale' => app()->getLocale()])}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('dashboard.Settings') }} </a>
							<a href="{{route('logout',['locale' => app()->getLocale()])}}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">{{ __('auth.logout') }}</a>
						</div>
					</div>
                @else	
					
					<div x-data="{ open: false }" class="relative inline-block text-{{ app()->getLocale() == 'ar' ? 'right' : 'left' }} px-6">
						<!-- Styled User Button -->
						<button 
							@click="open = !open"
							class="relative flex items-center justify-center w-10 h-10 rounded-full bg-gradient-to-br from-purple-500 to-indigo-600 shadow-lg hover:shadow-xl transition-all duration-300 group"
						>
							<!-- User Icon -->
							<i class="fas fa-user text-white text-xl"></i>
							
							<!-- Animated Ring Effect -->
							<span class="absolute inset-0 rounded-full border-2 border-transparent group-hover:border-white/30 transition-all duration-300"></span>
							
						</button>
						
						<!-- Dropdown Menu -->
						<div 
							x-show="open"
							@click.away="open = false"
							x-cloak
							x-transition:enter="transition ease-out duration-200"
							x-transition:enter-start="opacity-0 scale-95"
							x-transition:enter-end="opacity-100 scale-100"
							x-transition:leave="transition ease-in duration-150"
							x-transition:leave-start="opacity-100 scale-100"
							x-transition:leave-end="opacity-0 scale-95"
							class="absolute left-0  mt-2 w-64 origin-top-right rounded-xl bg-white shadow-xl z-50 overflow-hidden border border-gray-100 "
						>
							<!-- Dropdown Header -->
							<div class="p-4 bg-gradient-to-r from-purple-500 to-indigo-600 text-white">
								<h3 class="font-bold text-lg">{{ __('messages.welcome') }}</h3>
								<p class="text-sm opacity-90">{{ __('messages.join_community') }}</p>
							</div>
							
							<!-- Dropdown Content -->
							<div class="p-4">
								<!-- Login Button -->
								<a href="{{route('login')}}" class="flex items-center justify-between px-4 py-3 mb-2 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors group">
									<div class="flex items-center">
										<div class="p-2 mr-3 rounded-full bg-indigo-100 text-indigo-600">
											<i class="fas fa-sign-in-alt text-sm"></i>
										</div>
										<div class="px-2">
											<p class="font-medium text-gray-800">{{ __('messages.sign_in') }}</p>
											<p class="text-xs text-gray-500">{{ __('messages.already_have_account') }}</p>
										</div>
									</div>
									<i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-gray-400 group-hover:text-indigo-500 transition-colors"></i>
								</a>
								
								<!-- Register Button -->
								<a href="{{ route('register') }}" class="flex items-center justify-between px-4 py-3 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors group">
									<div class="flex items-center">
										<div class="p-2 mr-3 rounded-full bg-purple-100 text-purple-600">
											<i class="fas fa-user-plus text-sm"></i>
										</div>
										<div class="px-2">
											<p class="font-medium text-gray-800">{{ __('messages.create_account') }}</p>
											<p class="text-xs text-gray-500">{{ __('messages.new_to_platform') }}</p>
										</div>
									</div>
									<i class="fas fa-chevron-{{ app()->getLocale() == 'ar' ? 'left' : 'right' }} text-gray-400 group-hover:text-purple-500 transition-colors"></i>
								</a>
							</div>
							
							<!-- Dropdown Footer -->
							<div class="px-4 py-3 bg-gray-50 border-t text-center">
							</div>
						</div>
					</div>
					
				@endauth	
                <!-- Language Toggle -->
               	<livewire:language-switcher :currentRouteName="Route::currentRouteName()" 
											:currentRouteParams="request()->route()->parameters()" /> 
				
				
            </div>
        </div>
        
        <!-- Mobile Navigation -->
        <div x-show="navOpen" class="md:hidden bg-white py-2 px-4 border-t">
            <a href="{{ route('Home',['locale' => app()->getLocale()]) }}" class="block py-2 text-gray-700">{{ __('messages.Home') }}</a>
            <a href="{{ route('AllCar',['locale' => app()->getLocale()]) }}" class="block py-2 text-gray-700">{{ __('messages.Cars') }}</a>
            <a href="{{ route('aboutUs',['locale' => app()->getLocale()]) }}" class="block py-2 text-gray-700">{{ __('messages.AboutUs') }}</a>
            <a href="{{ route('ComplaintSuggestionForm') }}" class="block py-2 text-gray-700">{{ __('messages.ContactUs') }}</a>
            @auth
        <!-- Mobile Account Links for Authenticated Users -->
        <div class="pt-2 border-t mt-2">
            <a href="{{route('dashboard',['locale' => app()->getLocale()])}}" class="block py-2 text-gray-700">{{ __('dashboard.dashboard') }}</a>
            <a href="{{ route('carlists',['locale' => app()->getLocale()]) }}" class="block py-2 text-gray-700">{{ __('dashboard.Cars') }}</a>
            <a href="{{route('Settings',['locale' => app()->getLocale()])}}" class="block py-2 text-gray-700">{{ __('dashboard.Settings') }}</a>
            <a href="{{route('logout',['locale' => app()->getLocale()])}}" class="block py-2 text-gray-700">{{ __('auth.logout') }}</a>
        </div>
    @else
        <!-- Mobile Login & Register Links for Non-Authenticated Users -->
        <div class="pt-2 border-t mt-2">
            <a href="{{route('login')}}" class="block py-2 text-gray-700">{{ __('auth.login') }}</a>
            <a href="{{ route('register') }}" class="block py-2 text-gray-700">{{ __('auth.register') }}</a>
        </div>
    @endauth
			<div class="pt-2 border-t mt-2">
                <livewire:language-switcher :currentRouteName="Route::currentRouteName()" 
											:currentRouteParams="request()->route()->parameters()" />
            </div>
			
        </div>
    </nav>

    <!-- 2. Carousel -->
    <div class="relative h-96 overflow-hidden">
        <div class="absolute inset-0 flex transition-transform duration-1000" 
             :style="`transform: translateX(${isRtl ? currentSlide * 100 : -currentSlide * 100}%);`">
            <div class="w-full flex-shrink-0 bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white">
                <div class="text-center px-8">
                    <h2 class="text-4xl font-bold mb-4">{{app()->getLocale() == 'ar' ? $settings->intro_title_1_Ar : $settings->intro_title_1}}</h2>
                    <p class="text-xl mb-6">{{app()->getLocale() == 'ar' ? $settings->intro_text_1_Ar : $settings->intro_text_1}}</p>
                    <button onclick="scrollToSearchSection('search-section', '{{ route('Home',['locale' => app()->getLocale()]) }}')" class="bg-white text-primary px-6 py-2 rounded-full font-semibold hover:bg-gray-100">
                        {{ __('messages.start_search') }}
                    </button>
                </div>
            </div>
            <div class="w-full flex-shrink-0 bg-gradient-to-r from-secondary to-primary flex items-center justify-center text-white">
                <div class="text-center px-8">
                    <h2 class="text-4xl font-bold mb-4">{{app()->getLocale() == 'ar' ? $settings->intro_title_2_Ar : $settings->intro_title_2}}</h2>
                    <p class="text-xl mb-6">{{app()->getLocale() == 'ar' ? $settings->intro_text_2_Ar : $settings->intro_text_2}}</p>
                    <button onclick="window.location.href='{{ route('AllCar',['locale' => app()->getLocale()]) }}'" class="bg-white text-primary px-6 py-2 rounded-full font-semibold hover:bg-gray-100">
                        {{ __('messages.explore_cars') }}
                    </button>
                </div>
            </div>
            <div class="w-full flex-shrink-0 bg-gradient-to-r from-primary to-secondary flex items-center justify-center text-white">
                <div class="text-center px-8">
                    <h2 class="text-4xl font-bold mb-4">{{app()->getLocale() == 'ar' ? $settings->intro_title_3_Ar : $settings->intro_title_3}}</h2>
                    <p class="text-xl mb-6">{{app()->getLocale() == 'ar' ? $settings->intro_text_3_Ar : $settings->intro_text_3}}</p>
                    <button onclick="window.location.href='{{ route('addNewAds',['locale' => app()->getLocale()]) }}'" class="bg-white text-primary px-6 py-2 rounded-full font-semibold hover:bg-gray-100">
                       {{ __('messages.post_Ads') }}
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
                    <h3 class="logo text-xl font-bold mb-4">{{app()->getLocale() == 'ar' ? $settings->site_name_Ar : $settings->site_name}}</h3>
                    <p class="text-gray-400">{{app()->getLocale() == 'ar' ? $settings->siteDescriptionAr : $settings->siteDescription}}</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">{{ __('messages.QuickLink') }}</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('Home',['locale' => app()->getLocale()]) }}" class="text-gray-400 hover:text-white">{{ __('messages.Home') }}</a></li>
                        <li><a href="{{ route('AllCar',['locale' => app()->getLocale()]) }}" class="text-gray-400 hover:text-white">{{ __('messages.Cars') }}</a></li>
                        <li><a href="{{ route('aboutUs',['locale' => app()->getLocale()]) }}" class="text-gray-400 hover:text-white">{{ __('messages.AboutUs') }}</li>
                        <li><a href="{{ route('ComplaintSuggestionForm',['locale' => app()->getLocale()]) }}" class="text-gray-400 hover:text-white">{{ __('messages.ContactUs') }}</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">{{ __('messages.ContactUs') }}</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center"><i class="fas fa-phone-alt mr-2 px-2"></i>{{$settings->whatsapp_number}}</li>
                        <li class="flex items-center"><i class="fas fa-envelope mr-2 px-2"></i> {{$settings->sitemail}}</li>
                        <li class="flex items-center"><i class="fas fa-map-marker-alt mr-2 px-2"></i> {{$settings->site_location}}</li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">{{ __('messages.ConnectWithUs') }}</h4>
                    <div class="flex space-x-4">
                        <a href="{{$settings->facebook_url}}" class="text-gray-400 hover:text-white px-2"><i class="fab fa-facebook-f text-xl"></i></a>
                        <a href="https://wa.me/{{ $settings->whatsapp_number }}" class="text-gray-400 hover:text-white px-2"><i class="fab fa-whatsapp text-xl"></i></a>
                        <a href="{{$settings->instagram_url}}" class="text-gray-400 hover:text-white px-2"><i class="fab fa-instagram text-xl"></i></a>
                    </div>
                    <div class="mt-4 text-blue-400">
                         <!-- Language Toggle -->
						<livewire:language-switcher :currentRouteName="Route::currentRouteName()" 
											:currentRouteParams="request()->route()->parameters()" /> 
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>{{ __('messages.rights_reserved', [
									'year' => date('Y'),
									'name' => app()->getLocale() == 'ar' ? $settings->site_name_Ar : $settings->site_name
								]) 
					}}
				</p>
            </div>
        </div>
    </footer>


    
	<script>
	function scrollToSearchSection(sectionId, url = null) {
	   // Scroll to the search section
	     if (window.location.pathname === url || url === null) {
			document.getElementById(sectionId)?.scrollIntoView({ behavior: 'smooth' });
		} else {
			window.location.href = url + '#' + sectionId;
		}	
	}
    window.addEventListener('reload-page', () => {
        window.location.reload();
    });
	
	</script>
</body>
</html>

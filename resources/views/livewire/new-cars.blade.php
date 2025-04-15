<div>
    <!-- 5. Latest 6 Cars -->
    <section class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">{{ __('messages.RecentlyCars') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
		@foreach($cars as $car)
                <div wire:click="show({{$car->car_Id}})" class="cursor-pointer  bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition">
                    <div class="h-48 bg-gray-200 relative">
                        <img src="{{ asset('storage/'.explode(',', $car->car_Image)[0] ) }}" alt="{{ $car->Brand }}" class="h-full w-full object-cover">
                        <div class="absolute top-2 right-2 bg-white/90 px-2 py-1 rounded text-sm font-medium">
                            <span x-text="{{ $car->car_Year }}">{{ $car->car_Year }}</span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg" >{{ $car->Brand }}  {{ $car->car_Model }}</h3>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-primary font-bold" >$  {{ $car->car_Price }}</span>
                            <button class="text-gray-500 hover:text-primary">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
		@endforeach 
        </div>
    </section>

    <!-- 6. Random 3 Cars -->
    <section class="container mx-auto px-4 py-8 bg-gray-100 rounded-lg">
        <h2 class="text-2xl font-bold mb-6">{{ __('messages.FeatureCars') }}</h2>
        <div wire:poll.keep-alive.20s class="grid grid-cols-1 md:grid-cols-3 gap-6">
		@foreach($randomCars as $car)
                <div wire:click="show({{$car->car_Id}})" class="cursor-pointer bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 hover:shadow-lg transition">
                    <div class="h-48 bg-gray-200 relative">
                        <img src="{{ asset('storage/'.explode(',', $car->car_Image)[0] ) }}" alt="{{ $car->Brand }}" class="h-full w-full object-cover">
                        <div class="absolute top-2 right-2 bg-white/90 px-2 py-1 rounded text-sm font-medium">
                            <span x-text="{{ $car->car_Year }}"></span>
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="font-semibold text-lg" >{{ $car->Brand }}  {{ $car->car_Model }}</h3>
                        <div class="flex justify-between items-center mt-2">
                            <span class="text-primary font-bold" >${{ $car->car_Price }}</span>
                            <button class="px-3 py-1 bg-primary text-white text-sm rounded hover:bg-secondary">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>
		@endforeach 
        </div>
    </section>

    <!-- 7. Last 5 Sold Cars -->
    <section class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">{{ __('messages.SoldCars') }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
		@foreach($soldCars as $car)
                <div wire:click="show({{$car->car_Id}})" class="cursor-pointer  bg-white rounded-lg shadow overflow-hidden border border-gray-200">
                    <div class="h-32 bg-gray-200 relative">
                        <img src="{{ asset('storage/'.explode(',', $car->car_Image)[0] ) }}" alt="{{ $car->Brand }}" class="h-full w-full object-cover">
                        <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                            <span class="text-white font-bold text-lg">SOLD</span>
                        </div>
                    </div>
                    <div class="p-3">
                        <h4 class="font-medium" >{{ $car->Brand }}  {{ $car->car_Model }}</h4>
                        <p class="text-sm text-gray-600" x-text="{{ $car->car_Year }}"></p>
                    </div>
                </div>
		@endforeach 
        </div>
    </section>
</div>
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Breadcrumbs -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2">
            
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-right text-gray-400"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Car Details</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- Main Content -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <!-- Image Slider and Details -->
        <div class="md:flex">
            <!-- Image Slider -->
            <div class="md:w-1/2 p-4">
                <div class="relative overflow-hidden rounded-lg">
                    <!-- Main Image -->
                    <div class="w-full h-64 md:h-96 bg-gray-200 rounded-lg overflow-hidden">
                        <img src="{{ asset('storage/' . $mainImage) }}" 
                             alt="{{ $car->Brand }} {{ $car->car_Model }}" 
                             class="w-full h-full object-cover transition duration-500 ease-in-out transform hover:scale-102">
                    </div>
                    
                    <!-- Thumbnail Navigation -->
                    <div class="flex mt-4 space-x-2">
                        @foreach(explode(',', $car->car_Image) as $image)
                        <div class="w-1/3 cursor-pointer border-2 border-transparent hover:border-blue-500 rounded-lg overflow-hidden transition-all duration-200">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 alt="{{ $car->Brand }} {{ $car->car_Model }}" 
                                 class="w-full h-20 object-cover"
                                 wire:click="changeMainImage('{{ $image }}')">
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Car Details -->
            <div class="md:w-1/2 p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-2">{{ $car->Brand }} {{ $car->car_Model }} ({{ $car->car_Year }})</h1>
                <div class="flex items-center mb-4">
                    
                </div>

                
                <div class="bg-blue-50 p-4 rounded-lg mb-6">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-2xl font-bold text-primary">${{ number_format($car->car_Price) }}</span>
                        </div>
                        @if($car->isSold)
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">SOLD</span>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Details</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 mr-2"></i>
                            <span class="text-gray-700">Year: {{ $car->car_Year }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-palette text-blue-500 mr-2"></i>
                            <span class="text-gray-700">Color: {{ $car->color }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                            <span class="text-gray-700">Location: {{ $car->city }}, {{ $car->country }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-user text-blue-500 mr-2"></i>
                            <span class="text-gray-700">Seller: {{ $car->user->name }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">Description</h3>
                    <p class="text-gray-600">
                        {{ $car->car_Description }}
                    </p>
                </div>
                
                @if(!$car->sold)
                <div class="flex space-x-3">
					
                    <button class="bg-primary hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg flex items-center transition duration-200">
                        <i class="fas fa-star mr-2"></i> Add Review
                    </button>
					<div x-data="{ phoneNumber: @entangle('phone'),isSold: @entangle('isSold') }">
						<button :disabled="isSold" @click="!isSold && (window.location.href = 'tel:${phoneNumber}')"   class="border border-primary text-primary hover:bg-blue-50 font-bold py-3 px-6 rounded-lg flex items-center transition duration-200">
							<i class="fas fa-phone mr-2"></i> Contact Seller
						</button>
					</div>
                </div>
                @endif
            </div>
        </div>
        
        

</div>
</div>

@push('styles')
<style>
    .fa-star {
        transition: all 0.2s ease;
    }
</style>
@endpush

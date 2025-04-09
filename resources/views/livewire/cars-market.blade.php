<div class="flex-grow overflow-auto max-w-7xl mx-auto bg-white rounded-lg shadow-md p-6">
    <!-- Header with search and controls -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Car Marketplace</h1>
        
        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
            <!-- Search input -->
            <div class="relative flex-grow">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Search cars..." 
                       class="w-full pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
            
            <!-- Filter selection dropdown -->
            <div class="relative" x-data="{filterDropdownOpen : false,}">
                <button @click="filterDropdownOpen = !filterDropdownOpen" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition flex items-center">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                
                <!-- Filter dropdown menu -->
                <div x-show="filterDropdownOpen" @click.away="filterDropdownOpen = false" 
                     class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg z-10 border">
                    <div class="p-2">
                        @foreach($filterOptions as $key => $label)
                            @if(!array_key_exists($key, $activeFilters))
                                <div wire:click="addFilter('{{ $key }}')" 
                                     class="flex items-center p-2 hover:bg-gray-100 rounded cursor-pointer">
                                    @if($key === 'Brand')
                                        <i class="fas fa-car mr-2 text-gray-500"></i>
                                    @elseif($key === 'car_Model')
                                        <i class="fas fa-tag mr-2 text-gray-500"></i>
                                    @elseif($key === 'car_Price')
                                        <i class="fas fa-dollar-sign mr-2 text-gray-500"></i>
                                    @elseif($key === 'car_Year')
                                        <i class="fas fa-calendar-alt mr-2 text-gray-500"></i>
                                    @elseif($key === 'color')
                                        <i class="fas fa-palette mr-2 text-gray-500"></i>
                                    @elseif($key === 'country' || $key === 'city')
                                        <i class="fas fa-map-marker-alt mr-2 text-gray-500"></i>
                                    @elseif($key === 'isSold')
                                        <i class="fas fa-check-circle mr-2 text-gray-500"></i>
                                    @endif
                                    <span>{{ $label }}</span>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Sort dropdown -->
            <div class="relative">
                <select wire:model.live="sortBy" class="appearance-none pl-3 pr-8 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 w-full md:w-auto">
                    <option value="">Sort by</option>
                    <option value="price_asc">Price: Low to High</option>
                    <option value="price_desc">Price: High to Low</option>
                    <option value="year_asc">Year: Oldest</option>
                    <option value="year_desc">Year: Newest</option>
                </select>
                <i class="fas fa-chevron-down absolute right-3 top-3 text-gray-400 pointer-events-none"></i>
            </div>
        </div>
    </div>
    
    <!-- Active filters container -->
    <div class="flex flex-wrap gap-2 mb-6">
	
        @foreach($activeFilters as $filter => $value)
            <div class="bg-white border rounded-lg p-2 flex items-center">
				
                <span class="text-sm mr-2">{{ $filterOptions[$filter] }}:</span>
                
                @if($filter === 'car_Price')
                    <select wire:model.live="priceCondition" class="text-sm border rounded focus:outline-none focus:border-blue-500 px-1 py-1 mr-1">
                        <option value="greater">Greater than</option>
                        <option value="less">Less than</option>
                        <option value="between">Between</option>
                    </select>
                    
                    <input type="number" wire:model.live.debounce.300ms="priceValue" placeholder="Value" 
                           class="text-sm border-b focus:outline-none focus:border-blue-500 px-1 py-1 w-20">
                           
                    @if($priceCondition === 'between')
                        <span class="mx-1">and</span>
                        <input type="number" wire:model.live.debounce.300ms="priceValue2" placeholder="Value" 
                               class="text-sm border-b focus:outline-none focus:border-blue-500 px-1 py-1 w-20">
                    @endif
				@elseif($filter === 'isSold')
					<select wire:model.live.debounce.300ms="activeFilters.{{ $filter }}"  class="text-sm border rounded focus:outline-none focus:border-blue-500 px-1 py-1 mr-1">
                        <option value="" selected disabled>Choose Option</option>
						<option value="0">Avaiable</option>
                        <option value="1">Sold</option>
                    </select>
                @else
                    <input type="{{ $filter === 'car_Year' ? 'number' : 'text' }}" 
                           wire:model.live.debounce.300ms="activeFilters.{{ $filter }}" 
                           placeholder="Enter {{ $filter }}" 
                           class="text-sm border-b focus:outline-none focus:border-blue-500 px-1 py-1 w-24">
                @endif
                
                <button wire:click="removeFilter('{{ $filter }}')" class="ml-2 text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endforeach
    </div>
    
    <!-- Cars grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($cars as $car)
            <div wire:click="show({{$car->car_Id}})" class="cursor-pointer bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <div class="relative">
                    <img src="{{ asset('storage/'.explode(',', $car->car_Image)[0] ) }}" 
                         alt="{{ $car->Brand }} {{ $car->car_Model }}" class="w-full h-48 object-cover">
                    <span class="absolute top-2 right-2 {{ $car->isSold ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} text-xs px-2 py-1 rounded-full font-semibold">
                        {{ $car->isSold ? 'Sold' : 'Available' }}
                    </span>
                </div>
                <div class="p-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="font-bold text-lg">{{ $car->Brand }} {{ $car->car_Model }}</h3>
                            <p class="text-gray-600">{{ $car->car_Year }} </p>
                        </div>
                    </div>
                    
                    <div class="mt-3 flex items-center text-gray-500 text-sm">
                        <i class="fas fa-map-marker-alt mr-1"></i>
                        <span>{{ $car->city }}, {{ $car->country }}</span>
                    </div>
                    
                    <div class="mt-4 flex justify-between items-center">
                        <span class="font-bold text-lg">${{ number_format($car->car_Price) }}</span>
                        <button class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-heart"></i>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-car text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">No cars found matching your criteria</p>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination would go here -->
	<div class="mt-4">
        {{ $cars->links() }} <!-- عرض التصفح بين الصفحات -->
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('livewire:load', function() {
        Livewire.on('filterUpdated', () => {
            // Any JavaScript you might need when filters change
        });
    });
</script>
@endpush

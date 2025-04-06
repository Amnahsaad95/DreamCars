<!-- resources/views/livewire/car-listing.blade.php -->
<div class="container mx-auto px-4 py-8">
    <!-- Filter Controls -->
    <div class="mb-8 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div class="flex flex-wrap items-center gap-3">
            <!-- Filter Dropdown Button -->
            <div class="relative">
                <button 
                    wire:click="$toggle('showFilterDropdown')"
                    class="flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg transition"
                >
                    <i class="fas fa-plus"></i>
                    <span>Add Filter</span>
                </button>
                
                <!-- Filter Selection Dropdown -->
                @if($showFilterDropdown)
					
                    <div 
                        class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10 border border-gray-200"
                        wire:click.away="showFilterDropdown = false"
                    >
                        <div class="py-1">
                            @foreach($availableFilters as $key => $filter)
							
                                <button
                                    wire:click="toggleFilter('{{ $key }}')"
                                    class="w-full flex items-center gap-2 px-4 py-2 text-left hover:bg-gray-100"
                                    :class="{ 'bg-blue-50': @this.isActive('{{ $key }}') }"
                                >
                                    <i class="fas {{ $filter['icon'] ?? 'fa-question' }}"></i>
                                    <span>{{ $filter['name'] ?? 'not found'}}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            
            <!-- Active Filter Badges -->
            @foreach($activeFilters as $filterKey)
                <div class="flex items-center gap-2 bg-blue-50 px-3 py-1 rounded-full border border-blue-100">
                    <i class="fas {{ $availableFilters[$filterKey]['icon'] }}"></i>
                    <span>{{ $availableFilters[$filterKey]['name'] }}</span>
                    <button wire:click="removeFilter('{{ $filterKey }}')" class="text-blue-500 hover:text-blue-700">
                        <i class="fas fa-times text-xs"></i>
                    </button>
                </div>
            @endforeach
        </div>
        
        <!-- Filter Inputs Section -->
        @if(count($activeFilters) > 0)
            <div class="mt-4 space-y-3">
                @foreach($activeFilters as $filterKey)
                    @php $filter = $availableFilters[$filterKey]; @endphp
                    
                    <div class="flex items-center gap-3 p-3 bg-gray-50 rounded border border-gray-200">
                        <div class="font-medium flex items-center gap-2 min-w-[120px]">
                            <i class="fas {{ $filter['icon'] }}"></i>
                            <span>{{ $filter['name'] }}</span>
                        </div>
                        
                        <!-- Select Input -->
                        @if($filter['type'] === 'select')
                            <select 
                                wire:model="filterValues.{{ $filterKey }}"
                                class="flex-1 px-3 py-2 border rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            >
                                <option value="">Select {{ $filter['name'] }}</option>
                                @foreach($filter['options'] as $option)
                                    <option value="{{ $option }}">{{ $option }}</option>
                                @endforeach
                            </select>
                        @endif
                        
                        <!-- Range Input -->
						@if($filter['type'] === 'input')
                            <div class="flex-1 flex items-center gap-3">
                               
                                <input 
                                    type="text" 
                                    wire:model="filterValues.{{ $filterKey }}"
                                    placeholder="Brand" 
                                    class="w-1/2 px-3 py-2 border rounded"
                                >
                            </div>
                        @endif
						
                        @if($filter['type'] === 'range')
                            <div class="flex-1 flex items-center gap-3">
                                <input 
                                    type="number" 
                                    wire:model="filterValues.{{ $filterKey }}_min"
                                    placeholder="Min" 
                                    class="w-1/2 px-3 py-2 border rounded"
                                    min="{{ $filter['min'] }}"
                                    max="{{ $filter['max'] }}"
                                >
                                <span>to</span>
                                <input 
                                    type="number" 
                                    wire:model="filterValues.{{ $filterKey }}_max"
                                    placeholder="Max" 
                                    class="w-1/2 px-3 py-2 border rounded"
                                    min="{{ $filter['min'] }}"
                                    max="{{ $filter['max'] }}"
                                >
                            </div>
                        @endif
                        
                        <button wire:click="removeFilter('{{ $filterKey }}')" class="text-gray-500 hover:text-red-500">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    
    <!-- Cars Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
        @foreach($cars as $car)
		
            <div wire:click="show({{$car->car_Id}})" class="bg-white rounded-lg shadow-sm overflow-hidden border border-gray-200 hover:shadow-md cursor-pointer transition">
                <div class="h-48 bg-gradient-to-br from-blue-50 to-gray-100 flex items-center justify-center relative">
                    
                        <img 
                            src="{{ asset('storage/'.explode(',', $car->car_Image)[0] ) }}" 
                            alt="{{ $car->Brand }} {{ $car->car_Model }}"
                            class="h-full w-full object-cover"
                        >
                    <div class="absolute top-2 right-2 bg-white/80 px-2 py-1 rounded text-sm">
                        {{ $car->car_Year }}
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-lg">
                        {{ $car->Brand }} {{ $car->car_Model }}
                    </h3>
                    <div class="flex justify-between items-center mt-2">
                        <span class="text-blue-600 font-medium">${{ number_format($car->car_Price) }}</span>
                        <div class="text-gray-500 text-sm">
                            <i class="fas fa-gas-pump mr-1"></i>
                            {{ $car->color }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination -->
    <div class="mt-8">
        {{ $cars->links() }}
    </div>
</div>



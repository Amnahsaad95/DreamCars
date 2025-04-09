<div class="flex-grow overflow-auto container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Car Management</h1>
    
    <!-- Search and Add New Car Section -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 gap-4">
        <div class="relative w-full md:w-64">
            <input type="text" wire:model.live.debounce.150ms="search" placeholder="Search cars..." 
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
        </div>
        <button wire:click="goToCreateCar" class="w-full md:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-plus"></i> Add New Car
        </button>
		
    </div>
    
    <!-- Sorting Controls -->
    <div class="flex flex-wrap items-center gap-4 mb-4">
        <div class="flex items-center gap-2">
            <label for="sort-by" class="text-sm font-medium text-gray-700">Sort by:</label>
            <select wire:model.live="sortBy" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="Brand">Brand</option>
                <option value="car_Model">Model</option>
                <option value="car_Year">Year</option>
                <option value="car_Price">Price</option>
            </select>
        </div>
        <div class="flex items-center gap-2">
            <label for="sort-order" class="text-sm font-medium text-gray-700">Order:</label>
            <select wire:model.live="sortDirection" class="border border-gray-300 rounded-md px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                <option value="asc">Ascending</option>
                <option value="desc">Descending</option>
            </select>
        </div>
    </div>
    
    <!-- Cars Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
						
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"></th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('make')">
                            Make
                            @if($sortBy === 'Brand')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('model')">
                            Model
                            @if($sortBy === 'car_Model')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('year')">
                            Year
                            @if($sortBy === 'car_Year')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Color</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" wire:click="sortBy('price')">
                            Price
                            @if($sortBy === 'car_Price')
                                <i class="fas fa-sort-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                            @else
                                <i class="fas fa-sort ml-1"></i>
                            @endif
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($cars as $car)
                        <tr>
							<td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full object-cover" src="{{ asset('storage/'.explode(',', $car->car_Image)[0] ) }}" alt="{{ $car->Brand }}">
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $car->Brand }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $car->car_Model }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $car->car_Year }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center space-x-2">
									<div class="w-4 h-4 rounded-full border" style="background-color: #{{ ltrim($car->color, '#')}} !important;"></div>
									<span class="text-sm text-gray-700">{{ $car->color }}</span>
								</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">${{ number_format($car->car_Price, 2) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
									@if ($car->isSold)
										<span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">Sold</span>
									@else
										<span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">Available</span>
									@endif
								</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $car->city }}</div>
                            </td>
							<td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $car->country }}</div>
                            </td>
							<td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $car->car_Description }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button wire:click="View({{ $car->car_Id }},'false')" class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button wire:click="View({{ $car->car_Id }},'true')" class="text-yellow-600 hover:text-yellow-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button wire:click="delete({{ $car->car_Id }})" wire:confirm="return confirm('Are you sure?')" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-sm text-gray-500">
                                No cars found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Pagination -->
    <div class="flex items-center justify-between mt-6">
        <div class="text-sm text-gray-700">
            Showing <span class="font-medium">{{ $cars->firstItem() }}</span> to <span class="font-medium">{{ $cars->lastItem() }}</span> of <span class="font-medium">{{ $cars->total() }}</span> results
        </div>
        <div class="flex space-x-2">
            {{ $cars->links() }}
        </div>
    </div>

</div>


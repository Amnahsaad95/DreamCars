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
                                <button wire:click="openViewModal({{ $car->car_Id }})" class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <button wire:click="edit({{ $car->car_Id }})" class="text-yellow-600 hover:text-yellow-900 mr-3">
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

    <!-- Add/Edit Car Modal -->
	 <div x-data="{ isModalOpen: @entangle('isModalOpen') }">
	    <div x-show="isModalOpen" x-cloak class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold text-gray-800">{{ $carId ? 'Edit Car' : 'Add New Car' }}</h3>
                <button wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <form wire:submit.prevent="store">
                <div class="grid grid-cols-1 gap-4 mb-4">
                    <div class="mb-5">
						<label for="brand" class="mb-3 block text-base font-medium text-[#07074D]">
							Brand
						</label>
						<input type="text" name="brand" id="brand" placeholder="Enter Brand" wire:model="brand"
							class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
						@error('brand') <span style="color: red;">{{ $message }}</span> @enderror
					</div>
                    <div class="-mx-3 flex flex-wrap">
						<div class="w-full px-3 sm:w-1/2">
							<div class="mb-5">
								<label for="model" class="mb-3 block text-base font-medium text-[#07074D]">
									Model
								</label>
								<input type="text" name="model" id="model" placeholder="Enter Model" wire:model="model"
									class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
								@error('model') <span style="color: red;">{{ $message }}</span> @enderror
							</div>
						</div>
						<div class="w-full px-3 sm:w-1/2">
							<div class="mb-5">
								<label for="year" class="mb-3 block text-base font-medium text-[#07074D]">
									Year
								</label>
								<input type="number" name="year" id="year" placeholder="Enter Year" wire:model="year"
									class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
								@error('year') <span style="color: red;">{{ $message }}</span> @enderror
						   </div>
						</div>
					</div>
                    <div class="-mx-3 flex flex-wrap">                
						<div class="w-full px-3 sm:w-1/2">
							<div class="mb-5">
								<label for="price" class="mb-3 block text-base font-medium text-[#07074D]">
									Price
								</label>
								<input type="number" name="price" id="price" placeholder="Enter Price" wire:model="price"
									class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
								@error('price') <span style="color: red;">{{ $message }}</span> @enderror
							</div>
						</div>
						<div class="w-full px-3 sm:w-1/2">
							<div class="mb-5">
								<label for="color" class="mb-3 block text-base font-medium text-[#07074D]">
									Color
								</label>
								<input type="color" name="color" id="color" value="#ff0000" wire:model="color"
									class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 h-12 cursor-pointer outline-none focus:border-[#6A64F1] focus:shadow-md" />
							</div>
						</div>
					</div>
                    <div class="mb-5 pt-3">
						<label class="mb-5 block text-base font-semibold text-[#07074D] sm:text-xl">
							Address Details
						</label>
						<div class="-mx-3 flex flex-wrap">
							<div class="w-full px-3 sm:w-1/2">
								<div class="mb-5">
									<input type="text" name="city" id="city" placeholder="Enter City" wire:model="city"
										class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
									@error('city') <span style="color: red;">{{ $message }}</span> @enderror
								</div>
							</div>
							<div class="w-full px-3 sm:w-1/2">
								<div class="mb-5">
									<input type="text" name="country" id="country" placeholder="Enter Country" wire:model="country"
										class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
									@error('country') <span style="color: red;">{{ $message }}</span> @enderror
							   </div>
							</div>                    
						</div>
					</div>
					<div class="mb-5">
						<label for="image" class="mb-3 block text-base font-medium text-[#07074D]">
							Car Image
						</label>
						<input type="file" name="images" id="images" placeholder="Car Image" wire:model="images"
							class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" multiple/>
						<div wire:loading wire:target="images">Uploading...</div>
						@error('images') <span style="color: red;">{{ $message }}</span> @enderror
						@error('images.*') <span style="color: red;">{{ $message }}</span> @enderror
									
					</div> 
					
					<div class="mb-5">
						<label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
							Description
						</label>
						<input type="text" name="description" id="description" placeholder="Enter Description" wire:model="description"
							class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
						@error('description') <span style="color: red;">{{ $message }}</span> @enderror
					</div> 
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" wire:click="closeModal" 
                        class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        {{ $carId ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
    </div></div>
	
    <!-- View Car Modal -->
	<div x-data="{ isViewModalOpen: @entangle('isViewModalOpen') }">
	    
	    <div x-show="isViewModalOpen" x-cloak class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
        <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
  

        <x-slot name="title">
            Car Details
        </x-slot>

        <x-slot name="content">
            <div class="space-y-4">
                <div class="flex justify-center mb-4">
                    <img src="https://source.unsplash.com/random/400x200/?{{ $viewCar->make ?? 'car' }}" alt="Car Image" class="h-40 w-full object-cover rounded-md">
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-medium text-gray-500">Make</p>
                        <p class="text-sm text-gray-900">{{ $viewCar->make ?? '' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Model</p>
                        <p class="text-sm text-gray-900">{{ $viewCar->model ?? '' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Year</p>
                        <p class="text-sm text-gray-900">{{ $viewCar->year ?? '' }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Color</p>
                        <p class="text-sm text-gray-900">{{ ucfirst($viewCar->color ?? '') }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Price</p>
                        <p class="text-sm text-gray-900">${{ number_format($viewCar->price ?? 0, 2) }}</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Mileage</p>
                        <p class="text-sm text-gray-900">{{ number_format($viewCar->mileage ?? 0) }} mi</p>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Status</p>
                        <p class="text-sm text-gray-900">{{ ucfirst($viewCar->status ?? '') }}</p>
                    </div>
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <button wire:click="closeModal" wire:loading.attr="disabled">
                Close
            </button>
        </x-slot>
	</div>	</div>	</div>	
</div>


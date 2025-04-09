
 <div>
	<!-- 3. Advertising Banner -->
	<div wire:poll.keep-alive.20s>
	<div class="max-w-4xl w-full mx-auto my-8">
		<!-- Banner Header -->
		<div class="flex justify-between items-center mb-2">
			<span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">Sponsored Ad</span>
			<div class="flex items-center space-x-2">
				<span class="text-xs text-gray-500">Views:</span>
				<span class="text-xs font-bold text-blue-600">{{ $randomAds->hit }}</span>
				
			</div>
		</div>
		
		<!-- Main Banner -->
		<div class="relative group overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
			<!-- Ad Image -->
			<a wire:click="recordClick" class="cursor-pointer">
				<img 
					src="{{ asset('storage/'.$randomAds->Image ) }}" 
					alt="{{ $randomAds->FullName }}" 
					class="w-full h-48 md:h-64 object-cover transition-transform duration-500 group-hover:scale-105"
				>
			</a>
			
			<!-- Ad Content Overlay -->
			<div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex flex-col justify-end p-6">
				<h3 class="text-xl md:text-2xl font-bold text-white mb-2">{{ $randomAds->FullName }}</h3>
				<p class="text-sm md:text-base text-gray-200 mb-4">{{ $randomAds->location }}</p>
				<button wire:click="recordClick({{ $randomAds->id }})" class="self-start bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-300">
					Learn More <i class="fas fa-arrow-right ml-1"></i>
				</button>
			</div>
		</div>
		
		<!-- Ad Info Footer -->
		<div class="flex justify-between items-center mt-2">
			<span class="text-xs text-gray-500">Advertisement from {{ $randomAds->FullName }}</span>
		</div>
	</div></div>

	
	<!-- 4. Search Input -->
	<div class="container mx-auto px-4 py-8 bg-gray-100 rounded-lg">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<h1 class="text-3xl font-bold text-center mb-8">Find Your Perfect Car</h1>
			
			 <div class="relative w-full max-w-xl mx-auto" x-data="{ open: @entangle('showDropdown') }">
				<!-- Search Input -->
				<div class="relative">
					<input
						type="text"
						wire:model.live.debounce.150ms="search"
						placeholder="Search for cars..."
						class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm"
						@focus="open = true"
						@click.away="open = false"
					>
					<div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
						<svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
						</svg>
					</div>
				</div>

				<!-- Dropdown Results -->
				<div x-show="open" class="absolute z-10 mt-1 w-full bg-white rounded-md shadow-lg">
					<ul class="max-h-60 overflow-auto">
						@forelse($searchResults as $car)
							<li wire:click="show({{$car['car_Id']}})" wire:key="car-{{ $car['car_Id'] ?? '' }}" class="px-4 py-2 hover:bg-gray-100 cursor-pointer border-b border-gray-100" wire:click="selectCar({{ $car['car_Id'] ??'' }})">
								<div class="font-medium text-gray-900">{{ $car['Brand'] ?? ''}} {{ $car['car_Model'] ??''}}</div>
								<div class="text-sm text-gray-500"> {{ $car['car_Year'] ?? '' }}</div>
							</li>
						@empty
							<li class="px-4 py-2 text-gray-500">
								@if(strlen($search) > 0)
									No cars found for "{{ $search }}"
								@else
									Type at least 3 characters to search
								@endif
							</li>
						@endforelse
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
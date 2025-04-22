
 <div>
	<!-- 3. Advertising Banner -->
	<div wire:poll.keep-alive.20s>
	<div class="max-w-4xl w-full mx-auto my-8">
		<!-- Banner Header -->
		<div class="flex justify-between items-center mb-2">
			<span class="text-xs font-semibold text-gray-500 uppercase tracking-wide">{{ __('messages.sponsored_ad') }}</span>
			<div class="flex items-center space-x-2">
				<span class="text-xs text-gray-500">{{ __('messages.views') }}</span>
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
					{{ __('messages.learn_more') }} <i class="fas fa-arrow-right ml-1"></i>
				</button>
			</div>
		</div>
		
		<!-- Ad Info Footer -->
		<div class="flex justify-between items-center mt-2">
			<span class="text-xs text-gray-500">{{ __('messages.advertisement_from') }} {{ $randomAds->FullName }}</span>
		</div>
	</div></div>

	
	<!-- 4. Search Input -->
	<div id="search-section" class="container mx-auto px-4 py-8 bg-gray-100 rounded-lg">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<h1 class="text-3xl font-bold text-center mb-8">{{ __('messages.SearchInput') }}</h1>
			<div class="max-w-3xl mx-auto mb-8 relative" x-data="{ showResults: @entangle('showDropdown') }">
			<div class="relative flex items-center {{ app()->getLocale()  == 'ar' ? 'flex-row-reverse text-right' : 'text-left' }}" >
				<input 
					wire:model.live.debounce.150ms="search" 
					class="w-full px-6 py-4 rounded-xl border-2 border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 outline-none transition-all shadow-sm text-gray-700 placeholder-gray-400 pr-24"
					placeholder="{{ __('messages.SearchPlasceHold') }}"
					type="text"
					@focus="showResults = true"
					@click.away="showResults = false"
				>
				<div class="absolute {{ app()->getLocale() == 'ar' ? 'left-3' : 'right-3' }} flex items-center gap-4">
					<!-- Compare Button (only shows when items are selected) -->
					@if(count($selectedCars) > 1)
					<button 
						wire:click="$set('showComparisonModal', true)"
						class="bg-green-600 hover:bg-green-700 text-white px-3 py-2 rounded-lg transition-colors flex items-center shadow-md {{ app()->getLocale() == 'ar' ? 'left-3' : 'right-3' }}"
					>
						<span class="hidden sm:inline px-2">{{ __('messages.compare') }}</span>
						<i class="fas fa-balance-scale ml-1"></i>
						<span class="ml-1 bg-white text-green-600 rounded-full w-5 h-5 flex items-center justify-center text-xs">
							{{ count($selectedCars) }}
						</span>
					</button>
					@endif
					
					<!-- Search Button -->
					<button 
						class="bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-lg transition-colors {{ app()->getLocale() == 'ar' ? 'left-3' : 'right-3' }}"
					>
						<i class="fas fa-search"></i>
					</button>
				</div>
			</div>

			<!-- Search Results Dropdown -->
			@if($search && count($searchResults))
			<div x-show="showResults" class="absolute z-10 mt-2 w-full bg-white rounded-xl shadow-xl border border-gray-200 max-h-96 overflow-y-auto">
				@foreach($searchResults as $car)
				<div 
					wire:click="show({{$car['car_Id']}})"
					class="p-3 hover:bg-gray-50 cursor-pointer border-b border-gray-100 flex items-center gap-4"
				>
					<div class="flex-shrink-0 w-12 h-12 bg-gray-100 rounded-lg overflow-hidden mr-4 ">
						<img src="{{ asset('storage/'.explode(',', $car['car_Image'])[0] ) }}" alt="{{ $car['Brand'] }}" class="w-full h-full object-cover">
					</div>
					<div class="flex-grow">
						<h3 class="font-medium text-gray-800">{{ $car['Brand'] ?? ''}}</h3>
						<p class="text-sm text-gray-500">{{ $car['car_Year'] ?? ''}}</p>
					</div>
					<div class="flex-shrink-0 ml-4">
						<span class="text-blue-600 font-medium">{{ $car['formatted_price'] ?? ''}}</span>
						<button 
							@if(count($selectedCars) >= 4 && !in_array($car['car_Id'], $selectedCars)) disabled @endif 
							wire:click.stop="toggleSelection({{$car['car_Id']}})"
							class="text-gray-400 hover:text-blue-600 {{ (count($selectedCars) >= 4 && !in_array($car['car_Id'], $selectedCars)) ? 'opacity-50 cursor-not-allowed' : '' }}"
						>
							<i class="fas {{ in_array($car['car_Id'], $selectedCars) ? 'fa-check-circle text-blue-600' : 'fa-plus-circle' }} px-2"></i>
						</button>
					</div>
				</div>
				@endforeach
			</div>
			@endif
			 
			 <!-- Selected Cars -->
			@if(count($selectedCars) > 0)
			<div class="mb-8 {{ app()->getLocale()  == 'ar' ? ' text-right' : 'text-left' }}">
				<h3 class="text-lg font-semibold mb-4">{{ __('messages.selected_for_comp') }} ({{ count($selectedCars) }})</h3>
				<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
					@foreach($selectedCars as $index => $carId)
					@php $car = App\Models\Car::find($carId); @endphp
					@if($car)
					<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
						<div class="relative">
							<img src="{{ asset('storage/'.explode(',', $car->car_Image)[0] ) }}" alt="{{ $car->Brand }} {{ $car->car_Model }}" class="w-full h-48 object-cover">
							
							<button 
								wire:click="removeSelected({{ $index }})"
								class="absolute top-2 right-2 bg-white rounded-full p-2 shadow-md text-red-500 hover:bg-red-100"
							>
								<i class="fas fa-times"></i>
							</button>
						</div>
						<div class="p-4">
							<h4 class="font-bold text-lg">{{ $car->car_Model }} {{ $car->car_Year }}</h4>
							<p class="text-blue-600 font-bold text-xl my-2">{{$car->formattedPrice()}}</p>
							<div class="flex justify-between text-sm text-gray-600">
								<span>{{ $car->city }}</span>
								<span>{{ $car->country }}</span>
							</div>
							<button 
								wire:click="show({{ $car->car_Id }})"
								class="mt-3 w-full py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-sm font-medium"
							>
								{{ __('messages.car_Detail') }}
							</button>
						</div>
					</div>
					@endif
					@endforeach
				</div>
			</div>
			@endif
		
		</div>

	<!-- Comparison Modal -->
	<div 
		x-data="{ open: @entangle('showComparisonModal') }"
		x-show="open"
		x-cloak
		x-transition:enter="transition ease-out duration-300"
		x-transition:enter-start="opacity-0"
		x-transition:enter-end="opacity-100"
		x-transition:leave="transition ease-in duration-200"
		x-transition:leave-start="opacity-100"
		x-transition:leave-end="opacity-0"
		class="fixed inset-0 z-50 overflow-y-auto"
		style="background-color: rgba(0,0,0,0.5);"
		@click.away="open = false"
		@keydown.escape.window="open = false"
	>
		<div class="flex items-center justify-center min-h-screen p-4">
			<div 
				class="bg-white rounded-lg shadow-xl max-w-6xl w-full max-h-[90vh] overflow-hidden flex flex-col"
				@click.stop
			>
				<div class="border-b border-gray-200 p-4 flex justify-between items-center">
					<h3 class="text-xl font-bold">{{ __('messages.compare') }}</h3>
					<button 
						wire:click="$set('showComparisonModal', false)"
						class="text-gray-500 hover:text-gray-700"
					>
						<i class="fas fa-times"></i>
					</button>
				</div>
				
				<div class="flex-1 overflow-auto">
					<table class="min-w-full divide-y divide-gray-200">
						<thead class="bg-gray-50">
							<tr>
								<th scope="col" class="px-6 py-3 {{ app()->getLocale()  == 'ar' ? ' text-right' : 'text-left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">{{ __('messages.feature') }}</th>
								@foreach($selectedCars as $carId)
								@php $car = App\Models\Car::find($carId); @endphp
								<th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
									@if($car)
									<div class="flex flex-col items-center">
										<img src="{{ asset('storage/'.explode(',', $car['car_Image'])[0] ) }}" class="w-16 h-16 object-contain mb-2" alt="">
										
									</div>
									@endif
								</th>
								@endforeach
							</tr>
						</thead>
						<tbody class="bg-white divide-y divide-gray-200">
							@foreach($comparisonFeatures1 as $feature => $value)
							<tr>
								<td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $value }}</td>
								@foreach($selectedCars as $carId)
								@php $car = App\Models\Car::find($carId); @endphp
								<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
									@if($car)
										@if($feature === 'color')
											<div class="inline-flex items-center gap-2 px-2 py-1 rounded-md" style="background-color: {{ $car->color }}20"> <!-- 20 = 12.5% opacity -->
												<span class="w-4 h-4 rounded-full border border-gray-300" style="background-color: {{ $car->color }}"></span>
												<span class="font-medium" style="color: {{ $car->color }}">
													{{ $car->color }}
												</span>
											</div>
										 @elseif($feature === 'isSold')
											@if($car->isSold)
												<span class="text-red-600 font-medium">{{ __('dashboard.sold') }}</span>
											@else
												<span class="text-green-600 font-medium">{{ __('dashboard.available') }}</span>
											@endif
										@elseif($feature === 'car_Price')
											{{$car->formattedPrice()}}
										@else
											{{ $car->$feature ?? 'N/A' }}
										@endif
									@else
										N/A
									@endif
								</td>
								@endforeach
							</tr>
							@endforeach
							
						   
						</tbody>
					</table>
				</div>
				
				<div class="border-t border-gray-200 p-4 flex justify-end">
					<button 
						wire:click="$set('showComparisonModal', false)"
						class="px-4 py-2 bg-gray-200 hover:bg-gray-300 rounded-lg"
					>
						{{ __('messages.close') }}
					</button>
				</div>
			</div>
		</div>
	</div>
			 
		</div>
	</div>
<!------------->
	
</div>
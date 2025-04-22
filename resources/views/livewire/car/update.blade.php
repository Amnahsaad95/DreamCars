<div class="flex-grow overflow-auto container mx-auto px-4 py-8">
    <!-- View Mode -->
    @if(!$editMode)	
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ __('dashboard.detail') }}</h1>
			
					@if(auth()->user()->Role == 1)
            <button wire:click="toggleEdit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 flex items-center">
                <i class="fas fa-edit mr-2 px-2"></i> {{ __('dashboard.Edit') }}
            </button>
			@endif
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <!-- Car Images -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 p-6">
                @foreach($images as $image)
                <div class="border rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $image) }}" 
                         alt="{{ $car->Brand }} {{ $car->car_Model }}" 
                         class="w-full h-64 object-cover">
                    
                </div>
                @endforeach
            </div>

            <!-- Car Details -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $car->Brand }}</h2>
                        <p class="text-gray-600 mb-4">{{ $car->car_Description }}</p>
                        
                        <div class="grid grid-cols-2 gap-4 mb-4">
							<div>
                                <p class="text-gray-500 text-sm">{{ __('dashboard.city') }}</p>
                                <p class="font-medium">{{ $car->city}} </p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">{{ __('dashboard.country') }}</p>
                                <p class="font-medium">{{ $car->country }}</p>
                            </div>
                            
                        </div>
                    </div>

                    <div>
						<h2 class="text-xl font-semibold mb-4">{{ __('dashboard.features') }}</h2>
                        <div class="grid grid-cols-2 gap-4 mb-4">
							<div>
                                <p class="text-gray-500 text-sm">{{ __('dashboard.model') }} </p>
                                <p class="font-medium">{{ $car->car_Model }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">{{ __('dashboard.year') }}</p>
                                <p class="font-medium">{{ $car->car_Year}} </p>
                            </div>
                            
                            <div>
                                <p class="text-gray-500 text-sm">{{ __('dashboard.price') }}</p>
                                <p class="font-medium text-blue-600">{{$car->formattedPrice()}}</p>
                            </div>
                            <div>
                                <p class="text-gray-500 text-sm">{{ __('dashboard.sold') }} </p>
                                <p class="font-medium">{{ $car->isSold == 0 ? __('dashboard.no') : __('dashboard.yes') }}</p>
                            </div>
							<div>
                                <p class="text-gray-500 text-sm py-2">{{ __('dashboard.color') }} </p>
								<div class="inline-flex items-center gap-2 px-2 py-2 rounded-md" style="background-color: {{ $car->color }}20"> <!-- 20 = 12.5% opacity -->
									<span class="w-4 h-4 rounded-full border border-gray-300" style="background-color: {{ $car->color }}"></span>
									<span class="font-medium" style="color: {{ $car->color }}">
										{{ $car->color }}
									</span>
								</div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Edit Mode -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ __('dashboard.Edit') }}</h1>
            <button wire:click="toggleEdit" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 flex items-center">
                <i class="fas fa-times mr-2 px-2"></i> {{ __('dashboard.cancel') }} 
            </button>
        </div>

        <form wire:submit.prevent="save" class="bg-white rounded-xl shadow-md overflow-hidden p-6">
            <!-- Car Images Edit -->
            <div class="mb-8">
                <h2 class="text-xl font-semibold mb-4">{{ __('dashboard.image') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    @foreach([0, 1, 2] as $index)
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-4">
                        @if(isset($car_Image[$index]))
                            <img src="{{ $car_Image[$index]->temporaryUrl() }}" 
                                 alt="Preview" 
                                 class="w-full h-48 object-cover mb-3 rounded hover:scale-105 transition-transform">
                        @elseif(isset($images[$index]))
                            <img src="{{ asset('storage/'.$images[$index] ?? '') }}" 
                                 alt="Preview" 
                                 class="w-full h-48 object-cover mb-3 rounded hover:scale-105 transition-transform">
						
                        @endif
                        
                        <input type="file" wire:model.live="car_Image.{{ $index }}" 
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @error('car_Image.'.$index) <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Car Details Edit -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h2 class="text-xl font-semibold mb-4">{{ __('dashboard.basic_info') }}</h2>
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">{{ __('dashboard.brand') }}</label>
                        <input type="text" wire:model="Brand" class="w-full p-2 border rounded">
                        @error('Brand') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2">{{ __('dashboard.description') }}</label>
                        <textarea wire:model="car_Description" class="w-full p-2 border rounded h-32"></textarea>
                        @error('car_Description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4">
						<div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('dashboard.city') }}</label>
                            <input type="text" step="0.01" wire:model="city" class="w-full p-2 border rounded">
                            @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
						<div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('dashboard.country') }}</label>
                            <input type="text" step="0.01" wire:model="country" class="w-full p-2 border rounded">
                            @error('country') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                    </div>
                </div>

                <div>
                    <h2 class="text-xl font-semibold mb-4">{{ __('dashboard.features') }}</h2>
                    <div class="grid grid-cols-2 gap-4">
						<div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('dashboard.model') }} </label>
                            <input type="text" wire:model="car_Model" class="w-full p-2 border rounded">
                            @error('car_Model') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('dashboard.year') }} </label>
                            <input type="number" wire:model="car_Year" class="w-full p-2 border rounded">
                            @error('car_Year') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('dashboard.price') }}</label>
                            <input type="number" step="0.01" wire:model="car_Price" class="w-full p-2 border rounded">
                            @error('car_Price') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('dashboard.sold') }} </label>
							<label class="relative inline-flex items-center cursor-pointer">
								<input type="checkbox" wire:model="isSold" class="sr-only peer" @checked($isSold)>
								<div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-red-500 transition-all"></div>
								<div class="absolute left-1 top-1 bg-white w-4 h-4 rounded-full peer-checked:translate-x-full transition-all"></div>
							</label>
							
                            @error('isSold') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('dashboard.color') }} </label>
                            <input type="color" wire:model="color" class="w-full p-2 h-10 border rounded">
                            @error('color') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" wire:click="toggleEdit" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600">
                    {{ __('dashboard.cancel') }} 
                </button>
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    {{ __('dashboard.save') }} 
                </button>
            </div>
        </form>
    @endif

</div>

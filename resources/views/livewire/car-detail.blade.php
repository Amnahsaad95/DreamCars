<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Breadcrumbs -->
    <nav class="flex mb-6" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2">
            
            <li aria-current="page">
                <div class="flex items-center">
                    <i class="fas fa-chevron-{{app()->getLocale() == 'ar' ? 'left' : 'right'}} text-gray-400"></i>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 px-2">{{ __('messages.car_Detail') }}</span>
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
                            <span class="text-2xl font-bold text-primary">{{$car->formattedPrice()}}</span>
                        </div>
                        @if($car->isSold)
                            <span class="bg-red-100 text-red-800 text-xs font-semibold px-2.5 py-0.5 rounded">{{ __('dashboard.sold') }}</span>
                        @endif
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('messages.details') }}</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <div class="flex items-center">
                            <i class="fas fa-calendar-alt text-blue-500 mr-2 px-2"></i>
                            <span class="text-gray-700">{{ __('messages.year') }} : {{ $car->car_Year }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-palette text-blue-500 mr-2 px-2"></i>
							 <div class="inline-flex items-center gap-2 px-2 py-1 rounded-md" style="background-color: {{ $car->color }}20"> <!-- 20 = 12.5% opacity -->
								<span class="w-4 h-4 rounded-full border border-gray-300" style="background-color: {{ $car->color }}"></span>
								<span class="font-medium" style="color: {{ $car->color }}">
									{{ $car->color }}
								</span>
							</div>
						</div>
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-2 px-2"></i>
                            <span class="text-gray-700">{{ __('messages.location') }} : {{ $car->city }}, {{ $car->country }}</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-user text-blue-500 mr-2 px-2"></i>
                            <span class="text-gray-700">{{ __('messages.seller') }} : {{ $car->user->name }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">{{ __('messages.description') }} </h3>
                    <p class="text-gray-600">
                        {{ $car->car_Description }}
                    </p>
                </div>
                
                @if(!$car->sold)
                <div class="flex gap-4">
					
                    <button wire:click="addComplaint({{$car->car_Id}})" class="bg-primary hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg flex items-center transition duration-200">
                        <i class="fas fa-star mr-2 px-2"></i> {{ __('messages.add_complaint') }}
                    </button>
					<div x-data="{ 
							callSeller() {								
									window.location.href = 'tel:' + @entangle('phone').initialValue;								
							}
						}">	
						<button 
							@if($isSold) disabled @endif 
							wire:click="callSeller" 
							class="border border-primary text-primary hover:bg-blue-50 font-bold py-3 px-6 @if($isSold) disabled-button @endif rounded-lg flex items-center transition duration-200"
							>
							<i class="fas fa-phone{{app()->getLocale() == 'ar' ? '-alt' : '' }} px-2"></i> {{ __('messages.contact_seller') }}
						</button>
					</div>
                </div>
                @endif
            </div>
        </div>
        
        
<!-- Comments Section -->
        <div class="p-6 border-t border-gray-200">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">{{ __('messages.customer_reviews') }}</h2>
            @if(session()->has('message'))
				<div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
					{{ session('message') }}
				</div>
			@endif
            <div class="bg-gray-50 p-4 rounded-lg mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">{{ __('messages.write_review') }}</h3>
                <form wire:submit.prevent="addComment">
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            {{ __('messages.name') }}
                        </label>
                        <input 
                            wire:model="name"
                            id="name" 
							type="text"							
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            placeholder="{{ __('messages.enter_name') }}"></textarea>
                        @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
					 <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="phone">
                            {{ __('messages.phone') }}
                        </label>
                        <input 
                            wire:model="commentPhone"
                            id="phone" 
							type="text"							
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            placeholder="{{ __('messages.enter_phone') }}"></textarea>
                        @error('commentPhone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="comment">
                            {{ __('messages.comment') }}
                        </label>
                        <textarea 
                            wire:model="newComment"
                            id="comment" 
                            rows="3" 
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                            placeholder="{{ __('messages.enter_comment') }}"></textarea>
                        @error('newComment') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="bg-primary hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        {{ __('messages.submit_review') }}
                    </button>
                </form>
            </div>
            
            
            <!-- Comments List -->
            <div class="space-y-6">
			
                @forelse($comments as $comment)
                <div class="border-b border-gray-200 pb-6">
                    <div class="flex items-start">
                        
                        <div class="ml-4 flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="text-sm font-bold text-gray-900">{{ $comment->name }}</h4>
                                <span class="text-xs text-gray-500">{{ $comment->created_at }}</span>
                            </div>
                            <p class="text-sm text-gray-600">
                                {{ $comment->content }}
                            </p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center py-8 text-gray-500">
                    {{ __('messages.No_Reviews') }}
                </div>
                @endforelse
            </div>
        </div>
    </div>

<script>
    // You can call your Livewire method from the front-end to trigger the logic.
    function callSeller() {
        if (!@this.isSold && @this.phone) {
            window.location.href = 'tel:' + @this.phone;
        }
    }
</script>
</div>



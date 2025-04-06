<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="mb-6">
            <div class="flex justify-between items-center mb-2">
                <h2 class="text-xl font-semibold text-gray-700">Complete your profile</h2>
                <span class="text-xs text-gray-500">Step 2 of 2</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-1.5">
                <div class="bg-blue-600 h-1.5 rounded-full" style="width: 100%"></div>
            </div>
        </div>
        <div class="flex flex-col items-center mb-6">
			<div class="relative group">
				<!-- Circular Profile Picture -->
				<div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg">
					<img src="{{ $profileImage }}" alt="Profile" class="w-full h-full object-cover">
				</div>
				
				<!-- Camera Icon Overlay -->
				<label class="absolute bottom-0 right-0 bg-blue-500 rounded-full p-2 cursor-pointer transform transition-all duration-300 group-hover:scale-110">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
					</svg>
					<input wire:model.live="image" type="file" accept="image/*" class="hidden" />
					@error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
				</label>
			</div>
			
			<p class="mt-4 text-gray-600 text-sm">Click the camera icon to upload a new photo</p>
		</div>
        <form wire:submit.prevent="submit" class="space-y-4">
           
            
            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                <input wire:model="phone" type="tel" id="phone" name="phone" 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
             <div class="flex space-x-4">
                <div class="w-1/2">
                    <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                    <input wire:model="city" type="text" id="city" name="city" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    @error('city') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                
                <div class="w-1/2">
                    <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                    <input wire:model="country" type="text" id="country" name="country" 
                        class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    
                    @error('country') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
            
		
            
            <div class="pt-4">
                <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Complete Registration
                </button>
            </div>
        </form>
        
        <div class="mt-4 text-center text-sm text-gray-600">
            <button wire:click="skip" class="font-medium text-blue-600 hover:text-blue-500">Skip for now</button>
        </div>
    </div>
</div>
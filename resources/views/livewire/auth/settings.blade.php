<div class="flex-grow overflow-auto">
<div class="flex-grow overflow-auto container mx-auto px-4 py-12">
    
	@if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif
	
	<!-- Admin Control Bar -->
    <div class="flex justify-between items-center mb-8 bg-white p-4 rounded-lg shadow">
        <h1 class="text-2xl font-bold">Site Information</h1>
        <button wire:click="toggleEdit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
            @if($viewMode)
                <i class="fas fa-edit mr-2"></i> Edit Mode
            @else
                <i class="fas fa-eye mr-2"></i> View Mode
            @endif
        </button>
    </div>
	
    <!-- View Mode -->
    @if($viewMode)
        <!-- Site Info -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Site Information</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Site Name:</p>
                    <p class="font-medium">{{ $siteName }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Description:</p>
                    <p class="font-medium">{{ $siteDescription }}</p>
                </div>
            </div>
        </div>
		<!-- Site Logo -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Site Icon and Logo</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">Site icon:</p>
					@if($oldicon)
						<img src=" {{ asset('storage/' . $oldicon) }}" class="w-20 h-20 rounded-lg border border-gray-200">
					@else
						<span class="text-gray-400">No Icon</span>
					@endif
                </div>
                <div>
                    <p class="text-gray-600">Site Logo:</p>
					@if($oldlogo)
						<img src=" {{ asset('storage/' . $oldlogo) }}" class="w-30 h-30 rounded-lg border border-gray-200">
					@else
						<span class="text-gray-400">No Logo</span>
					@endif
                </div>
            </div>
        </div>

        <!-- Images -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Gallery Images</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="border rounded-lg p-3">
					@if($oldimage1)
						<img src="{{ asset('storage/' . $oldimage1) }}" alt="Image 1" class="w-full mb-2 rounded">
					@else
						<span class="text-gray-400">No Image</span>
					@endif
				</div>
                <div class="border rounded-lg p-3">
					@if($oldimage2)
						<img src="{{ asset('storage/' . $oldimage2) }}" alt="Image 2" class="w-full mb-2 rounded">
					@else
						<span class="text-gray-400">No Image</span>
					@endif
				</div>
				<div class="border rounded-lg p-3">
					@if($oldimage3)
						<img src="{{ asset('storage/' . $oldimage3) }}" alt="Image 3" class="w-full mb-2 rounded">
					@else
						<span class="text-gray-400">No Image</span>
					@endif
				</div>
            </div>
        </div>

        <!-- Intro Texts -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Intro Sections</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-2">{{ $title1 }}</h3>
                    <p class="text-gray-700">{{ $intro1 }}</p>
                </div>
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-2">{{ $title2 }}</h3>
                    <p class="text-gray-700">{{ $intro2 }}</p>
                </div>
				<div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-2">{{ $title3 }}</h3>
                    <p class="text-gray-700">{{ $intro3 }}</p>
                </div>
            </div>
        </div>

        <!-- Social Media -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">Social Media Links</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div>
                    <p class="text-gray-600"><i class="fab fa-envelope text-blue-700 mr-2"></i> Email:</p>
                    <p class="font-medium">{{ $sitemail }}</p>
                </div>
                <div>
                    <p class="text-gray-600"><i class="fab fa-facebook text-blue-600 mr-2"></i> Facebook:</p>
                    <p class="font-medium">{{ $facebook_url}}</p>
                </div>                
                <div>
                    <p class="text-gray-600"><i class="fab fa-instagram text-pink-600 mr-2"></i> Instagram:</p>
                    <p class="font-medium">{{ $instagram_url}}</p>
                </div>
				<div>
                    <p class="text-gray-600"><i class="fab fa-whatsapp text-blue-400 mr-2"></i> Whatsapp:</p>
                    <p class="font-medium">{{ $whatsapp_number }}</p>
                </div>
                
            </div>
        </div>
    @else
        <!-- Edit Mode -->
        <form wire:submit.prevent="saveSite">
            <!-- Site Info -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Site Information</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 mb-1">Site Name</label>
                        <input type="text" wire:model="siteName" class="w-full p-2 border rounded">
                        @error('siteName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Description</label>
                        <textarea wire:model="siteDescription" class="w-full p-2 border rounded h-24"></textarea>
                        @error('siteDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
			
			<!-- Site Logo -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Site Icon and Logo</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 mb-1">Site Icon</label>
                        <div class="mt-1 flex items-center space-x-4">
							<label class="cursor-pointer">
								<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
									Select Icon
									<input type="file" class="hidden" wire:model.live="site_icon">
								</span>
							</label>
							@error('site_icon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
						</div>
						
						<!-- Image Preview -->
						@if ($site_icon)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
								<img src="{{ $site_icon->temporaryUrl() }}" class="w-20 h-20 rounded-lg border border-gray-200">
							</div>
						@elseif($oldicon)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
								<img src=" {{ asset('storage/' . $oldicon) }}" class="w-20 h-20 rounded-lg border border-gray-200">
							</div>
						@else
							<span class="text-gray-400">No Icon</span>
						@endif
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">Site Logo</label>
                        <div class="mt-1 flex items-center space-x-4">
							<label class="cursor-pointer">
								<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
									Select Logo
									<input type="file" class="hidden" wire:model.live="site_logo">
								</span>
							</label>
							@error('site_logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
						</div>
						
						<!-- Image Preview -->
						@if ($site_logo)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
								<img src="{{ $site_logo->temporaryUrl() }}" class="w-20 h-20 rounded-lg border border-gray-200">
							</div>
						@elseif($oldlogo)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
								<img src=" {{ asset('storage/' . $oldlogo) }}" class="w-20 h-20 rounded-lg border border-gray-200">
							</div>
						@else
							<span class="text-gray-400">No Logo</span>
						@endif
                    </div>
                </div>
            </div>

            <!-- Images -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Gallery Images</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="border rounded-lg p-3">
                        <label for="site-name" class="block text-sm font-medium text-gray-700">Site Intro Image 1</label>                                
						<div class="mt-1 flex items-center space-x-4">
							<label class="cursor-pointer">
								<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
									Select Image
									<input type="file" class="hidden" wire:model.live="intro_image_1">
								</span>
							</label>
							@error('intro_image_1') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
						</div>
						
						<!-- Image Preview -->
						@if ($intro_image_1)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
								<img src="{{ $intro_image_1->temporaryUrl() }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@elseif($oldimage1)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
								<img src=" {{ asset('storage/' . $oldimage1) }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@else
							<span class="text-gray-400">No Image</span>
						@endif
                    </div>
					<div class="border rounded-lg p-3">
						<label for="site-url" class="block text-sm font-medium text-gray-700">Site Intro Image 2</label>
						<div class="mt-1 flex items-center space-x-4">
							<label class="cursor-pointer">
								<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
									Select Image
									<input type="file" class="hidden" wire:model.live="intro_image_2">
								</span>
							</label>
							@error('intro_image_2') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
						</div>
						
						<!-- Image Preview -->
						@if ($intro_image_2)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
								<img src="{{ $intro_image_2->temporaryUrl() }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@elseif($oldimage2)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
								<img src=" {{ asset('storage/' . $oldimage2) }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@else
							<span class="text-gray-400">No Image</span>
						@endif
					</div>
					<div class="border rounded-lg p-3">
						<label for="site-desc" class="block text-sm font-medium text-gray-700">Site Intro Image 3</label>
						<div class="mt-1 flex items-center space-x-4">
							<label class="cursor-pointer">
								<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
									Select Image
									<input type="file" class="hidden" wire:model.live="intro_image_3">
								</span>
							</label>
							@error('intro_image_3') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
						</div>
						
						<!-- Image Preview -->
						@if ($intro_image_3)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
								<img src="{{ $intro_image_3->temporaryUrl() }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@elseif($oldimage3)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
								<img src=" {{ asset('storage/' . $oldimage3) }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@else
							<span class="text-gray-400">No Image</span>
						@endif
					</div>
                    
                </div>
            </div>

            <!-- Intro Texts -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Intro Sections</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="border rounded-lg p-4">
                        <label class="block text-gray-600 mb-1">Title</label>
                        <input type="text" wire:model="title1" class="w-full p-2 border rounded mb-2">
                        @error('title1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label class="block text-gray-600 mb-1">Text</label>
                        <textarea wire:model="intro1" class="w-full p-2 border rounded h-24"></textarea>
                        @error('intro1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
					<div class="border rounded-lg p-4">
                        <label class="block text-gray-600 mb-1">Title</label>
                        <input type="text" wire:model="title1" class="w-full p-2 border rounded mb-2">
                        @error('title2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label class="block text-gray-600 mb-1">Text</label>
                        <textarea wire:model="intro2" class="w-full p-2 border rounded h-24"></textarea>
                        @error('intro2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
					<div class="border rounded-lg p-4">
                        <label class="block text-gray-600 mb-1">Title</label>
                        <input type="text" wire:model="title1" class="w-full p-2 border rounded mb-2">
                        @error('title3') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label class="block text-gray-600 mb-1">Text</label>
                        <textarea wire:model="intro3" class="w-full p-2 border rounded h-24"></textarea>
                        @error('intro3') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">Social Media Links</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <div>
                        <label class="block text-gray-600 mb-1"><i class="fab fa-envelope text-blue-400 mr-2"></i> Email</label>
                        <input type="email" wire:model="sitemail" class="w-full p-2 border rounded">
                        @error('sitemail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
					<div>
                        <label class="block text-gray-600 mb-1"><i class="fab fa-facebook text-blue-600 mr-2"></i> Facebook</label>
                        <input type="url" wire:model="facebook_url" class="w-full p-2 border rounded">
                        @error('facebook_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1"><i class="fab fa-instagram text-pink-600 mr-2"></i> Instagram</label>
                        <input type="url" wire:model="instagram_url" class="w-full p-2 border rounded">
                        @error('instagram_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1"><i class="fab fa-whatsapp text-blue-700 mr-2"></i> Whatsapp</label>
                        <input type="url" wire:model="whatsapp_number" class="w-full p-2 border rounded">
                        @error('whatsapp_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-4">
                <button type="button" wire:click="cancelSiteEdit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Save Changes
                </button>
            </div>
        </form>
    @endif
</div>
<div class="flex-grow overflow-auto container mx-auto px-4 py-12">
	<div class="flex justify-between items-center mb-8 bg-white p-4 rounded-lg shadow">
        <h1 class="text-2xl font-bold">Profile Information</h1>
        <button wire:click="profileEdit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
            @if($viewProfileMode)
                <i class="fas fa-edit mr-2"></i> Edit Mode
            @else
                <i class="fas fa-eye mr-2"></i> View Mode
            @endif
        </button>
    </div>
</div>
    
</div>

<div class="flex-grow overflow-auto container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Settings Information</h1>
        
        <!-- Tabs Navigation -->
        <div class="flex border-b border-gray-200 mb-6">
            <button 
                wire:click="switchTab('profile')" 
                class="py-2 px-4 font-medium text-sm rounded-t-lg border border-b-0 {{ $activeTab === 'profile' ? 'bg-white text-blue-600 border-gray-200' : 'border-transparent text-gray-500 hover:text-gray-700' }}"
            >
                Profile
            </button>
            <button 
                wire:click="switchTab('site')" 
                class="py-2 px-4 font-medium text-sm rounded-t-lg border border-b-0 {{ $activeTab === 'site' ? 'bg-white text-blue-600 border-gray-200' : 'border-transparent text-gray-500 hover:text-gray-700' }}"
            >
                Site Information
            </button>
        </div>
        
        @if (session('message'))
            <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                {{ session('message') }}
            </div>
        @endif
        
        <!-- Profile Tab Content -->
        <div class="{{ $activeTab !== 'profile' ? 'hidden' : '' }} bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Profile Information</h2>
                @if(!$editingProfile)
                    <button wire:click="editProfile" class="text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                @endif
            </div>
            
            @if(!$editingProfile)
                <div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                           <div class="mb-4">
								<img src=" {{ asset('storage/' . Auth::user()->profile_Image) }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
                        </div>
                        <div>
							<div class="mb-4">
                                <label class="block text-sm font-medium text-gray-500">Name</label>
                                <p class="mt-1 text-gray-900">{{ Auth::user()->name }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-500">Email</label>
                                <p class="mt-1 text-gray-900">{{ Auth::user()->email }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-500">Phone</label>
                                <p class="mt-1 text-gray-900">{{ Auth::user()->phone }}</p>
                            </div>
							<div class="mb-4">
                                <label class="block text-sm font-medium text-gray-500">City</label>
                                <p class="mt-1 text-gray-900">{{ Auth::user()->city }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-500">Country</label>
                                <p class="mt-1 text-gray-900">{{ Auth::user()->country }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <form wire:submit.prevent="saveProfile">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
							<div class="mb-4">
											
								<label class="block text-sm font-medium text-gray-700">Profile Image*</label>
								<div class="mt-1 flex items-center space-x-4">
									<label class="cursor-pointer">
										<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
											Select Image
											<input type="file" class="hidden" wire:model.live="profile_Image">
										</span>
									</label>
									@error('profile_Image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
								</div>
								
								<!-- Image Preview -->
								@if ($profile_Image)
									<div class="mt-4">
										<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
										<img src="{{ $profile_Image->temporaryUrl() }}" class="max-w-xs rounded-lg border border-gray-200">
									</div>
								@elseif($oldimage)
									<div class="mt-4">
										<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
										<img src=" {{ asset('storage/' . $oldimage) }}" class="max-w-xs rounded-lg border border-gray-200">
									</div>
								@endif
							</div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                 <input wire:model="name" type="text" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                             </div>
                            <div class="mb-4">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input wire:model="email" type="text" id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                                <input wire:model="phone" type="text" id="phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                            <div class="mb-4">
                                <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                <input wire:model="city" type="text" id="city" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                            <div class="mb-4">
                                <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                <input wire:model="country" type="text" id="country" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" wire:click="cancelProfileEdit" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Save Changes
                        </button>
                    </div>
                </form>
            @endif
        </div>
        
        <!-- Site Information Tab Content -->
        <div class="{{ $activeTab !== 'site' ? 'hidden' : '' }} bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-xl font-semibold text-gray-800">Site Information</h2>
                @if(!$editingSite)
                    <button wire:click="editSite" class="text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-edit mr-1"></i> Edit
                    </button>
                @endif
            </div>
            
            @if(!$editingSite)
                <div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-500">Site Name</label>
                                <p class="mt-1 text-gray-900">{{ $siteName }}</p>
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-500">Site Icon</label>
                                @if($oldicon)
									<img src=" {{ asset('storage/' . $oldicon) }}" class="w-20 h-20 rounded-lg border border-gray-200">
								@else
									<span class="text-gray-400">No Icon</span>
								@endif
                            </div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-500">Site Logo</label>
                                @if($oldlogo)
									<img src=" {{ asset('storage/' . $oldlogo) }}" class="w-30 h-30 rounded-lg border border-gray-200">
								@else
									<span class="text-gray-400">No Logo</span>
								@endif
                            </div>
                        </div>
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-500">Social Media Links</label>
                                <div class="mt-1">
                                    <p class="text-gray-900"><i class="fab fa-whatsapp  mr-2 text-blue-400"></i> {{ $whatsapp_number }}</p>
                                    <p class="text-gray-900 mt-2"><i class="fab fa-facebook mr-2 text-blue-600"></i> {{ $facebook_url }}</p>
                                    <p class="text-gray-900 mt-2"><i class="fab fa-instagram mr-2 text-pink-500"></i> {{ $instagram_url }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="grid md:grid-cols-2 gap-6">
                        <div>
							<label class="block text-sm font-medium text-gray-500">Site Intro Image</label>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-500">Image 1</label>        
								@if($oldimage1)
									<img src=" {{ asset('storage/' . $oldimage1) }}" class="max-w-xs rounded-lg border border-gray-200">
								@else
									<span class="text-gray-400">No Image</span>
								@endif
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-500">Image 2</label>                             
								@if($oldimage2)
									<img src=" {{ asset('storage/' . $oldimage3) }}" class="max-w-xs rounded-lg border border-gray-200">
								@else
									<span class="text-gray-400">No Image</span>
								@endif							
                            </div>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-500">Image 3</label>
								@if($oldimage3)
									<img src=" {{ asset('storage/' . $oldimage3) }}" class="max-w-xs rounded-lg border border-gray-200">
								@else
									<span class="text-gray-400">No Image</span>
								@endif							
                            </div>
                        </div>
                        <div>
							<label class="block text-sm font-medium text-gray-500">Site Intro Text</label>
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-500">Intro 1</label>
                                <p class="mt-1 text-gray-900">{{ $oldimage1 }}</p>
                            </div>
							<div class="mt-4">
                                <label class="block text-sm font-medium text-gray-500">Intro 2</label>
                                <p class="mt-1 text-gray-900">{{ $oldimage2 }}</p>
                            </div>
							<div class="mt-4">
                                <label class="block text-sm font-medium text-gray-500">Intro 3</label>
                                <p class="mt-1 text-gray-900">{{ $oldimage3 }}</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            @else
                <form wire:submit.prevent="saveSite">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <label for="site-name" class="block text-sm font-medium text-gray-700">Site Name</label>
                                <input wire:model="siteName" type="text" id="site-name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            </div>
                            <div class="mb-4">
                                <label for="site-url" class="block text-sm font-medium text-gray-700">Site Icon</label>
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
                            <div class="mb-4">
                                <label for="site-desc" class="block text-sm font-medium text-gray-700">Site Logo</label>
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
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Social Media Links</label>
                                <div class="mt-1 space-y-2">
                                    <div class="flex items-center">
                                        <i class="fab fa-whatsapp  mr-2 text-blue-400 w-5"></i>
                                        <input wire:model="whatsapp_number" type="text" id="whatsapp" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fab fa-facebook mr-2 text-blue-600 w-5"></i>
                                        <input wire:model="facebook_url" type="text" id="facebook" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fab fa-instagram mr-2 text-pink-500 w-5"></i>
                                        <input wire:model="instagram_url" type="text" id="instagram" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
						
                    </div>
					<div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
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
                            <div class="mb-4">
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
                            <div class="mb-4">
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
                        <div>
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700">Site Intro Text</label>
                                <div class="mt-1 space-y-2">
                                    <div class="flex items-center">
                                        <label for="site-url" class="block text-sm font-medium text-gray-700">Site Intro 1</label>
                                    <textarea wire:model="intro1" id="site-desc" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
									</div>
                                    <div class="flex items-center">
                                        <label for="site-url" class="block text-sm font-medium text-gray-700">Site Intro 2</label>
										<textarea wire:model="intro2" id="site-desc" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
									</div>
                                    <div class="flex items-center">
                                        <label for="site-url" class="block text-sm font-medium text-gray-700">Site Intro 3</label>
										<textarea wire:model="intro3" id="site-desc" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
									</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end space-x-3">
                        <button type="button" wire:click="cancelSiteEdit" class="px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Save Changes
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>

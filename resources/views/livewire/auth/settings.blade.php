<div class="flex-grow overflow-auto">
<div class="flex-grow overflow-auto container mx-auto px-4 py-12">
    
	@if (session()->has('message'))
        <div class="mt-4 p-4 bg-green-100 text-green-700 rounded py-6">
            {{ session('message') }}
        </div>
    @endif
	@if(auth()->user()->Role == 1) 
	<!-- Admin Control Bar -->
    <div class="flex justify-between items-center mb-8 bg-white p-4 rounded-lg shadow">
        <h1 class="text-2xl font-bold">{{ __('auth.site_info') }}</h1>
        <button wire:click="toggleEdit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
            @if($viewMode)
                <i class="fas fa-edit mr-2 px-2"></i> {{ __('auth.edit_mode') }}
            @else
                <i class="fas fa-eye mr-2 px-2"></i> {{ __('auth.view_mode') }}
            @endif
        </button>
    </div>
	
    <!-- View Mode -->
    @if($viewMode)
        <!-- Site Info -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_info') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">{{ __('auth.site_name') }}</p>
                    <p class="font-medium">{{ $siteName }}</p>
					<p class="text-gray-600">{{ __('auth.site_location') }}</p>
                    <p class="font-medium">{{ $site_location }}</p>
                </div>
                <div>
                    <p class="text-gray-600">{{ __('auth.site_desc') }}</p>
                    <p class="font-medium">{{ $siteDescription }}</p>
					<p class="text-gray-600">{{ __('auth.site_desc_Ar') }}</p>
                    <p class="font-medium">{{ $siteDescriptionAr }}</p>
                </div>
            </div>
        </div>
		<!-- Site Logo -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_Icon_logo') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <p class="text-gray-600">{{ __('auth.site_icon') }}</p>
					@if($oldicon)
						<img src=" {{ asset('storage/' . $oldicon) }}" class="w-20 h-20 rounded-lg border border-gray-200">
					@else
						<span class="text-gray-400">{{ __('auth.site_no_icon') }}</span>
					@endif
                </div>
                <div>
                    <p class="text-gray-600">{{ __('auth.site_logo') }}</p>
					@if($oldlogo)
						<img src=" {{ asset('storage/' . $oldlogo) }}" class="w-30 h-30 rounded-lg border border-gray-200">
					@else
						<span class="text-gray-400">{{ __('auth.site_no_logo') }}</span>
					@endif
                </div>
            </div>
        </div>

        <!-- Images -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_images') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="border rounded-lg p-3">
					@if($oldimage1)
						<img src="{{ asset('storage/' . $oldimage1) }}" alt="Image 1" class="w-full mb-2 rounded">
					@else
						<span class="text-gray-400">{{ __('auth.site_no_images') }}</span>
					@endif
				</div>
                <div class="border rounded-lg p-3">
					@if($oldimage2)
						<img src="{{ asset('storage/' . $oldimage2) }}" alt="Image 2" class="w-full mb-2 rounded">
					@else
						<span class="text-gray-400">{{ __('auth.site_no_images') }}</span>
					@endif
				</div>
				<div class="border rounded-lg p-3">
					@if($oldimage3)
						<img src="{{ asset('storage/' . $oldimage3) }}" alt="Image 3" class="w-full mb-2 rounded">
					@else
						<span class="text-gray-400">{{ __('auth.site_no_images') }}</span>
					@endif
				</div>
            </div>
        </div>

        <!-- Intro Texts -->
        <div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_section') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-2">{{ $intro_title_1 }}</h3>
                    <p class="text-gray-700">{{ $intro_text_1 }}</p>
                </div>
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-2">{{ $intro_title_2 }}</h3>
                    <p class="text-gray-700">{{ $intro_text_2 }}</p>
                </div>
				<div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-2">{{ $intro_title_3 }}</h3>
                    <p class="text-gray-700">{{ $intro_text_3 }}</p>
                </div>
            </div>
        </div>
		<div class="bg-white p-6 rounded-lg shadow mb-8">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_intro_section_Ar') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-2">{{ $intro_title_1_Ar }}</h3>
                    <p class="text-gray-700">{{ $intro_text_1_Ar }}</p>
                </div>
                <div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-2">{{ $intro_title_2_Ar }}</h3>
                    <p class="text-gray-700">{{ $intro_text_2_Ar }}</p>
                </div>
				<div class="border rounded-lg p-4">
                    <h3 class="font-semibold mb-2">{{ $intro_title_3_Ar }}</h3>
                    <p class="text-gray-700">{{ $intro_text_3_Ar }}</p>
                </div>
            </div>
        </div>

        <!-- Social Media -->
        <div class="bg-white p-6 rounded-lg shadow">
            <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_social_media_link') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div>
                    <p class="text-gray-600"><i class="fab fa-envelope text-blue-700 mr-2"></i> {{ __('auth.email') }} :</p>
                    <p class="font-medium">{{ $sitemail }}</p>
                </div>
                <div>
                    <p class="text-gray-600"><i class="fab fa-facebook text-blue-600 mr-2"></i> {{ __('auth.site_facebook') }}</p>
                    <p class="font-medium">{{ $facebook_url}}</p>
                </div>                
                <div>
                    <p class="text-gray-600"><i class="fab fa-instagram text-pink-600 mr-2"></i> {{ __('auth.site_instagram') }}</p>
                    <p class="font-medium">{{ $instagram_url}}</p>
                </div>
				<div>
                    <p class="text-gray-600"><i class="fab fa-whatsapp text-blue-400 mr-2"></i> {{ __('auth.site_whatsapp') }}</p>
                    <p class="font-medium">{{ $whatsapp_number }}</p>
                </div>
                
            </div>
        </div>
    @else
        <!-- Edit Mode -->
        <form wire:submit.prevent="saveSite">
            <!-- Site Info -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_info') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_name') }}</label>
                        <input type="text" wire:model="siteName" class="w-full p-2 border rounded">
                        @error('siteName') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_location') }}</label>
                        <input type="text" wire:model="site_location" class="w-full p-2 border rounded">
                        @error('site_location') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_desc') }}</label>
                        <textarea wire:model="siteDescription" class="w-full p-2 border rounded h-28"></textarea>
                        @error('siteDescription') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
						<label class="block text-gray-600 mb-1">{{ __('auth.site_desc_Ar') }}</label>
                        <textarea wire:model="siteDescriptionAr" class="w-full p-2 border rounded h-28"></textarea>
                        @error('siteDescriptionAr') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
			
			<!-- Site Logo -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_Icon_logo') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_icon') }}</label>
                        <div class="mt-1 flex items-center space-x-4">
							<label class="cursor-pointer">
								<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
									{{ __('auth.site_select_icon') }}
									<input type="file" class="hidden" wire:model.live="site_icon">
								</span>
							</label>
							@error('site_icon') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
						</div>
						
						<!-- Image Preview -->
						@if ($site_icon)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src="{{ $site_icon->temporaryUrl() }}" class="w-20 h-20 rounded-lg border border-gray-200">
							</div>
						@elseif($oldicon)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src=" {{ asset('storage/' . $oldicon) }}" class="w-20 h-20 rounded-lg border border-gray-200">
							</div>
						@else
							<span class="text-gray-400">{{ __('auth.site_no_icon') }}</span>
						@endif
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_logo') }}</label>
                        <div class="mt-1 flex items-center space-x-4">
							<label class="cursor-pointer">
								<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
									{{ __('auth.site_select_logo') }}
									<input type="file" class="hidden" wire:model.live="site_logo">
								</span>
							</label>
							@error('site_logo') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
						</div>
						
						<!-- Image Preview -->
						@if ($site_logo)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src="{{ $site_logo->temporaryUrl() }}" class="w-20 h-20 rounded-lg border border-gray-200">
							</div>
						@elseif($oldlogo)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src=" {{ asset('storage/' . $oldlogo) }}" class="w-20 h-20 rounded-lg border border-gray-200">
							</div>
						@else
							<span class="text-gray-400">{{ __('auth.site_no_logo') }}</span>
						@endif
                    </div>
                </div>
            </div>

            <!-- Images -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_images') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="border rounded-lg p-3">
                        <label for="site-name" class="block text-sm font-medium text-gray-700">{{ __('auth.site_intro_image_1') }}</label>                                
						<div class="mt-1 flex items-center space-x-4">
							<label class="cursor-pointer">
								<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
									{{ __('auth.site_select_image') }}
									<input type="file" class="hidden" wire:model.live="intro_image_1">
								</span>
							</label>
							@error('intro_image_1') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
						</div>
						
						<!-- Image Preview -->
						@if ($intro_image_1)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src="{{ $intro_image_1->temporaryUrl() }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@elseif($oldimage1)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src=" {{ asset('storage/' . $oldimage1) }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@else
							<span class="text-gray-400">{{ __('auth.site_no_images') }}</span>
						@endif
                    </div>
					<div class="border rounded-lg p-3">
						<label for="site-url" class="block text-sm font-medium text-gray-700">{{ __('auth.site_intro_image_2') }}</label>
						<div class="mt-1 flex items-center space-x-4">
							<label class="cursor-pointer">
								<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
									{{ __('auth.site_select_image') }}
									<input type="file" class="hidden" wire:model.live="intro_image_2">
								</span>
							</label>
							@error('intro_image_2') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
						</div>
						
						<!-- Image Preview -->
						@if ($intro_image_2)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src="{{ $intro_image_2->temporaryUrl() }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@elseif($oldimage2)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src=" {{ asset('storage/' . $oldimage2) }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@else
							<span class="text-gray-400">{{ __('auth.site_no_images') }}</span>
						@endif
					</div>
					<div class="border rounded-lg p-3">
						<label for="site-desc" class="block text-sm font-medium text-gray-700">{{ __('auth.site_intro_image_3') }}</label>
						<div class="mt-1 flex items-center space-x-4">
							<label class="cursor-pointer">
								<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
									{{ __('auth.site_select_image') }}
									<input type="file" class="hidden" wire:model.live="intro_image_3">
								</span>
							</label>
							@error('intro_image_3') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
						</div>
						
						<!-- Image Preview -->
						@if ($intro_image_3)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src="{{ $intro_image_3->temporaryUrl() }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@elseif($oldimage3)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src=" {{ asset('storage/' . $oldimage3) }}" class="max-w-xs rounded-lg border border-gray-200">
							</div>
						@else
							<span class="text-gray-400">{{ __('auth.site_no_images') }}</span>
						@endif
					</div>
                    
                </div>
            </div>

            <!-- Intro Texts -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_section') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="border rounded-lg p-4">
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Title') }}</label>
                        <input type="text" wire:model="intro_title_1" class="w-full p-2 border rounded mb-2">
                        @error('intro_title_1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Text') }}</label>
                        <textarea wire:model="intro_text_1" class="w-full p-2 border rounded h-24"></textarea>
                        @error('intro_text_1') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
					<div class="border rounded-lg p-4">
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Title') }}</label>
                        <input type="text" wire:model="intro_title_2" class="w-full p-2 border rounded mb-2">
                        @error('intro_title_2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Text') }}</label>
                        <textarea wire:model="intro_text_2" class="w-full p-2 border rounded h-24"></textarea>
                        @error('intro_text_2') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
					<div class="border rounded-lg p-4">
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Title') }}</label>
                        <input type="text" wire:model="intro_title_3" class="w-full p-2 border rounded mb-2">
                        @error('intro_title_3') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Text') }}</label>
                        <textarea wire:model="intro_text_3" class="w-full p-2 border rounded h-24"></textarea>
                        @error('intro_text_3') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                </div>
            </div>
			
			<div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_intro_section_Ar') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    
                    <div class="border rounded-lg p-4">
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Title_Ar') }}</label>
                        <input type="text" wire:model="intro_title_1_Ar" class="w-full p-2 border rounded mb-2">
                        @error('intro_title_1_Ar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Text_Ar') }}</label>
                        <textarea wire:model="intro_text_1_Ar" class="w-full p-2 border rounded h-24"></textarea>
                        @error('intro_text_1_Ar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
					<div class="border rounded-lg p-4">
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Title_Ar') }}</label>
                        <input type="text" wire:model="intro_title_2_Ar" class="w-full p-2 border rounded mb-2">
                        @error('intro_title_2_Ar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Text_Ar') }}</label>
                        <textarea wire:model="intro_text_2_Ar" class="w-full p-2 border rounded h-24"></textarea>
                        @error('intro_text_2_Ar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
					<div class="border rounded-lg p-4">
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Title_Ar') }}</label>
                        <input type="text" wire:model="intro_title_3_Ar" class="w-full p-2 border rounded mb-2">
                        @error('intro_title_3_Ar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        <label class="block text-gray-600 mb-1">{{ __('auth.site_Text_Ar') }}</label>
                        <textarea wire:model="intro_text_3_Ar" class="w-full p-2 border rounded h-24"></textarea>
                        @error('intro_text_3_Ar') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    
                </div>
            </div>

            <!-- Social Media -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.site_social_media_link') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <div>
                        <label class="block text-gray-600 mb-1"><i class="fab fa-envelope text-blue-400 mr-2"></i> {{ __('auth.email') }}</label>
                        <input type="email" wire:model="sitemail" class="w-full p-2 border rounded">
                        @error('sitemail') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
					<div>
                        <label class="block text-gray-600 mb-1"><i class="fab fa-facebook text-blue-600 mr-2"></i> {{ __('auth.site_facebook') }}</label>
                        <input type="url" wire:model="facebook_url" class="w-full p-2 border rounded">
                        @error('facebook_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1"><i class="fab fa-instagram text-pink-600 mr-2"></i> {{ __('auth.site_instagram') }}</label>
                        <input type="url" wire:model="instagram_url" class="w-full p-2 border rounded">
                        @error('instagram_url') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-gray-600 mb-1"><i class="fab fa-whatsapp text-blue-700 mr-2"></i> {{ __('auth.site_whatsapp') }}</label>
                        <input type="text" wire:model="whatsapp_number" class="w-full p-2 border rounded">
                        @error('whatsapp_number') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" wire:click="cancelSiteEdit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    {{ __('dashboard.cancel') }}
                </button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ __('dashboard.save') }}
                </button>
            </div>
        </form>
    @endif
</div>
@endif
<div class="flex-grow overflow-auto container mx-auto px-4 py-12">
	<div class="flex justify-between items-center mb-8 bg-white p-4 rounded-lg shadow">
        <h1 class="text-2xl font-bold">{{ __('auth.Profile_Info') }}</h1>
        <button wire:click="profileEdit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
            @if($viewProfileMode)
                <i class="fas fa-edit mr-2 px-2"></i> {{ __('auth.edit_mode') }}
            @else
                <i class="fas fa-eye mr-2 px-2"></i> {{ __('auth.view_mode') }}
            @endif
        </button>
    </div>
	<!-- View Mode -->
    @if($viewProfileMode)
		<!-- Profile Information -->
		<div class="bg-white p-6 rounded-lg shadow mb-8">
			<h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.Profile_Info') }}</h2>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div>
					<p class="text-gray-600">{{ __('auth.name') }}</p>
					<p class="font-medium">{{ $name }}</p>
				</div>
				<div>
					<p class="text-gray-600">{{ __('auth.email') }}</p>
					<p class="font-medium">{{ $email }}</p>
				</div>
				<div>
					<p class="text-gray-600">{{ __('auth.phone') }}</p>
					<p class="font-medium">{{ $phone }}</p>
				</div>
				<div>
					<p class="text-gray-600">{{ __('auth.location') }}</p>
					<p class="font-medium">{{ $city }} , {{ $country }}</p>
				</div>
			</div>
		</div>
		<!-- Profile image -->
		<div class="bg-white p-6 rounded-lg shadow mb-8">
			<h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.prof_img') }}</h2>
			<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
				<div>
					<p class="text-gray-600">{{ __('auth.image') }}</p>
					@if($oldimage)
						<img src=" {{ asset('storage/' . $oldimage) }}" class="w-[300px] h-[300px] rounded-lg border border-gray-200">
					@else
						<span class="text-gray-400">{{ __('auth.no_prof') }}</span>
					@endif
				</div>
			</div>
		</div>
		
	 @else
        <!-- Edit Mode -->
        <form wire:submit.prevent="saveProfile">
            <!-- Site Info -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.Profile_Info') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-gray-600 mb-1">{{ __('auth.name') }}</label>
                        <input type="text" wire:model="name" class="w-full p-2 border rounded">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
					<div>
                        <label class="block text-gray-600 mb-1">{{ __('auth.email') }}</label>
                        <input type="text" wire:model="email" class="w-full p-2 border rounded">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
					<div>
                        <label class="block text-gray-600 mb-1">{{ __('auth.phone') }}</label>
                        <input type="text" wire:model="phone" class="w-full p-2 border rounded">
                        @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
					<div>
                        <label class="block text-gray-600 mb-1">{{ __('auth.City') }}</label>
                        <input type="text" wire:model="city" class="w-full p-2 border rounded">
                        @error('city') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
						
						<label class="block text-gray-600 mb-1">{{ __('auth.Country') }}</label>
                        <input type="text" wire:model="country" class="w-full p-2 border rounded">
                        @error('country') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>
			
			<!-- Profile Image -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.prof_img') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <div>
                        <label class="block text-gray-600 mb-1">{{ __('auth.prof_img') }}</label>
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
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src="{{ $profile_Image->temporaryUrl() }}" class="w-20 h-20 rounded-lg border border-gray-200">
							</div>
						@elseif($oldimage)
							<div class="mt-4">
								<span class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.preview') }}</span>
								<img src=" {{ asset('storage/' . $oldimage) }}" class="w-20 h-20 rounded-lg border border-gray-200">
							</div>
						@else
							<span class="text-gray-400">{{ __('auth.no_prof') }}</span>
						@endif
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" wire:click="cancelProfileEdit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    {{ __('dashboard.cancel') }}
                </button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    {{ __('dashboard.save') }}
                </button>
            </div>
        </form>
    @endif
	<!-- Profile Password -->
		<div class="bg-white p-6 rounded-lg shadow mb-8 p-12">
			<h2 class="text-xl font-semibold mb-4 border-b pb-2">{{ __('auth.chang_password') }}</h2>
			<button wire:click="passwordEdit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 flex items-center">
				@if($changePasswordMode)
					<i class="fas fa-edit mr-2 px-2"></i> {{ __('dashboard.cancel') }}
				@else
					<i class="fas fa-edit mr-2 px-2"></i>  {{ __('auth.edit_password') }}
				@endif
			</button>
			@if (session()->has('success'))
				<div class="mt-4 p-4 bg-green-100 text-green-700 rounded">
					{{ session('success') }}
				</div>
			@endif
			@if (session()->has('error'))
				<div class="mt-4 p-4 bg-red-100 text-red-700 rounded">
					{{ session('error') }}
				</div>
			@endif
			@if($changePasswordMode)
			<form wire:submit.prevent="updatePassword">
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label class="block text-gray-600 mb-1">{{ __('auth.current_pass') }}</label>
							<input type="password" wire:model.defer="current_password" placeholder="{{ __('auth.current_pass') }}" class="w-full p-2 border rounded">
							@error('current_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
						</div>
					</div>
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label class="block text-gray-600 mb-1">{{ __('auth.new_pass') }}</label>
							<input type="password" wire:model.defer="new_password" placeholder="{{ __('auth.new_pass') }}" class="w-full p-2 border rounded">
							@error('new_password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
						</div>
					</div>
					<div class="grid grid-cols-1 md:grid-cols-2 gap-4">
						<div>
							<label class="block text-gray-600 mb-1">{{ __('auth.conf_pass') }}</label>
							<input type="password" wire:model.defer="new_password_confirmation" placeholder="{{ __('auth.conf_pass') }}" class="w-full p-2 border rounded">
							@error('new_password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
						</div>
					</div>
					<div class="flex justify-end gap-2">
						<button type="button" wire:click="cancelPasswordEdit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
							{{ __('dashboard.cancel') }}
						</button>
						<button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
							{{ __('dashboard.save') }}
						</button>
					</div>
			</form>
		@endif
		</div>
		
</div>
    
</div>


<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="flex justify-center mb-6">
            <a href="{{ route('Home',['locale' => app()->getLocale()])  }}" class="logo text-2xl font-bold text-gray-800">{{app()->getLocale() == 'ar' ? $settings->site_name_Ar : $settings->site_name}}</a>
        </div>
        
        <h2 class="text-xl font-semibold text-gray-700 mb-6">{{ __('auth.Reset_Link') }}</h2>
        
        <form wire:submit.prevent="sendLink" class="space-y-4">
		
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">{{ __('auth.email') }}</label>
                <input wire:model="email" type="email" id="email" name="email" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    {{ __('auth.Reset_Link') }}
                </button>
            </div>
        </form>
		@if($resetLink)
        <div style="margin-top: 20px;">
            <strong>{{ __('auth.Reset') }}</strong> 
            <a href="{{ $resetLink }}"class="text-blue-500 ">{{ __('auth.click_Here') }}</a>
        </div>
    @endif
	</div>
</div>
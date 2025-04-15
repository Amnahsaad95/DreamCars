<div class="container mx-auto px-4 py-8 max-w-6xl">
<div class="max-w-2xl mx-auto p-12 bg-white rounded-lg shadow-md">
	<h1 class="text-2xl text-center font-bold mb-6">{{ __('messages.submit_feedback') }}</h1>
    @if(session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="submit">
        <!-- Type Selection -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">{{ __('messages.type') }}</label>
            <div class="flex space-x-4">
                <label class="inline-flex items-center">
                    <input type="radio" wire:model.live="type" value="complaint" class="form-radio" {{ $isDisabled ? 'disabled' : '' }}>
                    <span class="ml-2">{{ __('messages.complaint') }}</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="radio" wire:model.live="type" value="suggestion" class="form-radio" {{ $isDisabled ? 'disabled' : '' }}>
                    <span class="ml-2">{{ __('messages.suggestion') }}</span>
                </label>
            </div>
        </div>

        <!-- About Selection (only for complaints) -->
        @if($type === 'complaint')
            <div class="mb-4">
                <label class="block text-gray-700 mb-2">{{ __('messages.this_complaint_is_about') }}</label>
                <div class="flex space-x-4">
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model.live="about_type" value="user" class="form-radio" {{ $isDisabled ? 'disabled' : '' }}>
                        <span class="ml-2">{{ __('messages.user') }}</span>
                    </label>
                    <label class="inline-flex items-center">
                        <input type="radio" wire:model.live="about_type" value="car" class="form-radio" {{ $isDisabled ? 'disabled' : '' }}>
                        <span class="ml-2">{{ __('messages.car') }}</span>
                    </label>
                </div>
            </div>
			@endif
            <!-- Dynamic field for about_name -->
            @if($about_type)
				
                <div class="mb-4">
				@if($about_type === 'user')					
					<div class="relative mb-4">
						<label class="block text-gray-700 mb-2">{{ __('messages.user_name') }}</label>
						<input type="text" wire:model.live.debounce.150ms="user_name" placeholder="search ....." class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">

						<div class="absolute z-10 bg-white  w-full mt-1 max-h-60 overflow-auto">
							@foreach($results as $result)
								<div wire:click="selectOption({{ $result->user_Id }})" class="p-2 hover:bg-gray-100 cursor-pointer border border-gray-100">
									{{ $result->name }}
								</div>
							@endforeach
						</div>
					</div>
				@else
					<div class="relative mb-4">
						<label class="block text-gray-700 mb-2">{{ __('messages.car_name') }}</label>
						<input type="text" wire:model.live.debounce.150ms="car_name" placeholder="search ....." class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" {{ $isDisabled ? 'disabled' : '' }}>

						<div class="absolute z-10 bg-white  w-full mt-1 max-h-60 overflow-auto">
							@foreach($results as $result)
								<div wire:click="selectOption({{ $result->car_Id }})" class="p-2 hover:bg-gray-100 cursor-pointer border border-gray-100">
									{{ $result->Brand }} {{ $result->car_Model }}
								</div>
							@endforeach
						</div>
					</div>
				@endif
            @endif
        

        <!-- Name -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">{{ __('messages.car_Detail') }}</label>
            <input type="text" wire:model="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Phone -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">{{ __('messages.car_Detail') }}</label>
            <input type="text" wire:model="phone" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Content -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-2">
                @if($type === 'complaint') {{ __('messages.complaint') }} @else {{ __('messages.suggestion') }} @endif
            </label>
            <textarea wire:model="content" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
            @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
        </div>

        <!-- Public/Private -->
        <div class="mb-4">
            <label class="inline-flex items-center">
                <input type="checkbox" wire:model="is_public" class="form-checkbox">
                <span class="ml-2">{{ __('messages.make') }} @if($type === 'complaint') {{ __('messages.complaint') }} @else {{ __('messages.suggestion') }} @endif {{ __('messages.public') }}</span>
            </label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            {{ __('messages.submit') }} @if($type === 'complaint') {{ __('messages.complaint') }} @else {{ __('messages.suggestion') }} @endif
        </button>
		</div>
    </form>
	</div>

</div>
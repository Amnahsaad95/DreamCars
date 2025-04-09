

<div class="flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="flex justify-center mb-6">
            <a href="{{ url('/') }}" class="logo text-2xl font-bold text-gray-800">Dream Cars</a>
        </div>
        
        <h2 class="text-xl font-semibold text-gray-700 mb-6">Reset Password</h2>
        <!-- Success or Error Message -->
		@if (session()->has('message'))
			<div class="alert alert-success">
				{{ session('message') }}
			</div>
		@elseif(session()->has('error'))
			<div class="alert alert-danger">
				{{ session('error') }}
			</div>
		@endif

        <form wire:submit.prevent="resetPassword" class="space-y-4">
		
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                <input wire:model="password" type="password" id="password" name="password" placeholder="New Password" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
			<div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input wire:model="password_confirmation" type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                @error('password_confirmation') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <button type="submit" 
                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Reset Password
                </button>
            </div>
        </form>
		
	</div>
</div>
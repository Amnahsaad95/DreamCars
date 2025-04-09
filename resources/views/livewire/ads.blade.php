
<div class="container mx-auto px-4 py-8 max-w-6xl">
	<div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-lg">
		<h2 class="text-2xl font-bold text-gray-800 mb-6">Create New Advertisement</h2>
		
		@if (session()->has('message'))
			<div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
				{{ session('message') }}
			</div>
		@endif
		
		<form wire:submit.prevent="save" class="space-y-6">
			<!-- Name -->
			<div>
				<label for="FullName" class="block text-sm font-medium text-gray-700">Full Name*</label>
				<input type="text" id="FullName" wire:model="FullName" 
					   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
				@error('FullName') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
			</div>     
			
			
			<!-- Image Upload -->
			<div>
				<label class="block text-sm font-medium text-gray-700">Ad Image*</label>
				<div class="mt-1 flex items-center space-x-4">
					<label class="cursor-pointer">
						<span class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-25 transition">
							Select Image
							<input type="file" class="hidden" wire:model="image">
						</span>
					</label>
					@error('image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
				</div>
				
				<!-- Image Preview -->
				@if ($image)
					<div class="mt-4">
						<span class="block text-sm font-medium text-gray-700 mb-1">Preview:</span>
						<img src="{{ $image->temporaryUrl() }}" class="max-w-xs rounded-lg border border-gray-200">
					</div>
				@endif
			</div>
			
			<!-- URL -->
			<div>
				<label for="url" class="block text-sm font-medium text-gray-700">Target URL*</label>
				<input type="url" id="url" wire:model="url" 
					   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
				@error('url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
			</div>
			<div>
				<label for="location" class="block text-sm font-medium text-gray-700">Locatione*</label>
				<input type="text" id="location" wire:model="location" 
					   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
				@error('location') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
			</div>
			<!-- Date Range -->
			<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
				<div>
					<label for="start_date" class="block text-sm font-medium text-gray-700">Start Date*</label>
					<input type="date" id="start_date" wire:model="start_date" 
						   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
					@error('start_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
				</div>
				<div>
					<label for="end_date" class="block text-sm font-medium text-gray-700">End Date*</label>
					<input type="date" id="end_date" wire:model="end_date" 
						   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 p-2 border">
					@error('end_date') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
				</div>
			</div>
			
			
			<!-- Submit Button -->
			<div class="flex justify-end">
				<button type="submit" 
						class="px-6 py-3 bg-blue-600 text-white font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition">
					Create Advertisement
				</button>
			</div>
		</form>
	</div>
</div>
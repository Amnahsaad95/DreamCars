
<div class="flex-grow  overflow-auto container mx-auto px-4 py-8 bg-white">
	<h2 class="text-2xl mb-4 text-center">Add New Car</h2> 
	
	
    <!-- Author: FormBold Team -->
    <div class="mx-auto float-left ml-6 w-full max-w-[550px] bg-white">
		@if (session()->has('success'))
			
			<div role="alert">
			  <div class="bg-green-500 text-white font-bold rounded-t px-4 py-2">
				Success
			  </div>
			  <div class="border border-t-0 border-green-400 rounded-b bg-green-100 px-4 py-3 text-green-700">
				<p>{{ session('success') }}</p>
			  </div>
			</div>
		@endif
        <form>
            <div class="mb-5">
                <label for="brand" class="mb-3 block text-base font-medium text-[#07074D]">
                    Brand
                </label>
                <input type="text" name="brand" id="brand" placeholder="Enter Brand" wire:model="brand"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
				@error('brand') <span style="color: red;">{{ $message }}</span> @enderror
			</div>           
            <div class="-mx-3 flex flex-wrap">
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="model" class="mb-3 block text-base font-medium text-[#07074D]">
                            Model
                        </label>
                        <input type="text" name="model" id="model" placeholder="Enter Model" wire:model="model"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
						@error('model') <span style="color: red;">{{ $message }}</span> @enderror
                    </div>
                </div>
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="year" class="mb-3 block text-base font-medium text-[#07074D]">
                            Year
                        </label>
                        <input type="number" name="year" id="year" placeholder="Enter Year" wire:model="year"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
						@error('year') <span style="color: red;">{{ $message }}</span> @enderror
				   </div>
                </div>
            </div>
			<div class="-mx-3 flex flex-wrap">                
                <div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="price" class="mb-3 block text-base font-medium text-[#07074D]">
                            Price
                        </label>
                        <input type="number" name="price" id="price" placeholder="Enter Price" wire:model="price"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
						@error('price') <span style="color: red;">{{ $message }}</span> @enderror
					</div>
                </div>
				<div class="w-full px-3 sm:w-1/2">
                    <div class="mb-5">
                        <label for="color" class="mb-3 block text-base font-medium text-[#07074D]">
                            Color
                        </label>
						<input type="color" name="color" id="color" value="#ff0000" wire:model="color"
                            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 h-12 cursor-pointer outline-none focus:border-[#6A64F1] focus:shadow-md" />
                    </div>
                </div>
            </div>		

            <div class="mb-5 pt-3">
                <label class="mb-5 block text-base font-semibold text-[#07074D] sm:text-xl">
                    Address Details
                </label>
                <div class="-mx-3 flex flex-wrap">
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <input type="text" name="city" id="city" placeholder="Enter City" wire:model="city"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
							@error('city') <span style="color: red;">{{ $message }}</span> @enderror
						</div>
                    </div>
                    <div class="w-full px-3 sm:w-1/2">
                        <div class="mb-5">
                            <input type="text" name="country" id="country" placeholder="Enter Country" wire:model="country"
                                class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
							@error('country') <span style="color: red;">{{ $message }}</span> @enderror
					   </div>
                    </div>                    
                </div>
            </div>
			
			<div class="mb-5">
                <label for="image" class="mb-3 block text-base font-medium text-[#07074D]">
                    Car Image
                </label>
				<div class="max-w-4xl mx-auto p-6">
				<!-- Drop Zone -->
				<div 
					x-data="{ isDragging: false }"
					x-on:drop.prevent=" 						
					isDragging = false;
					if($refs.input){
						$refs.input.files = $event.dataTransfer.files;
						$refs.input.dispatchEvent(new Event('change'));
					}"
					x-on:dragover.prevent="isDragging = true"
					x-on:dragleave.prevent="isDragging = false"
					x-bind:class="isDragging ? 'border-blue-500 bg-blue-50' : 'border-gray-300'"
					class="border-2 border-dashed rounded-lg p-8 text-center cursor-pointer transition-colors duration-200 bg-white"
					
				>
					<div class="flex flex-col items-center justify-center space-y-2">
						<svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
							<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
						</svg>
						<p class="text-gray-600">Drag & drop files here or click to browse</p>
						<p class="text-sm text-gray-500">Supports: JPG, PNG, GIF (Max: 5MB each)</p>
						<input 
							type="file" 
							id="fileInput" 
							class="hidden" 
							wire:model.live="images" 
							x-ref="input"
							multiple
						>
						<label for="fileInput" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 cursor-pointer">
							Select Files
						</label>
					</div>
				</div>

				<!-- Preview Area -->
				<div class="mt-6 grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
					@foreach($uploadedImages as $index => $file)
						<div class="relative group rounded-lg overflow-hidden border border-gray-200">
							<img src="{{ $file['preview'] }}" alt="{{ $file['name'] }}" class="w-full h-32 object-cover">
							<div class="p-2">
								<p class="text-sm font-medium text-gray-900 truncate">{{ $file['name'] }}</p>
								<p class="text-xs text-gray-500">{{ $this->formatFileSize($file['size']) }}</p>
							</div>
							<button 
								wire:click="removeFile({{ $index }})"
								class="absolute top-2 right-2 p-1 bg-red-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity"
							>
								<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
								</svg>
							</button>
						</div>
					@endforeach
				</div>
				@error('images.*') 
					<span class="text-red-500 text-sm">{{ $message }}</span> 
				@enderror

				<!-- Actions -->
				<div class="mt-6 flex justify-end space-x-3">
					<button 
						wire:click="clearAll"
						class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600 {{ count($uploadedImages) ? '' : 'opacity-50 cursor-not-allowed' }}"
						@if(!count($uploadedImages)) disabled @endif
					>
						Clear All
					</button>
				</div>

			</div>
				
							
			</div> 
			
			<div class="mb-5">
                <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
                    Description
                </label>
                <input type="text" name="description" id="description" placeholder="Enter Description" wire:model="description"
                    class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
				@error('description') <span style="color: red;">{{ $message }}</span> @enderror
			</div> 

            <div>
                <button wire:click.prevent="save()"
                    class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
                    Create Car
                </button>
            </div>
        </form>
    </div>
</div>
@push('scripts')
<script>
    // Helper function to format file size
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
</script>
@endpush
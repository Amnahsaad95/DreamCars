<div>
    @if (session()->has('success'))
        <div style="color: green;">{{ session('success') }}</div>
		@endif

		<form wire:submit.prevent="{{ $updateMode ? 'updateBrand' : 'addBrand' }}">
			<label for="name"> Brand Name :</label>
			<input type="text" id="name" wire:model="name">
			@error('name') <span style="color: red;">{{ $message }}</span> @enderror

			<button type="submit">{{ $updateMode ? 'Edit' : 'Add' }}</button>
			@if($updateMode)
				<button type="button" wire:click="resetFields()">Cancel</button>
			@endif
		</form>

		<h2>Brands List</h2>
		<ul>
			@foreach($brands as $brand)
				<li>
					<a href="{{ route('cars.list', ['brand' => $brand->brand_Id]) }}"> {{ $brand->brand_Name }}</a>
					<button wire:click="editBrand({{ $brand->brand_Id }})">Edit</button>
					<button wire:click="deleteBrand({{ $brand->brand_Id }})" onclick="confirm('Are you sure ??') || event.stopImmediatePropagation()">Delete</button>
				</li>
			@endforeach
		</ul>

</div>

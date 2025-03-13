<section class="py-5">
	<div class="container">
		@if (session()->has('success'))
			<div class="alert alert-success" role="alert">
			  <h5 class="alert-heading">{{ session('success') }}</h5>
			</div>
		@endif
			
			<form class="form-inline" wire:submit.prevent="{{ $updateMode ? 'updateBrand' : 'addBrand' }}">
			  <label class="sr-only" for="name">Brand Name  : </label>
			  <input type="text" class="form-control mb-2 mr-sm-2" id="name" placeholder="Brand Name" wire:model="name">		  
				@error('name') <span style="color: red;">{{ $message }}</span> @enderror
			  <button type="submit" class="btn btn-primary mb-2"> {{ $updateMode ? 'Edit' : 'Add' }}</button>
				@if($updateMode)
					<button type="button" class="btn btn-outline-success mb-2" wire:click="resetFields()">Cancel</button>
				@endif
			</form>

			<h2>Brands List</h2>
			<div class="table-responsive-sm" style={width:400px} >
				<table class="table table-striped table-hover " >
					<thead>
						<tr>
							<th>Brand Name</th>
							<th width="150px">Action</th>
						</tr>
					</thead>

					<tbody>

						@foreach($brands as $brand)

						<tr>

							<td><a href="{{ route('cars.list', ['brand' => $brand->brand_Id]) }}"> {{ $brand->brand_Name }}</a></td>
							<td>
								<button wire:click="editBrand({{ $brand->brand_Id }})" class="btn btn-primary btn-sm">Edit</button>
								<button wire:click="deleteBrand({{ $brand->brand_Id }})" class="btn btn-danger btn-sm" onclick="confirm('Are you sure ??') || event.stopImmediatePropagation()">Delete</button>				
							</td>
						</tr>
						@endforeach
					</tbody>

				</table>
			</div>
	</div>
</section>


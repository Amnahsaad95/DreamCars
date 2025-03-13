<div>
        <h2>Brand's Car List  {{ $brand->brand_Name }}</h2>
		
		@if (session()->has('success'))
			<div class="alert alert-success" role="alert">
			  <h5 class="alert-heading">{{ session('success') }}</h5>
			</div>
		@endif
		
		<form class="form-inline" wire:submit.prevent="{{ $updateMode ? 'updateCar' : 'addCar' }}">
			<label class="sr-only" for="name">Car name:</label>
			<input type="text" class="form-control mb-2 mr-sm-2" id="name" wire:model="name">
			@error('name') <span style="color: red;">{{ $message }}</span> @enderror

	<br/>
			
			<label class="sr-only" for="model_Year">Model Year  :</label>
			<input type="number" class="form-control mb-2 mr-sm-2" id="model_Year" wire:model="model_Year">
			@error('model_Year') <span style="color: red;">{{ $message }}</span> @enderror
			<br/>
			<label class="sr-only" for="fuel_Type">Fuel Type :</label>
			<select class="form-select" id="fuel_Type" wire:model="fuel_Type">
				<option value="">-------</option>
					<option value="Gasoline">Gasoline</option>				
					<option value="Diesel">Diesel</option>				
					<option value="electricity">Electricity</option>
			</select>
			@error('fuel_Type') <span style="color: red;">{{ $message }}</span> @enderror
<br/>
			<label class="sr-only" for="transmission">Transmission :</label>
			<select class="form-select" id="transmission" wire:model="transmission">
				<option value="">--------</option>
					<option value="Manual">Manual</option>				
					<option value="automatic">Automatic</option>
				
			</select>
			@error('transmission') <span style="color: red;">{{ $message }}</span> @enderror
			<label class="sr-only" for="price">Price :</label>
			<input type="number" class="form-control mb-2 mr-sm-2" id="price" wire:model="price">
			@error('price') <span style="color: red;">{{ $message }}</span> @enderror
			<br/>
			<label class="sr-only" for="description">Description:</label>
			<input type="text" class="form-control mb-2 mr-sm-2" id="description" wire:model="description">
			@error('description') <span style="color: red;">{{ $message }}</span> @enderror
			<button type="submit" class="btn btn-primary mb-2"> {{ $updateMode ? 'Edit' : 'Add' }}</button>
			@if($updateMode)
				<button type="button" class="btn btn-outline-success mb-2" wire:click="resetFields()">Cancel</button>
			@endif
    </form>
	<br/>
	
		@if($cars->isEmpty())
			<div class="alert alert-danger" role="alert">
			  <h6 class="alert-heading">No cars of this Brand</h6>
			</div>
			<p></p>
		@else		
			<div class="table-responsive-sm" style={width:400px} >
				<table class="table table-striped table-hover " >
					<thead>
						<tr>
							<th>Car Name</th>
							<th>Model</th>
							<th>Fuel Type</th>
							<th>Transmission</th>
							<th>Price</th>
							<th>Description</th>
							<th width="150px">Action</th>
						</tr>
					</thead>

					<tbody>

						@foreach($cars as $car)

						<tr>

							<td>{{ $car->car_Name }}</td>
							<td>{{ $car->car_Model_Year }}</td>
							<td>{{ $car->car_Fuel_Type }}</td>
							<td>{{ $car->car_Transmission }}</td>
							<td>{{ number_format($car->car_Price, 2) }} $</td>
							<td>{{ $car->car_Description }}</td>
							<td>
								<button wire:click="editCar({{ $car->car_Id }})" class="btn btn-primary btn-sm">Edit</button>
								<button wire:click="deleteCar({{ $car->car_Id }})" class="btn btn-danger btn-sm" onclick="confirm('Are you sure ??') || event.stopImmediatePropagation()">Delete</button>				
							</td>
						</tr>
						@endforeach
					</tbody>

				</table>
			</div>
		@endif

</div>

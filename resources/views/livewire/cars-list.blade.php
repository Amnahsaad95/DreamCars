<div>
        <h2>Brand's Car List  {{ $brand->brand_Name }}</h2>
		
		@if (session()->has('success'))
			<div style="color: green;">{{ session('success') }}</div>
		@endif

		<form wire:submit.prevent="{{ $updateMode ? 'updateCar' : 'addCar' }}">
			<label for="name">Car name:</label>
			<input type="text" id="name" wire:model="name">
			@error('name') <span style="color: red;">{{ $message }}</span> @enderror

	<br/>
			
			<label for="model_Year">Model Year  :</label>
			<input type="number" id="model_Year" wire:model="model_Year">
			@error('model_Year') <span style="color: red;">{{ $message }}</span> @enderror
			<br/>
			<label for="fuel_Type">Fuel Type :</label>
			<select id="fuel_Type" wire:model="fuel_Type">
				<option value="">-------</option>
					<option value="Gasoline">Gasoline</option>				
					<option value="Diesel">Diesel</option>				
					<option value="electricity">Electricity</option>
			</select>
			@error('fuel_Type') <span style="color: red;">{{ $message }}</span> @enderror
<br/>
			<label for="transmission">Transmission :</label>
			<select id="transmission" wire:model="transmission">
				<option value="">--------</option>
					<option value="Manual">Manual</option>				
					<option value="automatic">Automatic</option>
				
			</select>
			@error('transmission') <span style="color: red;">{{ $message }}</span> @enderror
<br/>
			<label for="price">Price :</label>
			<input type="number" id="price" wire:model="price">
			@error('price') <span style="color: red;">{{ $message }}</span> @enderror
			<br/>
			<label for="description">Description:</label>
			<input type="text" id="description" wire:model="description">
			@error('description') <span style="color: red;">{{ $message }}</span> @enderror
<br/>
			<button type="submit">{{ $updateMode ? 'Edit' : 'Add' }}</button>
			@if($updateMode)
				<button type="button" wire:click="resetFields()">Cancel</button>
			@endif
    </form>
	<br/>
	
		@if($cars->isEmpty())
			<p>No cars of this Brand</p>
		@else
		 
			<ul>
				@foreach ($cars as $car)
					<li>
						<h3>{{ $car->car_Name }}</h3> 
						<button wire:click="editCar({{ $car->car_Id }})">Edit</button>
						<button wire:click="deleteCar({{ $car->car_Id }})" onclick="confirm('Are you sure ??') || event.stopImmediatePropagation()">Delete</button>
          
						<p>Model: {{ $car->car_Model_Year }}</p>
						<p>Fuel Type : {{ $car->car_Fuel_Type }} </p>
						<p>Transmission : {{ $car->car_Transmission }} </p>
						<p>Description : {{ $car->car_Description }} </p>
						<p>Price : {{ number_format($car->car_Price, 2) }} $</p>
					</li>
				@endforeach
			</ul>
		@endif

</div>

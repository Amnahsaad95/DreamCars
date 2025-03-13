<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use App\Models\Brand;


class CarsList extends Component
{
    
	public $brand;
	public $name, $brand_id, $price,$model_Year,$description,$fuel_Type,$transmission, $car_id; 
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string',
       // 'brand_id' => 'required|exists:brands,brand_Id',
        'price' => 'required|numeric|min:1',
		'model_Year' => 'required|numeric',
		'description' => 'required|string',
    ];

    public function addCar()
    {
        $this->validate();
        Car::create(['car_Name' => $this->name, 
					 'brand_Id' => $this->brand->brand_Id, 
					 'car_Model_Year'=>$this->model_Year,
					 'car_Price' => $this->price,
					 'car_Fuel_Type'=>$this->fuel_Type,
					 'car_Transmission'=>$this->transmission,
					 'car_Description'=>$this->description]);
        session()->flash('success', 'Add successful');
        $this->resetExcept('brand');
    }

    public function editCar($id)
    {
        $car = Car::findOrFail($id);
        $this->car_id = $car->car_Id;
        $this->name = $car->car_Name;
        $this->brand->brand_Id = $car->brand_Id;
		$this->model_Year = $car->car_Model_Year;
        $this->price = $car->car_Price;
		$this->fuel_Type = $car->car_Fuel_Type;
		$this->transmission = $car->car_Transmission;
		$this->description = $car->car_Description;
        $this->updateMode = true;
    }

    public function updateCar()
    {
        $this->validate();
        $car = Car::findOrFail($this->car_id);
        $car->update(['car_Name' => $this->name, 
					  'brand_Id' => $this->brand->brand_Id, 
					  'car_Model_Year'=>$this->model_Year,
					  'car_Price' => $this->price,
					  'car_Fuel_Type'=>$this->fuel_Type,
					  'car_Transmission'=>$this->transmission,
					  'car_Description'=>$this->description]);
        session()->flash('success', 'Edit successful');
        $this->resetExcept('brand');
        $this->updateMode = false;
    }

    public function deleteCar($id)
    {
        Car::findOrFail($id)->delete();
        session()->flash('success', 'Delete successful');
		$this->resetExcept('brand');
    }
    public function mount($brand)
    {
		
       
        $this->brand = Brand::findOrFail($brand);
		
		session()->flash('brand', $this->brand);
    }

	public function resetFields()
    {
		$this->resetExcept('brand');
		
	}
	
	public function render()

    {
		
        return view('livewire.cars-list', [
            'cars' => $this->brand->cars ,
			'brand' => $this->brand
        ]);

    }
}

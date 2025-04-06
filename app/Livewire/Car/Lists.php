<?php

namespace App\Livewire\Car;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

class Lists extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $brand, $model, $year, $color, $price, $status,$city,$country,$images,$description;
    public $carId;
    public $isModalOpen = false;
    public $isViewModalOpen = false;
    public $viewCar;
    public $search = '';
    public $sortBy = 'Brand';
    public $sortDirection = 'asc';
	public $tempImageUrls = [];
    public $existingImages;

    protected $rules = [
        'brand' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'year' => 'required|integer|min:1900',
        'color' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
		'city' => 'required|string|max:255',
		'country' => 'required|string|max:255',
		'description' => 'required|string|max:255',
		'images' => 'required|array|min:3|max:3',
		'images.*' =>'image|mimes:jpeg,png,jpg,gif|max:4096',
    ];

    public function render()
    {
        $cars = Car::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('Brand', 'like', '%' . $this->search . '%')
                      ->orWhere('car_Model', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate(10);

        return view('livewire.car.lists', [
            'cars' => $cars,
            'colors' => ['red', 'blue', 'black', 'white', 'silver', 'gray', 'yellow'],
            'statuses' => ['available', 'reserved', 'sold'],
        ])->layout('components.layouts.admindashboard');
    }

    public function sortBy($field)
    {
        if ($this->sortBy === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortBy = $field;
    }

    public function openModal()
    {
		//dd("I am here");
        $this->resetForm();
        $this->isModalOpen = true;
    }

    public function openViewModal($id)
    {
		
        $this->viewCar = Car::findOrFail($id);
        $this->isViewModalOpen = true;
    }

    public function edit($id)
    {
        $car = Car::findOrFail($id);
        $this->carId = $id;
        $this->brand = $car->Brand;
        $this->model = $car->car_Model;
        $this->year = $car->car_Year;
        $this->color = $car->color;
        $this->price = $car->car_Price;
        $this->city = $car->city;
        $this->country = $car->country;
        $this->description = $car->car_Description;
        $this->isModalOpen = true;
    }

    public function store()
    {
        $this->validate();
        Car::updateOrCreate(['car_Id' => $this->carId], [
					 'Brand' => $this->brand, 
					 'user_Id' => 1, 
					 'car_Model'=>$this->model,
					 'car_Year'=>$this->year,
					 'car_Price' => $this->price,
					 'city'=>$this->city,
					 'country'=>$this->country,
					 'color'=>$this->color,
					 'car_Description'=>$this->description]
			);
        $this->closeModal();
        $this->resetForm();
    }

    public function delete($id)
    {
        Car::find($id)->delete();
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->isViewModalOpen = false;
    }
	
	public function goToCreateCar()
	{
		return redirect()->route('createCar'); // Uses Laravel route name
	}

    private function resetForm()
    {
        $this->carId = null;
        $this->brand = '';
        $this->model = '';
        $this->year = '';
        $this->color = '';
        $this->price = '';
        $this->city = '';
        $this->images = '';
        $this->country = '';
        $this->description = '';
    }
}

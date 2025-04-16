<?php

namespace App\Livewire\Car;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\Car;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Auth;

class Lists extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $brand, $model, $year, $color, $price, $status,$city,$country,$images,$description;
    public $carId;
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
        $cars;
		$user = Auth::user();
		if($user->Role == 1){
			$cars = Car::query()->when($this->search, function ($query) {
										$query->where(function ($q) {
											$q->where('Brand', 'like', '%' . $this->search . '%')
											  ->orWhere('car_Model', 'like', '%' . $this->search . '%');
										});
									})
									->orderBy($this->sortBy, $this->sortDirection)
									->paginate(10);
		}
		else{
			$cars = Car::query()->where('user_Id',$user->user_Id)
									->when($this->search, function ($query) {
										$query->where(function ($q) {
											$q->where('Brand', 'like', '%' . $this->search . '%')
											  ->orWhere('car_Model', 'like', '%' . $this->search . '%');
										});
									})
									->orderBy($this->sortBy, $this->sortDirection)
									->paginate(10);;
		}
		
            

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

    public function View($id,$edit)
    {
		//dd($edit);
		return redirect()->route('update',['locale' => app()->getLocale(),'id'=>$id,'edit'=>$edit]);
    }

    public function delete($id)
    {
        Car::find($id)->delete();
    }

	
	public function goToCreateCar()
	{
		return redirect()->route('createCar',['locale' => app()->getLocale()]); 
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

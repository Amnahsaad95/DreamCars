<?php

namespace App\Livewire\Car;

use Livewire\WithFileUploads;
use Carbon\Carbon;
use Livewire\Component;

use Illuminate\Support\Facades\Auth;

use App\Models\Car;

class Create extends Component
{
	use WithFileUploads;
	
	public $Brand, $user_Id, $car_Model,
			$car_Price,$car_Year,$car_Description,$color,
			$car_Image=[],$isSold,  $car_id,$city,$country;
   
    public $uploadedImages = [];
    public $isDragging = false;


    protected $rules = [
        'Brand' => 'required|string',
		'car_Model' => 'required|string',
		'city' => 'required|string',
		'country' => 'required|string',
        'car_Price' => 'required|numeric|min:1',
		'car_Year' => 'required|numeric',
		'color' => 'required|string',
		'car_Description' => 'required|string',
		'car_Image' => 'required|array|min:3|max:3',
		'car_Image.*' =>'image|mimes:jpeg,png,jpg,gif|max:7000',
    ];
	protected $messages = [
		'car_Image.*.image' => 'File should be image .',
		'car_Image.*.mimes' => 'image should be jpeg, png, jpg, gif.',
		'car_Image.*.max' => 'image max 2 MB',
	];
	


    public function save()
    {
		//dd($this->images);
        $this->validate();
		//dd($this->images);
		$imagePaths = [];
		
        foreach ($this->car_Image as $image) {
			            
			$imageName = 'Car_'.time().'_'.uniqid(). '.' .$image->extension();
			
			$path = $image->storeAs('cars', $imageName,'public');
            //$path = $image->store('cars', 'public'); 
			
            $imagePaths[] = $path;
			
        }
		//dd($imagePaths);

        $car = Car::create(['Brand' => $this->Brand, 
					 'user_Id' => Auth::user()->user_Id, 
					 'car_Model'=>$this->car_Model,
					 'car_Year'=>$this->car_Year,
					 'car_Price' => $this->car_Price,
					 'city'=>$this->city,
					 'country'=>$this->country,
					 'color'=>$this->color,
					 'car_Image' => implode(',', $imagePaths), 
					 'car_Description'=>$this->car_Description]);
		
        session()->flash('success', 'Add successful');
		$this->reset();
		return redirect()->route('carlists');
    }
	
    public function render()
    {
        return view('livewire.car.create')->layout('components.layouts.admindashboard');
    }
}

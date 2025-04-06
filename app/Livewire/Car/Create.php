<?php

namespace App\Livewire\Car;

use Livewire\WithFileUploads;
use Carbon\Carbon;
use Livewire\Component;

use App\Models\Car;

class Create extends Component
{
	use WithFileUploads;
	
	public $brand, $user_id, $price,$model,$year,$description,$color,$images=[],  $car_id,$city,$country; 
   
    public $uploadedImages = [];
    public $isDragging = false;


    protected $rules = [
        'brand' => 'required|string',
		'model' => 'required|string',
		'city' => 'required|string',
		'country' => 'required|string',
        'price' => 'required|numeric|min:1',
		'year' => 'required|numeric',
		'color' => 'required|string',
		'description' => 'required|string',
		'images' => 'required|array|min:3|max:3',
		'images.*' =>'image|mimes:jpeg,png,jpg,gif|max:2048',
    ];
	protected $messages = [
		'images.*.image' => 'File should be image .',
		'images.*.mimes' => 'image should be jpeg, png, jpg, gif.',
		'images.*.max' => 'image max 2 MB',
	];
	
	public function updatedImages()
    {
        $this->validateOnly('images');
		//dd($this->images);
		foreach ($this->images as $image) {
            $this->uploadedImages[] = [
                'preview' => $image->temporaryUrl(),
                'name' => $image->getClientOriginalName(),
                'size' => $image->getSize(),
                'file' => $image
            ];
        }
        

	}
	public function removeFile($index)
    {
        unset($this->uploadedImages[$index]);
        $this->uploadedImages = array_values($this->uploadedImages);
    }
	public function clearAll()
    {
        $this->uploadedImages = [];
    }
	
	public function formatFileSize($bytes)
	{
		if ($bytes == 0) return '0 Bytes';
		
		$units = ['Bytes', 'KB', 'MB', 'GB'];
		$i = floor(log($bytes, 1024));
		
		return round($bytes / pow(1024, $i), 2) . ' ' . $units[$i];
	}



    public function save()
    {
		//dd($this->images);
        $this->validate();
		//dd($this->images);
		$imagePaths = [];
		
        foreach ($this->images as $image) {
			
			$imageName = 'Car_'.time().'_'.uniqid(). '.' .$image->extension();
			
			$path = $image->storeAs('cars', $imageName,'public');
            //$path = $image->store('cars', 'public'); 
			
            $imagePaths[] = $path;
			
        }
		//dd($imagePaths);

        $car = Car::create(['Brand' => $this->brand, 
					 'user_Id' => 1, 
					 'car_Model'=>$this->model,
					 'car_Year'=>$this->year,
					 'car_Price' => $this->price,
					 'city'=>$this->city,
					 'country'=>$this->country,
					 'color'=>$this->color,
					 'car_Image' => implode(',', $imagePaths), 
					 'car_Description'=>$this->description]);
		
        session()->flash('success', 'Add successful');
		$this->reset();
    }
	
    public function render()
    {
        return view('livewire.car.create')->layout('components.layouts.admindashboard');
    }
}

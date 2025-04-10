<?php

namespace App\Livewire\Car;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Car;


class Update extends Component
{
	use WithFileUploads;
	
	public $car;
    public $editMode = false;
    public $Brand, $user_Id, $car_Model,
			$car_Price,$car_Year,$car_Description,$color,$images=[],
			$car_Image=[],$isSold,  $car_id,$city,$country;

	public function mount($id,$edit)
    {
		if($edit == 'true')
			$this->editMode = true;
        $this->loadData($id);
    }
	
	public function loadData($id)
	{
		$this->car = Car::findOrFail($id);
		$this->Brand = $this->car->Brand;
        $this->user_Id = $this->car->user->user_Id;
		$this->car_Model = $this->car->car_Model;
		$this->car_Price = $this->car->car_Price;
		$this->car_Year = $this->car->car_Year;
		$this->isSold = $this->car->isSold;
		$this->country = $this->car->country;
		$this->images = explode(',', $this->car->car_Image);
		$this->city = $this->car->city;
		$this->color = $this->car->color;
		$this->car_Description = $this->car->car_Description;
		
	}
	
	public function toggleEdit()
    {
        $this->editMode = !$this->editMode;
        
    }
	
	public function save()
	{
		$validated = $this->validate([
			'Brand' => 'required|string',
			'car_Model' => 'required|string',
			'city' => 'required|string',
			'country' => 'required|string',
			'car_Price' => 'required|numeric|min:1',
			'car_Year' => 'required|numeric',
			'isSold' => 'required|boolean',
			'color' => 'required|string',
			'car_Description' => 'required|string',
			'car_Image' => 'nullable|array|min:0|max:3',
			'car_Image.*' =>'nullable|image|mimes:jpeg,png,jpg,gif|max:7000',			
		]);
		
		$imagePaths = [];
		if(isset($this->car_Image))
		{
			foreach ($this->car_Image as $index => $image) {
				//dd($index);
				$imageName = 'Car_'.time().'_'.uniqid(). '.' .$image->extension();
				
				$path = $image->storeAs('cars', $imageName,'public');
				//$path = $image->store('cars', 'public'); 
				
				$this->images[$index] = $path;
				
			}
			$validated['car_Image'] = implode(',', $this->images);
		}
		if($this->isSold == true){
			$this->isSold =1;
		}
		else{
			//dd($this->isSold);
			$this->isSold =0;
		}
		//dd($this->isSold);
		
		$this->car->update($validated);	
		$this->loadData($this->car->car_Id);
		//dd($this->isSold);
        $this->editMode = false;  
		return redirect()->route('update',['id'=>$this->car->car_Id,'edit'=>'false']);
        session()->flash('message', 'Site information updated successfully!');
		
	}


    public function render()
    {
        return view('livewire.car.update')
			->layout('components.layouts.admindashboard');
    }
}

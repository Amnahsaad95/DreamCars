<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;

class CarSlider extends Component
{
	public $limit = 6; 
	
    public function render()
    {
		$cars = Car::take($this->limit)->get();
		
        return view('livewire.car-slider',compact('cars'));
    }
}

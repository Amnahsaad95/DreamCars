<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;

class NewCars extends Component
{
	
	public function getRandomCars()
	{
		return Car::inRandomOrder()->take(3)->get();
	}
	public function show($id){
		return redirect()->route('CarDetail',$id);
	}

	
    public function render()
    {
		$cars=Car::orderBy('created_at','desc')->take(6)->get();
		$soldcars=Car::where('isSold',true)->latest()->take(5)->get();
		
        return view('livewire.new-cars',['cars' =>$cars,
										 'randomCars'=> $this->getRandomCars(),
										 'soldCars'=>$soldcars]);
    }
}

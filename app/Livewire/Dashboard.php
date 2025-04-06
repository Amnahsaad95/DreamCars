<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Car; 
use App\Models\User;
use App\Models\Ads; 

class Dashboard extends Component
{
	
    public function render()
    {
		$userCount = User::count();
		$cars = Car::count();
		$ads = Ads::count();
		
        return view('livewire.dashboard',[
										 'users'=>$userCount,
										 'cars'=>$cars,
										 'ads'=>$ads,])
            ->layout('components.layouts.admindashboard');
    }
}
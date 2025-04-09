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
		if(Auth::user()->Role ==1)
			$cars = Car::count();
		else
			$cars = Car::query()->where('user_Id',Auth::user()->user_Id)->count();
		$ads = Ads::count();
		
        return view('livewire.dashboard',[
										 'users'=>$userCount,
										 'cars'=>$cars,
										 'ads'=>$ads,])
            ->layout('components.layouts.admindashboard');
    }
}
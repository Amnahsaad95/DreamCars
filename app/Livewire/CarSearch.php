<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ads; 
use App\Models\Car; 
use Livewire\WithPagination;


class CarSearch extends Component
{
    use WithPagination;

	public $search = '';
    public $searchResults = [];
    public $showDropdown = false;

    protected $queryString = ['search'];

    public function updatedSearch($value)
    {
        if (strlen($value) > 0) {
            $this->searchResults = Car::query()
                ->where('Brand', 'like', '%'.$value.'%')
                ->orWhere('car_Model', 'like', '%'.$value.'%')
                ->limit(5)
                ->get()
                ->toArray();
            
            $this->showDropdown = count($this->searchResults) > 0;
        } else {
            $this->searchResults = [];
            $this->showDropdown = false;
        }
    }

    public function selectCar($carId)
    {
        $car = Car::find($carId);
        $this->search = $car->Brand;
        $this->searchResults = [];
        $this->showDropdown = false;
        $this->emit('carSelected', $carId); // Emit event if you need to handle selection
    }
	
	public function getRandomAds()
	{
		return Ads::where('status', 'published')
                     ->inRandomOrder()
                     ->firstOrFail();
	}
	
	public function recordClick($adId)
    {
        // Increment views count
        $ad=Ads::findOrFail($adId);
		$ad->increment('hit');
        
        
        // Redirect to the ad URL
        return redirect()->to($ad->ad_Url);
    }

    public function render()
    {
		
        return view('livewire.car-search',['randomAds'=> $this->getRandomAds(),]);
    }

}

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
	
	
	//////////////////
	
    public $selectedCars = [];
    public $showComparisonModal = false;
    public $detailedView = null;
    
    public $comparisonFeatures = ['Brand', 'Model', 'Year', 'Price' ,'Avaliable','Location'];
    public $comparisonFeatures1 = [];
	
	public function mount()
	{
		$this->comparisonFeatures1 = [
			'Brand' => __('dashboard.brand'),
			'car_Model' => __('dashboard.model'), 
			'car_Year' => __('dashboard.year'),
			'car_Price' => __('dashboard.price'),
			'color' => __('dashboard.color'),
			'isSold' => __('dashboard.status'),
		];
	}

    public function selectResult($result)
    {
        $this->showResults = false;
        $this->viewDetails($result);
    }
	public function toggleSelection($carId)
    {
        if (in_array($carId, $this->selectedCars)) {
            $this->selectedCars = array_diff($this->selectedCars, [$carId]);
        } else {
            $this->selectedCars[] = $carId;
        }
    }

    public function removeSelected($index)
    {
        unset($this->selectedCars[$index]);
        $this->selectedCars = array_values($this->selectedCars);
    }
	
	
	/////////////////////////
	

    protected $queryString = ['search'];

	
    public function updatedSearch($value)
    {
        if (strlen($value) > 0) {
            $this->searchResults = Car::query()
                ->where('Brand', 'like', '%'.$value.'%')
                ->orWhere('car_Model', 'like', '%'.$value.'%')
                ->limit(5)
                ->get()
				 ->map(function ($car) {
					$carArray = $car->toArray();
					$carArray['formatted_price'] = $car->formattedPrice();
					return $carArray;
				})
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
	
	public function show($id){
		return redirect()->route('CarDetail',[
			'locale' => app()->getLocale(),
			'id' => $id
		]);
	}

    public function render()
    {
		
        return view('livewire.car-search',['randomAds'=> $this->getRandomAds(),]);
    }

}

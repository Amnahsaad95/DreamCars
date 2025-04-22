<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Car; 
use App\Models\User;
use App\Models\Ads; 

use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
	public $stats = [
        'totalCars' => 0,
        'avgPrice' => 0,
        'availableCount' => 0,
        'soldCount' => 0,
    ];
    
    public $brandChart = [
        'labels' => [],
        'data' => [],
    ];
    
    public $priceChart = [
        'labels' => [],
        'data' => [],
    ];
    
    public $statusChart = [
        'labels' => ['Available', 'Sold'],
        'data' => [],
        'colors' => ['#10B981', '#EF4444'],
    ];
    
    public $countryChart = [
        'labels' => [],
        'data' => [],
        'colors' => ['#FF5733', '#33FF57', '#3357FF', '#F1C40F', '#9B59B6', '#E74C3C']
    ];
	
	public function mount()
    {
        // Get data from your database
        $this->loadData();
    }
	
	public function loadData()
    {
        // Basic stats
        $this->stats['avgPrice'] = number_format(Car::avg('car_Price') ?? 0);
        $this->stats['availableCount'] = Car::where('isSold', 0)->count();
        $this->stats['soldCount'] = Car::where('isSold', 1)->count();
        
        // Cars by brand
        $brandStats = Car::select('Brand', DB::raw('count(*) as total'))
                        ->groupBy('Brand')
                        ->orderBy('total', 'desc')
                        ->get();
        $this->brandChart['labels'] = $brandStats->pluck('Brand')->toArray();
        $this->brandChart['data'] = $brandStats->pluck('total')->toArray();
        
        // Price trends by year
        $yearStats = Car::select(
                            DB::raw('car_Year as year'),
                            DB::raw('AVG(car_Price) as avg_price')
                        )
                        ->groupBy('year')
                        ->orderBy('year')
                        ->get();
        $this->priceChart['labels'] = $yearStats->pluck('year')->toArray();
        $this->priceChart['data'] = $yearStats->pluck('avg_price')->toArray();
        
        // Sales status
        $this->statusChart['data'] = [$this->stats['availableCount'], $this->stats['soldCount']];
        
        // Cars by country
        $countryStats = Car::select('city', DB::raw('count(*) as total'))
                          ->groupBy('city')
                          ->orderBy('total', 'desc')
                          ->get();
        $this->countryChart['labels'] = $countryStats->pluck('city')->toArray();
        $this->countryChart['data'] = $countryStats->pluck('total')->toArray();
    }
	
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
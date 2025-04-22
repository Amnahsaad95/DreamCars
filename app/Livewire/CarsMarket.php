<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;

class CarsMarket extends Component
{
	public $search = '';
    public $sortBy = '';
    public $activeFilters = [];
	public $colorTolerance = 80;
    public $priceCondition = 'greater';
    public $priceValue = '';
    public $priceValue2 = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => ''],
    ];


    public function render()
    {
		
		$cars = Car::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('Brand', 'like', '%'.$this->search.'%')
                      ->orWhere('car_Model', 'like', '%'.$this->search.'%')
                      ->orWhere('car_Description', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->activeFilters, function ($query) {
                foreach ($this->activeFilters as $filter => $value) {
					//dd($filter);
                    if ($filter === 'car_Price') {
                        if ($this->priceCondition === 'greater') {						
                            $query->where('car_Price', '>=', $this->priceValue);
                        } elseif ($this->priceCondition === 'less') {
                            $query->where('car_Price', '<=', $this->priceValue);
                        } elseif ($this->priceCondition === 'between') {
                            $query->whereBetween('car_Price', [$this->priceValue, $this->priceValue2]);
                        }
					}
					elseif($filter === 'color'){
						if (!empty($value)) {
							// Convert selected color to RGB
							list($r, $g, $b) = sscanf($value, "#%02x%02x%02x");							
							$query->where(function($q) use ($r, $g, $b) {
								   $q->whereRaw("
									ABS(CAST(CONV(SUBSTRING(color, 2, 2), 16, 10) AS SIGNED) - ?) <= ?
									AND ABS(CAST(CONV(SUBSTRING(color, 4, 2), 16, 10) AS SIGNED) - ?) <= ?
									AND ABS(CAST(CONV(SUBSTRING(color, 6, 2), 16, 10) AS SIGNED) - ?) <= ?
								", [
									$r, $this->colorTolerance,
									$g, $this->colorTolerance,
									$b, $this->colorTolerance
								]);
							});
						}
					}
					else {
						//dd($value);
                        $query->where($filter, 'like', '%'.$value.'%');
                    }
                }
            })
            ->when($this->sortBy, function ($query) {
                if ($this->sortBy === 'price_asc') {
                    $query->orderBy('car_Price');
                } elseif ($this->sortBy === 'price_desc') {
                    $query->orderByDesc('car_Price');
                } elseif ($this->sortBy === 'year_asc') {
                    $query->orderBy('car_Year');
                } elseif ($this->sortBy === 'year_desc') {
                    $query->orderByDesc('car_Year');
                }
            })
            ->paginate(10);;

        return view('livewire.cars-market', [
            'cars' => $cars,
            'filterOptions' => [
                'Brand' => __('dashboard.brand'),
                'car_Model' => __('dashboard.model'),
                'car_Year' => __('dashboard.year'),
                'color' => __('dashboard.color'),
                'country' => __('dashboard.country'),
                'city' => __('dashboard.city'),
                'isSold' => __('dashboard.sold'),
                'car_Price' => __('dashboard.price'),
            ]
        ]);
    }
	
	public function addFilter($filter)
    {
        if (!array_key_exists($filter, $this->activeFilters)) {
            $this->activeFilters[$filter] = '';
        }
    }
	
	public function removeFilter($filter)
    {
        unset($this->activeFilters[$filter]);
        
        if ($filter === 'car_Price') {
            $this->priceCondition = 'greater';
            $this->priceValue = '';
            $this->priceValue2 = '';
        }
    }

    public function updatedPriceCondition()
    {
        $this->activeFilters['car_Price'] = $this->priceValue;
    }

    public function updatedPriceValue()
    {
        $this->activeFilters['car_Price'] = $this->priceValue;
    }

    public function show($id){
		return redirect()->route('CarDetail',[
        'locale' => app()->getLocale(),
        'id' => $id
    ]);
	}


}

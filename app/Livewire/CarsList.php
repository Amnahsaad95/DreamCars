<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use Livewire\WithPagination;

class CarsList extends Component
{
    // Available filters with configuration
	use WithPagination;
	
    public array $availableFilters = [
        'Brand' => [
            'name' => 'Brand',
            'type' => 'input',
            'options' => [],
            'icon' => 'fa-car'
        ],
        'price' => [
            'name' => 'Price Range',
            'type' => 'range',
            'min' => 0,
            'max' => 100000,
            'icon' => 'fa-dollar-sign'
        ],
        'car_Year' => [
            'name' => 'Year',
            'type' => 'select',
            'options' => [],
            'icon' => 'fa-calendar'
        ],
        'color' => [
            'name' => 'Fuel Type',
            'type' => 'select',
            'options' => ['Petrol', 'Diesel', 'Electric', 'Hybrid'],
            'icon' => 'fa-gas-pump'
        ]
    ];

    public array $activeFilters = [];
    public array $filterValues = [];
    public bool $showFilterDropdown = false;

    public function mount()
    {
        // Load dynamic options from database
       // $this->availableFilters['Brand']['options'] = Car::distinct()->pluck('Brand')->toArray();
        $this->availableFilters['year']['options'] = range(date('Y'), 1990);
		//dd($this->availableFilters);
    }

    public function toggleFilter(string $filterKey)
    {
		//dd($availableFilters);
        if ($this->isActive($filterKey)) {
            $this->removeFilter($filterKey);
        } else {
            $this->addFilter($filterKey);
        }
    }

    public function addFilter(string $filterKey)
    {
        if (!in_array($filterKey, $this->activeFilters)) {
            $this->activeFilters[] = $filterKey;
            $this->filterValues[$filterKey] = '';
        }
    }

    public function removeFilter(string $filterKey)
    {
        $this->activeFilters = array_diff($this->activeFilters, [$filterKey]);
        unset($this->filterValues[$filterKey]);
    }

    public function isActive(string $filterKey): bool
    {
        return in_array($filterKey, $this->activeFilters);
    }

    public function getFilteredCars()
    {
        $query = Car::query();

        foreach ($this->activeFilters as $filter) {
            if (empty($this->filterValues[$filter])) continue;
            switch ($filter) {
                case 'price':
                    if (!empty($this->filterValues['price_min'])) {
                        $query->where('car_Price', '>=', $this->filterValues['price_min']);
                    }
                    if (!empty($this->filterValues['price_max'])) {
						dd("maaax");
                        $query->where('car_Price', '<=', $this->filterValues['price_max']);
                    }
                    break;
					
                case 'Brand' :
					if(strlen($this->filterValues['Brand']) >=1){dd("brrrrrand");
						$query->where('car_Name', 'like', '%' . $this->filterValues['Brand'] . '%');
					}
					break;
					
                default:
                    $query->where($filter, $this->filterValues[$filter]);
                    break;
            }
        }

        return $query->paginate(12);
    }
	
	public function show($id){
		return redirect()->route('CarDetail',$id);
	}

    public function render()
    {
        return view('livewire.cars-list', [
            'cars' => $this->getFilteredCars()
        ]);
    }
}


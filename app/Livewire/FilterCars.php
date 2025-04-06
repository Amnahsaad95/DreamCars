<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use Livewire\WithPagination;

class FilterCars extends Component
{
	use WithPagination;

	public $search = '';
	public $sortField = 'car_Price';
	public $sortDirection = 'asc';
	public $filters = [];
	public $available = null;
	public $showFilter = false;
	
public $filterKey = '';


	public function updatingSearch() {
		$this->resetPage();
	}

	public function updatingFilters() {
		$this->resetPage();
	}

	public function applyFilter($key, $value) {
		$this->filters[$key] = $value;
	}

	public function resetFilters() {
		$this->filters = [];
	}

	public function render()
	{
		$cars = Car::query()
			->when($this->search, fn($q) => $q->where('Brand', 'like', "%{$this->search}%"))
			->when(isset($this->filters['price']), function($q) {
				$operator = $this->filters['price']['operator'];
				$value = $this->filters['price']['value'];
				$q->where('car_Price', $operator, $value);
			})
			->when(isset($this->filters['brand']), fn($q) => $q->where('Brand', 'like', "%{$this->filters['brand']}%"))
			->when(isset($this->filters['available']), fn($q) => $q->where('isSold', $this->filters['available']))
			->orderBy($this->sortField, $this->sortDirection)
			->paginate(10);

		return view('livewire.filter-cars', ['cars'=> Car::orderBy('created_at','desc')->paginate(10)]);
	}

}


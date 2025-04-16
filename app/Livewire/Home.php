<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Car;

class Home extends Component
{
	use WithPagination;

    public $search = '';

    public function render()
    {		
        return view('livewire.home', ['cars'=>Car::WhereLike('Brand',$this->search ?? '')]);
    }
}

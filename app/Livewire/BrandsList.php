<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Brand;

class BrandsList extends Component
{
    public $name, $brand_id;
    public $updateMode = false ;

    protected $rules = [
        'name' => 'required|string',
    ];

    public function addBrand()
    {
        $this->validate();
        Brand::create(['brand_Name' => $this->name]);
        session()->flash('success', 'Add Successful');
        $this->reset('name');
    }

    public function editBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $this->brand_id = $brand->brand_Id;
        $this->name = $brand->brand_Name;
        $this->updateMode = true;
    }

    public function updateBrand()
    {
        $this->validate();
        $brand = Brand::findOrFail($this->brand_id);
        $brand->update(['brand_Name' => $this->name]);
        session()->flash('success', 'Edit Done');
        $this->reset();
        $this->updateMode = false;
    }

    public function deleteBrand($id)
    {
        Brand::findOrFail($id)->delete();
        session()->flash('success', 'Delete Successfully');
    }
	public function resetFields()
    {
		$this->reset();
	}	

    public function render()
    {
        return view('livewire.brands-list', ['brands' => Brand::all()]);
    }
}

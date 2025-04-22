<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Car;
use App\Models\complaintsSuggestions;

class ComplaintSuggestionForm extends Component
{
    public $name;
    public $phone;
    public $content;
    public $isDisabled = false;
    public $is_public = false;
    public $type = 'complaint'; // default to complaint
    public $about_type;
    public $user_name;
    public $user_Id;
    public $car_name;
    public $car_Id;
    public $results =[];
    public $selectedOption = null;
	
    
    protected $rules = [
        'name' => 'required|min:3',
        'phone' => 'required',
        'content' => 'required|min:10',
        'type' => 'required|in:complaint,suggestion',
        'about_type' => 'nullable|in:user,car',
        'user_name' => 'nullable|string|max:255',
        'car_name' => 'nullable|string|max:255',
    ];
	
	public function mount($carId = null)
    {
        $this->car_Id = $carId;

        if ($this->car_Id) {
            $this->car_name = Car::findOrFail($this->car_Id)->Brand.' '.Car::findOrFail($this->car_Id)->car_Model;
			$this->about_type="car";
			$this->isDisabled= true;
        }
    }

    public function render()
    {
        return view('livewire.complaint-suggestion-form');
    }
	
	public function updatedUserName()
	{
		$this->results = \App\Models\User::query()->where('name', 'like', '%' . $this->user_name . '%')->get();		
	}
	
	public function updatedCarName()
	{
		$this->results = \App\Models\Car::query()
										->where('Brand', 'like', '%' . $this->car_name . '%')
										->orwhere('car_Model', 'like', '%' . $this->car_name . '%')
										->get();		
	}

	public function selectOption($id)
	{
		$this->selectedOption = $id;
		if($this->about_type == 'car')
		{
			$car = \App\Models\Car::find($id) ?? '';
			$this->car_name = $car->Brand.' '.$car->car_Model;
			$this->car_Id = $id;
		}
		else			
		{
			$this->user_name = \App\Models\User::find($id)->name ?? '';
			$this->user_Id = $id;
		}
		
		$this->results = [];
	}

    public function submit()
    {
        $this->validate();
		$complaint ='suggestion';
		if($this->type == 'complaint')
		{
			$complaint ='complaint';
			if($this->about_type == 'car'){
				$complaint = $this->type.'_car';
				$this->user_Id = Car::findOrFail($this->car_Id)->user_Id;
			}
			
			if($this->about_type == 'user'){
				$complaint = $this->type.'_user';
			}
		}
        complaintsSuggestions::create([
            'name' => $this->name,
            'phone_email' => $this->phone,
            'content' => $this->content,
            'is_public' => $this->is_public,
            'type' => $complaint ,
            'user_Id' => $this->user_Id ?? null,
            'car_Id' => $this->car_Id ?? null,
        ]);
        session()->flash('message', __('messages.submitted_successfully', ['type' => __('messages.'.$this->type)]));
        
        $this->reset();
    }
}


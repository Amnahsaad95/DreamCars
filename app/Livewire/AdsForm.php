<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Ads;

class AdsForm extends Component
{
    
    use WithFileUploads;
    
    public $FullName;
    public $hit=0;
    public $image;
    public $url;
    public $start_date;
    public $end_date;
    public $location;
    
    protected $rules = [
        'FullName' => 'required|string|max:255',
        'location' => 'nullable|string',
        'image' => 'required|image|max:2048', // 2MB max
        'url' => 'required|url',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
    ];
    
    public function save()
    {
        $this->validate();
        
		$imagePath ='';
		if ($this->image) {
            // Store the uploaded photo
			$imageName = 'Ads_'.time().'_'.uniqid(). '.' .$this->image->extension();
			
			$path = $this->image->storeAs('ads', $imageName,'public');
			
            $imagePath = $path;
			
            
        }
        
        Ads::create([
            'FullName' => $this->FullName,
            'hit' => $this->hit,
            'Image' => $imagePath,
            'ad_Url' => $this->url,
            'start_date' => $this->start_date,
            'End_date' => $this->end_date,
            'location' => $this->location,
        ]);
        
        session()->flash('message', 'Ad created successfully!');
        
        $this->reset();
    }
    
    public function render()
    {
        return view('livewire.ads');
    }
}
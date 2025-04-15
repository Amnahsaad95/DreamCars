<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class RegisterDetails extends Component
{
    use WithFileUploads;
	
    public $country;
    public $phone;
    public $city;
    public $image;	
    public $profileImage;

    protected $rules = [
        'phone' => 'nullable|string|max:20',
        'city' => 'nullable|string|max:255',
        'country' => 'nullable|string|max:255',
        'image' => 'nullable|image|max:2048',
    ];
	
	 public function mount()
    {
         $this->name = auth()->user()->name;
         $this->email = auth()->user()->email;
         $this->profileImage = auth()->user()->profile_Image ?? asset('profile/default-profile.jpg');
    }
	
	 public function updatedImage()
    {
        $this->validateOnly('image');
        $this->profileImage=$this->image->temporaryUrl();
    }

    public function submit()
    {
        $this->validate();
		$imagePath ='';

        if ($this->image) {
			$imageName = 'Profile_'.time().'_'.uniqid(). '.' .$this->image->extension();
			
			$path = $this->image->storeAs('profile', $imageName,'public');
			
            $imagePath = $path;
			
            $this->profileImage = asset('storage/profile'.$imageName);
            
        }
		$user = Auth::user();
        $user->update([
            'phone' => $this->phone,
            'city' => $this->city,
            'country' => $this->country,
            'profile_Image' => $imagePath ?? '',
        ]);

        return redirect()->route('dashboard',['locale' => app()->getLocale()]);
    }

    public function skip()
    {
        return redirect()->route('dashboard',['locale' => app()->getLocale()]);
    }

    public function render()
    {
		 return view('livewire.auth.register-details')
            ->layout('components.layouts.auth', ['title' => 'Complete Profile']);
    }
}




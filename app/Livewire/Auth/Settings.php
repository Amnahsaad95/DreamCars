<?php

namespace App\Livewire\Auth;

use Livewire\Component;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Setting;

class Settings extends Component
{
	
    use WithFileUploads;
	
	public $activeTab = 'profile';
    
    // Profile fields
	
    public $name ;
    public $email ;
    public $phone  ;
    public $city  ;
    public $country ;
    public $profile_Image ;
    public $oldimage ;
    public $editingProfile = false;
    
    // Site fields
    public $settings;
    public $siteName;
    public $oldicon;
    public $site_logo;
    public $site_icon;
    public $oldlogo;
    public $sitemail="DreamCars@gmail.com" ;
    public $facebook_url ;
    public $whatsapp_number ;
    public $instagram_url ;
    public $intro_image_1;
    public $intro_image_2 ;
    public $intro_image_3 ;
    public $oldimage1;
    public $oldimage2 ;
    public $oldimage3 ;
    public $title1 = "Title  1" ;
    public $intro1 ;
    public $title2 = "Title  2"  ;
    public $intro2 ;
    public $title3 = "Title  3" ;
    public $intro3 ;
	public $viewMode = true;
	public $viewProfileMode = true;
	public $siteDescription ="Welcome to our amazing platform!";

	public function mount()
	{
		
		$user = Auth::user();
		$this->name = $user->name ;
		$this->email =  $user->email ;
		$this->phone =  $user->phone ;
		$this->city =  $user->city ;
		$this->country =  $user->country ;
		$this->oldimage = $user->profile_Image  ;
		// Site fields
		$this->settings = Setting::first();
		$this->siteName = $this->settings->site_name;
		$this->oldicon =$this->settings->site_icon;
		$this->oldlogo = $this->settings->site_logo;
		$this->facebook_url = $this->settings->facebook_url ;
		$this->whatsapp_number = $this->settings->whatsapp_number;
		$this->instagram_url = $this->settings->instagram_url;
		$this->oldimage1 = $this->settings->intro_image_1;
		$this->oldimage2 = $this->settings->intro_image_2;
		$this->oldimage3 = $this->settings->intro_image_3;
		$this->intro1 = $this->settings->intro_text_1;
		$this->intro2 = $this->settings->intro_text_2;
		$this->intro3 = $this->settings->intro_text_3;
		
	}
    
	public function toggleEdit()
    {
        $this->viewMode = !$this->viewMode;
    }
	
	public function profileEdit()
    {
        $this->viewProfileMode = !$this->viewMode;
    }


    public function saveProfile()
    {
        $validated = $this->validate([
			'name' => 'required|string|max:255',
			'email' => 'required|string|email|unique:users,email,'.auth()->user()->user_Id.',user_Id',
			'phone' => 'nullable|string|max:20',
			'city' => 'nullable|string|max:255',
			'country' => 'nullable|string|max:255',
			'profile_Image' => 'nullable|image|max:2048',
			
		]);
		if ($this->profile_Image) {
			
			if (auth()->user()->profile_Image) {
				Storage::disk('public')->delete(auth()->user()->profile_Image);
			}

			$imageName = 'Profile_'.time().'_'.uniqid(). '.' .$this->profile_Image->extension();

			$path = $this->profile_Image->storeAs('profile', $imageName, 'public');

			$validated['profile_Image'] = $path;
		}
		
		auth()->user()->update($validated);
		//dd($validated);
        $this->viewProfileMode = true;
        session()->flash('message', 'Profile updated successfully!');
    }

    

    public function saveSite()
    {
        // Here you would typically save to database
		$validated = $this->validate([
			'siteName' => 'required|string|max:255',
			'site_icon' => 'nullable|image|max:2048',
			'site_logo' => 'nullable|image|max:2048',
			'facebook_url' => 'nullable|string|max:255',
			'whatsapp_number' => 'nullable|string|max:255',
			'instagram_url' => 'nullable|string|max:255',
			'intro_image_1' => 'nullable|image|max:2048',
			'intro_image_2' => 'nullable|image|max:2048',
			'intro_image_3' => 'nullable|image|max:2048',
			'intro1' => 'nullable|string|max:255',
			'intro2' => 'nullable|string|max:255',
			'intro3' => 'nullable|string|max:255',
			
		]);
		if ($this->intro_image_1) {
			
			if ($this->settings->intro_image_1) {
				Storage::disk('public')->delete($this->settings->intro_image_1);
			}

			$imageName = 'Intro_'.time().'_'.uniqid(). '.' .$this->intro_image_1->extension();

			$path = $this->intro_image_1->storeAs('Intro', $imageName, 'public');

			$validated['intro_image_1'] = $path;
		}
		if ($this->intro_image_2) {
			
			if ($this->settings->intro_image_2) {
				Storage::disk('public')->delete($this->settings->intro_image_2);
			}

			$imageName = 'Intro_'.time().'_'.uniqid(). '.' .$this->intro_image_2->extension();

			$path = $this->intro_image_2->storeAs('Intro', $imageName, 'public');

			$validated['intro_image_2'] = $path;
		}
		if ($this->intro_image_3) {
			
			if ($this->settings->intro_image_3) {
				Storage::disk('public')->delete($this->settings->intro_image_3);
			}

			$imageName = 'Intro_'.time().'_'.uniqid(). '.' .$this->intro_image_3->extension();

			$path = $this->intro_image_3->storeAs('Intro', $imageName, 'public');

			$validated['intro_image_3'] = $path;
		}
		if ($this->site_icon) {
			
			if ($this->settings->site_icon) {
				//Storage::disk('public')->delete($this->settings->oldicon);
			}

			$imageName = 'Icon'.time().'_'.uniqid(). '.' .$this->site_icon->extension();

			$path = $this->site_icon->storeAs('icon', $imageName, 'public');

			$validated['site_icon'] = $path;
		}
		if ($this->site_logo) {
			
			if ($this->settings->site_logo) {
				Storage::disk('public')->delete($this->settings->site_logo);
			}

			$imageName = 'Logo'.time().'_'.uniqid(). '.' .$this->site_logo->extension();

			$path = $this->site_logo->storeAs('Logo', $imageName, 'public');

			$validated['site_logo'] = $path;
		}
		$this->settings->update($validated);		
		$this->settings = Setting::first();
        $this->viewMode = true; 
        session()->flash('message', 'Site information updated successfully!');
    }


    public function render()
    {
        return view('livewire.auth.settings')->layout('components.layouts.admindashboard');;
    }
}

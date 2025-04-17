<?php

namespace App\Livewire\Auth;

use Livewire\Component;

use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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
    public $sitemail ;
    public $facebook_url ;
    public $whatsapp_number ;
    public $instagram_url ;
    public $intro_image_1;
    public $intro_image_2 ;
    public $intro_image_3 ;
    public $oldimage1;
    public $oldimage2 ;
    public $oldimage3 ;
    public $intro_title_1  ;
    public $intro_text_1 ;
    public $intro_title_2   ;
    public $intro_text_2 ;
    public $intro_title_3  ;    
    public $intro_text_3 ;
    public $intro_title_1_Ar  ;
    public $intro_text_1_Ar ;
    public $intro_title_2_Ar   ;
    public $intro_text_2_Ar ;
    public $intro_title_3_Ar  ;    
    public $intro_text_3_Ar ;
	public $site_location  ;
	public $viewMode = true;
	public $changePasswordMode = false;
	public $viewProfileMode = true;
	public $siteDescription ;
	public $siteDescriptionAr ;
	// Password fields
	public $current_password;
    public $new_password;
    public $new_password_confirmation;

	public function mount()
	{
		$this->loadProfile();
		$this->loadSite();
	}
    
	public function toggleEdit()
    {
        $this->viewMode = !$this->viewMode;
    }
	public function loadProfile()
    {
        $user = Auth::user();
		$this->name = $user->name ;
		$this->email =  $user->email ;
		$this->phone =  $user->phone ;
		$this->city =  $user->city ;
		$this->country =  $user->country ;
		$this->oldimage = $user->profile_Image  ;
    }
	public function loadSite()
    {
        $this->settings = Setting::first();
		$this->siteName = $this->settings->site_name;
		$this->oldicon =$this->settings->site_icon;
		$this->oldlogo = $this->settings->site_logo;
		$this->site_location = $this->settings->site_location ;
		$this->siteDescription = $this->settings->siteDescription ;
		$this->siteDescriptionAr = $this->settings->siteDescriptionAr ;
		$this->sitemail = $this->settings->sitemail ;
		$this->facebook_url = $this->settings->facebook_url ;
		$this->whatsapp_number = $this->settings->whatsapp_number;
		$this->instagram_url = $this->settings->instagram_url;
		$this->oldimage1 = $this->settings->intro_image_1;
		$this->oldimage2 = $this->settings->intro_image_2;
		$this->oldimage3 = $this->settings->intro_image_3;
		$this->intro_text_1 = $this->settings->intro_text_1;
		$this->intro_text_2 = $this->settings->intro_text_2;
		$this->intro_text_3 = $this->settings->intro_text_3;
		$this->intro_title_1 = $this->settings->intro_title_1;
		$this->intro_title_2 = $this->settings->intro_title_2;
		$this->intro_title_3 = $this->settings->intro_title_3;
		$this->intro_text_1_Ar = $this->settings->intro_text_1_Ar;
		$this->intro_text_2_Ar = $this->settings->intro_text_2_Ar;
		$this->intro_text_3_Ar = $this->settings->intro_text_3_Ar;
		$this->intro_title_1_Ar = $this->settings->intro_title_1_Ar;
		$this->intro_title_2_Ar = $this->settings->intro_title_2_Ar;
		$this->intro_title_3_Ar = $this->settings->intro_title_3_Ar;
    }
	
	public function profileEdit()
    {
        $this->viewProfileMode = !$this->viewProfileMode;
    }
	
	public function cancelSiteEdit()
    {
        $this->viewMode = !$this->viewMode;
    }
	
	public function cancelProfileEdit()
    {
        $this->viewProfileMode = !$this->viewProfileMode;
    }


	public function passwordEdit()
    {
        $this->changePasswordMode = !$this->changePasswordMode;
    }
	
	public function cancelPasswordEdit()
    {
        $this->changePasswordMode = !$this->changePasswordMode;
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
		else{
			$validated['profile_Image'] = $this->oldimage;
		}
		
		auth()->user()->update($validated);
		//dd($validated);
		$this->loadProfile();
        $this->viewProfileMode = true;
		session()->flash('message', __('messages.action_success', ['item' => __('messages.profile')]));

    }

    

    public function saveSite()
    {
        // Here you would typically save to database
		$validated = $this->validate([
			'siteName' => 'required|string|max:255',
			'site_icon' => 'nullable|image|max:2048',
			'site_logo' => 'nullable|image|max:2048',
			'site_location' => 'nullable|string|max:255',
			'siteDescription' => 'nullable|string|max:255',
			'siteDescriptionAr' => 'nullable|string|max:255',
			'sitemail' => 'nullable|string|max:255',
			'facebook_url' => 'nullable|string|max:255',
			'whatsapp_number' => 'nullable|string|max:255',
			'instagram_url' => 'nullable|string|max:255',
			'intro_image_1' => 'nullable|image|max:2048',
			'intro_image_2' => 'nullable|image|max:2048',
			'intro_image_3' => 'nullable|image|max:2048',
			'intro_text_1' => 'nullable|string|max:255',
			'intro_text_2' => 'nullable|string|max:255',
			'intro_text_3' => 'nullable|string|max:255',
			'intro_title_1' => 'nullable|string|max:255',
			'intro_title_2' => 'nullable|string|max:255',
			'intro_title_3' => 'nullable|string|max:255',
			'intro_text_1_Ar' => 'nullable|string|max:255',
			'intro_text_2_Ar' => 'nullable|string|max:255',
			'intro_text_3_Ar' => 'nullable|string|max:255',
			'intro_title_1_Ar' => 'nullable|string|max:255',
			'intro_title_2_Ar' => 'nullable|string|max:255',
			'intro_title_3_Ar' => 'nullable|string|max:255',
			
		]);
		if ($this->intro_image_1) {
			
			if ($this->settings->intro_image_1) {
				Storage::disk('public')->delete($this->settings->intro_image_1);
			}

			$imageName = 'Intro_'.time().'_'.uniqid(). '.' .$this->intro_image_1->extension();

			$path = $this->intro_image_1->storeAs('Intro', $imageName, 'public');

			$validated['intro_image_1'] = $path;
		}
		else{
			$validated['intro_image_1']=$this->settings->intro_image_1;
		}
		if ($this->intro_image_2) {
			
			if ($this->settings->intro_image_2) {
				Storage::disk('public')->delete($this->settings->intro_image_2);
			}

			$imageName = 'Intro_'.time().'_'.uniqid(). '.' .$this->intro_image_2->extension();

			$path = $this->intro_image_2->storeAs('Intro', $imageName, 'public');

			$validated['intro_image_2'] = $path;
		}
		else{
			$validated['intro_image_2']=$this->settings->intro_image_2;
		}
		if ($this->intro_image_3) {
			
			if ($this->settings->intro_image_3) {
				Storage::disk('public')->delete($this->settings->intro_image_3);
			}

			$imageName = 'Intro_'.time().'_'.uniqid(). '.' .$this->intro_image_3->extension();

			$path = $this->intro_image_3->storeAs('Intro', $imageName, 'public');

			$validated['intro_image_3'] = $path;
		}
		else{
			$validated['intro_image_3']=$this->settings->intro_image_3;
		}
		if ($this->site_icon) {
			
			if ($this->settings->site_icon) {
				Storage::disk('public')->delete($this->settings->oldicon);
			}

			$imageName = 'Icon_'.time().'_'.uniqid(). '.' .$this->site_icon->extension();

			$path = $this->site_icon->storeAs('icon', $imageName, 'public');

			$validated['site_icon'] = $path;
		}
		else{
			$validated['site_icon']=$this->settings->site_icon;
		}
		if ($this->site_logo) {
			
			if ($this->settings->site_logo) {
				Storage::disk('public')->delete($this->settings->site_logo);
			}

			$imageName = 'Logo_'.time().'_'.uniqid(). '.' .$this->site_logo->extension();

			$path = $this->site_logo->storeAs('Logo', $imageName, 'public');

			$validated['site_logo'] = $path;
		}
		else{
			$validated['site_logo']=$this->settings->site_logo;
		}
		$this->settings->update($validated);		
		$this->loadSite();
        $this->viewMode = true;
		session()->flash('message', __('messages.action_success', ['item' => __('messages.site_info')]));
    }
	
	public function updatePassword()
    {
        $user = Auth::user();

        // Check old password
        if (!Hash::check($this->current_password, $user->password)) {
			return session()->flash('error', __('messages.current_password_incorrect'));
        }

        // Validate new password
        $this->validate([
            'new_password' => [
                'required',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*#?&]).+$/'
            ],
        ]);

        // Prevent same as old password
        if (Hash::check($this->new_password, $user->password)) {
			return session()->flash('error', __('messages.new_password_same_as_current'));
        }

        // Update password
        $user->password = Hash::make($this->new_password);
        $user->save();
		$this->changePasswordMode=false;
        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
		session()->flash('success', __('messages.action_success', ['item' => __('messages.password')]));

    }


    public function render()
    {
        return view('livewire.auth.settings')->layout('components.layouts.admindashboard');;
    }
}

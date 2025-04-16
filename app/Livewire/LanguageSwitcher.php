<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cookie;

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\SetLocale;

class LanguageSwitcher extends Component
{
	public $currentLocale;
    public $availableLocales = ['en', 'ar']; // Add your supported languages
	public $currentRouteName;
	public $currentRouteParams = [];

    
    public function mount()
    {
        $this->currentLocale = app()->getLocale();
    }
    
    public function changeLanguage($locale)
    {
        if (!in_array($locale, $this->availableLocales)) {
            return;
        }
        
		$params = array_merge($this->currentRouteParams, ['locale' => $locale]);
        return redirect()->route($this->currentRouteName, $params);
    }
	
    public function render()
    {
        return view('livewire.language-switcher');
    }
}

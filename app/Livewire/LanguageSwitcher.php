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
        
        // Get current route name and parameters
		
        //$routeName = Route::currentRouteName();
		//dd($this->currentRouteParams);
        /*$routeParams = array_merge(
            Route::current()->parameters(),
            ['locale' => $locale]
        );*/
		$params = array_merge($this->currentRouteParams, ['locale' => $locale]);

        
        // Redirect to the same route but with new locale
        return redirect()->route($this->currentRouteName, $params);
    }
	
	public function changeLanguage2($locale)
    {
		
		//session('locale', $locale);
		// Store the chosen language in session
		//dd(session('locale'));
		session()->flash('locale', $locale);
        app()->setLocale($locale);
       $this->redirect(request()->header('Referer'), navigate: true);
		
    }
	
    public function render()
    {
        return view('livewire.language-switcher');
    }
}

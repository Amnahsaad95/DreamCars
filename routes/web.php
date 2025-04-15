<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CarsMarket;
use App\Livewire\CarDetail;

use App\Livewire\Car\Create;
use App\Livewire\Car\Update;
use App\Livewire\Car\Lists;

use App\Livewire\AboutUs;
use App\Livewire\AdsForm;
use App\Livewire\ComplaintSuggestionForm;
use App\Livewire\Home;
use App\Livewire\LanguageSwitcher;


use App\Livewire\Auth\Lgin;
use App\Livewire\Auth\Register;
use App\Livewire\Auth\RegisterDetails;
use App\Livewire\Auth\ForgotPasswordForm;
use App\Livewire\Auth\ResetPassword;
use App\Livewire\Auth\ComplaintSuggestionManagement;
use App\Livewire\Auth\AdsManagement;
use App\Livewire\Auth\Settings;
use App\Livewire\Auth\UsersManagement;
use App\Livewire\Dashboard;
use App\Http\Controllers\LanguageController;

use App\Http\Controllers\LocaleController;

use Livewire\Livewire;

Route::group([
    'prefix' => '{locale}',
    'middleware' => 'setLocale'
	], function() {
		// All your application routes here
		Route::get('/home', Home::class)->name('Home'); 	
		Route::get('/AllCar', CarsMarket::class)->name('AllCar');
		Route::get('/CarDetail/{id}', CarDetail::class)->name('CarDetail');
		Route::get('/aboutUs', AboutUs::class)->name('aboutUs');
		Route::get('/addNewAds', AdsForm::class)->name('addNewAds');
		Route::get('/ComplaintSuggestionForm/{carId?}', ComplaintSuggestionForm::class)->name('ComplaintSuggestionForm');
		
		//*****************  Login / Register ****************

		Route::get('/login', Lgin::class)->name('login');
		Route::get('/register', Register::class)->name('register');
		Route::get('/register/details', RegisterDetails::class)->name('register.details')->middleware('CustomAuthenticate');
		Route::get('/forgot-password', ForgotPasswordForm::class)->name('forgot.password');
		Route::get('/reset-password/{token}', ResetPassword::class)->name('reset.password');
		Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('CustomAuthenticate');

		Route::get('/carlists', Lists::class)->name('carlists')->middleware('CustomAuthenticate');
		Route::get('/update/{id}/{edit}', Update::class)->name('update');

		Route::get('/UsersManagement', UsersManagement::class)->name('UsersManagement')->middleware('CustomAuthenticate');
		Route::get('/createCar', Create::class)->name('createCar')->middleware('CustomAuthenticate');

		Route::get('/ComplaintSuggestionManagement', ComplaintSuggestionManagement::class)->name('ComplaintSuggestionManagement')->middleware('CustomAuthenticate');
		Route::get('/AdsManagement', AdsManagement::class)->name('AdsManagement')->middleware('CustomAuthenticate');
		Route::get('/Settings', Settings::class)->name('Settings')->middleware('CustomAuthenticate');
		Route::get('/logout', function () {
		Auth::logout();

		$locale = App::getLocale(); // أو يمكن أخذها من request()->segment(1) لو كنت تستعملها في الرابط
		return redirect("/$locale/home");
	})->name('logout');

    
    // Other routes...
});
// Redirect root to default locale
Route::get('/', function () {
    $locale = app()->getLocale(); // أو أي طريقة لتحديد اللغة
    return redirect("/{$locale}/home");
});


//

Route::get('lang/{lang}', function ($lang) {
    if (in_array($lang, ['en', 'ar'])) {
        session()->put('lang', $lang);
    }
	
    return redirect()->back();
})->name('change.lang');

//Route::get('lang/{lang}', [LanguageController::class, 'changeLanguage'])->name('change.language');

Route::post('/locale', LocaleController::class)->name('locale.change');


Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/DreamCars/public/livewire/update', $handle);
});



Route::get('/carCreat', Create::class)->name('carCreat');







//---------------------------------------------------------------------------------------


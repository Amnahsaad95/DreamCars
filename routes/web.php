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


Route::get('/', Home::class); 



Route::get('/carCreat', Create::class)->name('carCreat');


Route::get('/AllCar', CarsMarket::class)->name('AllCar');
//Route::get('/AllCar', CarsList::class)->name('AllCar');
Route::get('/CarDetail/{id}', CarDetail::class)->name('CarDetail');


Route::get('/aboutUs', AboutUs::class)->name('aboutUs');
Route::get('/addNewAds', AdsForm::class)->name('addNewAds');
Route::get('/ComplaintSuggestionForm/{carId?}', ComplaintSuggestionForm::class)->name('ComplaintSuggestionForm');


//---------------------------------------------------------------------------------------

//*****************  Login / Register ****************

Route::get('/login', Lgin::class)->name('login');
Route::get('/register', Register::class)->name('register');
Route::get('/register/details', RegisterDetails::class)->name('register.details')->middleware('auth');
Route::get('/forgot-password', ForgotPasswordForm::class)->name('forgot.password');
Route::get('/reset-password/{token}', ResetPassword::class)->name('reset.password');
Route::get('/dashboard', Dashboard::class)->name('dashboard')->middleware('auth');

Route::get('/carlists', Lists::class)->name('carlists')->middleware('auth');
Route::get('/update/{id}/{edit}', Update::class)->name('update');

Route::get('/UsersManagement', UsersManagement::class)->name('UsersManagement')->middleware('auth');
Route::get('/createCar', Create::class)->name('createCar')->middleware('auth');

Route::get('/ComplaintSuggestionManagement', ComplaintSuggestionManagement::class)->name('ComplaintSuggestionManagement')->middleware('auth');
Route::get('/AdsManagement', AdsManagement::class)->name('AdsManagement')->middleware('auth');
Route::get('/Settings', Settings::class)->name('Settings')->middleware('auth');
Route::get('/logout', function () {
    Auth::logout();  // Logs out the user
    return redirect('/');  // Redirects to the home page or login page
})->name('logout');

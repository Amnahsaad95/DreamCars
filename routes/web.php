<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\BrandsList;
use App\Livewire\CarsList;
use App\Livewire\ContactUs;
use App\Livewire\Home;

Route::get('/', Home::class); 

Route::get('/brands', BrandsList::class)->name('brands'); 
Route::get('/cars/{brand}', CarsList::class)->name('cars.list');
Route::get('/contact', ContactUs::class)->name('contact');


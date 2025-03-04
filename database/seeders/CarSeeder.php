<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;
use App\Models\Brand;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
		Car::create([
            'car_Name' => 'Corolla',
            'brand_Id' => Brand::where('brand_Name', 'Toyota')->first()->brand_Id,
            'car_Model_Year' => 2022,
            'car_Price' => 25000.00,
            'car_Fuel_Type' => 'Gasoline',
            'car_Transmission' => 'automatic',
            'car_Image' => 'corolla.jpg',
            'car_Description' => 'Perfect car'
        ]);

        Car::create([
            'car_Name' => 'X5',
            'brand_Id' => Brand::where('brand_Name', 'BMW')->first()->brand_Id,
            'car_Model_Year' => 2023,
            'car_Price' => 60000.00,
            'car_Fuel_Type' => 'Diesel',
            'car_Transmission' => 'automatic',
            'car_Image' => 'x5.jpg',
            'car_Description' => 'Sport car.'
        ]);

    }
}

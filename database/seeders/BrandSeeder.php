<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(['brand_Name' => 'Toyota', 'brand_Image' => 'toyota.png']);
        Brand::create(['brand_Name' => 'BMW', 'brand_Image' => 'bmw.png']);
        Brand::create(['brand_Name' => 'Mercedes', 'brand_Image' => 'mercedes.png']);

    }
}

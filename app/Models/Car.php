<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
	
	protected $table = "cars";
	protected $primaryKey = 'car_Id';

    protected $fillable = ['car_Name', 'brand_Id', 'car_Model_Year', 'car_Price','car_Fuel_Type',
							'car_Transmission', 'car_Image', 'car_Description'];


	public function brand()
    {
        return $this->belongsTo(Brand::class,'brand_Id');
    }
}

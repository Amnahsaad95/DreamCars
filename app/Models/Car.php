<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;
	
	protected $table = "cars";
	protected $primaryKey = 'car_Id';

    protected $fillable = ['Brand', 'user_Id', 'car_Model', 'car_Year','city',
							'country', 'car_Image','color','car_Price', 'isSold','car_Description'];


	
	public function user()
    {
        return $this->belongsTo(User::class,'user_Id');
    }
}

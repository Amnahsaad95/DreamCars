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
	public function formattedPrice()
	{
		$price = number_format($this->car_Price, 0, '.', app()->getLocale() === 'ar' ? '٬' : ',');
		
		if (app()->getLocale() === 'ar') {
			$arabicNumerals = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];
			$price = str_replace(range(0, 9), $arabicNumerals, $price);
			return $price . ' ل.س';
		}
		
		return $price . ' SYP';
	}
}

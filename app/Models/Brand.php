<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Brand extends Model
{
    use HasFactory;
	
	protected $table = "brands";
	protected $primaryKey = 'brand_Id';

    protected $fillable = ['brand_Name', 'brand_Image'];

	public function cars()
	{
		return $this->hasMany(Car::class,'brand_Id');
	}
}

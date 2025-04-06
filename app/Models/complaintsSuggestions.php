<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class complaintsSuggestions extends Model
{
    use HasFactory;
	protected $table = "complaints_suggestions";
	protected $primaryKey = 'complainant_Id';

    protected $fillable = [
        'name',
        'phone_email',
        'content',
        'is_public',
        'status',
        'type',
        'user_Id',
        'car_Id',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];
	
	public function user()
    {
        return $this->belongsTo(User::class,'user_Id');
    }
	
	public function car()
    {
        return $this->belongsTo(Car::class,'car_Id');
    }


}

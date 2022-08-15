<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\ProductInterface;

class Trip extends Model implements ProductInterface
{
    use HasFactory;

    // fillable for Eloquet understand such attributes can be auto updated when use ::create()
    protected $fillable = [
        'street_origin', 
        'number_origin', 
        'district_origin', 
        'country_origin', 
        'street_destination', 
        'number_destination', 
        'district_destination', 
        'country_destination'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getColumns(){
        return $this->getAttributes();
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }
}

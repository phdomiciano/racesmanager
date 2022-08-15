<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Interfaces\ProductInterface;

class Address extends Model implements ProductInterface
{
    use HasFactory;

    // fillable for Eloquet understand such attributes can be auto updated when use ::create()
    protected $fillable = ['name', 'street', 'number', 'district', 'country'];

    protected $table = "adresses";

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

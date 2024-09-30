<?php

namespace App\Models\EgoModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diameter extends Model
{
    use HasFactory;
    public function products(){
        return $this->hasMany(Product::class,'diameter_id');
     }
}

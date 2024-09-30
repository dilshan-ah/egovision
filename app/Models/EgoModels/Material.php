<?php

namespace App\Models\EgoModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    public function products(){
        return $this->hasMany(Product::class,'material_id');
     }
}

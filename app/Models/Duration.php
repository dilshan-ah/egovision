<?php

namespace App\Models;

use App\Models\EgoModels\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
    use HasFactory;

    public function products(){
        return $this->hasMany(Product::class);
    }
}

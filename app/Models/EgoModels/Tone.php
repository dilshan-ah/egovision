<?php

namespace App\Models\EgoModels;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tone extends Model
{
    use HasFactory;
    public function products(){
        return $this->hasMany(Product::class,'tone_id');
    }
}

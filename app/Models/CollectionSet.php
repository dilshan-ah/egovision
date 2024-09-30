<?php

namespace App\Models;

use App\Models\EgoModels\ProductCategory;
use App\Models\EgoModels\Tone;
use App\Models\Duration;
use App\Models\EgoModels\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollectionSet extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }

    public function tone(){
        return $this->belongsTo(Tone::class, 'tone_id');
    }

    public function duration(){
        return $this->belongsTo(Duration::class, 'duration_id');
    }

}

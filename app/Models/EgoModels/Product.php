<?php

namespace App\Models\EgoModels;

use App\Models\Duration;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;
    
    public function color()
    {
        return $this->belongsTo(Color::class);
    }
    public function diameter()
    {
        return $this->belongsTo(Diameter::class);
    }

    public function lensDesign()
    {
        return $this->belongsTo(LensDesign::class);
    }

    public function baseCurve()
    {
        return $this->belongsTo(BaseCurve::class);
    }

    public function category()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function duration()
    {
        return $this->belongsTo(Duration::class,'duration_id');
    }

    public function tone()
    {
        return $this->belongsTo(Tone::class);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function wishlist()
    {
        return $this->hasOne(Wishlist::class);
    }
}

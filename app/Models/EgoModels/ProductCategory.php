<?php

namespace App\Models\EgoModels;

use App\Models\CollectionSet;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function collectionSet()
    {
        return $this->hasOne(CollectionSet::class, 'category_id');
    }
}

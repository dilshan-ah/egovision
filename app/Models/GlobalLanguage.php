<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlobalLanguage extends Model
{
    protected $table = 'languages';

    protected $fillable = ['name', 'code'];
}

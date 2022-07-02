<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cake extends Model
{
    protected $fillable = ['name', 'thumbnail', 'description', 'price', 'bakery_shop_id', 'cake_category_id'];

    use HasFactory;
}

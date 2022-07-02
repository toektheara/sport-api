<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BakeryShop extends Model
{
    protected $fillable = ['name', 'thumbnail', 'description', 'phone_number', 'provinces_id', 'districts_id', 'communes_id', 'villages_id'];

    use HasFactory;
}

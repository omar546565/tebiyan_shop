<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'old_price', 'price', 'created_at', 'updated_at', 'discount', 'description', 'image', 'in_favorites', 'in_cart'
    ];

    public function Images(){

        return $this ->hasMany('App\Models\Images','products_id','id');

    }

}

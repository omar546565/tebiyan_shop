<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;

    protected $fillable = [
        'products_id', 'images'
    ];

    public function Product(){
        return $this -> belongsToMany('App\Product','products_id','id');

    }
}

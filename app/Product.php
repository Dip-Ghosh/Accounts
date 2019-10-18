<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name','color','size','brand','product_type','manufacturer','image'];
}

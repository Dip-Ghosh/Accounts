<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductAveragePrice extends Model
{
    protected $fillable = ['product_id','avg_price'];
}

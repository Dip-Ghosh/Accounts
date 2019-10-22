<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $fillable = ['storing_id','product_id','quantity','price'];
}

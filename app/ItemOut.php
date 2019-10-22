<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOut extends Model
{
    protected $fillable = ['storing_out','product_id','quantity','price'];
}

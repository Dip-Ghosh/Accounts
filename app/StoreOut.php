<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreOut extends Model
{
    protected $fillable = ['product_type_id','product_id','quantity','note','date'];
}

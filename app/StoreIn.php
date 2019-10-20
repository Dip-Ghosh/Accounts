<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreIn extends Model
{
    protected $fillable = ['product_type_id','product_id','supplier_id','quantity','purchase_price','note','date'];
}

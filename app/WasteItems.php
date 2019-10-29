<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WasteItems extends Model
{
    protected $fillable = ['waste_id','product_id','quantity','price'];
}

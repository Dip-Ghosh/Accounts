<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreIn extends Model
{
    protected $fillable = ['invoice_no','supplier_id','note','date'];
}

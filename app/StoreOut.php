<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreOut extends Model
{
    protected $fillable = ['invoice_no','customer_info','note','date'];
}

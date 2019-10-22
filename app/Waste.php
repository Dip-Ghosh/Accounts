<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waste extends Model
{
    protected $fillable = ['invoice_no','note','date'];
}

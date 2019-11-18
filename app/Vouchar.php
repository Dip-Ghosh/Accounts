<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vouchar extends Model
{
    protected $fillable = ['vouchar_type','pay_type','vouchar_date','description'];

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoucharDetails extends Model
{

    protected $fillable = ['vouchar_id','account_code','amount','amount_type'];
}

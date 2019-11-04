<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ControlLedger extends Model
{
    protected $fillable = ['code','name','description','group_ledger_id','sub_group_ledger_id'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubGroupLedger extends Model
{
    protected $fillable = ['code','name','description','group_ledger_id'];
}

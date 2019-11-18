<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucharDetailsTable extends Migration
{

    public function up()
    {
        Schema::create('vouchar_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vouchar_id');
            $table->integer('account_code');
            $table->float('amount');
            $table->integer('amount_type');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('vouchar_details');
    }
}

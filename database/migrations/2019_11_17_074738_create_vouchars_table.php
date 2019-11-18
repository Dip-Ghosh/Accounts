<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoucharsTable extends Migration
{

    public function up()
    {
        Schema::create('vouchars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('vouchar_type');
            $table->integer('pay_type');
            $table->date('vouchar_date');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('vouchars');
    }
}

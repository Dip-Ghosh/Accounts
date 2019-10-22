<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWastesTable extends Migration
{

    public function up()
    {
        Schema::create('wastes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoice_no');
            $table->string('note');
            $table->date('date');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('wastes');
    }
}

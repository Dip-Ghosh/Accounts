<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreInsTable extends Migration
{

    public function up()
    {
        Schema::create('store_ins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invoice_no');
            $table->integer('supplier_id');
            $table->string('note');
            $table->date('date');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('store_ins');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemOutsTable extends Migration
{

    public function up()
    {
        Schema::create('item_outs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('storing_out');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('item_outs');
    }
}

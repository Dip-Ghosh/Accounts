<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWasteItemsTable extends Migration
{

    public function up()
    {
        Schema::create('waste_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('waste_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->integer('price');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('waste_items');
    }
}

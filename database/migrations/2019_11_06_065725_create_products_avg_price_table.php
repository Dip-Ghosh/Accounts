<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsAvgPriceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_avg_price', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('product_id');
            $table->float('avg_price')->default(0);
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('products_avg_price');
    }
}

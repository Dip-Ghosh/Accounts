<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{

    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',255);
            $table->string('address')->nullable();
            $table->string('email')->nullable();
            $table->integer('mobile')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('companies');
    }
}

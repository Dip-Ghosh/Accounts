<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomeYearsTable extends Migration
{

    public function up()
    {
        Schema::create('income_years', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('incomeYear');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('income_years');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{

    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bank_id');
            $table->integer('branch_id');
            $table->string('name');
            $table->string('address');
            $table->string('email');
            $table->string('mobile');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}

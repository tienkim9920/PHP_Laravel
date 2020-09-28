<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTempTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts_temp', function (Blueprint $table) {
            $table->id();
            $table->string('idUser');
            $table->string('idProduct');
            $table->string('nameProduct');
            $table->integer('priceProduct');
            $table->string('imageProduct');
            $table->integer('count');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts_temp');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!(Schema::hasTable('contents'))){
            Schema::create('contents', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_invoice')->unsigned();
                $table->foreign('id_invoice')->references('id')->on('invoices');
                $table->integer('id_product')->unsigned();
                $table->foreign('id_product')->references('id')->on('products');
                $table->timestamps();
            });
       }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
};

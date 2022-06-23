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
        if(!(Schema::hasTable('invoices'))){
            Schema::create('invoices', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_client')->unsigned();
                $table->foreign('id_client')->references('id')->on('users');
                $table->float('all_value');
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
        Schema::dropIfExists('invoices');
    }
};

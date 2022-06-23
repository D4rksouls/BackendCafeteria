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
        if(!(Schema::hasTable('acess_to_users'))){
            Schema::create('acess_to_users', function (Blueprint $table) {
                $table->integer('id')->unsigned();
                $table->foreign('id')->references('id')->on('users');
                $table->tinyInteger('admin');
                $table->tinyInteger('seller');
                $table->tinyInteger('client');
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
        Schema::dropIfExists('acess_to_users');
    }
};

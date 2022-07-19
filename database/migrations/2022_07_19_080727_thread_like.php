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
        Schema::create('thread_like', function (Blueprint $table) {
            $table->increments('id_like');
            $table->unsignedInteger('thread');
            $table->unsignedInteger('id_pengguna');
            $table->string('status');
            $table->timestamps();
            
            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};

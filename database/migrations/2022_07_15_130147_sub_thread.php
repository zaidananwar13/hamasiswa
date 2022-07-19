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
        Schema::create('subThread', function (Blueprint $table) {
            $table->increments('id_subThread');
            $table->unsignedInteger('id_thread');
            $table->unsignedInteger('subThreader');
            $table->integer('likes');
            $table->text('konten');
            $table->string('status')->default('good');
            $table->timestamps();
            
            $table->foreign('subThreader')->references('id_pengguna')->on('pengguna');
            $table->foreign('id_thread')->references('id_thread')->on('thread');
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

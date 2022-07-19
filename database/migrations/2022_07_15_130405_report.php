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
        Schema::create('report', function (Blueprint $table) {
            $table->increments('id_report');
            $table->unsignedInteger('id_thread');
            $table->unsignedInteger('reporter');
            $table->string('laporan');
            $table->string('status');
            $table->timestamps();
            
            $table->foreign('reporter')->references('id_pengguna')->on('pengguna');
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

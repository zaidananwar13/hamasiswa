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
        Schema::create('thread', function (Blueprint $table) {
            $table->increments('id_thread');
            $table->unsignedInteger('threadStarter');
            $table->integer('likes')->default(0);
            $table->string('judul');
            $table->text('konten');
            $table->string('status')->default('good');
            $table->timestamps();
            
            $table->foreign('threadStarter')->references('id_pengguna')->on('pengguna');
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

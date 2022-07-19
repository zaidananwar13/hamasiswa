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
        Schema::create('tag_thread', function (Blueprint $table) {
            $table->increments('id_tag_thread');
            $table->unsignedInteger('id_thread');
            $table->unsignedInteger('id_tag');
            $table->foreign('id_tag')->on('tag')->references('id_tag'); 
            $table->foreign('id_thread')->on('thread')->references('id_thread'); 
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

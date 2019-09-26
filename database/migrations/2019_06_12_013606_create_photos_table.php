<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('filename');
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned();;
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('album_id')->unsigned();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('photos');
    }
}

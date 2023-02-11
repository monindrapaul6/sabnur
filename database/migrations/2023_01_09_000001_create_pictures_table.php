<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('image_title', 191)->nullable();
            $table->string('image_alt', 191)->nullable();
            $table->string('image_full', 191)->nullable();
            $table->string('image_thumb', 191)->nullable();
            $table->string('image_small', 191)->nullable();
            $table->boolean('is_default')->default(0);
            $table->string('status', 8)->default('ACTIVE');
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
        Schema::dropIfExists('pictures');
    }
}

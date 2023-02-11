<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostalZipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postal_zips', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('zip_code', 6);
            $table->string('is_cod', 3)->default('NO');
            $table->string('is_delivery', 3)->default('NO');
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
        Schema::dropIfExists('postal_zips');
    }
}

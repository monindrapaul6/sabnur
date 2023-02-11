<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('name', 50);
            $table->string('contact_no', 15)->nullable();
            $table->string('street', 60)->nullable();
            $table->string('city', 30)->nullable();
            $table->string('country', 30)->nullable();
            $table->string('state',30)->nullable();
            $table->string('state_code', 3)->nullable();
            $table->string('zip', 6)->nullable();
            $table->string('locality', 100)->nullable();
            $table->string('landmark', 100)->nullable();
            $table->boolean('is_primary')->default(0);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('addresses');
    }
}

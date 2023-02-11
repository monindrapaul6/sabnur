<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiteinfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siteinfos', function (Blueprint $table) {
            $table->id();
            $table->string('report_email', 100)->nullable();
            $table->string('mail_driver', 5)->nullable();
            $table->string('mail_host', 50)->nullable();
            $table->string('mail_port', 5)->nullable();
            $table->string('mail_username', 50)->nullable();
            $table->string('mail_password', 20)->nullable();
            $table->string('mail_encryption', 5)->nullable();
            $table->string('mail_from_address', 50)->nullable();
            $table->string('mail_form_name', 20)->nullable();
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
        Schema::dropIfExists('siteinfos');
    }
}

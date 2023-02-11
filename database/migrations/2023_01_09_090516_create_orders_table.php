<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->string('order_no', 20)->nullable()->unique();
            $table->float('sub_total', 10,2);
            $table->float('discount', 10,2);
            $table->float('delivery_charge', 10,2);
            $table->float('cod_charge', 10,2);
            $table->float('special_discount', 10,2);
            $table->float('total', 10,2);
            $table->string('payment_mode', 15)->nullable();
            $table->float('payment_amount', 10,2);
            $table->timestamp('payment_date')->nullable();
            $table->string('transaction_id', 50)->nullable();
            $table->string('order_status', 20)->default('ORDER GENERATED');
            $table->string('razorpay_order')->nullable();
            $table->string('razorpay_order_id')->nullable();
            $table->string('razorpay_payment_id')->nullable();
            $table->string('payment_status', 20)->nullable();
            $table->string('courier_awb_code', 50)->nullable();
            $table->string('courier_courier_name', 50)->nullable();
            $table->boolean('is_paid')->default(0);
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
        Schema::dropIfExists('orders');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('order_no')->nullable();
            $table->string('invoice_no')->unique()->nullable()->unique();
            $table->float('product_mrp_price', 10,2)->nullable();
            $table->float('product_current_price', 10,2)->nullable();
            $table->float('unit_price', 10,2)->nullable();
            $table->float('net_amount', 10,2)->nullable();
            $table->decimal('tax_rate')->nullable();
            $table->float('tax_amount', 10,2)->nullable();
            $table->integer('product_quantity')->nullable();
            $table->float('special_discount', 10,2);
            $table->float('product_total_price', 10,2)->nullable();
            $table->string('courier_awb_code')->nullable();
            $table->string('courier_courier_name')->nullable();
            $table->string('order_status', 20)->default('ORDER GENERATED');
            $table->string('payment_status', 20)->nullable();
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
        Schema::dropIfExists('invoices');
    }
}

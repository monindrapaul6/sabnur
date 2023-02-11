<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->unsignedBigInteger('product_dp')->nullable();
            $table->foreign('product_dp')->references('id')->on('pictures');
            $table->string('hsn_no', 100)->nullable();
            $table->string('product_name', 150);
            $table->string('product_slug', 150)->nullable();
            $table->longText('product_summary')->nullable();
            $table->longText('product_details')->nullable();
            $table->float('product_mrp_price', 10,2)->nullable();
            $table->float('product_current_price', 10,2)->nullable();
            $table->integer('product_discount')->nullable();
            $table->decimal('unit_price', 10,2)->nullable();
            $table->decimal('net_amount', 10,2)->nullable();
            $table->decimal('tax_rate', 10)->nullable();
            $table->decimal('tax_amount', 10,2)->nullable();
            $table->string('is_combo', 3)->default('NO');
            $table->float('combo_discount')->nullable();
            $table->float('discounted_price')->nullable();
            $table->float('price_combo')->nullable();
            $table->bigInteger('num_of_views')->default(1);
            $table->float('rating', 8,2)->default(0);
            $table->integer('num_of_rating')->default(0);
            $table->boolean('stock_status')->default(1);
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
        Schema::dropIfExists('products');
    }
}

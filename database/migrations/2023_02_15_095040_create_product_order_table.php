<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::Create('product_order', function (Blueprint $table) {
            $table->id('id');
            $table->foreignId('order_id')->references('id')->on('orders');
            $table->foreignId('product_option_key_id')->nullable()->references('id')->on('product_option_keys');
            $table->double('price');
            $table->double('purchase_price');
            $table->integer('quantity')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_order', function (Blueprint $table) {
            //
        });
    }
}

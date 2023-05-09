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
            $table->id('id');
            $table->foreignId('client_id')->nullable()->references('id')->on('users');
            $table->float('total_price');
            $table->foreignId('coupon_id')->nullable()->references('id')->on('coupons');
            $table->string('order_status')->default('cart');
            $table->float('final_price');
            $table->float('tax');
            $table->string('address');
            $table->string('notes');
            $table->boolean('canceled')->default(0);
            $table->boolean('checkout')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('orders');
    }
}

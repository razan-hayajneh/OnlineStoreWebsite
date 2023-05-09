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
            $table->id('id');
            $table->text('name');
            $table->longtext('description')->nullable();
            $table->text('image_path')->nullable();
            $table->float('price');
            $table->foreignId('category_id')->nullable()->references('id')->on('categories');
            $table->integer('quantity')->nullable();
            $table->float('discount')->nullable();
            $table->boolean('discount_type')->nullable()->default(0);
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
        Schema::drop('products');
    }
}

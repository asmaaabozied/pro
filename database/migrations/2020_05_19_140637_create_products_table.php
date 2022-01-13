<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->integer('store_id');
            $table->integer('category_id');
            $table->integer('brand_id');
            $table->string('title_en');
            $table->text('description_en');
            $table->double('price');
            $table->string('image');
            $table->integer('quantity');
            $table->boolean('discount');
            $table->double('discount_rate');
            $table->date('discount_start_date');
            $table->date('discount_end_date');
            $table->boolean('featured');
            $table->boolean('active');
            $table->boolean('en');
            $table->nullableTimestamps();
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

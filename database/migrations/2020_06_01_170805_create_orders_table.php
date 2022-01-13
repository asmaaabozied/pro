<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

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
            $table->increments('id');
            $table->integer('cart_id');
            $table->integer('user_id');
            $table->integer('address_id');
            $table->float('shipping_cost');
            $table->string('discount_type');
            $table->float('discount');
            $table->integer('voucher_coupon_id');
            $table->float('voucher_coupon_total_discount');
            $table->double('total');
            $table->string('status');
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
        Schema::drop('orders');
    }
}

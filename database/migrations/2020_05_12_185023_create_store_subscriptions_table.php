<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoreSubscriptionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_subscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subscription_id');
            $table->integer('store_id');
            $table->double('actual_price');
            $table->double('price');
            $table->integer('duration');
            $table->date('expire_date');
            $table->boolean('active');
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
        Schema::drop('store_subscriptions');
    }
}

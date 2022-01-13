<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrderActionsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_actions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('reason_id');
            $table->text('detail');
            $table->string('status')->default('pending');
            $table->string('type')->default('order');
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
        Schema::drop('order_actions');
    }
}

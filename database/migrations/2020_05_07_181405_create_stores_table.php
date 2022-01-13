<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoresTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_en');
            $table->text('description_en');
            $table->string('phone');
            $table->string('image');
            $table->decimal('lat', 10, 8);
            $table->decimal('long', 11, 8);
            $table->integer('store_type');
            $table->integer('owner_id');
            $table->string('status');
            $table->boolean('activated');
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
        Schema::drop('stores');
    }
}

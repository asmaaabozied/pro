<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title_en');
            $table->text('description_en');
            $table->string('image');
            $table->string('icon');
            $table->integer('parent')->nullable();
            $table->boolean('en')->default(1);
            $table->boolean('active')->default(1);
            $table->boolean('menu')->default(0);
            $table->integer('order')->nullable();
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
        Schema::drop('categories');
    }
}

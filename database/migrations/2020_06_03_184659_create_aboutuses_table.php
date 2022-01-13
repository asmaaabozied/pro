<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAboutusesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aboutuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->default('about-us');
            $table->string('image')->nullable();
            $table->string('title_en')->nullable();
            $table->text('description_en')->nullable();
            $table->boolean('active')->default(1);
            $table->nullableTimestamps();
            $table->softDeletes();
        });
        $seeder = new \AboutUsTableSeeder();
        $seeder->run();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aboutuses');
    }
}

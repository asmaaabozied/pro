<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateVouchersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('title_en');
            $table->text('description_en');
            $table->string('code')->unique();
            $table->integer('count')->default(0);
            $table->integer('usage')->default(0);
            $table->float('rate');
            $table->date('start_date');
            $table->date('end_date');
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
        Schema::drop('vouchers');
    }
}

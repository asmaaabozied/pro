<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTermsPolicyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_terms_policy', function (Blueprint $table) {
            $table->id();
            $table->integer('store_id');
            $table->string('title_en');
            $table->text('description_en');
            $table->boolean('active')->default(1);
            $table->boolean('en')->default(1);
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
        Schema::dropIfExists('store_terms_policy');
    }
}

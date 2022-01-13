<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentvouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentvouchers', function (Blueprint $table) {
            $table->id();
            $table->string('comment');
            $table->string('review');
            $table->integer('user_id');
            $table->integer('favcomment_id');

            $table->integer('capon_id');
            $table->integer('like1');
            $table->integer('dislike');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentvouchers');
    }
}

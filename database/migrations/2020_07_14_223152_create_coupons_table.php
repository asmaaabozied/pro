<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatecouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('description_ar');
            $table->text('description_en');
            $table->integer('view')->default(0);
            $table->string('image');
            $table->integer('city_id');
            $table->integer('store_id');
            $table->integer('category_id');
            $table->boolean('active')->default(0);
            $table->boolean('featured')->default(0);
            $table->date('start_at');
            $table->date('valid_to');
            $table->string('code')->unique();
            $table->integer('count')->default(0);
            $table->integer('usage')->default(0);
            $table->float('discount_rate');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('coupon_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id');
            $table->string('image');
            // $table->boolean('active')->default(1);
            // $table->boolean('main')->default(0);
            $table->timestamps();
            $table->foreign('coupon_id')->references('id')
            ->on('coupons')->onDelete('cascade');
        });

        // Schema::create('coupon_details', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('coupon_id');
        //     $table->string('title_ar');
        //     $table->string('title_en');
        //     $table->string('discount');
        //     $table->string('start_at');
        //     $table->string('end_at');
        //     $table->string('old_price');
        //     $table->string('new_price');

        //     $table->foreign('coupon_id')->references('id')
        //     ->on('coupons')->onDelete('cascade');
        // });

        Schema::create('coupon_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            
            $table->foreign('coupon_id')->references('id')
            ->on('coupons')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
        });
        Schema::create('coupon_favs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('coupon_id');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            
            $table->foreign('coupon_id')->references('id')
            ->on('coupons')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
        });

        Schema::create('coupon_ratings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coupon_id');
            $table->float('rate');
            $table->text('review');
            $table->nullableTimestamps();
            $table->softDeletes();
            
            $table->foreign('coupon_id')->references('id')
            ->on('coupons')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
        });
        Schema::create('coupon_ratings_likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('coupon_rating_id');
            $table->boolean('like');
            $table->nullableTimestamps();
            $table->softDeletes();

            $table->foreign('coupon_rating_id')->references('id')
            ->on('coupon_ratings')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
            ->on('users')->onDelete('cascade');
        });
        // Schema::create('coupon_orders', function (Blueprint $table) {
        //     $table->increments('id');
        //     $table->unsignedBigInteger('coupon_id');
        //     $table->unsignedBigInteger('coupon_details_id');
        //     $table->unsignedBigInteger('user_id');
        //     $table->double('price');
        //     $table->nullableTimestamps();
        //     $table->softDeletes();
            
        //     $table->foreign('coupon_id')->references('id')
        //     ->on('coupons')->onDelete('cascade');
            
        //     $table->foreign('coupon_details_id')->references('id')
        //     ->on('coupon_details')->onDelete('cascade');
        //     $table->foreign('user_id')->references('id')
        //     ->on('users')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        // Schema::dropIfExists('coupon_orders');

        Schema::dropIfExists('coupon_ratings_likes');
        Schema::dropIfExists('coupon_ratings');
        Schema::dropIfExists('coupon_favs');
        Schema::dropIfExists('coupon_likes');
        // Schema::dropIfExists('coupon_details');
        Schema::dropIfExists('coupon_images');
        Schema::dropIfExists('coupons');
    }
}

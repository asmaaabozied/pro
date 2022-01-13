<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('account_type');
            $table->string('name');
            $table->string('email');
            $table->string('password');
            $table->string('image');
            $table->string('mobile');
            $table->integer('country_id');
            $table->integer('city_id');
            $table->string('address')->nullable();
            $table->boolean('mobile_verified')->default(0);
            $table->boolean('email_verified')->default(0);
            $table->boolean('activated')->default(0);
            $table->enum('status', trans('user.account_status'))->default('pending');
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('social_media')->default(0);
            $table->string('firebase_token')->nullable();

            $table->string('social_login')->nullable();
            $table->string('facebook_id')->nullable();
            $table->string('google_id')->nullable();

            $table->string('store_account_type')->nullable();

            $table->integer('user_code')->nullable()->unique();
            $table->integer('referral_code')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

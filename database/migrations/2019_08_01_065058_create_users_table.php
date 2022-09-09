<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('firstname');
            $table->string('lastname');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('mobile')->unique();
            $table->decimal('balance', 11, 2)->default(0);
            $table->string('password');
            $table->string('image')->nullable();
            $table->text('address')->nullable()->comment('contains full address');
            $table->tinyInteger('status')->default(1)->comment('0: banned, 1: active');
            $table->tinyInteger('ev')->default(0)->comment('0: email unverified, 1: email verified');
            $table->tinyInteger('sv')->default(0)->comment('0: sms unverified, 1: sms verified');
            $table->string('ver_code')->nullable()->comment('stores verification code');
            $table->dateTime('ver_code_send_at')->nullable()->comment('verification send time');
            $table->tinyInteger('ts')->default(0)->comment('0: 2fa off, 1: 2fa on');
            $table->tinyInteger('tv')->default(1)->comment('0: 2fa unverified, 1: 2fa verified');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

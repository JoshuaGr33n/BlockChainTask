<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGeneralSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sitename')->nullable();
            $table->string('cur_text')->nullable()->comment('currency text');
            $table->string('cur_sym')->nullable()->comment('currency symbol');
            $table->string('efrom')->nullable()->comment('email sent from');
            $table->text('etemp')->nullable()->comment('email template');
            $table->string('smsapi')->nullable()->comment('sms api');
            $table->string('bclr')->nullable()->comment('Base Color');
            $table->string('sclr')->nullable()->comment('Secondary Color');
            $table->tinyInteger('ev')->default(0)->comment('email verification, 0 - dont check, 1 - check');
            $table->tinyInteger('en')->default(0)->comment('email notification, 0 - dont send, 1 - send');
            $table->text('mail_config')->nullable()->comment('email configuration');
            $table->tinyInteger('sv')->default(0)->comment('sms verication, 0 - dont check, 1 - check');
            $table->tinyInteger('sn')->default(0)->comment('sms notification, 0 - dont send, 1 - send');
            $table->tinyInteger('social_login')->default(0)->comment('social login');
            $table->tinyInteger('reg')->default(0)->comment('allow registration');
            $table->tinyInteger('alert')->default(1)->comment('0 => none, 1 => iziToast, 2 => toaster');
            $table->string('active_template')->nullable()->comment('active template folder name');
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
        Schema::dropIfExists('general_settings');
    }
}

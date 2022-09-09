<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdraw_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('image');
            $table->decimal('min_limit', 18, 8);
            $table->decimal('max_limit', 18, 8)->default(0);
            $table->string('delay');
            $table->decimal('fixed_charge', 18, 8);
            $table->decimal('rate', 18, 8);
            $table->decimal('percent_charge', 5, 2);
            $table->string('currency');
            $table->text('description')->nullable();
            $table->text('user_data')->nullable();
            $table->string('verify_image');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('withdraw_methods');
    }
}

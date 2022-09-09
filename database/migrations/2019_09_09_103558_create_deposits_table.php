<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDepositsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('method_code')->unsigned();
            $table->string('method_currency');
            $table->decimal('amount', 18, 8);
            $table->decimal('rate', 18, 8);
            $table->decimal('charge', 18, 8);
            $table->decimal('final_amo', 18, 8);
            $table->string('btc_amo')->nullable();
            $table->string('btc_wallet')->nullable();
            $table->string('trx')->nullable();
            $table->integer('try')->default(0);
            $table->string('verify_image')->nullable();
            $table->text('detail')->nullable();
            $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('deposits');
    }
}

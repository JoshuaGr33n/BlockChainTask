<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithdrawalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('withdrawals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('method_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('trx')->unique();
            $table->decimal('amount', 18, 8);
            $table->decimal('charge', 18, 8);
            $table->string('delay');
            $table->string('currency');
            $table->decimal('rate', 18, 8);
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
        Schema::dropIfExists('withdrawals');
    }
}

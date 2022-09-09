<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewayCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateway_currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('currency');
            $table->string('symbol');
            $table->integer('method_code')->unsigned()->index();
            $table->decimal('min_amount', 18, 8);
            $table->decimal('max_amount', 18, 8);
            $table->decimal('percent_charge', 8, 4)->default(0);
            $table->decimal('fixed_charge', 18, 8)->default(0);
            $table->decimal('rate', 18, 8);
            $table->string('image')->nullable();
            $table->text('parameter')->nullable();
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
        Schema::dropIfExists('payment_method_currencies');
    }
}

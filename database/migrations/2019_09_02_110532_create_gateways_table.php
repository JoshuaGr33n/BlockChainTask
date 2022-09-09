<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gateways', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code')->unsigned()->unique()->index();
            $table->string('name');
            $table->string('alias')->nullable();
            $table->string('image')->nullable();
            $table->boolean('status')->default(1);
            $table->text('parameter_list')->nullable();
            $table->text('supported_currencies')->nullable();
            $table->tinyInteger('crypto')->default(0)->comment('0: fiat currency, 1: crypto currency');
            $table->text('extra')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('payment_methods');
    }
}

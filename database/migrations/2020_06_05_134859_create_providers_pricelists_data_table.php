<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvidersPricelistsDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('providers_pricelists_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('pricelist_id');
            $table->string('country');
            $table->string('description')->default(null)->nullable();
            $table->string('operator')->default(null)->nullable();
            $table->string('type')->default(null)->nullable();
            $table->bigInteger('prefix')->default(null)->nullable();
            $table->decimal('t1', 10, 5);
            $table->decimal('t2', 10, 5);
            $table->decimal('t3', 10, 5);
            $table->integer('period1')->default(null)->nullable();;
            $table->integer('period2')->default(null)->nullable();;
            $table->decimal('init_charge', 4, 2)->default(null)->nullable();;
            $table->integer('price_for_time')->default(null)->nullable();;
            $table->string('currency')->default(null)->nullable();;

            $table->foreign('pricelist_id')->references('id')->on('providers_pricelists')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('providers_pricelists_data');
    }
}

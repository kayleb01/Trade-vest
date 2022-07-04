<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEthAndUsdtToBtcAddress extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wallet_address', function (Blueprint $table) {
            $table->id();
            $table->string('btc_address')->nullable();
            $table->string('eth_address')->nullable();
            $table->string('usdt_address')->nullable();
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
        Schema::table('wallet_address', function (Blueprint $table) {
            $table->dropIfExists('wallet_address');
        });
    }
}

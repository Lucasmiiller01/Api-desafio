<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_addresses', function (Blueprint $table) {
            $table->unsignedBigInteger('delivery_id')->unsigned()->index();
            $table->unsignedBigInteger('address_id')->unsigned()->index();

            $table->foreign('delivery_id')
                ->references('id')->on('deliveries')
                ->onDelete('cascade');

            $table->foreign('address_id')
                ->references('id')->on('addresses')
                ->onDelete('cascade');

            $table->string('type')->default('start');
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
        Schema::dropIfExists('delivery_addresses');

    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('batch_id');
            $table->integer('sleeve_type_id');
            $table->integer('color_id');
            $table->integer('shipment_address_id');
            $table->integer('recipient_id');
            $table->string('xs')->nullable();
            $table->string('s')->nullable();
            $table->string('m')->nullable();
            $table->string('l')->nullable();
            $table->string('xl')->nullable();
            $table->string('xxl')->nullable();
            $table->string('xxxl')->nullable();
            $table->decimal('price_per_item', 65, 2)->nullable();
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
        Schema::dropIfExists('orders');
    }
}

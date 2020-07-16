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
            $table->integer('customer_id')->unsigned();
            $table->string('email',50)->nullable();
            $table->string('phone',50)->nullable();
            $table->string('address')->nullable();
            $table->string('coupon_code',100);
            $table->string('coupon_amount',100);
            $table->string('grand_total',100);
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customer');
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

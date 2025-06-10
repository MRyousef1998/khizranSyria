<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('code')->nullable();
            $table->date('order_date');
            $table->date('order_due_date');
            // $table->unsignedBigInteger('cart_id')->nullable();
            // $table->foreign('cart_id')->references('id')->on('carts');
             $table->unsignedBigInteger('client_id')->nullable();
            $table->foreign('client_id')->references('id')->on('users');
            $table->unsignedBigInteger('exported_id')->nullable();
            $table->foreign('exported_id')->references('id')->on('users');
            $table->unsignedBigInteger('representative_id')->nullable();
            $table->foreign('representative_id')->references('id')->on('users');
            $table->string('Status', 50);
            $table->integer('Value_Status');

            // $table->bigInteger('payment_id')->nullable();
            // $table->foreign('payment_id')->references('id')->on('user');

          

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

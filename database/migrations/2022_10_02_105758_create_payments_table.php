<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->date('pay_date');
            $table->string('product', 50);
            $table->bigInteger( 'orders_id' )->unsigned();
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
            $table->decimal('amount',8,2);
            // $table->decimal('amount_remanning',8,2);
            $table->decimal('discount',8,2)->nullable();
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
        Schema::dropIfExists('payments');
    }
}

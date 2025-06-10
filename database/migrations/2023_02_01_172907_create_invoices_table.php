<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->date('invoice_Date')->nullable();
            $table->date('Due_date')->nullable();
            $table->bigInteger( 'orders_id' )->unsigned();
            $table->foreign('orders_id')->references('id')->on('orders')->onDelete('cascade');
            $table->bigInteger( 'invoice_categories_id' )->unsigned();
            $table->foreign('invoice_categories_id')->references('id')->on('invoice_categories')->onDelete('cascade');
           
            $table->decimal('Amount_collection',8,2)->nullable();;
           
            $table->decimal('Discount',8,2);
            $table->decimal('Value_VAT',8,2);
            $table->string('Rate_VAT', 999);
            $table->decimal('Total',8,2);
            $table->string('Status', 50);
            $table->integer('Value_Status');
            $table->text('note')->nullable();
            $table->date('Payment_Date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
}

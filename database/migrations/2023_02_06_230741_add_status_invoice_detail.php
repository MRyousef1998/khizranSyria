<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusInvoiceDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices_details', function (Blueprint $table) {
            
            
            
            $table->string('Status', 50);
            $table->integer('Value_Status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices_details', function (Blueprint $table) {
            $table->dropColumn('Value_Status');
            $table->dropColumn('Status');
        });
    }
}

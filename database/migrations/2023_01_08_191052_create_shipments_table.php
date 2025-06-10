<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('marina_address');
            $table->string('parking_number');
            $table->string('image_name')->nullable();
            $table->string('mark');
            $table->string('Name_driver_lansh');
            $table->string('number_driver_lansh');
            $table->string('Name_driver');
            $table->string('number_driver');
            $table->decimal('shiping_cost',8,2);
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
        Schema::dropIfExists('shipments');
    }
}

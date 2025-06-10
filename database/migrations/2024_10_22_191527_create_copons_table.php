<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('copons', function (Blueprint $table) {
            $table->id();
            $table->string('copon_name');
            $table->string('copon_code');
            $table->integer('copon_count');
            $table->integer('copon_discount');
            $table->date('copone_expair_date');


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
        Schema::dropIfExists('copons');
    }
}

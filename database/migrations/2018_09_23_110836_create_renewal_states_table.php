<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenewalStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renewal_states', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('renewal_id')->index();
            $table->string('transition');
            $table->string('to');
            $table->timestamps();

            $table->foreign('renewal_id')->on('renewals')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renewal_states');
    }
}

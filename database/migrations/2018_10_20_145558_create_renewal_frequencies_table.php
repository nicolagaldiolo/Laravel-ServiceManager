<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRenewalFrequenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renewal_frequencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('value');
            $table->tinyInteger('type')->unsigned()->default(0);
            $table->unsignedInteger('user_id')->index();
            $table->timestamps();
            $table->unique( ['value','type','user_id'] );
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renewal_frequencies');
    }
}

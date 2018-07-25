<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('domains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url')->unique();
            $table->unsignedInteger('domain')->index()->nullable();
            $table->unsignedInteger('hosting')->index()->nullable();
            $table->dateTime('deadline');
            $table->decimal('amount', 10, 2);
            $table->boolean('payed');
            $table->string('note')->nullable();
            $table->unsignedInteger('user_id')->index();
            $table->timestamps();

            //foreignkey
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            //$table->foreign('domain')->on('providers')->references('id')->onDelete('set null')->onUpdate('cascade');
            //$table->foreign('hosting')->on('providers')->references('id')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('domains');
    }
}

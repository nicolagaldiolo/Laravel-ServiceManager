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
            $table->unsignedInteger('customer_id')->index();
            $table->string('screenshoot')->nullable();
            $table->unsignedInteger('domain_id')->index();
            $table->unsignedInteger('hosting_id')->index();
            $table->date('deadline');
            $table->decimal('amount', 10, 2);
            $table->boolean('payed');
            $table->boolean('status')->default(0);
            $table->string('note')->nullable();
            $table->unsignedInteger('user_id')->index();
            $table->timestamps();

            //foreignkey
            $table->foreign('user_id')->on('users')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('customer_id')->on('customers')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('domain_id')->on('providers')->references('id')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('hosting_id')->on('providers')->references('id')->onDelete('cascade')->onUpdate('cascade');
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

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\FrequencyRenewals;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('url');
            $table->unsignedInteger('customer_id')->index();
            $table->unsignedInteger('provider_id')->index();
            $table->unsignedInteger('service_type_id')->index();
            $table->tinyInteger('frequency')->unsigned();
            $table->string('screenshoot')->nullable();
            $table->boolean('health')->default(0);
            $table->string('note')->nullable();
            $table->timestamps();

            //foreignkey
            $table->foreign('customer_id')->on('customers')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}

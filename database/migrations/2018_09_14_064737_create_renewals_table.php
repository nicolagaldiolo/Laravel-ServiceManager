<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Enums\RenewalSM;
class CreateRenewalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('renewals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('service_id')->index();
            $table->date('deadline');
            $table->decimal('amount', 10, 2);
            $table->tinyInteger('status')->unsigned()->default(RenewalSM::S_to_confirm);
            $table->timestamps();

            $table->foreign('service_id')->on('services')->references('id')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('renewals');
    }
}

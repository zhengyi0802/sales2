<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_processes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id')->unsigned();
            $table->string('serialno', 30)->nullable();
            $table->dateTime('shipping_date')->nullable();
            $table->dateTime('completion_time')->nullable();
            $table->dateTime('chargeback_time')->nullable();
            $table->bigInteger('installer_id')->bigInteger()->nullable();
            $table->string('chargeback_reason')->nullable();
            $table->bigInteger('created_by')->unsigned();
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
        Schema::dropIfExists('shipping_processes');
    }
}

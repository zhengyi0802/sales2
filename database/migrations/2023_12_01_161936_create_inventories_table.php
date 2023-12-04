<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('serial', 6);
            $table->bigInteger('product_id')->unsigned();
            $table->integer('start_amount')->unsigned()->default(0);
            $table->integer('inbound')->unsigned()->default(0);
            $table->integer('outbound')->unsigned()->default(0);
            $table->integer('defective')->unsigned()->default(0);
            $table->integer('stock')->unsigned()->default(0);
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('inventories');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('customer_id')->unsigned();
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('sales_id')->unsigned();
            $table->bigInteger('project_id')->unsigned();
            $table->string('name');
            $table->string('phone', 20);
            $table->string('address');
            $table->integer('price')->unsigned()->default(0);
            $table->integer('installation_fee')->unsigned()->default(0);
            $table->text('memo')->nullable();
            $table->tinyInteger('flow')->unsigned()->default(1);
            $table->boolean('status')->default(true);
            $table->date('order_date')->nullable();
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
        Schema::dropIfExists('orders');
    }
}

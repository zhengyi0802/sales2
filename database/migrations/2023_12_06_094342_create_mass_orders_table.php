<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMassOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mass_orders', function (Blueprint $table) {
            $table->id();
            $table->string('cname', 100);
            $table->string('phone', 20)->unique();
            $table->string('line_id', 50)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('address');
            $table->string('cid', 20)->nullable();
            $table->string('invoice', 20)->nullable();
            $table->json('products');
            $table->bigInteger('price')->unsigned();
            $table->bigInteger('tax')->unsigned();
            $table->bigInteger('total')->unsigned();
            $table->text('memo')->nullable();
            $table->tinyInteger('mark')->unsigned();
            $table->tinyInteger('flow')->unsigned();
            $table->date('order_date');
            $table->date('process_date')->nullable();
            $table->date('outbound_date')->nullable();
            $table->date('arrived_date')->nullable();
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
        Schema::dropIfExists('mass_orders');
    }
}

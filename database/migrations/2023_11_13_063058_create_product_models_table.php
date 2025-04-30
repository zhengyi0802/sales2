<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_models', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('model', 20)->unique();
            $table->bigInteger('catagory_id')->unsigned();
            $table->bigInteger('vendor_id')->unsigned();
            $table->bigInteger('currency_id')->unsigned()->default(1);
            $table->decimal('purchase_cost', total:10, places:2)->default(1.00);
            $table->integer('price')->unsigned()->default(0);
            $table->json('briefs')->nullable();
            $table->json('specifications')->nullable();
            $table->text('descriptions')->nullable();
            $table->bigInteger('accessories')->unsigned()->default(0);
            $table->boolean('extra')->default(false);
            $table->boolean('is_accessories')->default(false);
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
        Schema::dropIfExists('product_models');
    }
}

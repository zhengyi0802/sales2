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
            $table->bigInteger('cataogry_id')->unsigned();
            $table->bigInteger('vendor_id')->unsigned();
            $table->json('bridfs')->nullable();
            $table->json('specifications')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('product_with')->unsigned()->nullable();
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

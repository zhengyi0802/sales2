<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone', 20)->unique();
            $table->string('line_id', 30)->nullable();
            $table->string('email', 30)->nullable();
            $table->string('company', 50)->nullable();
            $table->string('job', 30)->nullable();
            $table->string('address', 255)->nullable();
            $table->boolean('status')->default(true);
            $table->bigInteger('user_id')->unsigned()->nullable();
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
        Schema::dropIfExists('sales');
    }
}

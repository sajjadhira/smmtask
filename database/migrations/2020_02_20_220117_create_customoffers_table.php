<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomoffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customoffers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('offer');
            $table->string('link');
            $table->string('landing');
            $table->decimal('payout', 10 ,2)->default(0);
            $table->integer('user');
            $table->integer('manager')->nullable();
            $table->integer('administrator')->nullable();
            $table->integer('company')->nullable();
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
        Schema::dropIfExists('customoffers');
    }
}

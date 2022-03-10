<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trackings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sid');
            $table->integer('campaign');
            $table->integer('landing');
            $table->integer('offer');
            $table->integer('custom_offer');
            $table->string('browser');
            $table->string('ip');
            $table->decimal('payout', 10 ,2)->default(0);
            $table->decimal('custom_payout', 10 ,2)->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('tracking');
    }
}

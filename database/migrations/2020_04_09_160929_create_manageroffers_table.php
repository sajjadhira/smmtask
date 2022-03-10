<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateManageroffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manageroffers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('offer');
            $table->decimal('payout', 10 ,2)->default(0);
            $table->string('landing');
            $table->string('link');
            $table->integer('manager');
            $table->integer('administrator');
            $table->integer('company');
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
        Schema::dropIfExists('manageroffers');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailersmtpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailersmtps', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('campaign')->nullable();
            $table->string('type');
            $table->string('email');
            $table->string('password');
            $table->string('host');
            $table->integer('port');
            $table->integer('leads')->default(0);
            $table->integer('user')->nullable();
            $table->integer('manager')->nullable();
            $table->integer('administrator')->nullable();
            $table->integer('company')->nullable();
            $table->integer('manual')->nullable();
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
        Schema::dropIfExists('mailersmtps');
    }
}

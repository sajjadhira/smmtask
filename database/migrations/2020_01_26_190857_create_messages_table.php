<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section');
            $table->string('type');
            $table->integer('template');
            $table->longText('message');
            $table->integer('sequence')->default(0);
            $table->integer('delay')->default(0);
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->integer('user');
            $table->integer('manager')->nullable();
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
        Schema::dropIfExists('messages');
    }
}

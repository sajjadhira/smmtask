<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConversationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section');
            $table->integer('campaign');
            $table->string('type');
            $table->string('format');
            $table->string('system');
            $table->string('contact');
            $table->string('context');
            $table->string('media')->nullable();
            $table->string('link')->nullable();
            $table->string('sid');
            $table->integer('status');
            $table->integer('init');
            $table->integer('time');
            $table->integer('release');
            $table->integer('user');
            $table->integer('dc')->default(0);
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
        Schema::dropIfExists('conversation');
    }
}

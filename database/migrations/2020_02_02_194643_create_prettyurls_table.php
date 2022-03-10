<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrettyurlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prettyurls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section');
            $table->string('code');
            $table->string('domain');
            $table->string('destination');
            $table->integer('clicks')->default(0);
            $table->integer('sent')->default(0);
            $table->decimal('ctr', 10 ,2)->default(0);
            $table->integer('hited');
            $table->integer('active');
            $table->integer('status');
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
        Schema::dropIfExists('prettyurl');
    }
}

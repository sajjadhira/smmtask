<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('model_name');
            $table->string('model_age')->nullable();
            $table->string('model_height')->nullable();
            $table->string('model_skin')->nullable();
            $table->string('model_image')->nullable();
            $table->string('landing_page');
            $table->string('offer_form');
            $table->integer('user');
            $table->integer('manager')->nullable();
            $table->integer('administrator')->nullable();
            $table->integer('company')->nullable();
            $table->string('sms_template')->nullable();
            $table->string('chat_template')->nullable();
            $table->string('email_template')->nullable();
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
        Schema::dropIfExists('users');
    }
}

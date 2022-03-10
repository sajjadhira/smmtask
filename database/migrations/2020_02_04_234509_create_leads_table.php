<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section');
            $table->integer('campaign');
            $table->string('name')->nullable();
            $table->string('system')->nullable();
            $table->string('contact');
            $table->string('sid')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('zip')->nullable();
            $table->string('ip')->nullable();
            $table->integer('sms_response_count')->default(0);
            $table->integer('sms_followup_count')->default(0);
            $table->integer('email_response_count')->default(0);
            $table->integer('email_followup_count')->default(0);
            $table->integer('chat_response_count')->default(0);
            $table->integer('chat_followup_count')->default(0);
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
        Schema::dropIfExists('leads');
    }
}

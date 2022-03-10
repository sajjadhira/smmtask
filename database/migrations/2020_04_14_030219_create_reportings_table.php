<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('date');
            $table->integer('campaign')->default(0);
            $table->integer('user')->default(0);
            $table->integer('manager')->default(0);
            $table->integer('administrator')->default(0);
            $table->integer('company')->default(0);
            $table->integer('sms_leads')->default(0);
            $table->integer('chat_leads')->default(0);
            $table->integer('email_leads')->default(0);
            $table->integer('clicks')->default(0);
            $table->integer('sales')->default(0);
            $table->integer('pps_clicks')->default(0);
            $table->integer('ppl_clicks')->default(0);
            $table->integer('pps_sales')->default(0);
            $table->integer('ppl_sales')->default(0);
            $table->decimal('pps_earning', 10 ,2)->default(0);
            $table->decimal('ppl_earning', 10 ,2)->default(0);
            $table->decimal('user_pps_earning', 10 ,2)->default(0);
            $table->decimal('user_ppl_earning', 10 ,2)->default(0);
            $table->decimal('manager_pps_earning', 10 ,2)->default(0);
            $table->decimal('manager_ppl_earning', 10 ,2)->default(0);
            $table->decimal('earning', 10 ,2)->default(0);
            $table->decimal('user_earning', 10 ,2)->default(0);
            $table->decimal('manager_earning', 10 ,2)->default(0);
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
        Schema::dropIfExists('reportings');
    }
}

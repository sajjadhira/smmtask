<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type');
            $table->integer('user');
            $table->integer('administrator')->nullable();
            $table->integer('company')->nullable();
            $table->integer('admin');
            $table->decimal('balance', 10 ,2)->default(0);
            $table->decimal('old_balance', 10 ,2)->default(0);
            $table->decimal('new_balance', 10 ,2)->default(0);
            $table->string('method')->nullable();
            $table->string('note')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('transactions');
    }
}

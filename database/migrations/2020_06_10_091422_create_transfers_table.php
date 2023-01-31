<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sender_id');
            $table->index('sender_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('receiver_id')->nullable();
            $table->index('receiver_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('amount');
            $table->string('sender_date');
            $table->string('receiver_date');
            $table->string('text')->nullable();
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
        Schema::dropIfExists('transfers');
    }
}

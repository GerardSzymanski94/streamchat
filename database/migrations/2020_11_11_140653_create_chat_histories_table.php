<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChatHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat_histories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('chat')->nullable();
            $table->text('messages')->nullable();
            $table->text('color')->nullable();
            $table->text('time')->nullable();
            $table->text('user')->nullable();
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
        Schema::dropIfExists('chat_histories');
    }
}

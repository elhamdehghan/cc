<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTextMessagesTable extends Migration
{

    public function up()
    {
        Schema::create('text_messages', function (Blueprint $table) {
            $table->id();
            $table->string('mobile');
            $table->text('body');
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('text_messages');
    }
}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->unsignedInteger('sender_id');
            $table->unsignedInteger('recipient_id');

            //other fields
            $table->string('message_text');
            $table->enum('message_type', array('sent', 'received'))->default('received');
            $table->enum('message_status', array('draft', 'success', 'failure'))->default('draft');

            //timestamps
            $table->timestamps();

            //foreign keys
            $table->foreign('sender_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('recipient_id')->references('id')->on('contacts')->onDelete('cascade');
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

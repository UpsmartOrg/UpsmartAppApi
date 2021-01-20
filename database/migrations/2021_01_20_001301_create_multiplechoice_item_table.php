<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiplechoiceItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multiplechoice_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('multiplechoice_question_id');
            $table->string('title');
            $table->timestamps();

            //Foreign keys
            $table->foreign('multiplechoice_question_id')
                ->references('id')
                ->on('multiplechoice_question')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('multiplechoice_item');
    }
}

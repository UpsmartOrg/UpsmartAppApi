<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('conducted_survey_id');
            $table->unsignedBigInteger('open_question_id')->nullable();
            $table->string('open_question_answer')->nullable();
            $table->unsignedBigInteger('dropdown_item_id')->nullable();
            $table->unsignedBigInteger('multiplechoice_item_id')->nullable();
            $table->timestamps();

            //Foreign keys
            $table->foreign('conducted_survey_id')
                ->references('id')
                ->on('conducted_survey')
                ->onDelete('restrict');

            $table->foreign('open_question_id')
                ->references('id')
                ->on('open_question')
                ->onDelete('restrict');

            $table->foreign('dropdown_item_id')
                ->references('id')
                ->on('dropdown_item')
                ->onDelete('restrict');

            $table->foreign('multiplechoice_item_id')
                ->references('id')
                ->on('multiplechoice_item')
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
        Schema::dropIfExists('answer');
    }
}

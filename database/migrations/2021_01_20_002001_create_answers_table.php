<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('survey_id');
            $table->unsignedBigInteger('open_question_id')->nullable();
            $table->string('open_question_answer')->nullable();
            $table->unsignedBigInteger('multiplechoice_item_id')->nullable();
            $table->timestamps();

            //Foreign keys
            $table->foreign('survey_id')
                ->references('id')
                ->on('surveys')
                ->onDelete('restrict');

            $table->foreign('open_question_id')
                ->references('id')
                ->on('open_questions')
                ->onDelete('restrict');

            $table->foreign('multiplechoice_item_id')
                ->references('id')
                ->on('multiplechoice_items')
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
        Schema::dropIfExists('answers');
    }
}

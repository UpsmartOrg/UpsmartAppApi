<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDropdownItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dropdown_item', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dropdown_question_id');
            $table->string('title');
            $table->timestamps();

            //Foreign keys
            $table->foreign('dropdown_question_id')
                ->references('id')
                ->on('dropdown_question')
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
        Schema::dropIfExists('dropdown_item');
    }
}

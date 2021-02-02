<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBinInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bin_info', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->unique();
            $table->string('address')->nullable();
            $table->string('bin_id')->unique();
            $table->unsignedBigInteger('zone_id')->nullable();
            $table->timestamps();

//            Foreign keys
//            $table->foreign('bin_id')
//                ->references('ID')
//                ->on('upsmartBins.DataSensoren');
            $table->foreign('zone_id')
                ->references('id')
                ->on('zones')
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
        Schema::dropIfExists('bin_info');
    }
}

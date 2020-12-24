<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoadmapTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roadmap_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('roadmap_id')->default(0);
            $table->unsignedBigInteger('serverapp_id')->default(0);
            //$table->unsignedBigInteger('roadmap_person_id')->default(0);
            $table->unsignedBigInteger('roadmap_task')->default(1);
            $table->string('roadmap_update')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
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
        Schema::dropIfExists('roadmap_types');
    }
}

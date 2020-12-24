<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoadmapPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roadmap_persons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('roadmap_id')->default(0);
            $table->unsignedBigInteger('serverapp_id')->default(0);
            $table->unsignedBigInteger('roadmap_type')->default(0);
            $table->unsignedBigInteger('person_id')->default(0);
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
        Schema::dropIfExists('roadmap_persons');
    }
}

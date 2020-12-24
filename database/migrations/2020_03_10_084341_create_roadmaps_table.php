<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoadmapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roadmaps', function (Blueprint $table) {
            $table->bigIncrements('roadmap_id');
            $table->unsignedBigInteger('server_app_id')->default(0);
            $table->unsignedBigInteger('estimate_id')->default(0);
            $table->integer('status')->default(1);
            $table->date('milestone_date')->nullable();
            $table->date('roadmap_release_date')->nullable();
            $table->string('roadmap_update')->nullable();
            $table->string('roadmap_release')->nullable();
            $table->string('wishes')->nullable();
            $table->string('trello_board')->nullable();
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
        Schema::dropIfExists('roadmaps');
    }
}

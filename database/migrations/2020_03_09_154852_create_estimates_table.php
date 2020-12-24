<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEstimatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->bigIncrements('estimate_id');
            $table->unsignedBigInteger('server_app_id')->default(0);
            $table->unsignedBigInteger('roadmap_id')->default(0);
            $table->integer('status')->default(1);
            $table->integer('hour_estimate')->default(0);
            $table->string('hour_update')->nullable();
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
        Schema::dropIfExists('estimates');
    }
}

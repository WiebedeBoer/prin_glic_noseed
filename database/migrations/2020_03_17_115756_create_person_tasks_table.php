<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('roadmap_person_id')->default(0);
            $table->unsignedBigInteger('roadmap_id')->default(0);
            $table->string('task')->nullable();
            $table->date('start_date')->nullable();
            $table->bigInteger('start_time')->nullable();
            $table->date('end_date')->nullable();
            $table->bigInteger('end_time')->nullable();
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
        Schema::dropIfExists('person_tasks');
    }
}

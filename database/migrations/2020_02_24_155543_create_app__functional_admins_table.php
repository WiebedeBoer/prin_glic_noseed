<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppFunctionalAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_functionaladmin', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('app_functionaladmin_id'); 
            $table->unsignedBigInteger('app_id');
            $table->integer('hours')->default(0);  
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
        Schema::dropIfExists('app_functionaladmin');
    }
}

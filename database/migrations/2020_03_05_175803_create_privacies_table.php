<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrivaciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privacy', function (Blueprint $table) {
            $table->bigIncrements('privacy_id');
            $table->text('goals')->nullable();
            $table->text('involved')->nullable();
            $table->text('person_data')->nullable();
            $table->text('terms')->nullable();
            $table->text('recipients')->nullable();
            $table->text('extern')->nullable();
            $table->text('safety_measures')->nullable();
            $table->text('clients')->nullable();
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
        Schema::dropIfExists('privacy');
    }
}

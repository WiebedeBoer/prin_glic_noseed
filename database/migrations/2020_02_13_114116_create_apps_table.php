<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->bigIncrements('app_id');
            $table->string('app_name');  
            $table->unsignedBigInteger('app_status');          
            $table->string('app_url')->nullable();
            $table->text('app_remarks')->nullable();
            $table->unsignedBigInteger('language_dependency')->default(1);
            $table->string('language_version')->default("1.0");
            $table->unsignedBigInteger('framework_dependency')->default(1);
            $table->string('framework_version')->default("1.0");
            $table->unsignedBigInteger('database_dependency')->default(1);
            $table->string('privacy_status')->default("persoonsgegevens");
            $table->string('dvo_link')->nullable();
            $table->text('dvo')->nullable();
            $table->string('sla_link')->nullable();
            $table->text('sla')->nullable();
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
        Schema::dropIfExists('apps');
    }
}

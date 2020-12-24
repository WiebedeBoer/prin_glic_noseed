<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps_servers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('server_id');
            $table->unsignedBigInteger('app_id');
            $table->unsignedBigInteger('language_dependency')->default(1);
            $table->string('language_version')->default("1.0");
            $table->unsignedBigInteger('framework_dependency')->default(1);
            $table->string('framework_version')->default("1.0");
            $table->unsignedBigInteger('database_dependency')->default(1);
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
        Schema::dropIfExists('apps_servers');
    }
}

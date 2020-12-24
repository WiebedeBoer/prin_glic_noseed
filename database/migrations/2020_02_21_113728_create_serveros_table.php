<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServerosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server_os', function (Blueprint $table) {
            $table->bigIncrements('server_os_id');
            $table->string('server_os_name');
            $table->string('code_name');
            $table->date('release');
            $table->date('end_of_support');
            $table->date('notification')->default('1971-01-01');
            $table->text('server_os_description')->nullable();
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
        Schema::dropIfExists('server_os');
    }
}

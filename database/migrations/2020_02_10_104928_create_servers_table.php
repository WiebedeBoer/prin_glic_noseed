<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->bigIncrements('server_id');
            $table->string('server_name');
            $table->unsignedBigInteger('server_type')->default(4); //default 4 = onbekend
            $table->unsignedBigInteger('server_otap')->default(5); //default 5 = onbekend
            $table->unsignedBigInteger('server_status')->default(3); //default 3 = unknown
            $table->unsignedBigInteger('server_service')->default(4); //default 4 = onbekend
            $table->unsignedBigInteger('server_operating_system')->default(19); //default 20 = onbekend
            $table->integer('server_costs')->default(0); //default = 0
            $table->integer('memory_costs')->default(0); //default = 0
            $table->integer('sla_costs')->default(0); //default = 0
            $table->date('server_acquisition')->default('1970-01-01');
            $table->date('server_termination')->default('2019-03-01');
            $table->date('server_certificate_expiration')->default('2019-03-01');
            $table->string('server_machine')->default('Virtueel ESX');
            $table->text('server_remarks')->nullable();
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
        Schema::dropIfExists('servers');
    }
}

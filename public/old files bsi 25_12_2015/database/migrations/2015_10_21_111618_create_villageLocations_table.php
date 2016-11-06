<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillageLocationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('villageLocations', function(Blueprint $table) {
            $table->increments('id');
            $table->string('state_id');
            $table->string('district_id');
            $table->string('tahsil_id');
            $table->string('village_id');
            $table->string('name');
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
        Schema::drop('villageLocations');
    }
}

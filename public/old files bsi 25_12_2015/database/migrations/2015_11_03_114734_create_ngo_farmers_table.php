<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgoFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngo_farmers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('ngo_id');
            $table->string('project_id');
            $table->string('project_name');
            $table->string('farmer_id');
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
        Schema::drop('ngo_farmers');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFarmersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('mandal');
            $table->string('village');
            $table->string('group_name');
            $table->string('name');
            $table->string('father_husband');
            $table->string('gender');
            $table->string('caste');
            $table->integer('contact_number');
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
        Schema::drop('farmers');
    }
}

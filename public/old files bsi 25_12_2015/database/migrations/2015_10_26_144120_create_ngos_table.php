<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNgosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngos', function(Blueprint $table) {
            $table->increments('id');
            $table->string('state');
            $table->string('district');
            $table->string('mandal');
            $table->string('panchayat');
            $table->string('village');
            $table->string('name');
            $table->string('HON');
            $table->string('gender_HON');
            $table->string('contact_number');
            $table->string('email');
            $table->string('field_incharge');
            $table->string('gender_field_incharge');
            $table->string('contact_number_incharge');
            $table->string('email_incharge');
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
        Schema::drop('ngos');
    }
}

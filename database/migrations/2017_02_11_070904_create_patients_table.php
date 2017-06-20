<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('midname')->nullable()->index();
            $table->string('surname')->index();
            $table->date('dob');
            $table->boolean('isapproxage')->default(false);
            $table->string('approxage')->nullable();
            $table->date('approxdob');
            $table->string('gender',6);
            $table->string('phoneprimary',15)->index();
            $table->string('phonealternate',15)->index();
            $table->string('email');
            $table->text('address');
            $table->string('patientstate');
            $table->string('patientcity');
            $table->string('patientpin');
            $table->text('allergies');
            $table->string('bloodgroup',10);
            $table->string('idproof');
            $table->smallInteger('patientcode')->unsigned()->unique();
            $table->integer('created_by')->unsigned();
            $table->foreign('created_by')->references('id')->on('users');
            //$table->date('dob');
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
        Schema::dropIfExists('patients');
    }
}

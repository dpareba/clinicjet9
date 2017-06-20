<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClinicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clinics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->text('address');
            $table->string('state',50);
            $table->string('city');
            $table->string('pin',6);
            $table->boolean('isRemoteClinic')->default(false);//Check if Kenyan Clinic
            $table->string('clinictype');
            $table->integer('clinicadmin_id')->unsigned();
            $table->foreign('clinicadmin_id')->references('id')->on('users');
            $table->string('phoneprimary',10)->unique();
            $table->string('phoneprimarylandarea',5);
            $table->string('phoneprimarylandtel',8);
            $table->string('phonealternate',10);
            $table->string('email');
            $table->string('website');
            $table->smallInteger('cliniccode')->unsigned();
            $table->tinyInteger('margin_top')->default(1)->unsigned();
            $table->tinyInteger('margin_bottom')->default(1)->unsigned();
            $table->tinyInteger('margin_right')->default(1)->unsigned();
            $table->tinyInteger('margin_left')->default(1)->unsigned();
            $table->tinyInteger('margin_header')->default(0)->unsigned();
            $table->tinyInteger('margin_footer')->default(0)->unsigned();
            $table->tinyInteger('font_size')->default(12)->unsigned();
            $table->string('pageformat')->default('A4');
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
        Schema::dropIfExists('clinics');
    }
}

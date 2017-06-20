<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('verified')->default(false);
            $table->string('token')->nullable();
            $table->string('avatar')->default('default.jpg');
            $table->string('phone');
            $table->string('doctype');
            $table->boolean('isActivated')->default(false);
            $table->boolean('isClinicAdmin')->default(false);
            $table->boolean('isSuperAdmin')->default(false);
            $table->boolean('isRemoteDoc')->default(false);
            //$table->boolean('isIndiaDoc')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}

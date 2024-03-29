<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('roles', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name');
        $table->timestamps();
    });
    Schema::create('users_roles', function (Blueprint $table) {
        $table->bigInteger('user_id')->unsigned();
        $table->foreign('user_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade');
        $table->bigInteger('role_id')->unsigned();
        $table->foreign('role_id')
            ->references('id')
            ->on('roles')
            ->onDelete('cascade');
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
    Schema::dropIfExists('roles');
    Schema::dropIfExists('users_roles');
}
}

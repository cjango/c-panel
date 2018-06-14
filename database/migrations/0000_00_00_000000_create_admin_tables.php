<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 32);
            $table->string('password', 128);
            $table->string('nickname', 32)->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('admin_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->string('title', 50);
            $table->string('icon', 20)->nullable();
            $table->integer('sort')->unsigned();
            $table->string('uri')->nullable();
            $table->timestamps();
        });

        Schema::create('admin_operation_logs', function (Blueprint $table) {
            $table->bigInteger('id', true)->unsigned();
            $table->integer('admin_id')->unsigned()->index('user_logs_user_id_index');
            $table->string('path', 191);
            $table->string('method', 10);
            $table->string('ip', 15);
            $table->text('input', 65535)->nullable();
            $table->dateTime('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

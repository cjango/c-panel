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
            $table->string('password');
            $table->string('nickname', 32)->nullable();
            $table->string('remember_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('admin_logins', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->unsigned();
            $table->string('login_ip', 15)->nullable();
            $table->timestamp('created_at')->nullable();
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
            $table->integer('admin_id')->unsigned()->index();
            $table->string('path');
            $table->string('method', 10);
            $table->string('ip', 15);
            $table->text('input')->nullable();
            $table->timestamp('created_at')->nullable();
        });

        /**
         * 以下是权限表
         */
        Schema::create('admin_model_has_permissions', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->string('model_type', 191);
            $table->bigInteger('model_id')->unsigned();
            $table->primary(['permission_id', 'model_id', 'model_type'], 'main_key');
            $table->index(['model_type', 'model_id']);
        });

        Schema::create('admin_model_has_roles', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->string('model_type', 191);
            $table->bigInteger('model_id')->unsigned();
            $table->primary(['role_id', 'model_id', 'model_type'], 'main_key');
            $table->index(['model_type', 'model_id']);
        });

        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('guard_name', 191);
            $table->timestamps();
        });

        Schema::create('admin_roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 191);
            $table->string('guard_name', 191);
            $table->timestamps();
        });

        Schema::create('admin_role_has_permissions', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned()->index();
            $table->primary(['permission_id', 'role_id'], 'main_key');
        });

        Schema::table('admin_model_has_permissions', function (Blueprint $table) {
            $table->foreign('permission_id')->references('id')->on('admin_permissions')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });

        Schema::table('admin_model_has_roles', function (Blueprint $table) {
            $table->foreign('role_id')->references('id')->on('admin_roles')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });

        Schema::table('admin_role_has_permissions', function (Blueprint $table) {
            $table->foreign('permission_id')->references('id')->on('admin_permissions')->onUpdate('RESTRICT')->onDelete('CASCADE');
            $table->foreign('role_id')->references('id')->on('admin_roles')->onUpdate('RESTRICT')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::drop('admins');
        Schema::drop('admin_logins');
        Schema::drop('admin_menus');
        Schema::drop('admin_operation_logs');
        Schema::drop('admin_model_has_permissions');
        Schema::drop('admin_model_has_roles');
        Schema::drop('admin_permissions');
        Schema::drop('admin_roles');
        Schema::drop('admin_role_has_permissions');
    }
}

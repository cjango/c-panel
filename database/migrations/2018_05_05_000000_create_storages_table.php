<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateStoragesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hash', 40)->index('hash');
            $table->string('path', 191);
            $table->integer('size')->unsigned();
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
        Schema::drop('storages');
    }

}

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->uuid('task_uuid');
            $table->integer('status_id')->unsigned();
            $table->BigInteger('user_id')->unsigned();
            $table->string('task');
            $table->timestamps();
        });
        
        Schema::table('tasks', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('status')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}

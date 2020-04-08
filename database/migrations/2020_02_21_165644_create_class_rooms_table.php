<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_rooms', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('teacher_id')
                ->unsigned()
                ->nullable(); //column ini untuk menentukan siapa wali kelas
            $table->string('kdkelas')
                ->nullable();
            $table->string('namakelas')
                ->nullable();
            $table->integer('grade')
                ->nullable();
            $table->boolean('isActive');
            $table->timestamps();
            $table->foreign('teacher_id')->references('id')->on('teachers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_rooms');
    }
}

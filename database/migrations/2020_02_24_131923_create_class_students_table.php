<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('student_id')
                ->unsigned()
                ->nullable();
            $table->bigInteger('class_room_id')
                ->unsigned()
                ->nullable();
            $table->timestamps();
            $table->foreign('student_id')
                ->references('id')
                ->on('students');
            $table->foreign('class_room_id')
                ->references('id')
                ->on('class_rooms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_students');
    }
}

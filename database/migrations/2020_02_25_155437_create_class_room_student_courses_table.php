<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassRoomStudentCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_room_student_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_student_id')
                ->unsigned()
                ->nullable();
            $table->bigInteger('class_course_id')
                ->unsigned()
                ->nullable();
            $table->integer('semester')
                ->nullable();
            $table->integer('kkmpengetahuan')
                ->nullable();
            $table->integer('kkmketerampilan')
                ->nullable();
            $table->integer('nilaitugas')
                ->nullable();
            $table->integer('ulanganharian')
                ->nullable();
            $table->integer('uts')
                ->nullable();
            $table->integer('uas')
                ->nullable();
            $table->timestamps();
            $table->foreign('class_student_id')
                ->references('id')
                ->on('class_students')
                ->onDelete('cascade');
            $table->foreign('class_course_id')
                ->references('id')
                ->on('class_courses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_room_student_courses');
    }
}

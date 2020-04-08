<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //ini bertujuan untuk menampung data antara kelas dan matapelajaran
        //sehingga setiap siswa/i yang terdapat di kelas ini dapat mengakses mata pelajaran ini
        //dan akan bertujuan jika guru mencari data kelas dimana ia akan mengajar
        Schema::create('class_courses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_room_id')
                ->unsigned()
                ->nullable();
            $table->bigInteger('course_id')
                ->unsigned()
                ->nulable();
            $table->timestamps();
            $table->foreign('class_room_id')->references('id')->on('class_rooms');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_courses');
    }
}

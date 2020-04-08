<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListOfAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('list_of_attendees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_student_id')
                ->unsigned()
                ->nullable();
            $table->integer('semester');
            $table->integer('hadir')
                ->nullable();
            $table->integer('sakit')
                ->nullable();
            $table->integer('alpha')
                ->nullable();
            $table->integer('ijin')
                ->nullable();
            $table->string('Keterangan')
                ->nullable();
            $table->timestamps();
            $table->foreign('class_student_id')
                ->references('id')
                ->on('class_students')
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
        Schema::dropIfExists('list_of_attendees');
    }
}

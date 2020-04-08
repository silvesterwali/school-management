<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassExtracurricularsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_extracurriculars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('class_student_id')
                ->unsigned()
                ->nullable();
            $table->string('kegiatanextrakurikuler')
                ->nullable();
            $table->string('keterangan')
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
        Schema::dropIfExists('class_extracurriculars');
    }
}

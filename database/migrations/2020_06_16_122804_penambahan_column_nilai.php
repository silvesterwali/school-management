<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PenambahanColumnNilai extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('class_room_student_courses', function (Blueprint $table) {
            $table
                ->double('nilaitugas_dua')
                ->nullable()
                ->after('nilaitugas');
            $table
                ->double('nilaitugas_tiga')
                ->nullable()
                ->after('nilaitugas_dua');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('class_room_student_courses', function (Blueprint $table) {
            //
        });
    }
}

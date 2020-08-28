<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNilaiKerampianKeatifanSiswa extends Migration
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
                ->double('keaktifan')
                ->nullable()
                ->after('uts');
            $table
                ->double('kerapian')
                ->nullable()
                ->after('keaktifan');
            //
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUlanganSatuDanDuaTable extends Migration
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
                ->double('ulanganharian_dua')
                ->nullable()
                ->after('ulanganharian');

            $table
                ->double('ulanganharian_tiga')
                ->nullable()
                ->after('ulanganharian_dua');
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

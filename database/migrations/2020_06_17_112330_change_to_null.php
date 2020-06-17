<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeToNull extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('nip')
                ->nullable()
                ->change();
            $table->string('nama')
                ->nullable()
                ->change();
            $table->string('alamat')
                ->nullable()
                ->change();
            $table->string('jenjangpendidikan')
                ->nullable()
                ->change();
            $table->string('notelp')
                ->nullable()
                ->change();
            $table->date('tanggalgabung')
                ->nullable()
                ->change();
            $table->integer('status')
                ->nullable()
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teachers', function (Blueprint $table) {
            //
        });
    }
}

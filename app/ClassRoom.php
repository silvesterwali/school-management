<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassRoom extends Model
{
    protected $table    = "class_rooms";
    protected $fillable = [
        "teacher_id", "kdkelas",
        "namakelas", "grade", "school_year", "isActive",
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher');
    }
    //memberikan informasi kelas ini akan mempunya matapelasjaran apa saja
    public function ClassCourse()
    {
        return $this->hasMany('App\ClassCourse');
    }
    //kelas akan mengetahui  kelas ini digunakan oleh siswa siapa
    public function class_student()
    {
        return $this->hasOne('App\ClassStudent');
    }

    //kelas akan menunjukan tahun ajaran yang berlangsung
    public function school_year()
    {
        return $this->belongsTo('App\SchoolYear');
    }

    //untuk menampilkan data hubungan antara kelas siswa dan mapel
    public function class_room_Student_course()
    {
        return $this->hasMany('App\ClassRoomStudentCourse');
    }

}

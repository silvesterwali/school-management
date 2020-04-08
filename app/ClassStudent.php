<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassStudent extends Model
{
    protected $table    = "class_students";
    protected $fillable = [
        'student_id', 'class_room_id',
    ];
    //ini bertujunan untuk mengetahui siswa yang mengabil kelas ini
    public function student()
    {
        return $this->belongsTo('App\Student');
    }
    //untuk mengetahui kelas yang akan di akses oleh siswa
    public function class_room()
    {
        return $this->belongsTo('App\ClassRoom');
    }
    //untuk menampilkan data hubungan antara kelas siswa dan mapel
    public function class_room_Student_course()
    {
        return $this->hasMany('App\ClassRoomStudentCourse');
    }
    //untuk mengambil daftar hadir  siswa dalam setiap semester
    public function list_of_attendees()
    {
        return $this->hasMany('App\ListOfAttendees');
    }

    //untuk mengetahui data extracuri culer kelas;
    public function class_extracurricular()
    {
        return $this->hasOne('App\ClassExtracurricular');
    }
}

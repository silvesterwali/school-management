<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table    = "students";
    protected $fillable = ["user_id", "nisn", "nama",
        "jk", "tempatlahir", "tanggallahir", "agama", "namaayah",
        "namaibu", "namawali", "alamatorangtuawali", "tanggalmasuk", "grade", "creator"];
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    //siswa dapat mengakses dimana ia akan kelas akan belajar
    public function class_student()
    {
        return $this->hasOne('App\ClassStudent');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $table    = "courses";
    protected $fillable =
        [
        'teacher_id', 'kdapel', 'mapel',
        'kkmpengetahuan', 'kkmketerampilan', 'grade',
    ];

    public function teacher()
    {
        return $this->belongsTo('App\Teacher', 'teacher_id', 'id');
    }
    //ini akan memberikan data relasi mata pelajaran akan di akses dikelas mana saja
    public function class_course()
    {
        return $this->hasMany('App\ClassCourse');
    }
}

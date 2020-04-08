<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassCourse extends Model
{
    protected $table    = "class_courses";
    protected $fillable = [
        "class_room_id", "course_id",
    ];

    //ini akan mengetahui class mana dia berada
    public function class_room()
    {
        return $this->belongsTo('App\ClassRoom');
    }

    //ini mengetahui matapelajaran apa yang berrelasi
    public function course()
    {
        return $this->belongsTo('App\Course');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    protected $table    = "school_years";
    protected $fillable = [
        'kdtahunajaran',
        'tahunajaran',
    ];
    //akan menunjukan tahun ajaran akan berlangsung pada kelas mana saja
    public function class_room()
    {
        return $this->hasMany("App\ClassRoom");
    }
}

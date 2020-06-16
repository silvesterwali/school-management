<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListOfAttendees extends Model
{
    protected $table    = "list_of_attendees";
    protected $fillable = [
        "class_student_id", "semester",
        "hadir", "sakit", "alpha", "ijin", "keterangan",
    ];
    //untuk mengetahui absensi ini digunakan oleh siapa di kelas mana
    public function class_student()
    {
        return $this->belongsTo("App\ClassStudent")
            ->withDefault(['class_student']);
    }
}

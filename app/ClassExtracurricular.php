<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassExtracurricular extends Model
{
    protected $table    = "class_extracurriculars";
    protected $fillable = [
        "class_student_id",
        "kegiatanextrakurikuler",
        "keterangan",
    ];
    //untuk memanggil  dimana kelas extra kurikuler ini berlangsung
    public function class_student()
    {
        return $this->belongsTo('App\ClassStudent');
    }
}

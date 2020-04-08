<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{

    protected $table    = "teachers";
    protected $fillable = [
        "user_id", "nip", "nama", "alamat", "jenjangpendidikan",
        "notelp", "tanggalgabung", "status",
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function course()
    {
        return $this->hasMany('App\Course');
    }

    public function classroom()
    {
        return $this->hasMany('App\ClassRoom');
    }
}

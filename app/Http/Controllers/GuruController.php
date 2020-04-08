<?php

namespace App\Http\Controllers;

use App\ClassCourse;
use App\ClassRoom;
use App\ClassRoomStudentCourse;
use App\Course;
use App\Teacher;
use Auth;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $id           = Auth::user()->id;
        $idGuru       = Teacher::where('user_id', $id)->value('id');
        $kelas        = [];
        $classRoomTem = ClassRoom::where("isActive", 1)->get();
        for ($i = 0; $i < count($classRoomTem); $i++) {
            $kelas[$i]['id']         = $classRoomTem[$i]['id'];
            $kelas[$i]['nama']       = $classRoomTem[$i]['namakelas'];
            $kelas[$i]['isWali']     = $idGuru == $classRoomTem[$i]['teacher_id'] ? true : false;
            $kelas[$i]['wali']       = $classRoomTem[$i]->teacher->nama;
            $kelas[$i]['waliId']     = $classRoomTem[$i]->teacher->id;
            $kelas[$i]['isPengajar'] = $this->getIdListOfTeacher($classRoomTem[$i]['id'], $idGuru);
        }
        // dd($kelas);

        return view('dashboard.kelas.guru.index', compact('kelas'));
    }

    public function getIdListOfTeacher($idClass, $idGuru)
    {
        $idTeacher = Course::whereHas('class_course',
            function ($a) use ($idClass) {
                $a->where('class_room_id', $idClass);
            })->get('teacher_id')->toArray();
        // dd($idTeacher);

        $newAr = [];
        for ($i = 0; $i < count($idTeacher); $i++) {
            array_push($newAr, $idTeacher[$i]['teacher_id']);
        }
        if (!in_array($idGuru, $newAr)) {
            return false;
        }
        return true;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoom $kelas)
    {
        $kls       = $kelas;
        $idTeacher = Auth::user()->teacher->id;
        $mapel     = ClassCourse::whereHas('course', function ($query) use ($idTeacher) {
            $query->where('teacher_id', $idTeacher);
        })->where('class_room_id', $kelas->id)->get();
        return view('dashboard.kelas.guru.show', compact('kls', 'mapel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoom $kelas, ClassCourse $mapel, $semester)
    {
        $kls         = $kelas;
        $kelas_mapel = ClassRoomStudentCourse::where('class_course_id', $mapel->id)
            ->where('semester', $semester)->get();
        return view('dashboard.kelas.guru.mapel_edit', compact('kls', 'kelas_mapel', 'mapel', 'semester'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassRoom $kelas, ClassCourse $mapel, $semester)
    {
        $id              = $request->id;
        $kkmpengetahuan  = $request->kkmpengetahuan;
        $kkmketerampilan = $request->kkmketerampilan;
        $nilaitugas      = $request->nilaitugas;
        $ulanganharian   = $request->ulanganharian;
        $uts             = $request->uts;
        $uas             = $request->uas;
        $keterangan      = $request->kererangan;
        for ($i = 0; $i < count($id); $i++) {
            ClassRoomStudentCourse::where('id', $id[$i])
                ->update([
                    "kkmpengetahuan"  => $kkmpengetahuan[$i],
                    "kkmketerampilan" => $kkmketerampilan[$i],
                    "nilaitugas"      => $nilaitugas[$i],
                    "ulanganharian"   => $ulanganharian[$i],
                    "uts"             => $uts[$i],
                    "uas"             => $uas[$i],
                    "keterangan"      => $keterangan,
                ]);
        }
        return redirect()->
            route('guru_kelas_siswa.show', $kelas->id)
            ->with('status', " berhasil mengubah nilai matapelajaran");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

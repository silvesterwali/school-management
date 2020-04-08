<?php

namespace App\Http\Controllers;

use App\ClassExtracurricular;
use App\ClassRoom;
use App\ClassRoomStudentCourse;
use App\ClassStudent;
use App\ListOfAttendees;
use Auth;
use DataTables;
use Illuminate\Http\Request;

class KelasSiswaMapelController extends Controller
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
    public function index(Request $request, $kelas)
    {

        if ($request->ajax()) {
            $b    = $kelas;
            $data = ClassRoomStudentCourse::with(['class_student' => function ($query) use ($kelas) {
                $query->where('class_room_id', $kelas);
            }])->get();
            return DataTables::of($data)
                ->addColumn('nisn', function ($data) {
                    return $data->class_student->student->nisn;
                })
                ->addColumn('nama', function ($data) {
                    return $data->class_student->student->nama;
                })
                ->addColumn('nip', function ($data) {
                    return $data->class_course->course->teacher->nip;
                })
                ->addColumn('guru', function ($data) {
                    return $data->class_course->course->teacher->nama;
                })
                ->addColumn('mapel', function ($data) {
                    return $data->class_course->course->mapel;
                })
                ->editColumn('kkmpengetahuan', function ($data) {
                    $myId         = Auth::user()->id;
                    $waliKelas    = $data->class_course->class_room->teacher->user_id;
                    $guruPengajar = $data->class_course->course->teacher->user_id;
                    $isAdmin      = $this->check_admin();
                    if ($isAdmin xor $myId == $guruPengajar || $myId == $waliKelas) {
                        return $data->kkmpengetahuan;
                    }
                    return '<div class="alert alert-danger small p-1">Hidding Infomation</div>';
                })
                ->editColumn('kkmketerampilan', function ($data) {
                    $myId         = Auth::user()->id;
                    $waliKelas    = $data->class_course->class_room->teacher->user_id;
                    $guruPengajar = $data->class_course->course->teacher->user_id;
                    $isAdmin      = $this->check_admin();
                    if ($isAdmin xor $myId == $guruPengajar || $myId == $waliKelas) {
                        return $data->kkmketerampilan;
                    }
                    return '<div class="alert alert-danger small p-1">Hidding Infomation</div>';
                })
                ->editColumn('nilaitugas', function ($data) {
                    $myId         = Auth::user()->id;
                    $waliKelas    = $data->class_course->class_room->teacher->user_id;
                    $guruPengajar = $data->class_course->course->teacher->user_id;
                    $isAdmin      = $this->check_admin();
                    if ($isAdmin xor $myId == $guruPengajar || $myId == $waliKelas) {
                        return $data->nilaitugas;
                    }
                    return '<div class="alert alert-danger small p-1">Hidding Infomation</div>';
                })

                ->editColumn('ulanganharian', function ($data) {
                    $myId         = Auth::user()->id;
                    $waliKelas    = $data->class_course->class_room->teacher->user_id;
                    $guruPengajar = $data->class_course->course->teacher->user_id;
                    $isAdmin      = $this->check_admin();
                    if ($isAdmin xor $myId == $guruPengajar || $myId == $waliKelas) {
                        return $data->ulanganharian;
                    }
                    return '<div class="alert alert-danger small p-1">Hidding Infomation</div>';
                })
                ->editColumn('uts', function ($data) {
                    $myId         = Auth::user()->id;
                    $waliKelas    = $data->class_course->class_room->teacher->user_id;
                    $guruPengajar = $data->class_course->course->teacher->user_id;
                    $isAdmin      = $this->check_admin();
                    if ($isAdmin xor $myId == $guruPengajar || $myId == $waliKelas) {
                        return $data->uts;
                    }
                    return '<div class="alert alert-danger small p-1">Hidding Infomation</div>';
                })
                ->editColumn('uas', function ($data) {
                    $myId         = Auth::user()->id;
                    $waliKelas    = $data->class_course->class_room->teacher->user_id;
                    $guruPengajar = $data->class_course->course->teacher->user_id;
                    $isAdmin      = $this->check_admin();
                    if ($isAdmin xor $myId == $guruPengajar || $myId == $waliKelas) {
                        return $data->uas;
                    }
                    return '<div class="alert alert-danger small p-1">Hidding Infomation</div>';
                })
                ->editColumn('keterangan', function ($data) {
                    $myId         = Auth::user()->id;
                    $waliKelas    = $data->class_course->class_room->teacher->user_id;
                    $guruPengajar = $data->class_course->course->teacher->user_id;
                    $isAdmin      = $this->check_admin();
                    if ($isAdmin xor $myId == $guruPengajar || $myId == $waliKelas) {
                        return $data->keterangan;
                    }
                    return '<div class="alert alert-danger small p-1">Hidding Infomation</div>';
                })
                ->rawColumns(['kkmpengetahuan', 'kkmketerampilan', 'nilaitugas', 'ulanganharian', 'uts', 'uas', 'keterangan'])
                ->make(true);
        }

    }

    private function check_admin()
    {
        $roles = explode(',', Auth::user()->menuroles);
        if (!in_array('admin', $roles)) {
            return false;
        }
        return true;

    }

    public function attendees(Request $request, $attendees)
    {
        if ($request->ajax()) {
            $data = ListOfAttendees::with(["class_student" => function ($query) use ($attendees) {
                $query->where("class_room_id", $attendees);
            }])->get();
            return DataTables::of($data)
                ->addColumn('nisn', function ($data) {
                    return $data->class_student->student->nisn;
                })
                ->addColumn('nama', function ($data) {
                    return $data->class_student->student->nama;
                })

                ->make(true);

        }
    }

    public function attendeesEdit(ClassRoom $kelas, $semester)
    {
        $kls     = $kelas;
        $idKelas = $kelas->id;
        $data    = ListOfAttendees::with(["class_student" => function ($query) use ($idKelas) {
            $query->where("class_room_id", $idKelas);
        }])->where('semester', $semester)->get();
        return view('dashboard.kelas.guru.absensi', compact('kls', 'data', 'semester'));
    }

    public function attendeesUpdate(Request $request, ClassRoom $kelas, $semester)
    {

        $id    = $request->id;
        $hadir = $request->hadir;
        $sakit = $request->sakit;
        $alpha = $request->alpha;
        $izin  = $request->izin;
        $ket   = $request->keterangan;
        for ($i = 0; $i < count($id); $i++) {
            ListOfAttendees::where('id', $id[$i])->update([
                "hadir"      => $hadir[$i],
                "sakit"      => $sakit[$i],
                "ijin"       => $izin[$i],
                "alpha"      => $alpha[$i],
                "keterangan" => $ket[$i],
            ]);
        }

        return
        redirect()->
            route('KelasAbsentSiswa.attendeesEdit', ['kelas' => $kelas->id, 'semester' => $semester])
            ->with('status', "berhasil mengubah absensi kelas");

    }

    public function extrakurikuler(Request $request, $extrakurikuler)
    {
        if ($request->ajax()) {
            $data = ClassExtracurricular::with(["class_student" =>
                function ($query) use ($extrakurikuler) {
                    $query->where("class_room_id", $extrakurikuler);
                }])->get();
            return DataTables::of($data)
                ->addColumn('nisn',
                    function ($data) {
                        return $data->class_student->student->nisn;
                    })
                ->addColumn('nama',
                    function ($data) {
                        return $data->class_student->student->nama;
                    })
                ->addColumn('action', function ($data) {
                    $isAdmin = $this->check_admin();

                    $btn = "<a href='" . route('extrakurikuler.edit',
                        ['kelas' => $data->class_student->class_room->id, 'extrakurikuler' => $data->id]) . "'
                    class='btn btn-outline-info btn-sm small'><i class='fa fa-pencil-alt '></i>Edit</a>";
                    $del = "
                        <form method='post' action='" . route('extrakurikuler.delete', $data->id) . "'>
                        " . csrf_field() . "
                        <input type='hidden' name='_method' value='delete'>
                        <button class='btn btn-outline-danger btn-sm  small' type='submit'> <i class='fa fa-trash-alt '></i> Hapus</button>
                        </form>
                    ";
                    if (!$isAdmin) {
                        return "<div class='btn-group float-right'>" . $del . $btn . "</div>";
                    }
                    return $del;
                })
                ->rawColumns(['action'])
                ->make(true);

        }
    }
    public function extrakurikulerEdit(ClassRoom $kelas, ClassExtracurricular $extrakurikuler)
    {
        $kls   = $kelas;
        $extra = ClassExtracurricular::findOrFail($extrakurikuler->id);
        return view('dashboard.kelas.guru.extrakurikulerEdit', compact('kls', 'extra'));
    }
    public function extrakurikulerDestroy(ClassExtracurricular $extrakurikuler)
    {
        ClassExtracurricular::destroy($extrakurikuler->id);
        return redirect()->back()->with('status', 'status berhasil menghapus extrakurikuler terpilih');
    }
    public function extrakurikulerCreate(ClassRoom $extrakurikuler)
    {
        $kls   = $extrakurikuler;
        $siswa = ClassStudent::where('class_room_id', $kls->id)->get();
        return view('dashboard.kelas.guru.extrakurikulerCreate', compact('kls', 'siswa'));
    }

    public function extrakurikulerStore(ClassRoom $extrakurikuler, Request $request)
    {
        $request->validate([
            "namakegiatan" => 'required',
            "keterangan"   => 'required',
            "siswa"        => "required|min:1",
            "siswa.*"      => "required|min:1",
        ]);
        $sk = $request->siswa;
        $js = count($request->siswa);
        for ($i = 0; $i < $js; $i++) {
            $klsExtra                         = new ClassExtracurricular;
            $klsExtra->class_student_id       = $sk[$i];
            $klsExtra->kegiatanextrakurikuler = $request->namakegiatan;
            $klsExtra->keterangan             = $request->keterangan;
            $klsExtra->save();
        }
        return redirect()
            ->route('guru_kelas_siswa.show', $extrakurikuler->id)
            ->with('status', "berhasil menambah extrakurikuler pada kelas ini");
    }
    public function extrakurikulerUpdate(ClassRoom $kelas, ClassExtracurricular $extra, Request $request)
    {
        $request->validate([
            "namakegiatan" => 'required',
            "keterangan"   => 'required',
        ]);
        $k                         = ClassExtracurricular::find($extra->id);
        $k->kegiatanextrakurikuler = $request->namakegiatan;
        $k->keterangan             = $request->keterangan;
        $k->save();
        return redirect()
            ->route('guru_kelas_siswa.show', $kelas->id)
            ->with('status', "berhasil mengubah extrakurikuler pada kelas ini");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
?>

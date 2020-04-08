<?php

namespace App\Http\Controllers;

use App\ClassCourse;
use App\ClassRoom;
use App\ClassRoomStudentCourse;
use App\ClassStudent;
use App\Course;
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasMapelController extends Controller
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
            $data = ClassCourse::where("class_room_id", $kelas)->get();
            return DataTables::of($data)
                ->addColumn('kdmapel', function ($data) {
                    return $data->course->kdmapel;
                })
                ->addColumn('mapel', function ($data) {
                    $roles = explode(',', Auth::user()->menuroles);
                    if (in_array('admin', $roles)) {
                        return
                        '<a class="btn btn-link btn-sm "
                            href="' . route('mapel.edit',
                            $data->course->id) . '">' .
                        $data->course->mapel . '</a>';
                    }

                    return $data->course->mapel;

                })
                ->addColumn('pengajar', function ($data) {
                    return $data->course->teacher->nama;
                })
                ->addColumn('kkmpengetahuan', function ($data) {
                    return $data->course->kkmpengetahuan;
                })
                ->addColumn('kkmketerampilan', function ($data) {
                    return $data->course->kkmketerampilan;
                })
                ->addColumn('kelompokmapel', function ($data) {
                    return $data->course->kelompokmapel;
                })
                ->addColumn('grade', function ($data) {
                    return $data->course->grade;
                })
                ->addColumn('action', function ($data) {
                    $roles = explode(',', Auth::user()->menuroles);
                    if (in_array('admin', $roles)) {
                        $btn2 = route('KelasMapel.destroy', $data->id);
                        $form = '<form action="' . $btn2 . '" method="post"> ' . csrf_field() . '
                        <input type="hidden" name="_method" value="delete">
                        <button class="btn btn-outline-danger small btn-sm" type="submit"> <i class="fa fa-trash-alt "></i> Hapus</button>
                    </form>';
                        return $form;
                    }
                    return '<i class="fa fa-check text-success"></i>';

                })
            // ->setRowClass(function ($data) {
            //     return $data->course->teacher->user_id == Auth::user()->id ? 'bg-success' : 'bg-danger';
            // })
                ->rawColumns(['action', 'mapel'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ClassRoom $kelas)
    {
        //untuk mengambil matapelajaran terpilih di dalam kelas
        $oldExistsCourse = ClassCourse::where("class_room_id", $kelas->id)->get();
        $newExistsCouser = [];
        foreach ($oldExistsCourse as $a) {
            array_push($newExistsCouser, $a->course_id);
        }

        //untuk mengambil mata pelajaran seluruh
        $matapelajaran = Course::all();
        return view('dashboard.kelas.admin.matapelajaran.index',
            compact('kelas', 'matapelajaran', 'newExistsCouser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(["mapel" => "required"]);
        $jumlah_matapelajaran = count($request->mapel);
        $idKelas              = $request->idkelas;
        $idcourse             = $request->mapel;
        for ($i = 0; $i < $jumlah_matapelajaran; $i++) {
            $kelasMapel = ClassCourse::firstOrNew(
                ["class_room_id" => $idKelas, "course_id" => $idcourse[$i]],
            );
            $kelasMapel->save();
            $this->autoInsert($kelasMapel->id);
        }

        return
        redirect()->
            route('kelas.show', $idKelas)
            ->with('status', "berhasil menambah matapelajaran pada kelas ini");
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
    public function destroy(ClassCourse $kelasmapel)
    {
        DB::table('class_courses')->where('id', $kelasmapel->id)->delete();
        return
        redirect()->
            route('kelas.show', $kelasmapel->class_room_id)
            ->with('status', "berhasil menghapus matapelajaran pada kelas ini");

    }
    public function autoInsert($cr)
    {

        $info = ClassCourse::find($cr);
        ##  langkah 1 ambil class_student yang baru tersimplan ##
        $newKelasSiswa = ClassStudent::where("class_room_id", $info->class_room_id)->get();
        foreach ($newKelasSiswa as $siswa) {
            $kelasSiswaSM1 = ClassRoomStudentCourse::firstOrNew(
                ["class_student_id" => $siswa->id, "class_course_id" => $info->id, "semester" => 1],

            );
            $kelasSiswaSM1->save();
            $kelasSiswaSM2 = ClassRoomStudentCourse::firstOrNew(
                ["class_student_id" => $siswa->id, "class_course_id" => $info->id, "semester" => 2],

            );
            $kelasSiswaSM2->save();
        }
        return true;

    }
}

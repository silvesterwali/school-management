<?php

namespace App\Http\Controllers;

use App\ClassCourse;
use App\ClassExtracurricular;
use App\ClassRoom;
use App\ClassRoomStudentCourse;
use App\ClassStudent;
use App\ListOfAttendees;
use App\Student;
use Auth;
use DataTables;
use Illuminate\Http\Request;

class KelasSiswaController extends Controller
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
    public function index(Request $request, ClassRoom $KelasSiswa)
    {
        if ($request->ajax()) {
            $data = ClassStudent::where('class_room_id', $KelasSiswa->id);
            return DataTables::of($data)
                ->addColumn('nisn', function ($data) {

                    return $data->student->nisn;
                })
                ->addColumn('nama', function ($data) {
                    $roles = explode(',', Auth::user()->menuroles);
                    if (in_array('admin', $roles)) {
                        return "<a class='btn btn-link btn-sm' href='" . route("siswa.edit", $data->student->id) . "'>"
                        . $data->student->nama . '</a>';
                    }
                    return $data->student->nama;

                })

                ->addColumn('jeniskelamin', function ($data) {
                    return $data->student->jk == 0 ? 'P' : 'L';
                })
                ->addColumn('tempatlahir', function ($data) {
                    return $data->student->tempatlahir;
                })
                ->addColumn('tanggallahir', function ($data) {
                    return $data->student->tanggallahir;
                })
                ->addColumn('agama', function ($data) {
                    return $data->student->agama;
                })
                ->addColumn('namaayah', function ($data) {
                    return $data->student->namaayah;
                })
                ->addColumn('namaibu', function ($data) {
                    return $data->student->namaibu;
                })
                ->addColumn('namawali', function ($data) {
                    return $data->student->namawali;
                })
                ->addColumn('alamatorangtuawali', function ($data) {
                    return $data->student->alamatorangtuawali;
                })
                ->addColumn('tanggalmasuk', function ($data) {
                    return $data->student->tanggalmasuk;
                })
                ->addColumn('grade', function ($data) {
                    return $data->student->grade;
                })

                ->addColumn('action', function ($data) {
                    $roles = explode(',', Auth::user()->menuroles);
                    if (in_array('admin', $roles)) {
                        $btn2 = route('KelasSiswa.destroy', $data->id);
                        $form = '<form action="' . $btn2 . '" method="post"> ' . csrf_field() . '
                         <input type="hidden" name="_method" value="delete">
                         <button class="btn btn-outline-danger btn-sm small" type="submit"> <i class="fa fa-trash-alt">
                         </i>Hapus</button>
                     </form>';

                        return $form;
                    }
                    return '<i class="fa fa-check text-success"></i>';

                })
            // ->setRowClass(function ($data) {
            //     return $data->id % 2 == 0 ? 'alert-success' : 'alert-warning';
            // })
                ->rawColumns(['action', 'nama'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(ClassRoom $KelasSiswa)
    {
        $grade = $KelasSiswa->grade;
        // memilih siswa/siswi yang telah terdapat dalam kelas
        // dengan grade yang sama dengan kelas yang akan ditambahkan siswa
        $ks = ClassStudent::whereHas('class_room', function ($query) use ($grade) {
            $query->where('grade', $grade);
        })
            ->select('student_id')
            ->get()
            ->toArray();
        $siswa = Student::where('grade', $KelasSiswa->grade)
            ->whereNotIn('id', $ks)
            ->get();

        $kelas           = $KelasSiswa;
        $exists_students = ClassStudent::where('class_room_id', $KelasSiswa->id)->get();
        $esis            = [];
        foreach ($exists_students as $st) {
            array_push($esis, $st->student_id);
        }
        return view('dashboard.kelas.admin.siswa.index', compact('kelas', 'siswa', 'esis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(["siswa" => "required"]);
        $jumlah_siswa = count($request->siswa);
        $idKelas      = $request->idkelas;
        $idStudents   = $request->siswa;
        for ($i = 0; $i < $jumlah_siswa; $i++) {
            $kelasSiswa = ClassStudent::firstOrNew(
                ["student_id" => $idStudents[$i], "class_room_id" => $idKelas],
            );
            $kelasSiswa->save();
            //untuk memasukan  data mata pelajaran siswa

            $this->autoInsertMapel($kelasSiswa->id);
            //untuk memasukan data absesi

            $this->autoInsertExtracuriculum($kelasSiswa->id);
            //untuk memasukan data extracuriculer siswa

        }
        return
        redirect()->
            route('kelas.show', $idKelas)
            ->with('status', "berhasil menambah Siswa Ke kelas pada kelas ini");
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
    public function destroy(ClassStudent $KelasSiswa)
    {
        $kls = ClassStudent::find($KelasSiswa->id);
        $kls->delete();
        return
        redirect()->
            route('kelas.show', $KelasSiswa->class_room_id)
            ->with('status', "berhasil menghapus data siswa dari kelas");
    }
    /**
     * fungsi ini bertugas untuk memasukan atau auto inject siswa yang
     * terdaftar dalam kelas untuk mendapat mata pelajaran jika ada.
     * jika terdapat mata pelajaran makan akan di masukan
     * jika tidak ada mapel maka pekerjaan ini selesai
     */
    public function autoInsertMapel($cr)
    {
        $info = ClassStudent::find($cr);
        ##  langkah 1 ambil class_student yang baru tersimplan ##
        $newKelasSiswa = ClassCourse::where("class_room_id", $info->class_room_id)->get();
        foreach ($newKelasSiswa as $mapel) {
            $kelasSiswaSM1 = ClassRoomStudentCourse::firstOrNew(
                ["class_student_id" => $info->id, "class_course_id" => $mapel->id, "semester" => 1],
            );
            $kelasSiswaSM1->save();
            $kelasSiswaSM2 = ClassRoomStudentCourse::firstOrNew(
                ["class_student_id" => $info->id, "class_course_id" => $mapel->id, "semester" => 2],
            );
            $kelasSiswaSM2->save();
        }
        $this->autoInsertAbsensi($cr);
        return true;

    }

    //untuk auto insert absensi siswa
    public function autoInsertAbsensi($classId)
    {

        $a = ListOfAttendees::firstOrNew(["class_student_id" => $classId, "semester" => 1]);
        $a->save();
        $b = ListOfAttendees::firstOrNew(["class_student_id" => $classId, "semester" => 2]);
        $b->save();
        return true;

    }
    //untuk auto insert data extracuricular siswa/siswa
    public function autoInsertExtracuriculum($classId)
    {
        $extra = ClassExtracurricular::firstOrNew(["class_student_id" => $classId]);
        $extra->save();
        return true;
    }
}

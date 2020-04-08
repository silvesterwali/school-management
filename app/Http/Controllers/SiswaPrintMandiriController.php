<?php

namespace App\Http\Controllers;

use App\ClassExtracurricular;
use App\ClassRoom;
use App\ClassRoomStudentCourse;
use App\ClassStudent;
use App\ListOfAttendees;
use App\Student;
use Auth;
use Illuminate\Http\Request;
use PDF;

class SiswaPrintMandiriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $id    = Auth::user()->id;
        $siswa = Student::where('user_id', $id)->get('id');
        $kelas = ClassRoom::with(['class_student' => function ($query) use ($siswa) {
            $query->where('student_id', $siswa);
        }])->get();
        return view('dashboard.siswa.print.index', compact('kelas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kelas'    => 'required',
            'semester' => 'required',
        ]);
        $idKelas  = $request->kelas;
        $semester = $request->semester;

        $siswa_id = Auth::user()->student->id;
        $kelas    = ClassRoom::where('id', $idKelas)->first();
        $cs       = ClassStudent::where('class_room_id', $idKelas)->first();
        $nilai    = ClassRoomStudentCourse::where('class_student_id', $cs->id)
            ->where('semester', $semester)
            ->orderBy('class_course_id', 'asc')
            ->get();
        // $mapel = ClassCourse::where('class_room_id', $kelas->id)->get();
        $absen = ListOfAttendees::where('class_student_id', $cs->id)
            ->where('semester', $semester)
            ->get();
        $extra = ClassExtracurricular::where('class_student_id', $cs->id)
            ->whereNotNull('kegiatanextrakurikuler')
            ->whereNotNull('keterangan')
            ->get();

        $obNilai   = '';
        $namasiswa = Auth::user()->student->nama;
        $nis       = Auth::user()->student->nisn;
        $alamat    = "
            <div>
                <p>Sekolah : Sekolah Menengah Pertama Santo Yoseph Denpasar <br>
                Kelas: {$kelas->kdkelas}/{$kelas->namakelas}<br>
                Wali Kelas : {$kelas->teacher->nama} <br>
                NIP :{$kelas->teacher->nip}
                Nama :{$namasiswa}<br>
                NISN :{$nis}
                </p>
            </div>
        ";
        //perulangan nilai dan mata pelajaran
        foreach ($nilai as $key => $n) {
            $nomor = $key + 1;
            $obNilai .= "<tr>
                        <td class='nilai'>
                            {$nomor}
                        </td>
                        <td class='nilai'>
                            {$n->class_course->course->mapel}
                        </td>
                        <td class='nilai'>
                            {$n->kkmpengetahuan}
                        </td>
                        <td class='nilai'>
                            {$n->kkmketerampilan}
                        </td>
                        <td class='nilai'>
                            {$n->nitalitugas}
                        </td>
                        <td class='nilai'>
                            {$n->ulanganharian}
                        </td>
                        <td class='nilai'>
                            {$n->uts}
                        </td>
                        <td class='nilai'>
                            {$n->uas}
                        </td>
                        <td class='catatan'>
                            {$n->keterangan}
                        </td>
                    </tr>";
        }

        return $this->adminReport($alamat, $obNilai, $semester);

    }
    public function adminReport($alamat, $nilai, $semester)
    {
        $html = '<!DOCTYPE html>
            <html>
                <head>
                    <title>Laporan Semester tahunan</title>
                    <style>
                   h3 ,h6 {
                        margin-top:10px;
                        margin-bottom:5px;
                    }
                        table#ala mat{
                            widht:720px
                            mangin-top:5px;
                        }
                        #alamat td{
                            width:80px;
                            border:0px;
                        }
                        #alamat tr{
                            border:0px;
                        }
                        table#main{
                            border-collapse:collapse;
                            widht:100%
                            mangin-top:5px;
                        }
                        thead {
                            background-color:gray;
                            color:white;

                        }
                        th{
                            height:15px;
                            text-align:center;
                            padding:5px;
                            font-size:10px;
                        }
                        td {
                            font-size:10px;

                        }
                        .nilai {
                            text-align:center;
                            padding:3px;
                            vertical-align:top;

                        }
                        table ,th ,td {
                            border:0.5px solid #ddd;

                        }
                        .catatan {
                            font-size:9px;
                        }
                    </style>
                </head>
                <body>
                    <div style="margin-left:50px;margin-right:50px">
                        <h3>Laporan Semester ' . $semester . '</h3>
                        ' . $alamat . '
                        <hr>
                        <h6>Table nilai</h6>
                        <table id="main">
                        <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    Nama Matapelajaran
                                </th>
                                <th>
                                    Kkm Pengetahuan
                                </th>
                                <th>
                                    Kkm Ketermpilan
                                </th>
                                <th>
                                    Nilai Tugas
                                </th>
                                <th>
                                    Ulangan Harian
                                </th>
                                <th>
                                    UTS
                                </th>
                                <th>
                                    UAS
                                </th>
                                <th>
                                    Catatan
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            ' . $nilai . '
                        </tbody>
                    </table>
                    </div>

                </body>
            </html>
        ';
        $pdf = PDF::loadHTML($html)
            ->setPaper('A4', 'p')
            ->setWarnings(false)
            ->save('Laporan.pdf');
        return $pdf->stream();

    }
}

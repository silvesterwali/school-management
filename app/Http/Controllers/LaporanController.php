<?php

namespace App\Http\Controllers;

use App\ClassCourse;
use App\ClassRoom;
use App\ClassRoomStudentCourse;
use App\ClassStudent;
use Illuminate\Http\Request;
use PDF;

class LaporanController extends Controller
{
    public function index(ClassRoom $KelasSiswa)
    {
        $grade = $KelasSiswa->grade;
        $idk   = $KelasSiswa->id;
        // memilih siswa/siswi yang telah terdapat dalam kelas
        // dengan grade yang sama dengan kelas yang akan ditambahkan siswa
        $siswa = ClassStudent::where('class_room_id', $idk)
            ->orderBy('student_id', 'asc')
            ->get();
        $course = ClassCourse::where('class_room_id', $idk)->get();
        $kelas  = $KelasSiswa;
        return view('dashboard.kelas.laporan.admin', compact('kelas', 'siswa', 'course'));
    }

    public function adminReport(Request $request)
    {

        $request->validate(
            [
                "semester"      => "required",
                "class_mapel"   => "required",
                "class_student" => "required",
            ]
        );

        $idkelas      = $request->idkelas;
        $kelas        = ClassRoom::find($idkelas)->first();
        $namakelas    = $kelas->namakelas;
        $kodeKelas    = $kelas->kdkelas;
        $tahunajaran  = $kelas->school_year->tahunajaran;
        $grade        = $kelas->grade;
        $walikelas    = $kelas->teacher->nama;
        $nipwalikelas = $kelas->teacher->nip;
        $cetakan      = "Denpasar " . date('d-m-y') . "SMP St.Yoseph ";

        $tsekolah = "<div>
            <p>Sekolah : Sekolah Menengah Pertama Santo Yoseph Denpasar <br>
                Kelas : {$kodeKelas}/{$namakelas} <br>
                Wali kelas : {$walikelas} <br>
                NIP : {$nipwalikelas} <br>
                Grade : {$grade}
            </p>

        </div>";

        $siswa       = $request->class_student;
        $mapel       = $request->class_mapel;
        $semester    = $request->semester;
        $jumlahsiswa = count($request->class_student);
        $jumlahMapel = count($request->class_mapel);

        $tbody = '';

        for ($i = 0; $i < $jumlahsiswa; $i++) {
            $nomor_seri = $i + 1;
            for ($a = 0; $a < $jumlahMapel; $a++) {
                $nomor_mapel     = $a + 1;
                $ksc             = $this->getNilaiSiswaBerdasarakanMapel($siswa[$i], $mapel[$a], $semester);
                $namaSiswa       = $ksc->class_student->student->nama;
                $nisnSiswa       = $ksc->class_student->student->nisn;
                $matapelajaran   = $ksc->class_course->course->mapel;
                $kodemapel       = $ksc->class_course->course->kdmapel;
                $kkmpengetahuan  = $ksc->kkmpengetahuan;
                $kkmketerampilan = $ksc->kkmketerampilan;
                $nilaitugas      = $ksc->nilaitugas;
                $ulanganharian   = $ksc->ulanganharian;
                $uts             = $ksc->uts;
                $uas             = $ksc->uas;
                $keterangan      = $ksc->keterangan;
                if ($a == 0) {
                    $tbody .= "<tr>
                            <td class='nilai'>{$nomor_seri}</td>
                            <td>{$nisnSiswa}</td>
                            <td>{$namaSiswa}</td>
                            <td class='nilai'>{$nomor_mapel}</td>
                            <td class='nilai'>{$kodemapel}</td>
                            <td class='nilai'>{$matapelajaran}</td>
                            <td class='nilai'>{$kkmpengetahuan}</td>
                            <td class='nilai'>{$kkmketerampilan}</td>
                            <td class='nilai'>{$nilaitugas}</td>
                            <td class='nilai'>{$ulanganharian}</td>
                            <td class='nilai'>{$uts}</td>
                            <td class='nilai'>{$uas}</td>
                            <td class='catatan'>{$keterangan}</td>
                    </tr>";
                } else {
                    $tbody .= "<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class='nilai'>{$nomor_mapel}</td>
                            <td class='nilai'>{$kodemapel}</td>
                            <td class='nilai'>{$matapelajaran}</td>
                            <td class='nilai'>{$kkmpengetahuan}</td>
                            <td class='nilai'>{$kkmketerampilan}</td>
                            <td class='nilai'>{$nilaitugas}</td>
                            <td class='nilai'>{$ulanganharian}</td>
                            <td class='nilai'>{$uts}</td>
                            <td class='nilai'>{$uas}</td>
                            <td class='catatan'>{$keterangan}</td>
                    </tr>";
                }

            }
        }

        $html = '<!DOCTYPE html>
            <html>
                <head>
                    <title>Laporan Semester tahunan</title>
                    <style>
                    h3 ,h6 {
                        margin-top:10px;
                        margin-bottom:5px;
                    }
                        table#alamat{
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
                    <div style="margin-left:20px;margin-right:30px">
                        <h3>Laporan Semester ' . $semester . '</h3>
                        ' . $tsekolah . '
                        <hr>
                        <table id="main">
                        <thead>
                            <tr>
                                <th>
                                    No
                                </th>
                                <th>
                                    NISN
                                </th>
                                <th>
                                    Nama Siswa
                                </th>
                                <th>
                                    NM
                                </th>
                                <th>
                                    KD MPL
                                </th>
                                <th>
                                    Mata Pelajaran
                                </th>
                                <th>
                                    KKM Pengetahuan
                                </th>
                                <th>
                                    KKM Keterampilan
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
                            ' . $tbody . '
                        </tbody>
                    </table>
                    <hr>
                    Mengetahui wali Kelas
                    <br>
                    <br>
                    <br>
                    <br>
                    <u>' . $walikelas . '</u><br>
                    Nip : ' . $nipwalikelas . '
                    <br>
                    <p class="catatan">Cetakan : ' . $cetakan . '</p>
                    </div>

                </body>
            </html>
        ';
        $pdf = PDF::loadHTML($html)
            ->setPaper('A4', 'landscape')
            ->setWarnings(false)
            ->save('Laporan.pdf');
        return $pdf->stream();

    }

    public function getNilaiSiswaBerdasarakanMapel($idKelasSiswa, $idkelasCourse, $semester)
    {
        // ClassRoomStudentCourse::with(['class_student' => function ($query) use ($kelas) {
        //     $query->where('class_room_id', $kelas);
        // }])->get();
        $nilai = ClassRoomStudentCourse::where('class_student_id', $idKelasSiswa)
            ->where('class_course_id', $idkelasCourse)
            ->where('semester', $semester)
            ->first();
        return $nilai;
    }
}

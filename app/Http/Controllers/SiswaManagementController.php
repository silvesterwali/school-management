<?php

namespace App\Http\Controllers;

use App\Student;
use App\User; //untuk mengakses data user
use Auth;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SiswaManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Student::latest()->get();
            return DataTables::of($data)
                ->addColumn('jeniskelamin', function ($data) {
                    return $data->jk == 0 ? 'P' : 'L';
                })
                ->addColumn('username', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('email', function ($data) {
                    return $data->user->email;
                })
                ->addColumn('action', function ($data) {
                    $btn1    = route('siswa.edit', $data->id);
                    $btnedit = '<a class="dropdown-item" href="' . $btn1 . '"> <i class="fa fa-pencil-alt text-info"></i> Edit</a>';
                    $btn2    = route('siswa.destroy', $data->id);
                    $form    = '<form action="' . $btn2 . '" method="post"> ' . csrf_field() . '
                        <input type="hidden" name="_method" value="delete">
                        <button class="dropdown-item" type="submit"> <i class="fa fa-trash-alt text-danger"></i> Hapus</button>
                    </form>';
                    $button = '<div class="dropright">
                        <a class="btn btn-sm btn-simple  rounded-circle border-white " href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <div class="dropdown-menu  ">
                            ' . $btnedit . $form . '
                        </div>
                        </div>';

                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('dashboard.siswa.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.siswa.admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn'          => 'required|unique:students,nisn',
            'nama'          => 'required|string',
            'jk'            => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'agama'         => 'required',
            'nama_ayah'     => 'required',
            'nama_ibu'      => 'required',
            'wali'          => 'required',
            'alamat'        => 'required',
            'username'      => 'required',
            'tanggal_masuk' => 'required',
            'grade'         => 'required',
            'kode_akses'    => 'required|min:6|unique:users,email',
            'password'      => 'required|min:6|confirmed',
        ]);
        $user            = new User;
        $user->name      = $request->username;
        $user->email     = $request->kode_akses;
        $user->menuroles = "siswa"; //secara di fault di isi siswa
        $user->password  = Hash::make($request->password);
        $user->save();
        $user->assignRole("siswa");

        $siswa                     = new Student;
        $siswa->user_id            = $user->id;
        $siswa->nisn               = $request->nisn;
        $siswa->nama               = $request->nama;
        $siswa->jk                 = $request->jk;
        $siswa->tempatlahir        = $request->tempat_lahir;
        $siswa->agama              = $request->agama;
        $siswa->tanggallahir       = $request->tanggal_lahir;
        $siswa->namaayah           = $request->nama_ayah;
        $siswa->namaibu            = $request->nama_ibu;
        $siswa->namawali           = $request->wali;
        $siswa->alamatorangtuawali = $request->alamat;
        $siswa->tanggalmasuk       = $request->tanggal_masuk;
        $siswa->grade              = $request->grade;
        $siswa->creator            = Auth::user()->name; //untuk mengatahui siapa ayng menulis
        $siswa->save();
        return redirect()->route('siswa.index')->with('status', 'Berhasil menambah siswa');

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
    public function edit(Student $siswa)
    {
        return view('dashboard.siswa.admin.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $siswa)
    {
        $request->validate([
            'nisn'          => 'required|unique:students,nisn,' . $siswa->id,
            'nama'          => 'required|string',
            'jk'            => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'agama'         => 'required',
            'nama_ayah'     => 'required',
            'nama_ibu'      => 'required',
            'wali'          => 'required',
            'alamat'        => 'required',
            // 'username'=>'required',
            'tanggal_masuk' => 'required',
            'grade'         => 'required',
            // 'kode_akses'=>'required|min:6|unique:users,email',
            // 'password'=>'required|min:6|confirmed',
        ]);
        $siswa                     = Student::find($siswa->id);
        $siswa->nisn               = $request->nisn;
        $siswa->nama               = $request->nama;
        $siswa->jk                 = $request->jk;
        $siswa->tempatlahir        = $request->tempat_lahir;
        $siswa->agama              = $request->agama;
        $siswa->tanggallahir       = $request->tanggal_lahir;
        $siswa->namaayah           = $request->nama_ayah;
        $siswa->namaibu            = $request->nama_ibu;
        $siswa->namawali           = $request->wali;
        $siswa->alamatorangtuawali = $request->alamat;
        $siswa->tanggalmasuk       = $request->tanggal_masuk;
        $siswa->grade              = $request->grade;
        $siswa->creator            = Auth::user()->name; //untuk mengatahui siapa ayng menulis
        $siswa->save();
        return redirect()->route('siswa.index')->with('status', 'Berhasil mengubah Data  siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $siswa)
    {
        //untuk menghapus  role user bersangkutan;

        //untuk menghapus table admn yang berkaitan
        DB::table('students')->where('id', $siswa->id)->delete();

        //menghapus dari table user
        DB::table('users')->where('id', $siswa->user_id)->delete();

        return redirect()->route('siswa.index')->with('status', 'Berhasil menghapus  siswa');
    }
}

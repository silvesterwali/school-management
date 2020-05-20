<?php

namespace App\Http\Controllers;

use App\Teacher;
use App\User; //untuk mengakses data user
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class GuruManagementController extends Controller
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
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = Teacher::latest()->get();
            return DataTables::of($data)
            // ->addColumn('sts', function ($data) {
            //     $a = '';
            //     switch ($data->status) {
            //         case '0':
            //             $a = "Non Aktif";

            //             break;
            //         case '1':
            //             $a = "Aktif";
            //             break;
            //         case '2':
            //             $a = "Pensiun";
            //             break;

            //         default:
            //             # code...
            //             break;
            //     }
            //     return $a;
            // })
                ->addColumn('akses', function ($data) {
                    return $data->user->menuroles;
                })
                ->addColumn('username', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('email', function ($data) {
                    return $data->user->email;
                })
                ->addColumn('action', function ($data) {
                    $btn1    = route('guru.edit', $data->id);
                    $btnedit = '<a class="dropdown-item" href="' . $btn1 . '"> <i class="fa fa-pencil-alt text-info"></i> Edit</a>';
                    $btn2    = route('guru.destroy', $data->id);
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
        return view('dashboard.gurustaff.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.gurustaff.admin.create');
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
            'nip'                => 'required|unique:teachers,nip',
            'nama'               => 'required|string',
            'tanggal_gabung'     => 'required',
            'jenjang_pendidikan' => 'required',
            'jabatan'            => 'required',
            'alamat'             => 'required',
            'nohp'               => 'required',
            'status'             => 'required',
            'username'           => 'required',
            'kode_akses'         => 'required|min:6|unique:users,email',
            'password'           => 'required|min:6|confirmed',
        ]);

        $user            = new User;
        $user->name      = $request->username;
        $user->email     = $request->kode_akses;
        $user->menuroles = $request->jabatan; //secara di fault di isi siswa
        $user->password  = Hash::make($request->password);
        $user->save();
        $user->assignRole($request->jabatan);
        $teacher                    = new Teacher;
        $teacher->user_id           = $user->id;
        $teacher->nip               = $request->nip;
        $teacher->nama              = $request->nama;
        $teacher->alamat            = $request->alamat;
        $teacher->jenjangpendidikan = $request->jenjang_pendidikan;
        $teacher->notelp            = $request->nohp;
        $teacher->tanggalgabung     = $request->tanggal_gabung;
        $teacher->status            = $request->status;
        $teacher->save();
        return redirect()->route('guru.index')->with('status', "Berhasil menambah Guru/pegawai");

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
    public function edit(Teacher $guru)
    {
        return view('dashboard.gurustaff.admin.edit', compact('guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Teacher $guru)
    {
        $request->validate([
            'nip'                => 'required|unique:teachers,nip,' . $guru->id,
            'nama'               => 'required|string',
            'tanggal_gabung'     => 'required',
            'jenjang_pendidikan' => 'required',
            'alamat'             => 'required',
            'nohp'               => 'required',
            'status'             => 'required',
            'jabatan'            => 'required',
        ]);

        $user            = User::find($guru->user_id);
        $user->menuroles = $request->jabatan; //secara di fault di isi siswa
        $user->save();
        $teacher                    = Teacher::find($guru->id);
        $teacher->nip               = $request->nip;
        $teacher->nama              = $request->nama;
        $teacher->alamat            = $request->alamat;
        $teacher->jenjangpendidikan = $request->jenjang_pendidikan;
        $teacher->notelp            = $request->nohp;
        $teacher->tanggalgabung     = $request->tanggal_gabung;
        $teacher->status            = $request->status;
        $teacher->save();

        return redirect()->route('guru.index')->with('status', "Berhasil mengubah data  Guru/pegawai");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $guru)
    {

        //untuk menghapus table admn yang berkaitan
        DB::table('teachers')->where('id', $guru->id)->delete();

        //menghapus dari table user
        DB::table('users')->where('id', $guru->user_id)->delete();

        return redirect()->route('guru.index')->with('status', 'Berhasil menghapus guru');
    }

}

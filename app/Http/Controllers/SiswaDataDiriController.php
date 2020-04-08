<?php

namespace App\Http\Controllers;

use App\Student;
use Auth;
use Illuminate\Http\Request;

class SiswaDataDiriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_diri_siswa = Auth::user()->student->id;
        $siswa           = Student::find($data_diri_siswa)->first();
        return view('dashboard.siswa.datadiri.index', compact('siswa'));
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
        $siswa = Student::find($id)->first();
        return view('dashboard.siswa.datadiri.edit', compact('siswa'));
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
        $request->validate([
            'nama'          => 'required|string',
            'jk'            => 'required',
            'tempat_lahir'  => 'required',
            'tanggal_lahir' => 'required',
            'agama'         => 'required',
            'nama_ayah'     => 'required',
            'nama_ibu'      => 'required',
            'wali'          => 'required',
            'alamat'        => 'required',
        ]);
        $siswa                     = Student::find($id);
        $siswa->nama               = $request->nama;
        $siswa->jk                 = $request->jk;
        $siswa->tempatlahir        = $request->tempat_lahir;
        $siswa->agama              = $request->agama;
        $siswa->tanggallahir       = $request->tanggal_lahir;
        $siswa->namaayah           = $request->nama_ayah;
        $siswa->namaibu            = $request->nama_ibu;
        $siswa->namawali           = $request->wali;
        $siswa->alamatorangtuawali = $request->alamat;
        $siswa->save();
        return redirect()->route('data_diri_siswa.index')->with('status', 'Berhasil mengubah Data');
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

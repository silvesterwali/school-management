<?php

namespace App\Http\Controllers;

use App\Teacher;
use Auth;
use Illuminate\Http\Request;

class GuruDataDiriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id   = Auth::user()->teacher->id;
        $guru = Teacher::findOrFail($id)->first();
        return view('dashboard.gurustaff.index', compact('guru'));
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
        $guru = Teacher::findOrFail($id)->first();
        return view('dashboard.gurustaff.edit', compact('guru'));
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
            'nama'               => 'required|string',
            'jenjang_pendidikan' => 'required',
            'alamat'             => 'required',
            'nohp'               => 'required',
        ]);
        $teacher                    = Teacher::find($id);
        $teacher->nama              = $request->nama;
        $teacher->alamat            = $request->alamat;
        $teacher->jenjangpendidikan = $request->jenjang_pendidikan;
        $teacher->notelp            = $request->nohp;
        $teacher->save();
        return redirect()->route('guru_data_diri.index')->with('status', "Berhasil mengubah data  Guru/pegawai");
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

<?php

namespace App\Http\Controllers;

use App\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TahunAjaranController extends Controller
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
        $tas = SchoolYear::paginate(10);
        return view('dashboard.tahunajaran.index', compact('tas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.tahunajaran.create');
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
            "kode_ta"      => 'required',
            "tahun_ajaran" => 'required',
        ]);

        $kode         = $request->kode_ta;
        $tahun_ajaran = $request->tahun_ajaran;
        $ta           = SchoolYear::firstOrNew(
            ["kdtahunajaran" => $kode],
            ["tahunajaran" => $tahun_ajaran]
        );
        $ta->save();
        return redirect()->route('ta.index')->with('status', 'Berhasil menambah  tahun ajaran');
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
    public function edit(SchoolYear $tum)
    {
        $ta = $tum;
        return view('dashboard.tahunajaran.edit', compact('ta'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolYear $tum)
    {
        $request->validate([
            "kode_ta"      => 'required',
            "tahun_ajaran" => 'required',
        ]);

        $ta                = SchoolYear::find($tum->id);
        $ta->kdtahunajaran = $request->kode_ta;
        $ta->tahunajaran   = $request->tahun_ajaran;
        $ta->save();
        return redirect()->route('ta.index')->with('status', 'Berhasil mengubah  tahun ajaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolYear $tum)
    {
        DB::table('school_years')->where('id', $tum->id)->delete();
        return redirect()->route('ta.index')->with('status', 'Berhasil menghapus tahun ajaran');
    }
}

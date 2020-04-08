<?php

namespace App\Http\Controllers;

use App\Course;
use App\Teacher;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapelController extends Controller
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
            $data = Course::latest()->get();
            return DataTables::of($data)
                ->addColumn('pengajar', function ($data) {
                    return $data->teacher->nama;
                })
                ->addColumn('action', function ($data) {
                    $btn1 = route('mapel.edit',
                        $data->id);
                    $btnedit = '<a class="dropdown-item" href="' . $btn1 . '"> <i class="fa fa-pencil-alt text-info"></i> Edit</a>';
                    $btn2    = route('mapel.destroy', $data->id);
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
        return view('dashboard.mapel.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru = $this->activeTeachers();
        return view('dashboard.mapel.admin.create', compact('guru'));
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
            'kode_mapel'         => 'required|unique:courses,kdmapel',
            'nama_matapelajaran' => 'required',
            'kkmpengetahuan'     => 'required',
            'kkmketerampilan'    => 'required',
            'kelompokmapel'      => 'required',
            'guru'               => 'required',
            'grade'              => 'required',
        ]);
        $mapel                  = new Course;
        $mapel->teacher_id      = $request->guru;
        $mapel->kdmapel         = $request->kode_mapel;
        $mapel->mapel           = $request->nama_matapelajaran;
        $mapel->kkmpengetahuan  = $request->kkmpengetahuan;
        $mapel->kkmketerampilan = $request->kkmketerampilan;
        $mapel->kelompokmapel   = $request->kelompokmapel;
        $mapel->grade           = $request->grade;
        $mapel->save();
        return redirect()->route('mapel.index')->with('status', 'Berhasil menambah matapelajaran');
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
    public function edit(Course $mapel)
    {
        $guru = $this->activeTeachers();
        return view('dashboard.mapel.admin.edit', compact('mapel', 'guru'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $mapel)
    {
        $request->validate([
            'kode_mapel'         => 'required|unique:courses,kdmapel,' . $mapel->id,
            'nama_matapelajaran' => 'required',
            'kkmpengetahuan'     => 'required',
            'kkmketerampilan'    => 'required',
            'kelompokmapel'      => 'required',
            'guru'               => 'required',
            'grade'              => 'required',
        ]);
        $mapel                  = Course::find($mapel->id);
        $mapel->teacher_id      = $request->guru;
        $mapel->kdmapel         = $request->kode_mapel;
        $mapel->mapel           = $request->nama_matapelajaran;
        $mapel->kkmpengetahuan  = $request->kkmpengetahuan;
        $mapel->kkmketerampilan = $request->kkmketerampilan;
        $mapel->kelompokmapel   = $request->kelompokmapel;
        $mapel->grade           = $request->grade;
        $mapel->save();
        return redirect()->route('mapel.index')->with('status', 'Berhasil mengubah matapelajaran');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Course $mapel)
    {
        DB::table('courses')->where('id', $mapel->id)->delete();
        return redirect()->route('mapel.index')->with('status', 'Berhasil menghapus  Mata pelajaran');
    }

    private function activeTeachers()
    {
        return Teacher::with(['user' =>
            function ($q) {
                $q->where('menuroles', '=', 'guru');
            },

        ])
            ->where('status', '=', 1)
            ->get();

    }
}

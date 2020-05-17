<?php

namespace App\Http\Controllers;

use App\ClassRoom;
use App\SchoolYear;
use App\Teacher;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasManagement extends Controller
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
            $data = ClassRoom::latest()->get();
            return DataTables::of($data)
                ->addColumn('wali', function ($data) {
                    return $data->teacher->nama;
                })
                ->addColumn("ta", function ($data) {
                    return $data->school_year->tahunajaran;
                })
                ->addColumn('sts', function ($data) {
                    return $data->isActive == 0 ? 'Non Active' : 'Active';
                })
                ->addColumn('action', function ($data) {

                    $is_aktif = $data->isActive == 1 ? route('nonactive.kelas', $data->id) : route('active.kelas', $data->id);
                    $is_what  = $data->isActive == 1 ? "Unactive" : "Active";
                    $btn1     = route('kelas.edit', $data->id);
                    $btnLihat = route('kelas.show', $data->id);
                    $btnedit  = '<a class="dropdown-item" href="' . $btn1 . '"> <i class="fa fa-pencil-alt text-info"></i> Edit</a>';
                    $btnedit .= '<a class="dropdown-item" href="' . $btnLihat . '"> <i class="fa fa-eye text-info"></i>  Detail Kelas</a>';
                    $btn2 = route('kelas.destroy', $data->id);
                    $form = '<form action="' . $btn2 . '" method="post"> ' . csrf_field() . '
                        <input type="hidden" name="_method" value="delete">
                        <button class="dropdown-item" type="submit"> <i class="fa fa-trash-alt text-danger"></i> Hapus</button>
                    </form>';

                    $form .= '<form action="' . $is_aktif . '" method="post"> ' . csrf_field() . '
                    <input type="hidden" name="_method" value="put">
                    <button class="dropdown-item" type="submit"> <i class="fa fa-cog text-danger"></i> ' . $is_what . ' </button>
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
        return view('dashboard.kelas.admin.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $guru         = $this->activeTeachers();
        $tahun_ajaran = SchoolYear::all();
        return view('dashboard.kelas.admin.create', compact('guru', 'tahun_ajaran'));
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
            "guru"         => 'required',
            'kode_kelas'   => 'required|unique:class_rooms,kdkelas',
            "namakelas"    => 'required',
            "status"       => "required",
            "grade"        => "required",
            "tahun_ajaran" => 'required',
        ]);
        $cr                 = new ClassRoom;
        $cr->teacher_id     = $request->guru;
        $cr->kdkelas        = $request->kode_kelas;
        $cr->namakelas      = $request->namakelas;
        $cr->grade          = $request->grade;
        $cr->school_year_id = $request->tahun_ajaran;
        $cr->isActive       = $request->status;
        $cr->save();
        return redirect()->route('kelas.index')->with('status', "Berhasil menambah kelas");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ClassRoom $kela)
    {
        //untuk menampilkan detail nama kelas
        $kls = $kela;
        return view('dashboard.kelas.admin.show', compact('kls'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ClassRoom $kela)
    {
        $kls          = $kela;
        $guru         = $this->activeTeachers();
        $tahun_ajaran = SchoolYear::all();
        return view('dashboard.kelas.admin.edit', compact('kls', 'guru', 'tahun_ajaran'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClassRoom $kela)
    {
        $request->validate([
            "guru"         => 'required',
            'kode_kelas'   => 'required|unique:class_rooms,kdkelas,' . $kela->id,
            "namakelas"    => 'required',
            "status"       => "required",
            "grade"        => "required",
            "tahun_ajaran" => 'required',
        ]);
        $cr                 = ClassRoom::find($kela->id);
        $cr->teacher_id     = $request->guru;
        $cr->kdkelas        = $request->kode_kelas;
        $cr->namakelas      = $request->namakelas;
        $cr->grade          = $request->grade;
        $cr->school_year_id = $request->tahun_ajaran;
        $cr->isActive       = $request->status;
        $cr->save();
        return redirect()->route('kelas.index')->with('status', "Berhasil mengubah kelas");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClassRoom $kela)
    {
        DB::table('class_rooms')->where('id', $kela->id)->delete();
        return redirect()->route('kelas.index')->with('status', 'Berhasil menghapus Kelas');
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
    public function nonactive(ClassRoom $kelas)
    {
        $cr           = ClassRoom::find($kelas->id);
        $cr->isActive = 0;
        $cr->save();
        return redirect()
            ->route('kelas.index')
            ->with('status', "Berhasil mengubah status kelas");
    }

    public function active(ClassRoom $kelas)
    {
        $cr           = ClassRoom::find($kelas->id);
        $cr->isActive = 1;
        $cr->save();
        return redirect()
            ->route('kelas.index')
            ->with('status', "Berhasil mengubah status kelas");
    }
}

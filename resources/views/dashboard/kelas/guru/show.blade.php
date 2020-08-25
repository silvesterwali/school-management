@extends('dashboard.base') @section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-users"></i>
                            {{ $kls->namakelas }}</h3>
                        <h4 class="card-subtitle">Kode Kelas :
                            {{ $kls->kdkelas}}</h4>
                        <h5>
                            Wali Kelas :
                            {{ $kls->teacher->nama }}</h5>
                        <h6>
                            Tahun Ajaran :
                            {{ $kls->school_year->tahunajaran }}
                        </h6>

                        <a
                            href="{{ route('guru_kelas_siswa.show',$kls->id) }}"
                            class="btn btn-success float-right mx-auto">{{ __('kembali') }}</a>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-body p-1">
                        @include('dashboard.base.success')
                        <nav class="p-0">
                            <div class="nav nav-tabs   nav-justified " id="nav-tab" role="tablist">
                                <a
                                    class="nav-item  nav-link active"
                                    id="nav-home-tab"
                                    data-toggle="tab"
                                    href="#nav-home"
                                    role="tab"
                                    aria-controls="nav-home"
                                    aria-selected="true">Siswa</a>
                                <a
                                    class="nav-item  nav-link"
                                    id="nav-profile-tab"
                                    data-toggle="tab"
                                    href="#nav-profile"
                                    role="tab"
                                    aria-controls="nav-profile"
                                    aria-selected="false">Mata Pelajaran</a>
                                <a
                                    class="nav-item  nav-link"
                                    id="nav-contact-tab"
                                    data-toggle="tab"
                                    href="#nav-contact"
                                    role="tab"
                                    aria-controls="nav-contact"
                                    aria-selected="false">Nilai Siswa</a>
                                @if(Auth::user()->teacher->id ==$kls->teacher->id)
                                <a
                                    class="nav-item  nav-link"
                                    id="nav-contact-tab"
                                    data-toggle="tab"
                                    href="#nav-absesi"
                                    role="tab"
                                    aria-controls="nav-contact"
                                    aria-selected="false">Absensi</a>
                                <a
                                    class="nav-item  nav-link"
                                    id="nav-contact-tab"
                                    data-toggle="tab"
                                    href="#nav-extrakurikuler"
                                    role="tab"
                                    aria-controls="nav-contact"
                                    aria-selected="false">Extrakurikuler</a>
                                @endif

                                <div class="dropdown nav-item nav-link ">
                                    <button
                                        class="btn btn-secondary dropdown-toggle"
                                        type="button"
                                        id="dropdownMenuButton"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false">
                                        General Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @if(Auth::user()->teacher->id==$kls->teacher->id)
                                        <a class="dropdown-item" href="{{ route('KelasAbsentSiswa.attendeesEdit',['kelas'=>$kls->id,'semester'=>1]) }}">
                                            Absen smts 1 </a>
                                            <a class="dropdown-item" href="{{ route('KelasAbsentSiswa.attendeesEdit',['kelas'=>$kls->id,'semester'=>2]) }}">
                                            Absen smts 2 </a>
                                        <a class="dropdown-item" href="{{  route('extrakurikuler.create',$kls->id) }}">Tambah Extrakurikuler</a>
                                        @endif
                                        @foreach($mapel as $mapel)
                                        <a class="dropdown-item" href="{{  route('guru_mapel_nilai.edit',['kelas'=>$kls->id,'mapel'=>$mapel->id,'semester'=>1 ]) }}">
                                                Edit
                                            {{ $mapel->course->kdmapel}}/sms 1
                                            <i class="fa fa-pencil-alt text-success"></i>
                                            </a>
                                            <a class="dropdown-item" href="{{  route('guru_mapel_nilai.edit',['kelas'=>$kls->id,'mapel'=>$mapel->id,'semester'=>2 ]) }}">
                                                    Edit
                                            {{ $mapel->course->kdmapel}}/sms 2
                                            <i class="fa fa-pencil-alt text-success"></i>
                                            </a>


                                        @endforeach
                                        <a class="dropdown-item" href="{{ route('cetak_laporan_semester',$kls->id) }}">cetak Report</a>

                                    </div>
                                </div>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <div
                                class="tab-pane fade show active "
                                id="nav-home"
                                role="tabpanel"
                                aria-labelledby="nav-home-tab">

                                <div class="table-responsive mt-3">
                                    <table class="table table-hover table-sm  table-bordered display "  style="font-size:12px ;widht:100%" id="AdminTableStudent">
                                    <thead class="bg-dark">
                                        <tr>
                                        <th>NISN</th>
                                        <th>NAMA</th>
                                        <th>JK</th>
                                        <th>TEMPAT LAHIR</th>
                                        <th>TANGGAL LAHIR</th>
                                        <th>AGAMA</th>
                                        <th>AYAH</th>
                                        <th>IBU</th>
                                        <th>WALI</th>
                                        <th>ALAMAT</th>
                                        <th>TANGGAL MASUK</th>
                                        <th>GRADE</th>
                                        <th class="text-center"><i class="fa fa-universal-access"></i></th>
                                    </tr>
                                    </thead>
                                    </table>
                                 </div>
                                </div>
                            <div
                                class="tab-pane fade"
                                id="nav-profile"
                                role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                <div class="table-responsive mt-3">
                                  <table class="table table-hover table-sm display table-bordered"  style="font-size:12px ;widht:100%" id="AdminTable">
                                    <thead class="bg-dark">
                                      <tr>
                                      <th>KODE MAPEL</th>
                                      <th>MAPEL</th>
                                      <th>PENGAJAR</th>
                                      <th>KKM PENGETAHUAN</th>
                                      <th>KKM KETERAMPILAN</th>
                                      <th>KEL.MAPEL</th>
                                      <th>GRADE</th>
                                      <th class="text-center"><i class="fa fa-universal-access"></i></th>
                                  </tr>
                                    </thead>
                                  </table>
                              </div>
                                </div>

                            <div
                                class="tab-pane fade"
                                id="nav-contact"
                                role="tabpanel"
                                aria-labelledby="nav-contact-tab">

                                <div class="table-responsive mt-2">
                                    <table class="table table-sm dispaly table-bordered"  id="SpantaTable" style="font-size:12px ;widht:100%">
                                        <thead>
                                            <tr>
                                                <th>Nisn</th>
                                                <th>Nama</th>
                                                <th>Nip</th>
                                                <th>Guru </th>
                                                <th>Semester</th>
                                                <th>Mapel</th>
                                                <th>KKM Pengetahuan</th>
                                                <th>KKM Keterampilan</th>
                                                <th>Nilai Tugas</th>
                                                <th>Nilai Tugas 2</th>
                                                <th>Nilai Tugas 3</th>
                                                <th>Ulangan Harian</th>
                                                <th>Ulangan Harian 2</th>
                                                <th>Ulangan Harian 3</th>
                                                <th>Uts</th>
                                                <th>Uas</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                                </div>
                            <div
                                class="tab-pane fade"
                                id="nav-absesi"
                                role="tabpanel"
                                aria-labelledby="nav-absensi-tab">
                                <!-- untuk menambahkan absensi siswa/siswi -->
                                @include('dashboard.kelas.admin.absensi')
                            </div>

                            <div
                                class="tab-pane fade"
                                id="nav-extrakurikuler"
                                role="tabpanel"
                                aria-labelledby="nav-absensi-tab">
                                <!-- untuk menambahkan absensi siswa/siswi -->
                                @include('dashboard.kelas.admin.extrakurikuler')
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection @section('javascript')
<script src="{{ asset('DataTables') }}/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
<script src="{{ asset('DataTables')}}/datatables.min.js"></script>
<script
src="{{ asset('DataTables')}}/DataTables-1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
        $('#AdminTable').DataTable({
            proccessing:true,
            serverSide:true,
            destroy: true,
            info: false,
            "autoWidth": false,
            ajax:{
                url:"{{ route('KelasMapel.index',$kls->id)}}",
            },
            columns:[
                {
                    data:'kdmapel',
                    name:'kdmapel',
                },
                {
                    data:'mapel',
                    name:'mapel',
                },
                {
                    data:'pengajar',
                    name:'pengajar',
                },
                    {
                    data:'kkmpengetahuan',
                    name:'kkmpengetahuan',
                },
                    {
                    data:'kkmketerampilan',
                    name:'kkmketerampilan',
                },
                    {
                    data:'kelompokmapel',
                    name:'kelompokmapel',
                },
                {
                    data:'grade',
                    name:'grade',
                },

                {
                    data:'action',
                    name:'action',
                    orderable:false
                }
            ]
        });

        $("#AdminTableStudent").DataTable({
            proccessing:true,
            serverSide:true,
            destroy: true,
            info: false,
            "autoWidth": false,
            ajax:{
                url:"{{ route('KelasSiswa.index',$kls->id)}}",
            },
            columns:[
                {
                    data:'nisn',
                    name:'nisn',
                },
                {
                    data:'nama',
                    name:'nama',
                },
                {
                    data:'jeniskelamin',
                    name:'jeniskelamin',
                },
                {
                    data:'tempatlahir',
                    name:'tempatlahir',
                },
                {
                    data:'tanggallahir',
                    name:'tanggallahir',
                },
                {
                    data:'agama',
                    name:'agama',
                },
                {
                    data:'namaayah',
                    name:'namaayah',
                },
                {
                    data:'namaibu',
                    name:'namaibu',
                },
                {
                    data:'namawali',
                    name:'namawali',
                },
                {
                    data:'alamatorangtuawali',
                    name:'alamatorangtuawali',
                },

                {
                    data:'tanggalmasuk',
                    name:'tanggalmasuk',
                },

                {
                    data:'grade',
                    name:'grade'

                },
                {
                    data:'action',
                    name:'action',
                    orderable:false
                }
            ]
        });

        $('#SpantaTable').DataTable({
            proccessing:true,
            serverSide:true,
            destroy: true,
            info: false,
            "autoWidth": false,
            ajax:{
                url:"{{ route('KelasSiswaMapel.index',$kls->id )  }}",
            },
            columns:[
                {
                    data:'nisn',
                    name:'nisn',
                },
                {
                    data:'nama',
                    name:'nama',
                },
                {
                    data:'nip',
                    name:'nip',
                },
                    {
                    data:'guru',
                    name:'guru',
                },
                    {
                    data:'semester',
                    name:'semester',
                },
                {
                    data:"mapel",
                    name:"mapel",
                },
                    {
                    data:'kkmpengetahuan',
                    name:'kkmpengetahuan',
                },
                {
                    data:'kkmketerampilan',
                    name:'kkmketerampilan',
                },
                {
                    data:'nilaitugas',
                    name:'nilaitugas',
                },
                 {
                    data:'nilaitugas_dua',
                    name:'nilaitugas_dua',
                },
                 {
                    data:'nilaitugas_tiga',
                    name:'nilaitugas_tiga',
                },

                {
                    data:'ulanganharian',
                    name:'ulanganharian',
                },

                {
                    data:'ulanganharian_dua',
                    name:'ulanganharian_dua',
                },

                {
                    data:'ulanganharian_tiga',
                    name:'ulanganharian_tiga',
                },
                {
                    data:'uts',
                    name:'uts',
                },
                {
                    data:'uas',
                    name:'uas',
                },
                {
                    data:'keterangan',
                    name:'keterangan'
                }
            ],
            initComplete: function () {
            this.api().columns([4,5]).every( function () {
                var column = this;
                var select = $('<select class="form-control form-control-sm"><option value=""></option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        }



        });
        $('#AbsensiKelas').DataTable({
                proccessing:true,
                serverSide:true,
                destroy: true,
                info: false,
                "autoWidth": false,
                ajax:{
                    url:"{{ route('KelasAbsentSiswa.attendees',$kls->id)}}",
                },
                columns:[
                    {
                        data:'nisn',
                        name:'nisn',
                    },
                    {
                        data:'nama',
                        name:'nama',
                    },
                    {
                        data:'semester',
                        name:'semester',
                    },
                    {
                        data:'hadir',
                        name:'hadir',
                    },
                    {
                        data:'sakit',
                        name:'sakit',
                    },
                    {
                        data:'ijin',
                        name:'ijin',
                    },
                    {
                        data:'alpha',
                        name:'alpha',
                    },
                    {
                        data:'Keterangan',
                        name:'Keterangan',
                    }


                ]
            });

            $('#extrakurikulerKelas').DataTable({
                proccessing:true,
                serverSide:true,
                destroy: true,
                info: false,
                "autoWidth": false,
                ajax:{
                    url:"{{ route('extrakurikuler.extrakurikuler',$kls->id)}}",
                },
                columns:[
                    {
                        data:'nisn',
                        name:'nisn',
                    },
                    {
                        data:'nama',
                        name:'nama',
                    },
                    {
                        data:'kegiatanextrakurikuler',
                        name:'kegiatanextrakurikuler',
                    },
                    {
                        data:'keterangan',
                        name:'keterangan',
                    },
                    {
                        data:'action',
                        name:'action'
                    }


                ]
            })


    });
</script>

@endsection

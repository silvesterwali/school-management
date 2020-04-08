@extends('dashboard.base')

@section('content')


        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('List Siswa/i') }}
                         <a href="{{ route('siswa.create') }}" class="btn btn-success float-right ">{{ __('Tambah siswa/i') }}</a>
                      </div>

                    <div class="card-body">
                          @include('dashboard.base.success')
                        <div class="table-responsive">
                            <table class="table table-hover table-sm"  style="font-size:12px" id="AdminTable">
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
                                <th>USERNAME</th>
                                <th>KODE AKSES</th>
                                <th class="text-center"><i class="fa fa-universal-access"></i></th>
                            </tr>
                              </thead>
                            </table>
                        </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>

@endsection


@section('javascript')
      <script src="{{ asset('DataTables')}}/datatables.min.js" ></script>
            <script src="{{ asset('DataTables')}}/DataTables-1.10.20/js/dataTables.bootstrap4.min.js" ></script>
      <script>
            $(document).ready(function(){
            $('#AdminTable').DataTable({
                proccessing:true,
                serverSide:true,
                destroy: true,
                info:false,
                "autoWidth": false,
                ajax:{
                    url:"{{ route('siswa.index')}}",
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
                        data:'username',
                        name:'username'
                    },
                    {
                        data:'email',
                        name:'email'
                    },
                    {
                        data:'action',
                        name:'action',
                        orderable:false
                    }
                ],
        //         initComplete: function () {
        //     this.api().columns([0]).every( function () {
        //         var column = this;
        //         var select = $('<select class="form-control form-control-sm" widht="100%"><option value="">NISN</option></select>')
        //             .appendTo( $(column.header()).empty() )
        //             .on( 'change', function () {
        //                 var val = $.fn.dataTable.util.escapeRegex(
        //                     $(this).val()
        //                 );

        //                 column
        //                     .search( val ? '^'+val+'$' : '', true, false )
        //                     .draw();
        //             } );

        //         column.data().unique().sort().each( function ( d, j ) {
        //             select.append( '<option value="'+d+'">'+d+'</option>' )
        //         } );
        //     } );
        // }

            });
        });

    </script>
      </script>
@endsection

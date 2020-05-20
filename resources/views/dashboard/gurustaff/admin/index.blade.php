@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('List Guru Dan Pegawai') }}
                         <a href="{{ route('guru.create') }}" class="btn btn-success float-right ">{{ __('Tambah Guru/Pegawai') }}</a>
                      </div>

                    <div class="card-body">
                          @include('dashboard.base.success')
                        <div class="table-responsive">
                            <table class="table table-hover table-sm"  style="font-size:12px" id="AdminTable">
                              <thead class="bg-dark">
                                 <tr>
                                <th>NIP</th>
                                <th>NAMA</th>
                                <!-- <th>STATUS</th> -->
                                <th>TANGGAL MASUK</th>
                                <th>PENDIDIKAN</th>
                                 <th>ROLE AKSES </th>
                                <th>NO.TELP</th>
                                <th>ALAMAT</th>
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
                ajax:{
                    url:"{{ route('guru.index')}}",
                },
                columns:[
                    {
                        data:'nip',
                        name:'nip',
                    },
                    {
                        data:'nama',
                        name:'nama',
                    },
                    // {
                    //     data:'sts',
                    //     name:'sts',
                    // },
                    {
                        data:'tanggalgabung',
                        name:'tanggalgabung',
                    },
                    {
                        data:'jenjangpendidikan',
                        name:'jenjangpendidikan',
                    },
                    {
                        data:'akses',
                        name:'akses',
                    },
                    {
                        data:'notelp',
                        name:'notelp',
                    },
                    {
                        data:'alamat',
                        name:'alamat',
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
                ]
            });
        });

    </script>
      </script>
@endsection

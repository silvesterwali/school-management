@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-align-justify"></i>{{ __('List Mata Pelajaran') }}
                        <a href="{{ route('mapel.create') }}" class="btn btn-success float-right ">{{ __('Tambah Mapel') }}</a>
                      </div>
                          <div class="card-body">
                                @include('dashboard.base.success')
                              <div class="table-responsive">
                                  <table class="table table-hover table-sm"  style="font-size:12px" id="AdminTable">
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
                    url:"{{ route('mapel.index')}}",
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
        });

    </script>

@endsection

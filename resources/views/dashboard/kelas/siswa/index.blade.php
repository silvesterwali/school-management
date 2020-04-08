@extends('dashboard.base') @section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Data kelas</h3>
            <p class="card-subtitle">Silakan akses kelas anda</>
        </div>
        <div class="card-body p-2">
        <div class="fade-in">

            <div class="row">
                @foreach($kelas as $k)

                <div class="col-sm-6 col-lg-4">
                    <div class="card  bg-success">
                        <div class="card-body pb-0 text-light p-2 d-flex align-items-center">

                            <div class="border-light p-3 mr-3">
                                <svg class="c-icon c-icon-xl">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-house"></use>
                                </svg>
                            </div>
                            <div>
                                <div class="text-value ">{{ $k->namakelas }} </div>
                                <div class=" text-uppercase font-weight-bold small">Wali kelas</div>
                                <div
                                    class=" text-uppercase font-weight-bold small">
                                    {{$k->teacher->nama }}</div>
                            </div>
                        </div>
                        <div class="card-footer px-3 py-2">
                            <a
                                class="btn-block text-muted d-flex justify-content-between align-items-center"
                                href="{{ route('siswa_kelas_akses.show',$k->id) }}">
                                <span class="small font-weight-bold">Lihat Kelas</span>
                                <svg class="c-icon">
                                    <use xlink:href="assets/icons/coreui/free-symbol-defs.svg#cui-chevron-right"></use>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                @endforeach
            </div>
            <!-- /.row-->

            <!-- /.row-->
        </div>
        </div>
    </div>

</div>

@endsection @section('javascript')

<script src="{{ asset('js/Chart.min.js') }}"></script>
<script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
<script src="{{ asset('js/main.js') }}" defer="defer"></script>
@endsection

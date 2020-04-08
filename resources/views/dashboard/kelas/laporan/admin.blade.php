
@extends('dashboard.base') @section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">
                            <i class="fa fa-users"></i>
                            {{ $kelas->namakelas }}</h2>
                        <h4 class="card-subtitle">Kode Kelas :
                            {{ $kelas->kdkelas}}</h4>
                        <h5>
                            Wali Kelas :
                            {{ $kelas->teacher->nama }}</h5>
                        <a
                            href="{{ url('/') }}"
                            class="btn btn-success float-right mx-auto">{{ __('kembali') }}</a>
                    </div>
                    <div class="card-body">
                        <h5>Penambahan Mata Pelajaran</h5>
                        <ol>
                            <li>Pilih Siswa/i yang akan dicetak laporannya</li>
                            <li>Pilih Semester </li>
                            <li>Pilih matapelajaran ayan akan  dicetak </li>
                        </ol>
                        <form id="formMapel" action="{{ route('cetak_laporan_semester.store') }}" method="post">
                            {{ csrf_field () }}
                            <input type="hidden" name="idkelas" value="{{$kelas->id}}">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="form-control-label">{{__('Pilih Semester')}}</label>
                                        <div class="form-check  form-check-radio">
                                            <label class="form-check-label">
                                                <input name="semester"
                                                    class="form-check-input {{ $errors->has('semester') ? ' is-invalid' : '' }}"
                                                    type="radio" value="1" {{ old('semester') == 1 ? 'checked' : ''}}>
                                                Semester Ganjil
                                                <span class="form-check-sign">

                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check  form-check-radio">
                                            <label class="form-check-label">
                                                <input name="semester"
                                                    class="form-check-input {{ $errors->has('semester') ? ' is-invalid' : '' }}"
                                                    type="radio" value="2" {{ old('semester') == 2 ? 'checked' : ''}}>
                                                Semester Genap
                                                <span class="form-check-sign">

                                                </span>
                                            </label>
                                        </div>
                                        @include('dashboard.base.feedback', ['field' => 'semester'])
                                    </div>
                                </div>

                            <div class="row">
                                <div class="col-sm-6">
                                <div class="table-responsive">
                                <h3>Table Siswa</h3>
                                <table class="table table-condensed table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>NISN</th>
                                            <th>Nama</th>
                                            <th>Jk</th>
                                            <th>Grade</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($siswa as $mp)
                                        <tr>
                                            <td>{{ $mp->student->nisn }}</td>
                                            <td>{{ $mp->student->nama }}</td>
                                            <td>{{ $mp->student->jk == 1 ? 'L': 'P' }}</td>
                                            <td>{{ $mp->student->grade }}</td>
                                            <td class="text-center">
                                                <input
                                                name="class_student[]"
                                                value="{{ $mp->id }}"
                                                {{ old('class_student[]') == $mp->id ? 'checked' : ''}}
                                                type="checkbox"
                                                class="form-check-input selectedMapel">

                                            </td>
                                        </tr>
                                        @endforeach()
                                    </tbody>
                                </table>
                            </div>
                                </div>
                                <div class="col-sm-6">
                                <div class="table-responsive">
                                <h3>Table Mapel</h3>
                                <table class="table table-condensed table-sm table-hover">
                                    <thead>
                                        <tr>
                                            <th>KD MAPEL</th>
                                            <th>MAPEL</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($course as $course)
                                        <tr>
                                            <td>{{ $course->course->kdmapel }}</td>
                                            <td>{{ $course->course->mapel }}</td>

                                            <td class="text-center">
                                                <input
                                                name="class_mapel[]"
                                                value="{{ $course->id }}"
                                                {{ old('class_mapel') == $course->id ? 'checked' : ''}}
                                                type="checkbox"
                                                class="form-check-input selectedMapel">

                                            </td>
                                        </tr>
                                        @endforeach()
                                    </tbody>
                                </table>
                            </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <button
                                        type="sumbit"
                                        class="btn btn-success">
                                        Cetak Laporan
                                    </button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')
<script>
$(document).ready(function(){
    // $("#btnSubmit").hide();
    // $(".selectedMapel").on("click",function(){
    //     if ($('input[name="siswa[]"]:checked').length>0){
    //         $("#btnSubmit").show();
    //     }else{
    //         $("#btnSubmit").hide();
    //     }

    // });


});

</script>
@endsection

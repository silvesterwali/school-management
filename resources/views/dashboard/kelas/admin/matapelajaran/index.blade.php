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
                            href="{{ route('kelas.show',$kelas->id) }}"
                            class="btn btn-success float-right mx-auto">{{ __('kembali') }}</a>
                    </div>
                    <div class="card-body">
                        <h5>Penambahan Mata Pelajaran</h5>
                        <ol>
                            <li>Pilih Mata pelajaran yang sesuai dengan mata pelajaran</li>
                            <li>Pastikan matapelajaran tidak duplicate/auto pendobelan dalam kelas</li>
                            <li>Tombol  akan submit muncul jika matapelajaran sudah terpilih</li>
                        </ol>
                        <form id="formMapel" action="{{ route('KelasMapel.store') }}" method="post">
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
                            <div class="table-responsive">
                                <table class="table table-condensed table-sm">
                                    <thead>
                                        <tr>
                                            <th>KD.Mapel</th>
                                            <th>Nama Mapel</th>
                                            <th>Kel.Mapel</th>
                                            <th>Grade</th>
                                            <th>Pengajar</th>
                                            <th>#</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($matapelajaran as $mp)
                                        <tr>
                                            <td>{{ $mp->kdmapel }}</td>
                                            <td>{{ $mp->mapel }}</td>
                                            <td>{{ $mp->kelompokmapel }}</td>
                                            <td>{{ $mp->grade }}</td>
                                            <td>{{ $mp->teacher->nama }}</td>
                                            <td class="text-center">

                                                    @if(!in_array($mp->id,$newExistsCouser))
                                                        <input
                                                        name="mapel[]"
                                                        value="{{ $mp->id }}"
                                                        type="checkbox"
                                                        class="form-check-input selectedMapel">
                                                    @else
                                                        <span class="badge badge-success">{{__('Sudah terpilih ')}}</span>
                                                    @endif

                                            </td>
                                        </tr>
                                        @endforeach()
                                        <tr>
                                            <td colspan="5"></td>
                                            <td class="text-center">
                                                <button id="btnSubmit" class="btn btn-success" type="submit">Masukan</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
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
    $("#btnSubmit").hide();
        $(".selectedMapel").on("click",function(){
        if ($('input[name="mapel[]"]:checked').length>0){
            $("#btnSubmit").show();
        }else{
            $("#btnSubmit").hide();
        }

});
});

</script>
@endsection

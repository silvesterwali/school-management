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
                        <h6>{{__('ExtraKurikuler Kelas')}}</h6>
                        <ul>

                            <li>Lakukan jika ada perubahan</li>
                        </ul>
                        @include('dashboard.base.success')
                        <form method="post" action="{{ route('extrakurikuler.update',['kelas'=>$kls->id,'extra'=>$extra->id] )}}">
                        @method('put')
                        {{ csrf_field () }}
                            <div class="table-responsive col-sm-6">
                                <table class="table table-sm table-bordered">
                                    <tbody>
                                            <tr>
                                                <td>Nama :</td>
                                                <td>{{$extra->class_student->student->nama}}</td>
                                            </tr>
                                        <tr>
                                            <td colspan="2">
                                            <div class="form-group{{ $errors->has('hadir') ? ' has-danger' : '' }}">
                                                    <lable>{{__('Nama Kegiatan')}}</lable>
                                                    <input type="text" name="namakegiatan"
                                                        class="form-control form-control-alternative{{ $errors->has('namakegiatan') ? ' is-invalid' : '' }}"
                                                        placeholder="{{ __('Nama Kegiatan') }}" value="{{  $extra->kegitanextrakurikuler }}">
                                                    @include('dashboard.base.feedback', ['field' => 'namakegiatan'])
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                            <div class="form-group{{ $errors->has('keterangan') ? ' has-danger' : '' }}">
                                                    <lable>{{__('Keterangan')}}</lable>
                                                    <textarea name="keterangan"
                                                        class="form-control form-control-alternative{{ $errors->has('keterangan') ? ' is-invalid' : '' }}"
                                                        placeholder="{{ __('Keterangan') }}">{{ $extra->keterangan }}</textarea>
                                                    @include('dashboard.base.feedback', ['field' => 'keterangan'])
                                                </div>
                                            </td>
                                        </tr>
                                            <tr>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-success" type="submit">Masukan
                                                    </button>
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
<script src="{{ asset('DataTables') }}/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
<script src="{{ asset('DataTables')}}/datatables.min.js"></script>
<script
src="{{ asset('DataTables')}}/DataTables-1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
        $('#Alkdj').DataTable();
    });
</script>
@endsection

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
                        <h5>{{ $mapel->course->mapel}}/semester {{ $semester }} / TA : {{ $mapel->class_room->school_year->tahunajaran}} </h5>

                        @include('dashboard.base.success')
                        <form method="post" action="{{ route('guru_mapel_nilai.update',['kelas'=>$kls->id,'mapel'=>$mapel->id,'semester'=>$semester ])}}">
                        @method('put')
                        {{ csrf_field () }}
                            <div class="table-responsive ">
                                <table style="min-width:600px" class="table table-sm table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>NISN</th>
                                            <th>Nama Siswa</th>
                                            <th width="150">KKM Pengetahun</th>
                                            <th width="150">KKM Keterampilan</th>
                                            <th width="150">Nilai Tugas</th>
                                            <th width="150">Nilai Tugas 2</th>
                                            <th width="150">Nilai Tugas 3</th>
                                            <th width="150">Ulangan Harian</th>
                                            <th width="150">Ulangan Harian 2</th>
                                            <th width="150">Ulangan Harian</th>
                                            <th width="150">UTS</th>
                                            <th width="150">UAS</th>
                                            <th width="150">Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            @foreach($kelas_mapel as $km)
                                                <tr>
                                                    <td style="min-width:100px">
                                                        {{ $km->class_student->student->nisn }}
                                                    </td>
                                                    <td style="min-width:100px" >
                                                        {{ $km->class_student->student->nama }}
                                                        <input  type="hidden" name="id[]" value="{{$km->id}}">
                                                    </td>
                                                    <td>
                                                    <div class="form-group{{ $errors->has('kkmpengetahuan') ? ' has-danger' : '' }}">
                                                    <input style="min-width:100px" type="number" name="kkmpengetahuan[]"
                                                        class="form-control form-control-alternative{{ $errors->has('kkmpengetahuan') ? ' is-invalid' : '' }}"
                                                        placeholder="{{__('KKM Pengetahuan') }}" value="{{ $km->kkmpengetahuan }}">
                                                    @include('dashboard.base.feedback', ['field' => 'kkmpengetahuan'])
                                                </div>
                                                    </td>
                                                    <td>
                                                    <div class="form-group{{ $errors->has('kkmketerampilan') ? ' has-danger' : '' }}">
                                                    <input style="min-width:100px" type="number" name="kkmketerampilan[]"
                                                        class="form-control form-control-alternative{{ $errors->has('kkmketerampilan') ? ' is-invalid' : '' }}"
                                                        placeholder="{{__('KKM keterampilan') }}" value="{{ $km->kkmketerampilan }}">
                                                    @include('dashboard.base.feedback', ['field' => 'kkmketerampilan'])
                                                </div>
                                                    </td>
                                                    <td >
                                                    <div class="form-group{{ $errors->has('nilaitugas') ? ' has-danger' : '' }}">
                                                    <input style="min-width:100px"" type="number" name="nilaitugas[]"
                                                        class="form-control form-control-alternative{{ $errors->has('nilaitugas') ? ' is-invalid' : '' }}"
                                                        placeholder="{{__('Nilai Tugas') }}" value="{{ $km->nilaitugas }}">
                                                    @include('dashboard.base.feedback', ['field' => 'nilaitugas'])
                                                </div>
                                                    </td>

                                                     <td >
                                                    <div class="form-group{{ $errors->has('nilaitugas_dua') ? ' has-danger' : '' }}">
                                                    <input style="min-width:100px" type="number" name="nilaitugas_dua[]"
                                                        class="form-control form-control-alternative{{ $errors->has('nilaitugas_dua') ? ' is-invalid' : '' }}"
                                                        placeholder="{{__('Nilai Tugas 2') }}" value="{{ $km->nilaitugas_dua }}">
                                                    @include('dashboard.base.feedback', ['field' => 'nilaitugas_dua'])
                                                </div>
                                                    </td>

                                                     <td >
                                                    <div class="form-group{{ $errors->has('nilaitugas_tiga') ? ' has-danger' : '' }}">
                                                    <input style="min-width:100px" type="number" name="nilaitugas_tiga[]"
                                                        class="form-control form-control-alternative{{ $errors->has('nilaitugas_tiga') ? ' is-invalid' : '' }}"
                                                        placeholder="{{__('Nilai Tugas 3') }}" value="{{ $km->nilaitugas_tiga }}">
                                                    @include('dashboard.base.feedback', ['field' => 'nilaitugas_tiga'])
                                                </div>
                                                    </td>
                                                    <td >
                                                    <div class="form-group{{ $errors->has('ulanganharian') ? ' has-danger' : '' }}">
                                                    <input style="min-width:100px" type="number" name="ulanganharian[]"
                                                        class="form-control form-control-alternative{{ $errors->has('ulanganharian') ? ' is-invalid' : '' }}"
                                                        placeholder="{{__('ulangan harian') }}" value="{{ $km->ulanganharian }}">
                                                    @include('dashboard.base.feedback', ['field' => 'ulanganharian'])
                                                </div>
                                                    </td>

                                                      <td >
                                                    <div class="form-group{{ $errors->has('ulanganharian_dua') ? ' has-danger' : '' }}">
                                                    <input style="min-width:100px" type="number" name="ulanganharian_dua[]"
                                                        class="form-control form-control-alternative{{ $errors->has('ulanganharian_dua') ? ' is-invalid' : '' }}"
                                                        placeholder="{{__('ulangan harian 2') }}" value="{{ $km->ulanganharian_dua }}">
                                                    @include('dashboard.base.feedback', ['field' => 'ulanganharian_dua'])
                                                </div>
                                                    </td>
                                                      <td >
                                                    <div class="form-group{{ $errors->has('ulanganharian_tiga') ? ' has-danger' : '' }}">
                                                    <input style="min-width:100px" type="number" name="ulanganharian_tiga[]"
                                                        class="form-control form-control-alternative{{ $errors->has('ulanganharian_tiga') ? ' is-invalid' : '' }}"
                                                        placeholder="{{__('ulangan harian 3') }}" value="{{ $km->ulanganharian_tiga }}">
                                                    @include('dashboard.base.feedback', ['field' => 'ulanganharian_tiga'])
                                                </div>
                                                    </td>
                                                    <td >
                                                    <div  class="form-group{{ $errors->has('uts') ? ' has-danger' : '' }}">
                                                    <input style="min-width:100px"type="number" name="uts[]"
                                                        class="form-control form-control-alternative{{ $errors->has('uts') ? ' is-invalid' : '' }}"
                                                        placeholder="{{__('UTS') }}" value="{{ $km->uts }}">
                                                    @include('dashboard.base.feedback', ['field' => 'uts'])
                                                </div>
                                                    </td>
                                                    <td >
                                                    <div class="form-group{{ $errors->has('uas') ? ' has-danger' : '' }}">
                                                    <input style="min-width:100px" type="number" name="uas[]"
                                                        class="form-control form-control-alternative{{ $errors->has('uas') ? ' is-invalid' : '' }}"
                                                        placeholder="{{__('UAS') }}" value="{{ $km->uas }}">
                                                    @include('dashboard.base.feedback', ['field' => 'uas'])
                                                </div>
                                                    </td>
                                                    <td >
                                                    <div class="form-group{{ $errors->has('keterangan') ? ' has-danger' : '' }}">
                                                    <textarea style="min-width:200px"  name="keterangan[]" class="form-control">
                                                            {{ $km->keterangan }}
                                                    </textarea>

                                                    @include('dashboard.base.feedback', ['field' => 'keterangan'])
                                                </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="11">
                                                </td>
                                                <td colspan="2">
                                                    <button type="submit" class="btn btn-success btn-sm" >
                                                        {{__('Masukan Dan Simpan') }}
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
<!-- <script src="{{ asset('DataTables') }}/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
<script src="{{ asset('DataTables')}}/datatables.min.js"></script>
<script
src="{{ asset('DataTables')}}/DataTables-1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
        $('#Alkdj').DataTable();
    });
</script> -->
@endsection

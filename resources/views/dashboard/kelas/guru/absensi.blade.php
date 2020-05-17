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
                        <h6>{{__('Abesensi siswa/i Semester-') . $semester }}</h6>
                        @include('dashboard.base.success')
                        <form method="post" action="{{ route('attendees.attendeesUpdate',['kelas'=>$kls->id ,'semester'=>$semester] )}}">

                        {{ csrf_field () }}
                        @method('put')
                        <div class="table-responsive">
                            <table
                                class=" table  table-sm table-hover table-bordered table-condensed"
                                cellspacing="0"
                                style="font-size:12px ;widht:100%"
                                id="Alkdj">
                                <thead>
                                    <tr>
                                        <th>Nis</th>
                                        <th>Nama</th>
                                        <th>Smt</th>
                                        <th>Hadir</th>
                                        <th>Sakit</th>
                                        <th>Izin</th>
                                        <th>Alpa</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($data as $dt)
                                        <tr>
                                            <td>
                                                <input type="hidden" name="id[]" value="{{$dt->id}}">
                                                {{ $dt->class_student->student->nisn }}
                                            </td>
                                            <td>
                                                {{ $dt->class_student->student->nama }}
                                            </td>
                                            <td>
                                                {{ $dt->semester }}
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('hadir') ? ' has-danger' : '' }}">
                                                    <input type="number" name="hadir[]"
                                                        class="form-control form-control-alternative{{ $errors->has('hadir') ? ' is-invalid' : '' }}"
                                                        placeholder="{{ __('Hadir') }}" value="{{ $dt->hadir }}">
                                                    @include('dashboard.base.feedback', ['field' => 'hadir'])
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('sakit') ? ' has-danger' : '' }}">
                                                    <input type="number" name="sakit[]"
                                                        class="form-control form-control-alternative{{ $errors->has('sakit') ? ' is-invalid' : '' }}"
                                                        placeholder="{{ __('Sakit') }}" value="{{ $dt->sakit }}">
                                                    @include('dashboard.base.feedback', ['field' => 'sakit'])
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group{{ $errors->has('izin') ? ' has-danger' : '' }}">
                                                    <input type="number" name="izin[]"
                                                        class="form-control form-control-alternative{{ $errors->has('izin') ? ' is-invalid' : '' }}"
                                                        placeholder="{{ __('Izin') }}" value="{{ $dt->ijin }}">
                                                    @include('dashboard.base.feedback', ['field' => 'izin'])
                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group{{ $errors->has('alpha') ? ' has-danger' : '' }}">
                                                    <input type="number" name="alpha[]"
                                                        class="form-control form-control-alternative{{ $errors->has('alpha') ? ' is-invalid' : '' }}"
                                                        placeholder="{{ __('Alpha') }}" value="{{ $dt->alpha }}">
                                                    @include('dashboard.base.feedback', ['field' => 'alpha'])
                                                </div>
                                            </td>
                                            <td >

                                                    <textarea name="keterangan[]" class="small text-left form-control form-control-alternative{{ $errors->has('keterangan') ? ' is-invalid' : '' }}" placeholder="{{__('keterangan')}}">
                                                    {{ $dt->Keterangan }}
                                                </textarea>

                                                    @include('dashboard.base.feedback', ['field' => 'keterangan'])

                                            </td>
                                        </tr>

                                    @endforeach()
                                    <tr>
                                            <td colspan="6"></td>
                                            <td colspan="2">
                                                <button type="submit" class="btn btn-success">Simpan Absensi</button>
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

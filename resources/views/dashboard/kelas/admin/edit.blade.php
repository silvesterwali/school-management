@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-users"></i>{{ __('Edit Kelas') }}
                        <a href="{{ route('kelas.index') }}"
                            class="btn btn-success float-right ">{{ __('kembali') }}</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('kelas.update',$kls->id) }}" method="post">
                            @method('put')
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-sm-12">
                                    <h4>Infomasi Kelas</h4>
                                    @include('dashboard.base.success')
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('kode_kelas') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-name">{{ __('KODE KELAS') }}</label>
                                        <input type="text" name="kode_kelas" id="input-name"
                                            class="form-control form-control-alternative {{ $errors->has('kode_kelas') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Kode Kelas') }}" value="{{ $kls->kdkelas }}">
                                        @include('dashboard.base.feedback', ['field' => 'kode_kelas'])
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('namakelas') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-name">{{ __('Nama Kelas') }}</label>
                                        <input type="text" name="namakelas"
                                            class="form-control form-control-alternative{{ $errors->has('namakelas') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama Kelas') }}" value="{{ $kls->namakelas }}">
                                        @include('dashboard.base.feedback', ['field' => 'namakelas'])
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="form-control-label">{{__('Status')}}</label>
                                        <div class="form-check  form-check-radio">
                                            <label class="form-check-label">
                                                <input name="status"
                                                    class="form-check-input {{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                    type="radio" value="1"
                                                    {{ $kls->isActive
                                                        == 1 ? 'checked' : ''}}>
                                                Aktive
                                                <span class="form-check-sign">

                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check  form-check-radio">
                                            <label class="form-check-label">
                                                <input name="status"
                                                    class="form-check-input {{ $errors->has('status') ? ' is-invalid' : '' }}"
                                                    type="radio" value="0" {{ $kls->isActive == 0 ? 'checked' : ''}}>
                                                Non Active
                                                <span class="form-check-sign">

                                                </span>
                                            </label>
                                        </div>
                                        @include('dashboard.base.feedback', ['field' => 'status'])
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group {{ $errors->has('grade') ? 'has-danger': '' }}">
                                        <label>{{__('Grade')}}</label>
                                        <select class="form-control" name="grade">
                                            <option value="">Pilih grade</option>
                                            <option value="1" {{ $kls->grade == 1 ? 'selected' : '' }}> {{__('Grade 1')}} </option>
                                            <option value="2" {{ $kls->grade == 2 ? 'selected' : '' }}> {{__('Grade 2')}} </option>
                                            <option value="3" {{ $kls->grade == 3 ? 'selected' : '' }}> {{__('Grade 3')}} </option>

                                        </select>
                                        @include('dashboard.base.feedback', ['field' => 'grade'])
                                    </div>
                                    <em>Grade akan mempermudah meneukan siswa dengan grade yang sama</em>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group {{ $errors->has('tahun_ajaran') ? 'has-danger': '' }}">
                                        <label>{{__('Tahun Ajaran')}}</label>
                                        <select class="form-control" name="tahun_ajaran">
                                            <option value="">Pilih tahun_ajaran</option>
                                            @foreach($tahun_ajaran as $tahun_ajaran)
                                            <option value="{{ $tahun_ajaran->id }}"
                                                {{ $kls->school_year_id == $tahun_ajaran->id ? 'selected' : '' }}>
                                                {{ $tahun_ajaran->tahunajaran }}
                                            </option>
                                            @endforeach
                                        </select>
                                        @include('dashboard.base.feedback', ['field' => 'grade'])
                                    </div>
                                    <em>Pilih Tahun ajaran untuk memastikan kelas ini berlangsung apa tahun ajaran yang tepat</em>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group {{ $errors->has('guru') ? 'has-danger': '' }}">
                                        <label>{{__('Guru Wali kelas')}}</label>
                                        <select class="form-control" name="guru">
                                            <option value="">Pilih guru</option>
                                            @foreach($guru as $g)
                                            <option value="{{ $g->id }}"
                                                {{ $kls->teacher_id == $g->id ? 'selected' : '' }}>{{ $g->nama }}
                                            </option>
                                            @endforeach

                                        </select>
                                        @include('dashboard.base.feedback', ['field' => 'guru'])
                                    </div>
                                    <em>Pilih guru wali kelas</em>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Simpan dan Update</button>
                                    </div>
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

@endsection

@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-users"></i>{{ __('Menambah Mata Pelajaran') }}
                        <a href="{{ route('mapel.index') }}"
                            class="btn btn-success float-right ">{{ __('kembali') }}</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('mapel.store') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-sm-12">
                                    <h4>Infomasi Mata Pelajaran</h4>
                                    @include('dashboard.base.success')
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('kode_mapel') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-name">{{ __('KODE MAPEL') }}</label>
                                        <input type="text" name="kode_mapel" id="input-name"
                                            class="form-control form-control-alternative {{ $errors->has('kode_mapel') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Kode Mapel') }}" value="{{ old('kode_mapel') }}">
                                        @include('dashboard.base.feedback', ['field' => 'kode_mapel'])
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('nisn') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-name">{{ __('Nama Matapelajaran') }}</label>
                                        <input type="text" name="nama_matapelajaran"
                                            class="form-control form-control-alternative{{ $errors->has('nama_matapelajaran') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama Matapelajaran') }}"
                                            value="{{ old('nama_matapelajaran') }}">
                                        @include('dashboard.base.feedback', ['field' => 'nama_matapelajaran'])
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('kkmpengetahuan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-name">{{ __('KKM Pengetahuan') }}</label>
                                        <input type="number" name="kkmpengetahuan"
                                            class="form-control form-control-alternative {{ $errors->has('kkmpengetahuan') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('KKM Pengetahuan') }}"
                                            value="{{ old('kkmpengetahuan') }}">
                                        @include('dashboard.base.feedback', ['field' => 'kkmpengetahuan'])
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('kkmketerampilan') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-name">{{ __('KKM Keterampilan') }}</label>
                                        <input type="number" name="kkmketerampilan"
                                            class="form-control form-control-alternative {{ $errors->has('kkmketerampilan') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('KKM Keterampilan') }}"
                                            value="{{ old('kkmketerampilan') }}">
                                        @include('dashboard.base.feedback', ['field' => 'kkmketerampilan'])
                                    </div>
                                </div>



                                <div class="col-sm-3">
                                    <div class="form-group {{ $errors->has('kelompokmapel') ? 'has-danger': '' }}">
                                        <label>{{__('Kelompok Mapel')}}</label>
                                        <select class="form-control" name="kelompokmapel">
                                            <option value="">Pilih kelompok Mapel</option>
                                            <option value="IPA" {{ old('kelompokmapel') == 'IPA' ? 'selected' : ''}}>IPA</option>
                                            <option value="IPS" {{ old('kelompokmapel') == 'IPS' ? 'selected' : ''}}>IPS</option>
                                            <option value="BHS" {{ old('kelompokmapel') == 'BHS' ? 'selected' : ''}}>BHS</option>
                                            <option value="UMUM" {{ old('kelompokmapel') == 'UMUM' ? 'selected' : ''}}>UMUM</option>

                                        </select>
                                        @include('dashboard.base.feedback', ['field' => 'kelompokmapel'])
                                    </div>
                                    <em>pilih kelompok mapel</em>
                                </div>






                                <div class="col-sm-3">
                                    <div class="form-group {{ $errors->has('grade') ? 'has-danger': '' }}">
                                        <label>{{__('Grade')}}</label>
                                        <select class="form-control" name="grade">
                                            <option value="">Pilih grade</option>
                                            <option value="1" {{ old('grade') == 1 ? 'selected' : ''}}>1</option>
                                            <option value="2" {{ old('grade') == 2 ? 'selected' : ''}}>2</option>
                                            <option value="3" {{ old('grade') == 3 ? 'selected' : ''}}>3</option>

                                        </select>
                                        @include('dashboard.base.feedback', ['field' => 'grade'])
                                    </div>
                                    <em>Grade bertujuan untuk mengetahui kelas atau tingkat mana belaku</em>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group {{ $errors->has('guru') ? 'has-danger': '' }}">
                                        <label>{{__('Guru Pengajar')}}</label>
                                        <select class="form-control" name="guru">
                                            <option value="">Pilih guru</option>
                                            @foreach($guru as $g)
                                                <option value="{{ $g->id }}" {{ old('guru') == $g->id ? 'selected' : '' }}>{{ $g->nama }} </option>
                                            @endforeach

                                        </select>
                                        @include('dashboard.base.feedback', ['field' => 'guru'])
                                    </div>
                                    <em>Pilih guru yang mengajar mapel ini </em>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Simpan</button>
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

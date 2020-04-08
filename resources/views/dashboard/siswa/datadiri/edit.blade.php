@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-users"></i>{{ Auth::user()->student->nama }}
                        <a href="{{ url('/') }}"
                            class="btn btn-success float-right ">{{ __('kembali') }}</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('data_diri_siswa.update',$siswa->id) }}" method="post">
                            {{ csrf_field() }}
                            @method('put')
                            <div class="form-row">
                                <div class="col-sm-12">
                                    <h4>Infomasi Siswa/i</h4>
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('nisn') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('NISN') }}</label>
                                        <input type="text" name="nisn" id="input-name"
                                            class="form-control form-control-alternative {{ $errors->has('nisn') ? ' is-invalid' : '' }}"
                                            readonly
                                            placeholder="{{ __('NISN') }}" value="{{ $siswa->nisn }}">
                                        @include('dashboard.base.feedback', ['field' => 'nisn'])
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('nisn') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Nama') }}</label>
                                        <input type="text" name="nama"
                                            class="form-control form-control-alternative{{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama') }}" value="{{ $siswa->nama }}">
                                        @include('dashboard.base.feedback', ['field' => 'nama'])
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label class="form-control-label">{{__('Jenis Kelamin')}}</label>
                                        <div class="form-check  form-check-radio">
                                            <label class="form-check-label">
                                                <input name="jk"
                                                    class="form-check-input {{ $errors->has('jk') ? ' is-invalid' : '' }}"
                                                    type="radio" value="1" {{ $siswa->jk == 1 ? 'checked' : ''}}>
                                                Laki-laki
                                                <span class="form-check-sign">

                                                </span>
                                            </label>
                                        </div>
                                        <div class="form-check  form-check-radio">
                                            <label class="form-check-label">
                                                <input name="jk"
                                                    class="form-check-input {{ $errors->has('jk') ? ' is-invalid' : '' }}"
                                                    type="radio" value="0" {{ $siswa->jk == 0 ? 'checked' : ''}}>
                                                Perempuan
                                                <span class="form-check-sign">

                                                </span>
                                            </label>
                                        </div>
                                        @include('dashboard.base.feedback', ['field' => 'jk'])
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('tempat_lahir') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-name">{{ __('Tempat Lahir') }}</label>
                                        <input type="text" name="tempat_lahir"
                                            class="form-control form-control-alternative{{ $errors->has('tempat_lahir') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Tempat lahir') }}"
                                            value="{{ $siswa->tempatlahir }}">
                                        @include('dashboard.base.feedback', ['field' => 'tempat_lahir'])
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('tanggal_lahir') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                            for="input-name">{{ __('Tanggal Lahir') }}</label>
                                        <input type="date" name="tanggal_lahir"
                                            class="form-control form-control-alternative{{ $errors->has('tanggal_lahir') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Tanggal lahir') }}"
                                            value="{{ $siswa->tanggallahir }}">
                                        @include('dashboard.base.feedback', ['field' => 'tanggal_lahir'])
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('agama') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Agama') }}</label>
                                        <input type="text" name="agama"
                                            class="form-control form-control-alternative{{ $errors->has('agama') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Agama') }}" value="{{ $siswa->agama }}">
                                        @include('dashboard.base.feedback', ['field' => 'agama'])
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('nama_ayah') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Nama Ayah') }}</label>
                                        <input type="text" name="nama_ayah"
                                            class="form-control form-control-alternative{{ $errors->has('nama_ayah') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama Ayah') }}" value="{{ $siswa->namaayah }}">
                                        @include('dashboard.base.feedback', ['field' => 'nama_ayah'])
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('nama_ibu') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Nama Ibu') }}</label>
                                        <input type="text" name="nama_ibu"
                                            class="form-control form-control-alternative{{ $errors->has('nama_ibu') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama Ibur') }}" value="{{ $siswa->namaibu }}">
                                        @include('dashboard.base.feedback', ['field' => 'nama_ibu'])
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('wali') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Nama Wali') }}</label>
                                        <input type="text" name="wali"
                                            class="form-control form-control-alternative{{ $errors->has('wali') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Nama Wali') }}" value="{{ $siswa->namawali  }}">
                                        @include('dashboard.base.feedback', ['field' => 'wali'])
                                    </div>
                                </div>



                                <div class="clearfix"></div>
                                <div class="col-sm-6 col-xl-6">
                                    <div class="form-group {{ $errors->has('alamat') ? 'has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Alamat') }}</label>
                                        <textarea name="alamat" placeholder="Alamat Guru"
                                            class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Alamat') }}">{{ $siswa->alamatorangtuawali }} </textarea>
                                        @include('dashboard.base.feedback', ['field' => 'alamat'])
                                    </div>
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

@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-users"></i>{{ __('Menambah Guru/staff') }}
                         <a href="{{ route('guru.index') }}" class="btn btn-success float-right ">{{ __('kembali') }}</a>
                      </div>

                    <div class="card-body">
                       <form action="{{ route('guru.store') }}" method="post">
					{{ csrf_field() }}
                    <div class="form-row">
						<div class="col-sm-12">
							<h4>Infomasi Guru/Staff</h4>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-3">
							<div class="form-group{{ $errors->has('nip') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('NIP') }}</label>
								<input type="text" name="nip" id="input-name" class="form-control form-control-alternative {{ $errors->has('nip') ? ' is-invalid' : '' }}" placeholder="{{ __('NIP') }}" value="{{ old('nip') }}" >
								@include('dashboard.base.feedback', ['field' => 'nip'])
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group{{ $errors->has('nama') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('Nama') }}</label>
								<input type="text" name="nama"  class="form-control form-control-alternative{{ $errors->has('nama') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama') }}" value="{{ old('nama') }}" >
								@include('dashboard.base.feedback', ['field' => 'nama'])
							</div>
						</div>


						<div class="col-sm-3">
							<div class="form-group{{ $errors->has('jenjang_pendidikan') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('Jenjang pendidikan') }}</label>
								<input type="text" name="jenjang_pendidikan"  class="form-control form-control-alternative{{ $errors->has('jenjang_pendidikan') ? ' is-invalid' : '' }}" placeholder="{{ __('jenjeng pendidikan') }}" value="{{ old('jenjang_pendidikan') }}" >
								@include('dashboard.base.feedback', ['field' => 'jenjang_pendidikan'])
							</div>
						</div>





						<div class="clearfix"></div>
						<div class="col-sm-6 col-xl-6">
							<div class="form-group {{ $errors->has('alamat') ? 'has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('Alamat') }}</label>
								<textarea name="alamat"  placeholder="Alamat Guru" class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" >{{ old('alamat') }} </textarea>
								@include('dashboard.base.feedback', ['field' => 'alamat'])
							</div>
						</div>


                                   <div class="col-sm-3 col-xl-3">
                                        <div class ="form-group {{$errors->has('tanggal_gabung')?'has-danger':'' }}">
                                        <label class="form-control-label">{{__('Tanggal Bergabung')}}</label>
                                        <input name="tanggal_gabung" type="date" value="{{old('tanggal_gabung')}}" class="form-control {{ $errors->has('tanggal_gabung')?'is-invalid':''}}" placeholder="Tanggal Masuk"  >
                                             @include('dashboard.base.feedback', ['field' => 'tanggal_gabung'])
                                        </div>
                                   </div>


							 <div class="col-sm-3 col-xl-3">
                                        <div class ="form-group {{$errors->has('nohp')?'has-danger':'' }}">
                                        <label class="form-control-label">{{__('No HP')}}</label>
                                        <input name="nohp" type="text" value="{{old('nohp')}}" class="form-control {{ $errors->has('nohp')?'is-invalid':''}}" placeholder="nohp"  >
                                             @include('dashboard.base.feedback', ['field' => 'nohp'])
                                        </div>
                                   </div>



                                   <div class="col-sm-3">
                                        <div class="form-group {{ $errors->has('status') ? 'has-danger': '' }}">
                                             <label>{{__('Status')}}</label>
                                             <select class="form-control" name="status">
                                             	<option value="" >Pilih Status</option>
										<option value="0"  {{ old('status') == 0 ? 'selected' : ''}} >Non Aktif</option>
                                                  <option value="1"  {{ old('status') == 1 ? 'selected' : ''}} >Aktif</option>
                                                  <option value="2"  {{ old('status') == 2 ? 'selected' : ''}} >Pensiun</option>

                                             </select>
                                                  @include('dashboard.base.feedback', ['field' => 'status'])
                                        </div>
                                   </div>



                                   <div class="col-sm-3">
                                        <div class="form-group {{ $errors->has('jabatan') ? 'has-danger': '' }}">
                                             <label>{{__('Akses sebagai')}}</label>
                                             <select class="form-control" name="jabatan" >
                                             	<option value=""  >Pilih jabatan akses</option>
										<option value="guru"  {{ old('jabatan') == 'guru' ? 'selected' : ''}} >Guru</option>
                                                  <option value="pegawai"  {{ old('jabatan') == 'pegawai' ? 'selected' : ''}} >Pegawai</option>
                                                  <option value="admin"  {{ old('jabatan') == 'admin' ? 'selected' : ''}} >admin</option>

                                             </select>
                                                  @include('dashboard.base.feedback', ['field' => 'status'])
										<em>Untuk membedakan hak akses ketika menggunakan sistem</em>
                                        </div>
                                   </div>




						<div class="clearfix"></div>
						<div class="col-sm-12">
							<h5>Infomasi Akses</h5>
						</div>


						<div class="col-sm-3">
							<div class="form-group{{ $errors->has('username') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('Username ') }}</label>
								<input type="text" name="username"  class="form-control form-control-alternative{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="{{ __('Username') }}" value="{{ old('username') }}" >
								@include('dashboard.base.feedback', ['field' => 'username'])
							</div>
						</div>


						<div class="col-sm-3">
							<div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('Email/Kode Akses ') }}</label>
								<input type="text" name="kode_akses"  class="form-control form-control-alternative{{ $errors->has('kode_akses') ? ' is-invalid' : '' }}" placeholder="{{ __('Email/Kode akses') }}" value="{{ old('kode_akses') }}" >
								@include('dashboard.base.feedback', ['field' => 'kode_akses'])
								<em>Kode akses untuk login ke sistem</em>
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('Password') }}</label>
								<input type="password" name="password"  class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('Password') }}" value="{{ old('password') }}" >
								@include('dashboard.base.feedback', ['field' => 'password'])
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group{{ $errors->has('password_confirmation') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('Konfirmasi Password') }}</label>
								<input type="password" name="password_confirmation"  class="form-control form-control-alternative{{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" placeholder="{{ __('Konfirmasi Password') }}" value="{{ old('password_confirmation') }}" >
								@include('dashboard.base.feedback', ['field' => 'password_confirmation'])
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

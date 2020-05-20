@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-users"></i>{{ __('Edit Guru/staff') }}
                         <a href="{{ route('guru.index') }}" class="btn btn-success float-right ">{{ __('kembali') }}</a>
                      </div>

                    <div class="card-body">
                       <form action="{{ route('guru.update',$guru->id) }}" method="post">
                         @method('put')
					{{ csrf_field() }}
                    <div class="form-row">
						<div class="col-sm-12">
							<h4>Infomasi Guru/Staff</h4>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-3">
							<div class="form-group{{ $errors->has('nip') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('NIP') }}</label>
								<input type="text" name="nip" id="input-name"
                                        class="form-control form-control-alternative {{ $errors->has('nip') ? ' is-invalid' : '' }}"
                                         placeholder="{{ __('NIP') }}" value="{{ $guru->nip }}" >
								@include('dashboard.base.feedback', ['field' => 'nip'])
							</div>
						</div>

						<div class="col-sm-3">
							<div class="form-group{{ $errors->has('nama') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('Nama') }}</label>
								<input type="text" name="nama"  class="form-control form-control-alternative{{ $errors->has('nama') ? ' is-invalid' : '' }}" placeholder="{{ __('Nama') }}" value="{{ $guru->nama }}" >
								@include('dashboard.base.feedback', ['field' => 'nama'])
							</div>
						</div>


						<div class="col-sm-3">
							<div class="form-group{{ $errors->has('jenjang_pendidikan') ? ' has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('Jenjang pendidikan') }}</label>
								<input type="text" name="jenjang_pendidikan"  class="form-control form-control-alternative{{ $errors->has('jenjang_pendidikan') ? ' is-invalid' : '' }}" placeholder="{{ __('jenjeng pendidikan') }}" value="{{ $guru->jenjangpendidikan }}" >
								@include('dashboard.base.feedback', ['field' => 'jenjang_pendidikan'])
							</div>
						</div>





						<div class="clearfix"></div>
						<div class="col-sm-6 col-xl-6">
							<div class="form-group {{ $errors->has('alamat') ? 'has-danger' : '' }}">
								<label class="form-control-label" for="input-name">{{ __('Alamat') }}</label>
								<textarea name="alamat"  placeholder="Alamat Guru" class="form-control form-control-alternative{{ $errors->has('alamat') ? ' is-invalid' : '' }}" placeholder="{{ __('Alamat') }}" >{{ $guru->alamat }} </textarea>
								@include('dashboard.base.feedback', ['field' => 'alamat'])
							</div>
						</div>


                                   <div class="col-sm-3 col-xl-3">
                                        <div class ="form-group {{$errors->has('tanggal_gabung')?'has-danger':'' }}">
                                        <label class="form-control-label">{{__('Tanggal Bergabung')}}</label>
                                        <input name="tanggal_gabung" type="date" value="{{ $guru->tanggalgabung }}" class="form-control {{ $errors->has('tanggal_gabung')?'is-invalid':''}}" placeholder="Tanggal Masuk"  >
                                             @include('dashboard.base.feedback', ['field' => 'tanggal_gabung'])
                                        </div>
                                   </div>


							 <div class="col-sm-3 col-xl-3">
                                        <div class ="form-group {{$errors->has('nohp')?'has-danger':'' }}">
                                        <label class="form-control-label">{{__('No HP')}}</label>
                                        <input name="nohp" type="text" value="{{ $guru->notelp}}" class="form-control {{ $errors->has('nohp')?'is-invalid':''}}" placeholder="nohp"  >
                                             @include('dashboard.base.feedback', ['field' => 'nohp'])
                                        </div>
                                   </div>



                                   <!-- <div class="col-sm-3">
                                        <div class="form-group {{ $errors->has('status') ? 'has-danger': '' }}">
                                             <label>{{__('Status')}}</label>
                                             <select class="form-control" name="status">
                                             	<option value="" >Pilih Status</option>
										<option value="0"  {{ $guru->status == 0 ? 'selected' : ''}} >Non Aktif</option>
                                                  <option value="1"  {{ $guru->status == 1 ? 'selected' : ''}} >Aktif</option>
                                                  <option value="2"  {{ $guru->status == 2 ? 'selected' : ''}} >Pensiun</option>

                                             </select>
                                                  @include('dashboard.base.feedback', ['field' => 'status'])
                                        </div>
                                   </div>
 -->


                                   <div class="col-sm-3">
                                        <div class="form-group {{ $errors->has('jabatan') ? 'has-danger': '' }}">
                                             <label>{{__('Akses sebagai')}}</label>
                                             <select class="form-control" name="jabatan" >
                                             	<option value=""  >Pilih jabatan akses</option>
										<option value="guru"  {{ $guru->user->menuroles == 'guru' ? 'selected' : ''}} >Guru</option>
                                                  <option value="pegawai"  {{ $guru->user->menuroles == 'pegawai' ? 'selected' : ''}} >Pegawai</option>
                                                  <option value="admin"  {{ $guru->user->menuroles == 'admin' ? 'selected' : ''}} >admin</option>

                                             </select>
                                                  @include('dashboard.base.feedback', ['field' => 'status'])
										<em>Untuk membedakan hak akses ketika menggunakan sistem</em>
                                        </div>
                                   </div>


						<div class="col-sm-12">
							<div class="form-group">
								<button type="submit" class="btn btn-success">Simpan dan update</button>
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

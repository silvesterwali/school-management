@extends('dashboard.base')

@section('content')

        <div class="container-fluid">
          <div class="animated fadeIn">
            <div class="row">
              <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                      <i class="fa fa-users"></i>{{ __('Edit Guru/staff') }}
                         <a href="{{ route('guru_data_diri.index') }}" class="btn btn-success float-right ">{{ __('kembali') }}</a>
                      </div>

                    <div class="card-body">
                       <form action="{{ route('guru_data_diri.update',$guru->id) }}" method="post">
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
                                            readonly
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
                                        <div class ="form-group {{$errors->has('nohp')?'has-danger':'' }}">
                                        <label class="form-control-label">{{__('No HP')}}</label>
                                        <input name="nohp" type="text" value="{{ $guru->notelp}}" class="form-control {{ $errors->has('nohp')?'is-invalid':''}}" placeholder="nohp"  >
                                             @include('dashboard.base.feedback', ['field' => 'nohp'])
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

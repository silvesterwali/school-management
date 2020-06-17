@extends('dashboard.base') @section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>{{ __('User access') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <a href="{{ url('/') }}" class="btn btn-success m-2">{{ __('Kembali') }}</a>
                        </div>
                        <br>
                         @include('dashboard.base.success')
                        <form action="{{ route('userAccess.update',$user->id) }}" method="post">
                             @method('put')
                            {{ csrf_field() }}
                            <div class="form-row">


                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('Name') }}</label>
                                        <input
                                            type="text"
                                            name="name"
                                            value="{{ $user->name }}"
                                            id="input-name"
                                            class="form-control form-control-alternative {{ $errors->has('name') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Name') }}">
                                        @include('dashboard.base.feedback', ['field' => 'name'])
                                    </div>
                                </div>


                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                        <input
                                            type="text"
                                            name="email"
                                            value="{{ $user->email }}"
                                            id="input-email"
                                            class="form-control form-control-alternative {{ $errors->has('email') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Email') }}">
                                        @include('dashboard.base.feedback', ['field' => 'email'])
                                    </div>
                                </div>

                                    <div class="clearfix">
                                     *** jika tidak ingin mengganti password biarkan password lama kosong
                                    </div>

                                <div class="col-sm-3">

                                    <div class="form-group{{ $errors->has('password_lama') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-password-lama">{{ __('Password Lama') }}</label>
                                        <input
                                            type="password"
                                            name="password_lama"
                                            id="input-password-lama"
                                            class="form-control form-control-alternative {{ $errors->has('password_lama') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Password Lama') }}">
                                        @include('dashboard.base.feedback', ['field' => 'password_lama'])
                                    </div>
                                </div>



                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('password_baru') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-password-baru">
                                        {{ __('Password Baru') }}</label>
                                        <input
                                            type="password"
                                            name="password_baru"
                                            id="input-password-baru"
                                            class="form-control form-control-alternative {{ $errors->has('password_baru') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Password Baru') }}"
                                           >
                                        @include('dashboard.base.feedback', ['field' => 'password_baru'])
                                    </div>
                                </div>



                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('password_baru_confirm') ? ' has-danger' : '' }}">
                                        <label class="form-control-label"
                                        for="input-password-baru-confirm">{{ __('Password Baru Konfirm') }}</label>
                                        <input
                                            type="password"
                                            name="password_baru_confirm"
                                            id="input-password_baru_confirm"
                                            class="form-control form-control-alternative {{ $errors->has('password_lama_confirm') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Password Lama Konfirm') }}">
                                        @include('dashboard.base.feedback', ['field' => 'password_baru_confirm'])
                                    </div>
                                </div>


                                <div class="clearfix"></div>
                                <br>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info">Masukan</button>
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

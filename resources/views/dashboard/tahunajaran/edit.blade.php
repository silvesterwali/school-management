@extends('dashboard.base') @section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>{{ __('Tambah Tahun Ajaran') }}</div>
                    <div class="card-body">
                        <div class="row">
                            <a href="{{ route('ta.index') }}" class="btn btn-success m-2">{{ __('Kembali') }}</a>
                        </div>
                        <br>

                        <form action="{{ route('ta.update',$ta->id) }}" method="post">
                            @method('put')
                            {{ csrf_field() }}
                            <div class="form-row">
                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('kode_mapel') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('KODE TA') }}</label>
                                        <input
                                            type="text"
                                            name="kode_ta"
                                            id="input-name"
                                            class="form-control form-control-alternative {{ $errors->has('kode_ta') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Kode TA') }}"
                                            value="{{ $ta->kdtahunajaran }}">
                                        @include('dashboard.base.feedback', ['field' => 'kode_ta'])
                                    </div>
                                </div>

                                <div class="col-sm-3">
                                    <div class="form-group{{ $errors->has('tahun_ajaran') ? ' has-danger' : '' }}">
                                        <label class="form-control-label" for="input-name">{{ __('TAHUN AJARAN') }}</label>
                                        <input
                                            type="text"
                                            name="tahun_ajaran"
                                            id="input-name"
                                            class="form-control form-control-alternative {{ $errors->has('tahun_ajaran') ? ' is-invalid' : '' }}"
                                            placeholder="{{ __('Tahun Ajaran') }}"
                                            value="{{ $ta->tahunajaran }}">
                                        @include('dashboard.base.feedback', ['field' => 'tahun_ajaran'])
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-info">Masukan Dan Update</button>
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

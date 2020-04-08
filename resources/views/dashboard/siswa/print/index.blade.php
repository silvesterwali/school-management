@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-users"></i>  {{ Auth::user()->student->nama }}
                        <a href="{{ url('/') }}"
                            class="btn btn-success float-right ">{{ __('kembali') }}</a>
                    </div>

                    <div class="card-body">
                    @include('dashboard.base.success')
                    <h3>Print Mandiri Nilai Anda</h3>
                        <div class="row">
                            <div class="col-sm-6">
                            @if($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger">{{ $error }}</div>
                                @endforeach
                            @endif
                                <form
                                    action="{{ url('siswa_kelas_print') }}"
                                    method="post"
                                >

                                @csrf
                                    <div class="form-group {{ $errors->has('kelas') ? 'has-danger': '' }}">
                                        <label>{{__('Kelas')}}</label>
                                        <select name="kelas" class="form-control">
                                                <option value="">Pilih Kelas</option>
                                                @foreach($kelas as $k)
                                                    <option value="{{$k->id}}"  {{ old('kelas') == $k->id ? 'selected' : ''}} >{{$k->namakelas}}</option>
                                                @endforeach
                                        </select>
                                        @include('dashboard.base.feedback', ['field' => 'kelas'])

                                    </div>
                                    <div class="form-group {{ $errors->has('semester') ? 'has-danger': '' }}">
                                        <label>{{__('Semester')}}</label>
                                        <select name="semester" class="form-control">
                                                <option value="">Pilih Semester</option>
                                                <option
                                                    value="1"
                                                    {{ old('semester')==1  ? 'selected':''}}
                                                    >
                                                    Semester 1
                                                    </option>
                                                <option
                                                    value="2"
                                                    {{ old('semester')==2 ? 'selected':''}}
                                                    >
                                                    Semeter 2
                                                    </option>
                                        </select>
                                        @include('dashboard.base.feedback', ['field' => 'semester'])
                                    </div>
                                    <div class="form-group">
                                        <button
                                            class="btn btn-success",
                                            type="submit"
                                        >
                                            <i class="fa fa-print"></i>
                                            Cetak
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')

@endsection

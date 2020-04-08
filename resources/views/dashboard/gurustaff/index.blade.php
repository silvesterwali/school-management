@extends('dashboard.base')

@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-users"></i>  {{ Auth::user()->teacher->nama }}
                        <a href="{{ url('/') }}"
                            class="btn btn-success float-right ">{{ __('kembali') }}</a>
                    </div>

                    <div class="card-body">
                    @include('dashboard.base.success')
                        <div class="table-responsive">
                            <table class="tabl table-sm table-borderless" style="font-size:12px">
                                <tr>
                                    <th>
                                        NIP
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $guru->nip}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Nama
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $guru->nama}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Alamat
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $guru->alamat }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Jenjang pendidikan
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $guru->jenjangpendidikan}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        No telp
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $guru->notelp }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Tanggal Gabung
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $guru->tanggalgabung }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        action
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        <a href="{{ route('guru_data_diri.edit',$guru->id) }}"
                                            class="btn btn-warning btn-sm">
                                                Update
                                        </a>
                                    </td>
                                </tr>
                            </table>
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

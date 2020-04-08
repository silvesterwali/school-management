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
                        <div class="table-responsive">
                            <table class="tabl table-sm table-borderless" style="font-size:12px">
                                <tr>
                                    <th>
                                        NISN
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $siswa->nisn}}
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
                                        {{ $siswa->nama}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        JK
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $siswa->jk ==0 ? 'P':'L' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        TTL
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $siswa->tempatlahir }}-{{ $siswa->tanggallahir}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Agama
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $siswa->agama}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Nama Ayah
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $siswa->namaayah}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Nama Ibu
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $siswa->namaibu}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Nama Wali
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $siswa->namawali}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Alamat Orang Tua/Wali
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $siswa->alamatorangtuawali }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Tanggal Daftar
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $siswa->tanggalmasuk}}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Last Grade
                                    </th>
                                    <td>
                                        :
                                    </td>
                                    <td>
                                        {{ $siswa->grade}}
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
                                        <a href="{{ route('data_diri_siswa.edit',$siswa->id) }}"
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

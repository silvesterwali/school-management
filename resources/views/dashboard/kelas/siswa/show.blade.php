@extends('dashboard.base') @section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-users"></i>
                            {{ $kelas->namakelas }}</h3>
                        <h4 class="card-subtitle">Kode Kelas :
                            {{ $kelas->kdkelas}}</h4>
                        <h5>
                            Wali Kelas :
                            {{ $kelas->teacher->nama }}</h5>
                        <h6>
                            Tahun Ajaran :
                            {{ $kelas->school_year->tahunajaran }}
                        </h6>

                        <a
                            href="{{ route('siswa_kelas_akses.index') }}"
                            class="btn btn-success float-right mx-auto">{{ __('kembali') }}</a>
                    </div>
                    <div class="card-body">
                    {!! $nilaiSiswaCharts->container() !!}
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-body p-1">
                        @include('dashboard.base.success')
                        <nav class="p-0">
                            <div class="nav nav-tabs   nav-justified " id="nav-tab" role="tablist">
                                <a
                                    class="nav-item  nav-link active"
                                    id="nav-profile-tab"
                                    data-toggle="tab"
                                    href="#nav-profile"
                                    role="tab"
                                    aria-controls="nav-profile"
                                    aria-selected="false">Mata Pelajaran</a>
                                <a
                                    class="nav-item  nav-link"
                                    id="nav-contact-tab"
                                    data-toggle="tab"
                                    href="#nav-contact"
                                    role="tab"
                                    aria-controls="nav-contact"
                                    aria-selected="false">Nilai Siswa</a>

                                <a
                                    class="nav-item  nav-link"
                                    id="nav-contact-tab"
                                    data-toggle="tab"
                                    href="#nav-absesi"
                                    role="tab"
                                    aria-controls="nav-contact"
                                    aria-selected="false">Absensi</a>
                                <a
                                    class="nav-item  nav-link"
                                    id="nav-contact-tab"
                                    data-toggle="tab"
                                    href="#nav-extrakurikuler"
                                    role="tab"
                                    aria-controls="nav-contact"
                                    aria-selected="false">Extrakurikuler</a>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">

                            <div
                                class="tab-pane active"
                                id="nav-profile"
                                role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                <div class="table-responsive mt-3">
                                    <table class="table table-hover table-sm display table-bordered"  style="font-size:12px ;widht:100%" id="AdminTable">
                                    <thead class="bg-dark">
                                        <tr>
                                        <th>No</th>
                                        <th>KODE MAPEL</th>
                                        <th>MAPEL</th>
                                        <th>PENGAJAR</th>
                                        <th>KKM PENGETAHUAN</th>
                                        <th>KKM KETERAMPILAN</th>
                                        <th>KEL.MAPEL</th>
                                        <th>GRADE</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($mapel as $key =>$mapel)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $mapel->course->kdmapel }}</td>
                                                <td>{{ $mapel->course->mapel }}</td>
                                                <td>{{ $mapel->course->teacher->nama }}</td>
                                                <td>{{ $mapel->course->kkmpengetahuan }}</td>
                                                <td>{{ $mapel->course->kkmketerampilan }}</td>
                                                <td>{{ $mapel->course->kelompokmapel }}</td>
                                                <td>{{ $mapel->course->grade }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    </table>
                                </div>
                                </div>

                            <div
                                class="tab-pane fade"
                                id="nav-contact"
                                role="tabpanel"
                                aria-labelledby="nav-contact-tab">

                                <div class="table-responsive mt-2">
                                    <table class="table table-sm dispaly table-bordered"  id="SpantaTable" style="font-size:12px ;widht:100%">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nip</th>
                                                <th>Guru </th>
                                                <th>Semester</th>
                                                <th>Mapel</th>
                                                <th>KKM Pengetahuan</th>
                                                <th>KKM Keterampilan</th>
                                                <th>Nilai Tugas</th>
                                                <th>Nilai Tugas 2</th>
                                                <th>Nilai Tugas 3</th>
                                                <th>Ulangan Harian</th>
                                                <th>Ulangan Harian 2</th>
                                                <th>Ulangan Harian 3</th>
                                                <th>Uts</th>
                                                <th>Uas</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($nilai as $key=>$nilai)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $nilai->class_course->course->teacher->nip}}</td>
                                                <td>{{ $nilai->class_course->course->teacher->nama }}</td>
                                                <td>{{ $nilai->semester }}</td>
                                                <td>{{ $nilai->class_course->course->mapel }}</td>
                                                <td>{{ $nilai->kkmpengetahuan }}</td>
                                                <td>{{ $nilai->kkmketerampilan }}</td>
                                                <td>{{ $nilai->nilaitugas }}</td>
                                                <td>{{ $nilai->nilaitugas_dua }}</td>
                                                <td>{{ $nilai->nilaitugas_tiga }}</td>
                                                <td>{{ $nilai->ulanganharian }}</td>
                                                <td>{{ $nilai->ulanganharian_dua }}</td>
                                                <td>{{ $nilai->ulanganharian_tiga }}</td>
                                                <td>{{ $nilai->uts }}</td>
                                                <td>{{ $nilai->uas }}</td>
                                                <td>{{ $nilai->keterangan }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            <div
                                class="tab-pane fade"
                                id="nav-absesi"
                                role="tabpanel"
                                aria-labelledby="nav-absensi-tab">
                                <div class="table-responsie">
                                <table class="table table-sm dispaly table-bordered" style="font-size:12px ;widht:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>semester</th>
                                            <th>Hadir</th>
                                            <th>Sakit</th>
                                            <th>Izin</th>
                                            <th>Alpha</th>
                                            <td>Keterangan</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($absen as $key =>$absen)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $absen->semester}}</td>
                                                <td>{{ $absen->hadir}}</td>
                                                <td>{{ $absen->sakit}}</td>
                                                <td>{{ $absen->ijin}}</td>
                                                <td>{{ $absen->alpha}}</td>
                                                <td>{{ $absen->keterangan}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>
                            </div>

                            <div
                                class="tab-pane fade"
                                id="nav-extrakurikuler"
                                role="tabpanel"
                                aria-labelledby="nav-absensi-tab">
                                <!-- untuk menambahkan absensi siswa/siswi -->
                                <div class="table-responsie">
                                <table class="table table-sm dispaly table-bordered" style="font-size:12px ;widht:100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama kegiatan</th>
                                            <th>keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($extra as $key =>$extra)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $extra->kegiatatanextrakurikuler}}</td>
                                                <td>{{ $extra->keterangan}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection @section('javascript')
{{-- ChartScript --}}
        @if($nilaiSiswaCharts)
            {!! $nilaiSiswaCharts->script() !!}
            @endif
<script src="{{ asset('DataTables') }}/jQuery-3.3.1/jquery-3.3.1.min.js"></script>
<script src="{{ asset('DataTables')}}/datatables.min.js"></script>
<script
src="{{ asset('DataTables')}}/DataTables-1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/charts.js') }}"></script>
@endsection

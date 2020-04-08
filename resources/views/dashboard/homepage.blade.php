    @extends('dashboard.base') @section('content')

    <div class="container-fluid">
        <div class="fade-in">
                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card mb-3">
                            <img src="{{ URL::to('/assets/img/SEKOLAH-DEPAN-1240x400.jpg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                                <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">VISI</h3>
                            </div>
                            <div class="card-body">
                            UNGGUL DALAM MUTU DAN PELAYANAN, TEGUH DALAM IMAN, BERBUDAYA SERTA BERWAWASAN LINGKUNGAN
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                                <div class="card-header">
                                <h3 class="card-title">MISI</h3>
                            </div>
                            <div class="card-body">

                                Menyajikan pendidikan yang berkualitas, kreatif, inovatif dan prestatif
                                Meningkatkan profesionalisme tenaga pendidik dan kependidikan
                                Mewujudkan sikap dan prilaku yang beriman dan berkarakter
                                Menyediakan sarana dan prasarana yang mengikuti perkembangan IPTEK
                                Memberikan pelayanan prima
                                Membangun jejaring dalam lingkup Nasional dan Internasional sebagai implementasi kasih
                                Melaksanakan pendidikan yang berbudaya dan berwawasan lingkungan

                            </div>

                        </div>
                    </div>


                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Sejarah Singkat SMP Kristen 1 Harapan</h3>
                            </div>
                            <div class="card-body">



                            SMP Kristen 1 Harapan Denpasar didirikan oleh Majelis Sinode Gereja Protestan di Bali untuk mewujudkan salah satu tugas melayani Tuhan dan masyarakat di bidang pendidikan. Berdiri pada tanggal 22 Agustus 1955 dengan nama SMP Kristen Widya Pura 1 Denpasar. Nama Widya Pura diberikan oleh A.A Panji Trisna, mantan Raja Buleleng yang merupakan tokoh pejuang baru. Ijin operasionalnya dikeluarkan pada tanggal 27 April 1960 dengan Surat Keterangan Penegasan SMP Swasta No.Sek.1/3. Terhitung sejak tanggal 29 Maret 1964.

                            SMP Kristen Widya Pura 1 Denpasar secara resmi diserahterimakan oleh Majelis Sinode GKPB Bali kepada yayasan Badan Pendidikan Kristen “Maranatha” yang kemudian berganti nama menjadi “Yayasan Perguruan Kristen Widya Pura” yang sekarang kita kenal dengan nama “Yayasan Perguruan Kristen Harapan”.

                            Puji Syukur kita panjatkan kepada Tuhan karena sampai saat ini status SMP Kristen 1 Harapan “Terakreditasi A”.

                            Berikut adalah daftar kepala sekolah sejak berdirinya sekolah sampai saat ini:
                            <ol>
                                <li>Susetya Reksasiswaya (1955-1962)</li>
                                <li>I Nyoman Sumertha Turker (1962-1968)</li>
                                <li>I Made Sujaya, BA (1968-1975)</li>
                                <li>W.K Sutarsa (1975-1983)</li>
                                <li>I Ketut Petrus Wibawa, A.M.Pd (1983-1986)</li>
                                <li>I Gusti Putu Lipur, B.Sc (1986-1998)</li>
                                <li>Endang Sri Wahyuni, S.Pd (2002-2010)</li>
                                <li>Yuli Arthini, M.Pd (2010-2019)</li>
                                <li>Ir. Ni Nyoman Serayawati, M.Pd (2019-sekarang)</li>
                            </ol>

                            </div>
                        </div>
                    </div>
                </div>

            <!-- /.row-->
        </div>
    </div>

    @endsection @section('javascript')

    <script src="{{ asset('js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/coreui-chartjs.bundle.js') }}"></script>
    <script src="{{ asset('js/main.js') }}" defer="defer"></script>
    @endsection

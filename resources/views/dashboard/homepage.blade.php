    @extends('dashboard.base') @section('content')

    <div class="container-fluid">
        <div class="fade-in">
                <div class="row">

                    <div class="col-sm-12 col-md-12 col-lg-12">
                        <div class="card mb-3">
                            <img src="{{ URL::to('/assets/img/svg/papan.svg')}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="card-title text-center">SEKOLAH MENENGAH PERTAMA ST. YOSEPH DENPASAR</h2>
                                <p class="card-text text-center">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                        </div>
                    </div>



                    <div class="col-sm-12 col-md-12 col-lg-12 mt-12 " style="margin-top:100px">
                        <div class="row">
                            <div class="col-sm-6 tex-center">
                                 <img  src="{{ URL::to('/assets/img/svg/membaca.svg')}}" style="height:350px;widht:auto" class="rounded mx-auto d-block" alt="...">
                            </div>
                            <div class="col-sm-6">
                                <div class="mx-auto text-center">
                                    <h3>
                                         Belajar pangkal pandai
                                    </h3>
                                    <p class="mt-6">
                                    Pendidikan adalah senjata paling mematikan di dunia, karena dengan pendidikan, Anda dapat mengubah dunia." (Nelson Mandela)
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="col-sm-12 col-md-12 col-lg-12 mt-12 " style="margin-top:100px">
                        <div class="row">

                            <div class="col-sm-6">
                                <div class="mx-auto text-center">
                                    <h3>
                                        Waktu Adalah Emas
                                    </h3>
                                    <p class="mt-6">
                                    Pendidikan adalah senjata paling mematikan di dunia, karena dengan pendidikan, Anda dapat mengubah dunia." (Nelson Mandela)
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-6 tex-center">
                                 <img  src="{{ URL::to('/assets/img/svg/self_learn.svg')}}" style="height:350px;widht:auto" class="rounded mx-auto d-block" alt="...">
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

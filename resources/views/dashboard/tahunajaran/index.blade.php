@extends('dashboard.base') @section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-align-justify"></i>{{ __('Tahun AJaran') }}</div>
                    <div class="card-body">
                        @include('dashboard.base.success')
                        <div class="row">
                            <a href="{{ route('ta.create') }}" class="btn btn-success m-2">{{ __('Tambah TA') }}</a>

                        </div>
                        <br>
                        <table class="table table-responsive-sm table-sm table-condensed" style="font-size:12px">
                            <thead>
                                <tr>
                                    <th>KODE TA</th>
                                    <th>TAHUN AJARAN</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tas as $ta)
                                <tr>
                                    <td>
                                        <strong>{{ $ta->kdtahunajaran}}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $ta->tahunajaran }}</strong>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                        <a href="{{ route('ta.edit',$ta->id) }}" class="btn btn-sm btn-success">Edit</a>
                                        <form action="{{ route('ta.destroy', $ta->id ) }}" method="POST">
                                            @method('DELETE') @csrf
                                            <button class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $tas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('javascript')

@endsection

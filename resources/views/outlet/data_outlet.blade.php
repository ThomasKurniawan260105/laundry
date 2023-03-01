@include('partials.header')

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Input Data Outlet</h3>
                </div>
                <form action="/outlet/prosestambah" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="nama" class="col-sm-3 col-form-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="hidden" class="form-control" name="nama" id="nama">
                                <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama "
                                    required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="alamat" id="alamat" placeholder="Alamat"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="form-group row username">
                            <label for="username" class="col-sm-3 col-form-label">No_telp</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" name="tlp" id="tlp" placeholder="No_telp"
                                    required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="reset" class="btn btn-secondary" data-dismiss="modal">Clear</button>    
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-7">
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Data Outlet</h3>
                </div>
                <div class="card-body">
                    @if(session() -> exists('alert'))
                    <div class="alert alert-{{session()->get('alert') ['bg']}} alert-dismissible fade show"role="alert">
                        {{session()-> get('alert')['message']}}
                    </div>
                    @endif
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">Id</th>
                                <th>Nama</th>
                                <th>alamat</th>
                                <th>no telfon</th>
                                <th style="width: 15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tbl_outlet as $i => $outlet)
                            <tr>
                                <td>{{ $outlet->id }}</td>
                                <td>{{ $outlet->nama }}</td>
                                <td>{{ $outlet->alamat }}</td>
                                <td>{{ $outlet->tlp }}</td>

                                <td>
                                    <div class="button">
                                        <a href="javascript:;" data-toggle="modal" data-target="#modalEdit{{ $i }}"
                                            class="btn btn-success"><i class="fa fa-edit">Edit</i></a>
                                        <a href="{{url('/outlet/delete/' .$outlet -> id)}}"
                                            class="btn btn-danger"><i class="fa fa-edit">Delete</i></a>
                                    </div>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                    {{$tbl_outlet->links()}}
                </div>
            </div>
        </div>
    </div>
</div>

@foreach($tbl_outlet as $i => $outlet)
    <div class="modal fade" id="modalEdit{{ $i }}" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Data Outlet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="POST" action="{{ url('/outlet/edit/edit-outlet/' . $outlet->id) }}">
                    @csrf

                    <div class="modal-body">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control" placeholder="Nama" value="{{ $outlet->nama }}" required>
                        </div>

                        <div class="form-group">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ $outlet->alamat }}" required>
                        </div>

                        <div class="form-group">
                            <label>No Telfon</label>
                            <input type="number" name="tlp" class="form-control" placeholder="No Telfon" value="{{ $outlet->tlp }}" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Edit Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach


@include('partials.footer')

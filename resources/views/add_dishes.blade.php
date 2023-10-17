@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Buat opsi lauk') }}</div>

                    <div class="card-body">
                        <form action="" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Nama Opsi</label>
                                <input type="text" name="nama_lauk" placeholder="Masukkan opsi"
                                    class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="harga" placeholder="Masukkan harga"
                                class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
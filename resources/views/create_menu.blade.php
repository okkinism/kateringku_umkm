@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Buat Menu Baru') }}</div>

                    <div class="card-body">
                        <form action="{{ route('store_menu') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Nama Makanan</label>
                                <input type="text" name="nama_makanan" placeholder="Masukkan nama makanan" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" name="deskripsi" placeholder="Deskripsikan menu" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="harga" placeholder="Harga menu" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="gambar" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Submit Menu</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
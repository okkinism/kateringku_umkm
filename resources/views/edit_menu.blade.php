@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Ubah Menu</div>

                    <div class="card-body">
                        <form action="{{ route('update_menu', $menu) }}" method="post" enctype="multipart/form-data">
                            @method('patch')
                            @csrf
                            <div class="form-group">
                                <label>Nama Makanan</label>
                                <input type="text" name="nama_makanan" placeholder="Masukkan nama makanan"
                                    class="form-control" value="{{ $menu->nama_makanan }}">
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <input type="text" name="deskripsi" placeholder="Deskripsikan menu" class="form-control"
                                    value="{{ $menu->deskripsi }}">
                            </div>

                            <div class="form-group">
                                <label>Harga</label>
                                <input type="number" name="harga" placeholder="Harga menu" class="form-control"
                                    value={{ $menu->harga }}>
                            </div>

                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" name="gambar" class="form-control">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                        </form>
                        <form action="{{ route('delete_menu', $menu) }}" method="post">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger mt-2">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

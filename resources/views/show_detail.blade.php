@extends('layouts.app')

@section('content')
    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm">
                    <div class="card-header">{{ __('Detail Makanan') }}</div>

                    <div class="card-body shadow-sm">
                        <div class="row">
                            <div class="col-md-4 mb-3 text-center">
                                <img src="{{ url('storage/' . $menu->gambar) }}" class="img-thumbnail" alt=""
                                    width="100%">
                            </div>
                            <div class="col-md-8">
                                <div class="text-center text-md-start">
                                    <h2>{{ $menu->nama_makanan }}</h2>
                                    <h6>{{ $menu->deskripsi }}</h6>
                                    <h3>Rp {{ number_format($menu->harga, 0, ',', '.') }}</h3>
                                    <hr>
                                    @if (!Auth::user()->is_admin)
                                    <form action="{{ route('add_to_cart', $menu, $dish) }}" method="post" class="mb-3">
                                        @csrf
                                        <select class="form-select" name="dishes">
                                            @foreach ($dishes as $d)
                                                <option value="{{ $d->id }}">
                                                    {{ $d->nama_lauk }}
                                                    (+Rp{{ number_format($d->harga, 0, ',', '.') }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <br>
                                        <p class="text-center">Mau beli berapa?</p>
                                        <div class="input-group d-flex justify-content-center">
                                            <input type="number" class="form-control text-center" aria-describedby="basic-addon2" name="jumlah" value="1" style="max-width: 100px;">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit">Masukkan Keranjang</button>
                                            </div>
                                        </div>
                                    </form>                                    
                                    @else
                                        <div class="list-group">
                                            @php
                                                $menu_id = $menu->id;
                                            @endphp
                                            @foreach ($dishes as $dish)
                                                @if ($dish && $dish->menu_id == $menu_id)
                                                    <a class="list-group-item list-group-item">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div class="d-flex flex-column">
                                                                <span>{{ $dish->nama_lauk }}</span>
                                                                <span>Rp. {{ number_format($dish->harga, 0, ',', '.') }}</span>
                                                            </div>
                                                            <form action="{{ route('delete_dish', $dish) }}" method="post" class="ml-3">
                                                                @method('delete')
                                                                @csrf
                                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                                            </form>
                                                        </div>                                                                                                                                                                      
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>
                                        <hr>
                                        <div
                                            style="display: flex; justify-content: flex-start; gap: 10px; flex-wrap: wrap;">
                                            <form action="{{ route('edit_menu', $menu) }}" method="get">
                                                <button type="submit" class="btn btn-primary">Edit Menu</button>
                                            </form>
                                            <form action="{{ route('add_dishes', $menu) }}" method="get">
                                                <button type="submit" class="btn btn-primary">Tambah Opsi</button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if ($errors->any())
                            <div class="mt-3">
                                @foreach ($errors->all() as $error)
                                    <p class="text-danger">{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

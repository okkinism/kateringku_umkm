@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">{{ __('Keranjang') }}</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @php
                            $total_price = 0;
                        @endphp

                        <div class="row row-cols-1 row-cols-md-2 g-4">
                            @foreach ($carts as $cart)
                                <div class="col">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ url('storage/' . $cart->menu->gambar) }}">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $cart->menu->nama_makanan }}</h5>
                                            <p>Opsi: {{ $cart->dish->nama_lauk }}</p>
                                            <p>Harga: {{ number_format($cart->menu->harga, 0, ',', '.') }}</p>
                                            <form action="{{ route('update_cart', $cart) }}" method="post">
                                                @method('patch')
                                                @csrf
                                                <div class="input-group">
                                                    <input type="number" class="form-control text-center"
                                                        aria-describedby="basic-addon2" name="jumlah" id="jumlahCart"
                                                        value={{ $cart->jumlah }}>
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="submit">Ubah
                                                            Jumlah</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <br>
                                            <form id="delete-form-{{ $cart->id }}"
                                                action="{{ route('delete_cart', $cart) }}" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="button" class="btn btn-danger"
                                                    onclick="confirmDelete('{{ $cart->id }}')">
                                                Hapus Item
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $total_price += ($cart->menu->harga + $cart->dish->harga) * $cart->jumlah;
                                @endphp
                            @endforeach
                        </div>
                        <div class="d-flex flex-column align-items-end mt-3">
                            @if ($carts->isEmpty())
                                <h5>Oops! Keranjang kamu kosong.</h5>
                            @else
                                <h5>Total: Rp{{ number_format($total_price, 0, ',', '.') }}</h5>
                                <form action="{{ route('create_checkout') }}" method="get">
                                    <button type="submit" class="btn btn-primary">Buat Pesanan</button>
                                </form>
                            @endif
                        </div>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>

    <script>
        function confirmDelete(cartId) {
            if (confirm("Apakah Anda yakin ingin menghapus menu ini?")) {
                document.getElementById('delete-form-' + cartId).submit();
            }
        }
    </script>
@endsection

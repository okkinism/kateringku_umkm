@extends('layouts.app')
@section('content')
    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-body mx-md-4">
                        <div class="container">
                            <p class="my-5 mx-3 text-center" style="font-size: 30px;">Terima kasih atas pemesanan Anda!</p>
                            <ul class="list-unstyled">
                                <li class="text-black">{{ $order->name }}</li>
                                <li class="text-black">{{ $order->alamat }}</li>
                                <li class="text-black">{{ $order->no_telepon }}</li>
                                <li class="text-muted mt-1"><span class="text-black">Invoice</span> #{{ $order->id }}
                                </li>
                                <li class="text-black mt-1">{{ $order->created_at }}</li>
                            </ul>
                            <hr>

                            <div class="row text-black">
                                @foreach ($carts as $cart)
                                    <div class="col-xl-6">
                                        <p class="fw-bold">{{ $cart->menu->nama_makanan }}</p>
                                        <p class="fw-bold">{{ $cart->dish->nama_lauk }} (+Rp. {{ number_format($cart->dish->harga, 0, ',', '.') }})</p>
                                        <p class="text-muted">Jumlah: {{ $cart->jumlah }}</p>
                                    </div>
                                    <div class="col-xl-6">
                                        <p class="float-end">Rp {{ number_format($cart->menu->harga, 0, ',', '.') }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <hr style="border: 2px solid black;">
                            <div class="row text-black">
                                <div class="col-xl-12">
                                    <p class="float-end fw-bold">Total: Rp
                                        {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                    @if ($order->status == "Unpaid")
                                        <p class="card-text fw-bold text-warning">Unpaid</p>
                                    @else
                                        <p class="card-text fw-bold text-success">Paid</p>
                                    @endif
                                </div>
                            </div>
                            <hr style="border: 2px solid black;">
                        </div>
                        <p class="m-1 text-center"><small>-Terima kasih sekali lagi atas dukungan Anda!-</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

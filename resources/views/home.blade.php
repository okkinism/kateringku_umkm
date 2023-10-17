@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 p-2">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table align-middle table-striped table-hover mb-0 bg-white">
                            <thead class="bg-light">
                                <tr class="text-center">
                                    <th>Nama Pembeli</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Total Harga</th>
                                    <th>Catatan</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            @php
                                $total_price = 0;
                            @endphp
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="text-center">
                                        <td>
                                            <p class="fw-bold mb-1">{{ $order->name }}</p>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1">{{ $order->alamat }}</p>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1">{{ $order->no_telepon }}</p>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1">Rp
                                                {{ number_format($order->total_harga, 0, ',', '.') }}</p>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1 text-wrap">{{ $order->catatan }}</p>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1">
                                                @if ($order->status == 'Unpaid')
                                                    <span class="fw-bold text-warning">{{ $order->status }}</span>
                                                @elseif ($order->status == 'Paid')
                                                    <span class="fw-bold text-success">{{ $order->status }}</span>
                                                @endif
                                            </p>
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1">{{ date('d/m/Y', strtotime($order->created_at)) }}
                                            </p>
                                        </td>
                                    </tr>
                                    @if ($order->status == 'Paid')
                                        @php
                                            $total_price += $order->total_harga;
                                        @endphp
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-flex flex-column text-center">
                        <p class="fw-bold m-2">Grand Total : Rp {{ number_format($total_price, 0, ',', '.') }}</p>
                        <button class="btn btn-primary m-2" onclick="printLaporan()">Cetak Laporan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <script>
        function printLaporan() {
            window.print();
        }
    </script>
@endsection

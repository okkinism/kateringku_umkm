@extends('layouts.app')
@section('content')
    <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header">{{ __('Tahap Pembayaran') }}</div>

                    <div class="card-body">
                        <h5 class="card-title">Order ID {{ $order->id }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">By {{ $order->user->name }}</h6>
                        <p>Alamat: {{ $order->alamat }}</p>
                        <p>No. Telp: {{ $order->no_telepon }}</p>

                        @if ($order->status == 'Unpaid')
                            <p class="card-text">Unpaid</p>
                        @else
                            <p class="card-text">Paid</p>
                        @endif
                        <p>*) Catatan</p>
                        <p class="text-wrap">{{ $order->catatan }}</p>
                        <hr>

                        <p class="card-text fw-bold">Total : Rp. {{ number_format($order->total_harga, 0, ',', '.') }}</p>

                        <hr>
                        <div style="display: flex; justify-content: flex-end;">
                            <button class="btn btn-primary mt-3" id="pay-button">Bayar Sekarang!</button>
                        </div>
                        <div style="display: flex; justify-content: flex-end;">
                            <form action="{{ route('cancel_checkout', $order) }}" method="POST">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger mt-3">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    // alert("payment success!");
                    window.location.href = '/invoice/{{ $order->id }}'
                    console.log(result);
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
        });
    </script>
@endsection

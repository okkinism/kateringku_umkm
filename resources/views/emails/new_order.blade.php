@component('mail::message')
# New Order Notification

You have received a new order. Here are the details:

<strong>Nama:</strong> {{ $order->name }}<br>
<strong>Alamat:</strong> {{ $order->alamat }}<br>
<strong>No. Telepon:</strong> {{ $order->no_telepon }}<br>
<strong>Invoice:</strong> #{{ $order->id }}<br>
<strong>Tanggal Pemesanan:</strong> {{ $order->created_at }}<br>

@component('mail::table')
| Nama Makanan  | Harga      | Jumlah |
| ------------- | ---------- | ------ |
@foreach ($carts as $cart)
| {{ $cart->menu->nama_makanan }} | Rp {{ number_format($cart->menu->harga, 0, ',', '.') }} | {{ $cart->jumlah }} |
@endforeach
@endcomponent

<strong>Total Harga:</strong> Rp {{ number_format($order->total_harga, 0, ',', '.') }}<br>
<strong>Status Pembayaran:</strong> {{ $order->status == "Unpaid" ? 'Unpaid' : 'Paid' }}

Thanks for your attention,<br>
{{ config('app.name') }}
@endcomponent
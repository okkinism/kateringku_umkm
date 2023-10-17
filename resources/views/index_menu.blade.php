@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h4 class="mb-4 text-center text-md-start">
                    <span class="d-block d-md-inline">Halo!</span>
                    <span class="d-block d-md-inline">{{ explode(' ', $user->name)[0] }}</span>
                </h4>
                <div class="card shadow-sm">
                    @if (!Auth::user()->is_admin)
                        <div class="card-header bg-light text-dark">Mau beli yang mana?</div>
                    @else
                        <div class="card-header bg-light text-dark">Pilihan menu</div>
                    @endif

                    <div class="row row-cols-1 row-cols-md-2 g-2 m-auto shadow-sm p-4">
                        @foreach ($menus as $menu)
                            <div class="col">
                                <div class="card h-100 shadow-sm">
                                    <img class="card-img-top" src="{{ url('storage/' . $menu->gambar) }}"
                                        alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title fw-bold">{{ $menu->nama_makanan }}</h5>
                                        @if ($menu->dishes->count() > 0)
                                        <ul class="list-unstyled">
                                            @foreach ($menu->dishes as $dish)
                                                <li>{{ $dish->nama_lauk }}</li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p>Tidak ada opsi menu yang tersedia.</p>
                                    @endif
                                        <p class="card-text fw-bold">Harga : Rp.
                                            {{ number_format($menu->harga, 0, ',', '.') }}</p>
                                        <form action="{{ route('show_detail', $menu) }}" method="get">
                                            <button type="submit" class="btn btn-primary">Detail Menu</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="mt-4">
@endsection

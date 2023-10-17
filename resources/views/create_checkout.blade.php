@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Masukan Data Kamu') }}</div>

                    <div class="card-body">
                        <form action="{{ route('checkout') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nama Pembeli</label>
                                <input type="text" name="name" placeholder="*) Budi Raharjo"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}"
                                    required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alamat">Alamat Pengiriman</label>
                                <input type="text" name="alamat" placeholder="*) Jl. Parikesit, RT. 9, Rawa Makmur, Palaran"
                                    class="form-control @error('alamat') is-invalid @enderror" value="{{ $user->alamat }}"
                                    required>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="no_telepon">No. Telepon/WhatsApp</label>
                                <input type="number" name="no_telepon" placeholder="*) 0813xxxxxxxx"
                                    class="form-control @error('no_telepon') is-invalid @enderror"
                                    value="{{ $user->no_telepon }}" required>
                                @error('no_telepon')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="catatan">Tinggalkan Catatan</label>
                                <textarea type="text" name="catatan" placeholder="*) Kosong saja bila tidak perlu"
                                    class="form-control" rows="3"></textarea>
                            </div>

                            <div style="display: flex; justify-content: flex-end;">
                                <button type="submit" class="btn btn-primary mt-3">Proses</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2MEJ_KX6uKf5IlNtJo-ZE35EjYjVayyQ&libraries=places"></script>
@endsection

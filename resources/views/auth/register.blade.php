@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Registrasi Akun Pembeli</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3 row">
                                    <label for="name" class="col-md-4 col-form-label text-md-end">Nama Lengkap</label>
                                    <div class="col-md-8">
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            placeholder="" value="{{ old('name') }}"
                                            required autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>
                                    <div class="col-md-8">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            placeholder="" value="{{ old('email') }}" required
                                            autocomplete="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="alamat" class="col-md-4 col-form-label text-md-end">Alamat Pembeli</label>
                                    <div class="col-md-8">
                                        <input id="alamat" type="alamat"
                                            class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                                            placeholder="" value="{{ old('alamat') }}"
                                            required autocomplete="alamat">
                                        @error('alamat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="no_telepon" class="col-md-4 col-form-label text-md-end">Nomor
                                        Telepon/WhatsApp</label>
                                    <div class="col-md-8">
                                        <input id="no_telepon" type="no_telepon"
                                            class="form-control @error('no_telepon') is-invalid @enderror" name="no_telepon"
                                            placeholder=""
                                            value="{{ old('no_telepon') }}" required autocomplete="no_telepon">
                                        @error('no_telepon')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                                    <div class="col-md-8">
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror" name="password"
                                            placeholder="" required
                                            autocomplete="new-password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Konfirmasi
                                        Password</label>
                                    <div class="col-md-8">
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" placeholder="" required
                                            autocomplete="new-password">
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="agreeCheck" required>
                                    <label class="form-check-label" for="agreeCheck">
                                        Dengan mengklik Daftar, Anda menyetujui Ketentuan dan Kebijakan kami.
                                    </label>
                                </div>
                                <div class="row">
                                    <div class="col-md-8 offset-md-4 m-2 justify-content-end">
                                        <button type="submit" class="btn btn-primary" id="daftarButton" disabled>Daftar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.getElementById('agreeCheck').addEventListener('change', function() {
                document.getElementById('daftarButton').disabled = !this.checked;
            });
        </script>
    </div>
@endsection

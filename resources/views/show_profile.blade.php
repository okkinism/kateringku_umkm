@extends('layouts.app')

@section('content')
    <div class="container p-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('edit_profile') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" name="name" id="name" placeholder="Name" class="form-control"
                                    value="{{ $user->name }}">
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" value="{{ $user->email }}"
                                    disabled>
                            </div>
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <input type="text" name="alamat" id="alamat" placeholder="Alamat"
                                    class="form-control" value="{{ $user->alamat }}">
                            </div>
                            <div class="mb-3">
                                <label for="no_telepon" class="form-label">No. Telepon/WhatsApp</label>
                                <input type="text" name="no_telepon" id="no_telepon" placeholder="No. Telepon/WhatsApp"
                                    class="form-control" value="{{ $user->no_telepon }}">
                            </div>
                            <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <input type="text" class="form-control" id="role"
                                    value="{{ $user->is_admin ? 'Admin' : 'Member' }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary m-2">Ubah Profil</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection

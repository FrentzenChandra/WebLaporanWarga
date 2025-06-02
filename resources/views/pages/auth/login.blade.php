@extends('layouts.auth')

@section('title','Masuk')
@section('content')
<h5 class="fw-bold mt-5">Selamat datang di Lapor Pak Kades 👋</h5>
        <p class="text-muted mt-2">Silahkan masuk untuk melanjutkan</p>


        @session('message')
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ $value }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endsession

        <form action="{{ route('login.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">

                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
                </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">

                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>

            <button class="btn btn-primary w-100 mt-2"style="background-color: #6f42c1; color: #fff;" type="submit" color="primary" id="btn-login">
                Masuk
            </button>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('register') }}" class="text-decoration-none text-primary">Belum punya akun?</a>
                <a href="" class="text-decoration-none text-primary">Lupa
                    Password</a>
            </div>

        </form>
        @endsection

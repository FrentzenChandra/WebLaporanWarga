@extends('layouts.auth')

@section('title','Masuk')
@section('content')

    <h1>Verifikasi Email Anda Dari Email Yang diberikan dari kami!</h1>
    
    @session('success')
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $value }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endsession

    <p>Tidak Dapat Email?</p>
    <form action="{{route('verification.send')}}" method="POST">
        @csrf
        <button class="btn btn-success">Kirim Lagi?</button>
    </form>

@endsection

@extends('layouts.app')

@section('title' , 'home')

@section('content')

        <div class="d-flex flex-column justify-content-center align-items-center gap-2">
            <img src="{{asset('storage/' . Auth::user()->resident->avatar)}}" alt="avatar" class="avatar">
            <h5>{{Auth::user()->name}}</h5>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <div class="card profile-stats">
                    <div class="card-body">
                        <h5 class="card-title">
                            @if (count(Auth::user()->resident->reports))
                                {{count(Auth::user()->resident->reports)}}
                            @else
                            0
                            @endif

                        </h5>
                        <p class="card-text">Laporan Aktif</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="mt-4">
            <div class="list-group list-group-flush">
                <a href="#"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-user"></i>
                        <p class="fw-light">Pengaturan Akun</p>
                    </div>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
                <a href="#"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-lock"></i>
                        <p class="fw-light"> Kata sandi</p>
                    </div>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
                <a href="#"
                    class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <i class="fa-solid fa-question-circle"></i>
                        <p class="fw-light">Bantuan dan dukungan</p>
                    </div>
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
            </div>

            <div class="mt-4">
                <form id="logout-form" action="{{ route('logout') }}" method="POST" >
                    @csrf
                    <button class="btn btn-outline-danger w-100 rounded-pill">
                        Keluar
                    </button>
                </form>

            </div>
        </div>

@endsection

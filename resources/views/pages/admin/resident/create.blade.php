@extends('layouts.admin')

@section('title' , "Tambah Data Masyarakat")

@section('content')

        <div class="container-fluid">

            <!-- Page Heading -->
            <a href="{{route('admin.Resident.index')}}" class="btn btn-danger mb-3">Kembali</a>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Penduduk</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.Resident.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name') }}" name="name" >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email')}}" name="email" >
                            @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{old('password')}}" name="password" >
                            @error('password')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" value="{{old('avatar')}}" name="avatar" >
                            @error('avatar')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        {{-- <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div> --}}
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>

@endsection

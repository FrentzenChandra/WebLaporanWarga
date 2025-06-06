@extends('layouts.editProfileTemplate')

@section('title' , "Tambah Data Masyarakat")

@section('content')

        <div class="container-fluid mt-5">

            <!-- Page Heading -->


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Profil</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('profile.store', $Resident->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name' , $Resident->user->name) }}" name="name" >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" readonly class="form-control @error('email') is-invalid @enderror" id="email" value="{{old('email' , $Resident->user->email)}}" >
                        </div>
                        <div class="form-group">
                            <label for="avatar">Avatar <span class="text-danger fs-6">( input file baru untuk menganti gambar )</span></label>
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" value="{{old('avatar')}}" name="avatar" >
                            <div class="mt-4">Foto Sebelum</div>
                            <img src="{{ asset('storage/' . $Resident->avatar) }}" alt="gambar Error / tidak ditemukan" width="250" class="img-fluid">
                            @error('avatar')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>


                        <input hidden type="text" value="{{$Resident->avatar}}" name="old-avatar" >

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

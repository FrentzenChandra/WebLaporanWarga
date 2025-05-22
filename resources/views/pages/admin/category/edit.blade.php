@extends('layouts.admin')

@section('title' , "Tambah Data Masyarakat")

@section('content')

        <div class="container-fluid">

            <!-- Page Heading -->
            <a href="{{route('admin.Category.index')}}" class="btn btn-danger mb-3">Kembali</a>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Edit Data Kategori</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.Category.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Nama</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" value="{{ old('name' , $category->name)}}" name="name" >
                            @error('name')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="gambar">Gambar  <span class="text-danger fs-6">( input file baru untuk menganti gambar )</span></label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" value="{{old('gambar')}}" name="gambar" >
                            <div class="mt-4">Foto Sebelum</div>
                            <img src="{{ asset('storage/' . $category->image) }}" alt="gambar" width="250" class="img-fluid">
                            @error('gambar')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>


                        <input hidden type="text" value="{{$category->image}}" name="old-image" >

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

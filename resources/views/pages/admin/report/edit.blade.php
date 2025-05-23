@extends('layouts.admin')

@section('title' , "Tambah Data Masyarakat")

@section('content')



        <div class="container-fluid">

            <!-- Page Heading -->
            <a href="{{route('admin.Report.index')}}" class="btn btn-danger mb-3">Kembali</a>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tambah Data Report</h6>
                </div>
                <div class="card-body">
                    <form action="{{route('admin.Report.update' , $report->id)}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="code">Code</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" value="{{ old('code' , $report->code) }}" name="code" readonly>
                            @error('code')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div id="tes" for="resident_id" class="block">Pelapor / Penduduk <span class="text-danger" >*Klik Lalu Ketik Untuk Mencari*</span></div>
                            <select class="custom-select @error('resident_id') is-invalid @enderror" name="resident_id" id="resident_id">
                                <option value="" >--Pilih Penduduk--</option>
                                @foreach ($residents as $resident)
                                    <option value="{{$resident->id}}" @if ( old('resident_id' , $report->resident_id) == $resident->id ) selected  @endif >
                                        {{$resident->user->name}} - {{$resident->user->email}}
                                    </option>
                                @endforeach
                            </select>
                            @error('resident_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Judul Laporan </label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title' , $report->title) }}" name="title" >
                            @error('title')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div id="tes" for="category_id" class="block">Pilih Kategori Laporan <span class="text-danger" >*Klik Lalu Ketik Untuk Mencari*</span></div>
                            <select class="custom-select @error('category_id') is-invalid @enderror" name="category_id" id="category_id" >
                                    <option value="" >--Pilih Kategori--</option>
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @if (old('category_id', $report->report_category_id) == $category->id) selected @endif>{{$category->name}}</option>
                                    @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" class="form-control @error('latitude') is-invalid @enderror" id="latitude" value="{{ old('latitude' , $report->latitude) }}" name="latitude" >
                            @error('latitude')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" class="form-control @error('longitude') is-invalid @enderror" id="longitude" value="{{ old('longitude' , $report->longitude) }}" name="longitude" >
                            @error('longitude')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="address">Alamat Laporan</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" value="{{ old('address' , $report->address) }}" name="address" >
                            @error('address')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Bukti laporan <span class="text-danger" >*Ubah Untuk Menganti Biarkan jika tidak ganti*</span></label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" value="{{old('image', $report->image)}}" name="image" >
                            @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                            <img src="{{ asset('storage/' . $report->image) }}" alt="avatar" width="300" class="img-fluid mt-3">
                        </div>
                        <div class="form-group">
                            <label for="description">Deskripsi Laporan</label>
                            <textarea class="form-control " id="description"  name="description" rows="10" cols="100" style="resize:none">{{old('description' , $report->description)}}</textarea>
                        </div>
                        <input type="text" class="form-control @error('old-image') is-invalid @enderror" id="old-image" value="{{ old('old-image' , $report->image) }}" name="old-image" hidden >




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

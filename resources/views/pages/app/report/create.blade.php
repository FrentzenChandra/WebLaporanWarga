@extends('layouts.no-nav')


@section('title' , 'Membuat Report Baru')

@section('content')
        <h3 class="mb-3">Laporkan segera masalahmu di sini!</h3>

        <p class="text-description">Isi form dibawah ini dengan baik dan benar sehingga kami dapat memvalidasi dan
            menangani
            laporan anda
            secepatnya</p>

        <form action="{{route('userReport.store')}}" method="POST" class="mt-4" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="latitude" name="latitude">
            <input type="hidden" id="longitude" name="longitude">
            <input type="hidden" id="resident_id" name="resident_id" value="{{Auth::user()->resident->id}}">

            <div class="mb-3">
                <label for="title" class="form-label">Judul Laporan</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}">
                @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Kategori Laporan</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                    <option value="" >--Pilih Kategori--</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if (old('category_id') == $category->id)  selected   @endif>{{$category->name}}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Bukti Laporan</label>
                <input type="file" class="form-control" id="image" name="image" style="display: none;">

                <img alt="image" id="image-preview" class="img-fluid rounded-2 mb-3 border">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Ceritakan Laporan Kamu</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="map" class="form-label">Lokasi Laporan</label>
                <div id="map"></div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Alamat Lengkap</label>
                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3">{{ old('address') }}</textarea>
                @error('address')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                @enderror
            </div>
            <button class="btn btn-primary w-100 mt-2" type="submit" color="primary">
                Laporkan
            </button>
        </form>
@endsection

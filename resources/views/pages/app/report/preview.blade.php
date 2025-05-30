@extends('layouts.no-nav')

@section('title' , 'Create Report')

@section('content')


    <div class="d-flex flex-column justify-content-center align-items-center">
        <img alt="image" id="image-preview" class="img-fluid rounded-2">

        <div class="d-flex justify-content-center mt-3 gap-3">

            <a href="{{route('userReport.take')}}" class="btn btn-outline-primary">
                Ulangi Foto
            </a>
            <a href="{{route('userReport.create')}}" class="btn btn-primary">
                Gunakan Foto
            </a>
        </div>
    </div>


    @section('scripts')

    <script>
        var image = localStorage.getItem('image');
        var imagePreview = document.getElementById('image-preview');
        imagePreview.src = image;
    </script>

    @endsection

@endsection

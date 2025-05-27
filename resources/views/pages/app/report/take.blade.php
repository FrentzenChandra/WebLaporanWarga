@extends('layouts.no-nav')

@section('title' , 'Create Report')

@section('content')

    <div class="d-flex flex-column justify-content-center align-items-center">
            <video autoplay="true" id="video-webcam">
                Browsermu tidak mendukung bro, upgrade donk!
            </video>

            <div class="d-flex justify-content-center mt-3 position-absolute bottom-0">
                <button class="btn btn-primary btn-snap mb-3 " onclick="takeSnapshot()">
                    <i class="fas fa-camera"></i>
                </button>
            </div>
        </div>
    </div>


    @section('scripts')

    <script>
        var video = document.querySelector("#video-webcam");

        navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia ||
            navigator.msGetUserMedia || navigator.oGetUserMedia;

        if (navigator.getUserMedia) {
            navigator.getUserMedia({
                video: true
            }, handleVideo, videoError);
        }

        function handleVideo(stream) {
            video.srcObject = stream;
        }

        function videoError(e) {
            alert("Izinkan menggunakan webcam untuk demo!");
        }

        function takeSnapshot() {
            var canvas = document.createElement('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video-webcam');
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0);
            var dataURL = canvas.toDataURL('image/png');
            localStorage.setItem('image', dataURL);

            window.location.href = '{{route('userReport.preview')}}';
        }


    </script>

    @endsection

@endsection

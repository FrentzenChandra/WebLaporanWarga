@extends('layouts.no-nav')

@section('title', 'Create Report')

@section('content')
    <div class="d-flex flex-column justify-content-center align-items-center">
        <video autoplay playsinline id="video-webcam">
            Browsermu tidak mendukung bro, upgrade donk!
        </video>

        <div class="d-flex justify-content-center mt-3 position-absolute bottom-0 gap-2">
            <button class="btn btn-primary btn-snap mb-3" onclick="switchCamera()">
                <i class="fas fa-rotate"></i>
            </button>
            <button class="btn btn-primary btn-snap mb-3" onclick="takeSnapshot()">
                <i class="fas fa-camera"></i>
            </button>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    let currentFacingMode = "environment"; // default to rear
    let video = document.getElementById("video-webcam");
    let currentStream;

    function startCamera(facingMode) {
        if (currentStream) {
            currentStream.getTracks().forEach(track => track.stop());
        }

        navigator.mediaDevices.getUserMedia({
            video: { facingMode: facingMode }
        })
        .then(stream => {
            currentStream = stream;
            video.srcObject = stream;
        })
        .catch(err => {
            alert("Could not access the camera: " + err);
        });
    }

    function switchCamera() {
        currentFacingMode = (currentFacingMode === "user") ? "environment" : "user";
        startCamera(currentFacingMode);
    }

    function takeSnapshot() {
        const canvas = document.createElement('canvas');
        const context = canvas.getContext('2d');
        canvas.width = video.videoWidth;
        canvas.height = video.videoHeight;
        context.drawImage(video, 0, 0);
        const dataURL = canvas.toDataURL('image/png');
        localStorage.setItem('image', dataURL);
        window.location.href = '{{ route('userReport.preview') }}';
    }

    // Start camera on load
    window.addEventListener('load', () => {
        if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
            startCamera(currentFacingMode);
        } else {
            alert("Browser tidak mendukung getUserMedia");
        }
    });
</script>
@endsection

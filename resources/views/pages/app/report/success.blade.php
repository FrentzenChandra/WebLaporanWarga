@extends('layouts.no-nav')


@section('title', 'Sukses Membuat Laporan')

@section('content')

        <div class="d-flex flex-column justify-content-center align-items-center vh-75">
            <dotlottie-player
            src="https://lottie.host/84f4ee4c-ca21-4efc-8ce8-9e2a85b303f5/kSquQcQEZG.lottie"
            background="transparent"
            speed="1"
            style="width: 300px; height: 300px"
            loop
            autoplay
            ></dotlottie-player>

            <h6 class="fw-bold text-center mb-2">Yeay! Laporan kamu berhasil dibuat</h6>
            <p class="text-center mb-4">Kamu bisa melihat laporan yang dibuat di halaman laporan</p>


            <a href="{{route('myReport' , ['status' => 'delivered'])}}" class="btn btn-primary py-2 px-4">
                Lihat Laporan
            </a>
        </div>

@endsection


@section('scripts')
    <script
    src="https://unpkg.com/@dotlottie/player-component@2.7.12/dist/dotlottie-player.mjs"
    type="module"
    ></script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <script>
        // Ambil base64 dari localStorage
        var imageBase64 = localStorage.getItem('image');

        // Mengubah base64 menjadi binary Blob
        function base64ToBlob(base64, mime) {
            var byteString = atob(base64.split(',')[1]);
            var ab = new ArrayBuffer(byteString.length);
            var ia = new Uint8Array(ab);
            for (var i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], {
                type: mime
            });
        }

        // Fungsi untuk membuat objek file dan set ke input file
        function setFileInputFromBase64(base64) {
            // Mengubah base64 menjadi Blob
            var blob = base64ToBlob(base64, 'image/jpeg'); // Ganti dengan tipe mime sesuai gambar Anda
            var file = new File([blob], 'image.jpg', {
                type: 'image/jpeg'
            }); // Nama file dan tipe MIME

            // Set file ke input file
            var imageInput = document.getElementById('image');
            var dataTransfer = new DataTransfer();
            dataTransfer.items.add(file);
            imageInput.files = dataTransfer.files;

            // Menampilkan preview gambar
            var imagePreview = document.getElementById('image-preview');
            imagePreview.src = URL.createObjectURL(file);
        }

        // Set nilai input file dan preview gambar
        setFileInputFromBase64(imageBase64);
    </script>

@endsection

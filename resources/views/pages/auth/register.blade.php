<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>

    <link rel="stylesheet" href="{{asset('assets/app/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/app/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <div class="max-w-screen-sm mx-auto bg-white min-vh-100 p-3">

         <div class="max-w-screen-sm mx-auto bg-white min-vh-100 p-3 ">
        <h5 class="fw-bold mt-5">Daftar sebagai pengguna baru</h5>
        <p class="text-muted mt-2">Silahkan mengisi form dibawah ini untuk mendaftar</p>

        <form action="{{route('register.store')}}" method="POST" class="mt-4" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}"  id="email" name="email">
                @error('email')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="name" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" id="name" name="name">
                @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="avatar" class="form-label">Masukkan Gambar Profile</label>
                <input type="file" class="form-control @error('avatar') is-invalid @enderror" value="{{ old('avatar') }}" id="avatar" name="avatar">
                @error('avatar')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>


            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('password') }}" id="password" name="password">
                @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button class="btn btn-primary w-100 mt-2" type="submit" color="primary" id="btn-login">
                Masuk
            </button>

            <div class="d-flex justify-content-between mt-3">
                <a href="{{ route('login') }}" class="text-decoration-none text-primary">Sudah punya akun?</a>
            </div>
        </form>
    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>

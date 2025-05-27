    <a href="{{route('userReport.take')}}">
    <div class="floating-button-container d-flex" onclick="window.location.href = ''">
        <button class="floating-button">
            <i class="fa-solid fa-camera"></i>
        </button>
    </div>
    </a>


    <nav class="nav-mobile d-flex">
        <a href="{{route('home')}}" class="{{url()->current() === route('home') ? 'active' : ''}}">
            <i class="fas fa-house"></i>
            Beranda
        </a>
        <a href="{{route('myReport', ['status'=>'delivered'])}}" class="{{url()->current() === route('myReport') ? 'active' : ''}}">
            <i class="fas fa-solid fa-clipboard-list"></i>
            Laporanmu
        </a>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <a href="" class="{{url()->current() === route('userReport.take') ? 'active' : ''}}">
            <i class="fas fa-bell"></i>
            Notifikasi
        </a>
        <a href="{{route('profile')}}" class="{{url()->current() === route('profile') ? 'active' : ''}}">
            <i class="fas fa-user"></i>
            Profil
        </a>
</nav>

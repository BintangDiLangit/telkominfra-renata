<nav class="navbar navbar-expand-lg fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="{{ asset('assets/logo.png') }}" alt="Icon">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">We’re hiring!</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/elearning">E-Learning</a>
                </li>
            </ul>
            @auth
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="profile-user">
                            <img src="{{ asset('assets/profile.png') }}" class="foto-profile" alt="">
                            <div class="name-profile">
                                <p class="name">{{ auth()->user()->name }}</p>
                                <p class="status">{{ auth()->user()->getRoleNames()->first() }}</p>
                            </div>
                            <div class="dropdown">
                                <a href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-angle-down"></i>
                                </a>

                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('pengaturan.data.diri') }}">Profile</a>
                                    <a class="dropdown-item" href="{{ route('lamaran.saya') }}">Lamaran Saya</a>
                                    @if (auth()->user()->hasRole(1))
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <div class="notifiction">
                            <div class="garis-verical"></div>
                            <a class="nav-link" href="#" data-toggle="modal" data-target="#notification-modal">
                                <i class="fa-solid fa-bell">
                                    <div class="bulat"></div>
                                </i>
                            </a>
                            <div class="garis-verical"></div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <img class="nav-link" src="{{ asset('assets/image 5.png') }}" alt="">
                    </li>
                </ul>
            @endauth
            @guest
                <ul class="navbar-nav" style="align-items: center;">
                    <li class="nav-item">
                        <div class="auth-button">
                            <a href="/login" id="masuk">Masuk</a>
                            <a href="/register" id="daftar">Daftar</a>
                        </div>
                    </li>
                    <li class="nav-item active">
                        <div class="garis-verical"></div>
                    </li>
                    <li class="nav-item">
                        <img class="nav-link" src="../assets/image 5.png" alt="">
                    </li>
                </ul>
            @endguest
        </div>
    </div>
</nav>

@extends('user.layouts.master')
@section('title')
    Renata | Home
@endsection
@section('jumbotron')
    <header>
        <div class="gambar-orang">
            <img src="{{ asset('assets/Group 17.png') }}" alt="">
        </div>
        <div class="container">
            <h1 class="text-1">Tempat Pengembangan <span>Karier Terbaik</span> Untukmu</h1>
            <p class="text-2">Jelajahi 5000+ pekerjaan baru setiap bulan, Buat keputusan terbaik untuk kariermu dan
                bangun karier impianmu!</p>

            <!-- Pencarian -->
            <div class="pencarian">
                <i class="fa-solid fa-location-dot"></i>
                <p class="location">DKI Jakarta</p>
                <i class="fa-solid fa-angle-down"></i>
                <div class="garis-verical-cari"></div>
                <form action="">
                    <input type="text" placeholder="Cari Lowongan">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>

            <!-- Popular -->
            <div class="popular">
                <p class="text-popular">Popular:</p>
                <div class="card-popular">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <p>UI/UX Designer</p>
                </div>
                <div class="card-popular">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <p>Programmer</p>
                </div>
                <div class="card-popular">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <p>Staff Finance</p>
                </div>
            </div>
        </div>
    </header>
@endsection
@section('content')
    <div class="container flex-main">
        <!-- Lowongan Terpopuler -->
        <div class="lowongan">
            <div class="flex-lowongan">
                <h2>Lowongan terpopular:</h2>
                <a href="#">Lihat Semua</a>
            </div>
            <div class="flex-card-lowongan">
                @foreach ($lowongans as $lowongan)
                    <a href="{{ route('search.lowongan', ['keyword' => $lowongan->id]) }}"
                        style="text-decoration:none; color:black">
                        <div class="card-lowongan">
                            <h2 class="nama-lowongan">{{ $lowongan->judul }}</h2>
                            <p class="tempat-lowongan">{{ $lowongan->company->name }}</p>
                            <div class="deskripsi">
                                <i class="fa-solid fa-location-dot"></i>
                                <p class="text-deskripsi">{{ $lowongan->lokasi }}</p>
                            </div>
                            <div class="deskripsi">
                                <i class="fa-solid fa-dollar-sign"></i>
                                <p class="text-deskripsi">IDR {{ $lowongan->range_gaji }}</p>
                            </div>
                            <div class="deskripsi">
                                <i class="fa-solid fa-briefcase"></i>
                                <p class="text-deskripsi">{{ $lowongan->experience }}
                                </p>
                            </div>
                            <div class="flex-status">
                                <p class="status">{{ $lowongan->status }}</p>
                                <ul>
                                    <li class="waktu">
                                        <p>Lowongan Diposting {{ $lowongan->created_at->diffForHumans() }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <!-- Akhir Lowongan Terpopuler -->

        <!-- Category -->
        <div class="category">
            <h2 class="header-caregory">Category</h2>
            <div class="flex-category-card">
                @foreach ($kategoriLowongans as $kategoriLowongan)
                    <div class="border-card">
                        <a href="{{ route('search.lowongan', ['keyword' => $kategoriLowongan->name]) }}">
                            <div class="category-card" style="background-image: url('assets/Rectangle 15.png');">
                                <h2 class="nama-category">{{ $kategoriLowongan->name }}</h2>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        <!-- Akhir Categori -->

        <!-- Elarning -->
        <div class="elearning">
            <div class="flex-elearning">
                <h2>E-Learning</h2>
                <a href="">Lihat Semua</a>
            </div>
            <div class="flex-card-elearning">
                <div class="card-elearning">
                    <div class="flex-card-inside-elearning">
                        <img src="assets/Rectangle 15 (1).png" alt="">
                        <div class="deskripsi-elearning">
                            <h2>Submarine Business Implementation</h2>
                            <p>Total Materi : 5</p>
                            <a href="">
                                <p>Mulai</p>
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-elearning">
                    <div class="flex-card-inside-elearning">
                        <img src="assets/Rectangle 15 (2).png" alt="">
                        <div class="deskripsi-elearning">
                            <h2>5G Training Courses</h2>
                            <p>Total Materi : 5</p>
                            <a href="">
                                <p>Mulai</p>
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-elearning">
                    <div class="flex-card-inside-elearning">
                        <img src="assets/Rectangle 15 (3).png" alt="">
                        <div class="deskripsi-elearning">
                            <h2>Data Center Management</h2>
                            <p>Total Materi : 5</p>
                            <a href="">
                                <p>Mulai</p>
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Elarning -->
    </div>
@endsection

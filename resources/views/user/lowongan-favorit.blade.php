@extends('user.layouts.master')
@section('title')
    Renata - Lowongan Favorit
@endsection
@section('styleHead')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lowongan-favorit-style.css') }}">
@endsection
@section('content')
    <div class="container flex-main">
        <div class="side-bar">
            @include('user.component-datadiri.component-sidenav')
        </div>
        <div class="content">
            <h2 class="name-content">Lowongan Favorit</h2>

            <div class="flex-lowongan-fav">
                <div class="card-lowongan-fav">
                    <div class="flex-header">
                        <div class="posisi-lowongan">
                            <h2 class="posisi">Tax Staf</h2>
                            <p class="tempat">PT Telekomunikasi Seluler</p>
                        </div>
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <div class="deskripsi">
                        <i class="fa-solid fa-location-dot"></i>
                        <p class="text-deskripsi">Jakarta</p>
                    </div>
                    <div class="deskripsi">
                        <i class="fa-solid fa-dollar-sign"></i>
                        <p class="text-deskripsi">IDR 5.000.000 – 7.000.000</p>
                    </div>
                    <div class="deskripsi">
                        <i class="fa-solid fa-briefcase"></i>
                        <p class="text-deskripsi">Experienced 1 – 2 Year</p>
                    </div>

                    <div class="status-postingan-lamaran">
                        <p class="status aktif">Aktif</p>
                        <ul>
                            <li>
                                <p>Lowongan Diposting 3 Hari Yang Lalu</p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-lowongan-fav non-active">
                    <div class="flex-header">
                        <div class="posisi-lowongan">
                            <h2 class="posisi">Tax Staf</h2>
                            <p class="tempat">PT Telekomunikasi Seluler</p>
                        </div>
                        <i class="fa-solid fa-heart"></i>
                    </div>
                    <div class="deskripsi">
                        <i class="fa-solid fa-location-dot"></i>
                        <p class="text-deskripsi">Jakarta</p>
                    </div>
                    <div class="deskripsi">
                        <i class="fa-solid fa-dollar-sign"></i>
                        <p class="text-deskripsi">IDR 5.000.000 – 7.000.000</p>
                    </div>
                    <div class="deskripsi">
                        <i class="fa-solid fa-briefcase"></i>
                        <p class="text-deskripsi">Experienced 1 – 2 Year</p>
                    </div>

                    <div class="status-postingan-lamaran">
                        <p class="status tidak-aktif">NonAktif</p>
                        <ul>
                            <li>
                                <p>Lowongan Diposting 3 Hari Yang Lalu</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="halaman">
                <p class="status-halaman">
                    Menampilkan 5 dari 15 lamaran terbaru
                </p>
                <div class="pagination">
                    <button class="back">
                        <i class="fa-solid fa-angle-left"></i>
                        Back
                    </button>
                    <div class="number">
                        <a href="" class="active">1</a>
                        <a href="" class="">2</a>
                        <a href="" class="">3</a>
                    </div>
                    <button class="next">
                        Next
                        <i class="fa-solid fa-angle-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

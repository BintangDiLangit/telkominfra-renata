@extends('user.layouts.master')
@section('title')
    Renata - E Learning
@endsection
@section('styleHead')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/elearning-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/modal-form-style.css') }}">
@endsection
@section('content')
    <div class="container">
        <div class="header-elearning">
            <h2>E-Learning</h2>

            <div class="pencarian">
                <input type="text" placeholder="Cari berdasarkan Judul, Keahlian...">
                <button><i class="fa-solid fa-magnifying-glass"></i></button>
            </div>
        </div>
        <div class="flex-main">
            <div class="daftar-elearning">
                <!-- Kumpulan elearning -->
                <div class="card-elearning">
                    <div class="flex-card-inside-elearning">
                        <img src="{{ asset('assets/Rectangle 15 (1).png') }}" alt="">
                        <div class="deskripsi-elearning">
                            <h2>Submarine Business Implementation</h2>
                            <p>Total Materi : 5</p>
                        </div>
                    </div>
                </div>
                <div class="card-elearning">
                    <div class="flex-card-inside-elearning">
                        <img src="{{ asset('assets/Rectangle 15 (2).png') }}" alt="">
                        <div class="deskripsi-elearning">
                            <h2>5G Training Courses</h2>
                            <p>Total Materi : 5</p>
                        </div>
                    </div>
                </div>
                <div class="card-elearning">
                    <div class="flex-card-inside-elearning">
                        <img src="{{ asset('assets/Rectangle 15 (3).png') }}" alt="">
                        <div class="deskripsi-elearning">
                            <h2>Data Center Management</h2>
                            <p>Total Materi : 5</p>
                        </div>
                    </div>
                </div>
                <div class="card-elearning">
                    <div class="flex-card-inside-elearning">
                        <img src="{{ asset('assets/Rectangle 15 (3).png') }}" alt="">
                        <div class="deskripsi-elearning">
                            <h2>Data Center Management</h2>
                            <p>Total Materi : 5</p>
                        </div>
                    </div>
                </div>

                <!-- Piggination -->
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
            <div class="content-elearning">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/azevfQN9RTA"
                    title="YouTube video player" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen></iframe>
                <div class="rating">
                    <div class="bintang">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star"></i>
                    </div>
                    <p class="rata-rata">
                        4 <span>(296)</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

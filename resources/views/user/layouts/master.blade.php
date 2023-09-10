<!DOCTYPE html>
<html lang="en">

<head>
    @include('user.layouts.head')
</head>

<body>

    <!-- Navbar -->
    @include('user.layouts.navbar')
    <!-- Akhir Navbar -->

    <!-- Header -->
    @yield('jumbotron')
    <!-- Akhir Header -->
    <!-- Content -->
    <main>
        @yield('content')
        <!-- Footer -->
        @include('user.layouts.footer')
        <!-- Akhir Footer -->
    </main>
    <!-- Akhir Content -->


    <!-- Modal Notification -->
    <div class="modal fade" id="notification-modal" tabindex="-1" role="dialog" aria-labelledby="notification-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="header-notif">Notification</h2>
                    <div class="garis-notif"></div>
                    <div class="nav-notif">
                        <ul>
                            <li class="active" id="nav-lowongan" onclick="lowongan()">
                                <p>Lowongan Terbaru (2)</p>
                                <i class="fa-solid fa-circle"></i>
                            </li>
                            <li class="" id="nav-lamaran" onclick="lamaran()">
                                <p>Lamaran Anda (1)</p>
                                <i class="fa-solid fa-circle"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="isi-notif-lowongan">
                        <a href="">
                            <div class="card-notif belum-dibaca">
                                <div class="flex-ahli">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <p>sesuai keahlian anda</p>
                                </div>
                                <h2 class="nama-lowongan">Billing & Collection Staff</h2>
                                <p class="tempat-lowongan">PT Infrastruktur Telekomunikasi Indonesia</p>
                                <p class="gaji">IDR 5.000.000 – 7.000.000</p>
                            </div>
                        </a>
                        <a href="">
                            <div class="card-notif belum-dibaca">
                                <div class="flex-ahli">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <p>sesuai keahlian anda</p>
                                </div>
                                <h2 class="nama-lowongan">Billing & Collection Staff</h2>
                                <p class="tempat-lowongan">PT Infrastruktur Telekomunikasi Indonesia</p>
                                <p class="gaji">IDR 5.000.000 – 7.000.000</p>
                            </div>
                        </a>
                        <a href="">
                            <div class="card-notif">
                                <div class="flex-ahli">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <p>sesuai keahlian anda</p>
                                </div>
                                <h2 class="nama-lowongan">Billing & Collection Staff</h2>
                                <p class="tempat-lowongan">PT Infrastruktur Telekomunikasi Indonesia</p>
                                <p class="gaji">IDR 5.000.000 – 7.000.000</p>
                            </div>
                        </a>
                        <a href="">
                            <div class="card-notif">
                                <div class="flex-ahli">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <p>sesuai keahlian anda</p>
                                </div>
                                <h2 class="nama-lowongan">Billing & Collection Staff</h2>
                                <p class="tempat-lowongan">PT Infrastruktur Telekomunikasi Indonesia</p>
                                <p class="gaji">IDR 5.000.000 – 7.000.000</p>
                            </div>
                        </a>
                        <a href="">
                            <div class="card-notif">
                                <div class="flex-ahli">
                                    <i class="fa-solid fa-briefcase"></i>
                                    <p>sesuai keahlian anda</p>
                                </div>
                                <h2 class="nama-lowongan">Billing & Collection Staff</h2>
                                <p class="tempat-lowongan">PT Infrastruktur Telekomunikasi Indonesia</p>
                                <p class="gaji">IDR 5.000.000 – 7.000.000</p>
                            </div>
                        </a>
                    </div>
                    <div class="isi-notif-lamaran">
                        <a href="">
                            <div class="card-notif belum-dibaca">
                                <div class="status-lamaran interview">
                                    <i class="fa-solid fa-dharmachakra"></i>
                                    <p>Proses Interview</p>
                                </div>
                                <p class="pernyataan">Selamat, Lamaran anda untuk <span>“Tax Staff - PT Telekomunikasi
                                        Seluler”</span> telah masuk tahap interview.</p>
                                <p class="tanggal">24 Juni 2023</p>
                            </div>
                        </a>
                        <a href="">
                            <div class="card-notif">
                                <div class="status-lamaran dilihat">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <p>Lamaran anda Sedang di lihat</p>
                                </div>
                                <p class="pernyataan">Lamaran anda untuk <span>“Tax Staff - PT Telekomunikasi
                                        Seluler”</span> Sedang di Lihat.</p>
                                <p class="tanggal">22 Juni 2023</p>
                            </div>
                        </a>
                        <a href="">
                            <div class="card-notif">
                                <div class="status-lamaran terkirim">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <p>Lamaran Terkirim</p>
                                </div>
                                <p class="pernyataan">Selamat, Lamaran anda untuk <span>“Tax Staff - PT Telekomunikasi
                                        Seluler”</span> Berhasil Dikirim.</p>
                                <p class="tanggal">18 Juni 2023</p>
                            </div>
                        </a>
                        <a href="">
                            <div class="card-notif">
                                <div class="status-lamaran tidak-lolos">
                                    <i class="fa-solid fa-dharmachakra"></i>
                                    <p>Belum Lolos </p>
                                </div>
                                <p class="pernyataan">Maaf, Lamaran anda untuk <span>“Tax Staff - PT Telekomunikasi
                                        Seluler”</span> belum dapat diproses ketahap selanjutnya.</p>
                                <p class="tanggal">10 Juni 2023</p>
                            </div>
                        </a>

                    </div>

                    <div class="action-notif">
                        <a href="">Tandai Semua dibaca</a>
                        <a href="">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @stack('additional-modal')
    @include('user.layouts.script')

</body>

</html>

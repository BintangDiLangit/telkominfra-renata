@extends('user.layouts.master')
@section('title')
    Renata - Hasil Pencarian
@endsection
@section('styleHead')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/we-are-hearing-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/modal-form-style.css') }}">
@endsection
@section('content')
    <div class="pencarian">
        <div class="container">
            <div class="input-pencarian">
                <div class="kota">
                    <i class="fa-solid fa-location-dot"></i>
                    <select name="" id="">
                        <option value="">Semua Lokasi</option>
                        <option value="">Jakarta</option>
                        <option value="">Bogor</option>
                    </select>
                </div>
                <div class="cari">
                    <input type="text" placeholder="Cari lowongan">
                    <button><i class="fa-solid fa-magnifying-glass"></i></button>
                </div>
            </div>
            <div class="label">
                <div class="waktu">
                    <a href="">
                        <p>Paling Sesuai</p>
                    </a>
                    <a href="" class="active">
                        <p>Terbaru</p>
                    </a>
                </div>
                <div class="populer">
                    <a href="" class="card-populer">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <p>UI/UX Designer</p>
                    </a href="">
                    <a href="" class="card-populer">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <p>Programmer</p>
                    </a href="">
                    <a href="" class="card-populer">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <p>Staff Finance</p>
                    </a href="">
                </div>
            </div>
        </div>
    </div>
    <div class="lowongan-favorit container">
        <div class="flex-header">
            <h2 class="header">Hasil Pencarian</h2>
            <select name="" id="">
                <option value="">Semua</option>
                <option value="">Terbaru</option>
            </select>
        </div>
        <div class="flex-lowongan-fav">
            @if (count($lowongans) > 0)
                <div class="lowongan mt-0">
                    @foreach ($lowongans as $lowongan)
                        <div class="card-lowongan" data-id="{{ $lowongan->id }}">
                            <div class="flex-header">
                                <div class="posisi-lowongan">
                                    <h2 class="posisi">{{ $lowongan->judul }}</h2>
                                    <p class="tempat">{{ $lowongan->company->name }}</p>
                                </div>
                                {{-- <a href="{{ route('user.lowongan.favorit.status') }}"> --}}
                                <i class="fa-solid fa-heart"></i>
                                {{-- </a> --}}
                            </div>
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

                            <div class="status-postingan-lamaran">
                                <p class="status aktif">{{ $lowongan->status }}</p>
                                <ul>
                                    <li>
                                        <p>Lowongan Diposting {{ $lowongan->created_at->diffForHumans() }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    @endforeach
                    <button class="more">
                        Lihat Pekerjaan Lainnya
                        <i class="fa-solid fa-angle-down"></i>
                    </button>
                </div>
                <div class="deskripsi-lowongan">
                    <h2 class="jabatan" id="judul"></h2>
                    <p class="tempat-kerja" id="lokasi"></p>
                    <!-- <button class="lamar" data-toggle="modal" data-target="#berhasil-dikirim"> -->
                    <button class="lamar" id="lamar" data-target="#modal-kirim-lamaran">
                        <!-- <button class="lamar" data-toggle="modal" data-target="#modal-kirim-lamaran"> -->
                        <i class="fa-solid fa-angle-right"></i>
                    </button>

                    <div class="garis-batas"></div>

                    <h2 class="header-deskripsi">Deskripsi Pekerjaan</h2>
                    <p class="deskripsi" id="deskripsi">
                        <br>
                    </p>
                    <p class="deskripsi" id="salary">
                        <b>
                    </p>
                    <p class="deskripsi" id="experience">
                        <b></b>
                    </p>
                </div>
            @else
                <div class="lowongan mt-0">
                    <div class="card-lowongan">
                        <div class="flex-header">
                            Lowongan tidak ditemukan
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
@push('additional-modal')
    @if (count($lowongans) > 0)
        <!-- Modal Data Belum Lengkap -->
        <div class="modal fade" id="data-belum-lengkap" tabindex="-1" role="dialog"
            aria-labelledby="exampledata-belum-lengkap" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="header">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <h2>Profil Anda Belum lengkap</h2>
                        </div>
                        <p class="pernyataan">
                            Untuk dapat melamar pekerjaan anda diwajibkan untuk melengkapi data, harap untuk melengkapi
                            detail
                            data berikut ini:
                        </p>
                        <ul>
                            <li>Data Pribadi</li>
                            <li>Data Keluarga</li>
                            <li>Data Kontak Darurat</li>
                            <li>Data Pendidikan</li>
                        </ul>

                        <div class="button">
                            <button class="batal" class="close-modal-interview" data-dismiss="modal">Batal</button>
                            <button class="lengkapi" onclick="window.location.href='/pengaturan/data-diri';">Lengkapi
                                Sekarang</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Kirim Lamaran -->

        <div class="modal fade" id="modal-kirim-lamaran" tabindex="-1" role="dialog"
            aria-labelledby="modal-kirim-lamaranTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="header">
                            <i class="fa-regular fa-circle-question"></i>
                            <h2>Kirim Lamaran</h2>
                        </div>

                        <p class="pernyataan">Harap isi data dibawah ini sebelum melamar pekerjaan :</p>

                        <form id="lamaranForm" action="{{ route('user.lamaran.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="lowongan_id" value="{{ $lowongan->id }}">
                            <div class="input-group">
                                <label for="">Gaji yang Diharapkan</label>
                                <input type="number" name="ekspektasi_gaji" placeholder="Masukkan Gaji....">
                            </div>
                            <div class="input-group">
                                <label for="">Tanggal Kesiapan bergabung</label>
                                <input type="date" name="tanggal_kesiapan_bergabung" class="waktu"
                                    placeholder="Masukkan Gaji....">
                            </div>
                            <div class="input-group">
                                <label for="">Benefit yang diharapkan</label>
                                <textarea name="benefit" id="" cols="30" rows="10"></textarea>
                            </div>

                            <div class="button">
                                <button class="batal" class="close-modal-interview" data-dismiss="modal">Batal</button>
                                <button class="kirim" data-toggle="modal" data-target="#berhasil-dikirim">
                                    Kirim Lamaran
                                    <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Lamaran Berhasil Dikirim -->
        <div class="modal fade" id="berhasil-dikirim" tabindex="-1" role="dialog"
            aria-labelledby="exampleberhasil-dikirim" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <h2 class="header">Lamaran Berhasil Dikirm</h2>
                        <img src="../assets/Success Icon.png" alt="">
                        <p class="pernyataan">Selamat lamaran anda berhasil terkirim, silahkan menunggu proses selanjutnya.
                            Anda dapat melihat proses lamaran di
                            <span>Lamaran Saya</span> pada halaman <span>profil</span>
                        </p>

                        <button data-dismiss="modal">
                            Saya Mengerti
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal f131pxade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="form-modalTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body" id="lamaran-interview">
                        <h2 class="nama-lamaran">Tax Staff</h2>
                        <div class="flex-header">
                            <p class="tempat">PT Telekomunikasi Seluler</p>
                            <div class="flex-status">
                                <p class="status-lowongan">Aktif</p>
                                <ul>
                                    <li>
                                        <p>Anda melamar 1 Hari yang lalu</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="flex-keterangan-lamaran">
                            <div class="isi-lamaran1">
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
                            </div>
                            <div class="isi-lamaran-line"></div>
                            <div class="isi-lamaran2">
                                <div class="gaji">
                                    <p>Harapan Gaji</p>
                                    <p class="bold">6.500.000</p>
                                </div>
                                <div class="gabung">
                                    <p>Kesediaan Bergabung</p>
                                    <p class="bold">12 Mei 2023</p>
                                </div>
                            </div>
                        </div>
                        <div class="garis-modal"></div>
                        <p class="deskripsi">
                            Disini area untuk alasan melamar dan penjelasan mengenai benefit yang diharapkan In publishing
                            and
                            graphic design, Lorem ipsum is a placeholder text commonly used to demonstrate the visual form
                            of a
                            document or a typeface without relying on meaningful content. Lorem ipsum may be used as a
                            placeholder before final copy is available.
                        </p>
                        <div class="garis-modal"></div>
                        <div class="proses">
                            <div class="tanggal">
                                <ul>
                                    <li>
                                        <p>24 Juni 2023</p>
                                    </li>
                                    <li>
                                        <p>24 Juni 2023</p>
                                    </li>
                                    <li>
                                        <p>24 Juni 2023</p>
                                    </li>
                                    <li>
                                        <p>24 Juni 2023</p>
                                    </li>
                                </ul>
                            </div>
                            <div class="bar-proses">
                                <div class="garis-proses">
                                    <div class="persen"></div>
                                </div>
                                <ul>
                                    <li><i class="fa-solid fa-circle active"></i></li>
                                    <li><i class="fa-solid fa-circle active"></i></li>
                                    <li><i class="fa-solid fa-circle active"></i></li>
                                    <li><i class="fa-solid fa-circle"></i></li>
                                </ul>
                            </div>
                            <div class="nama-proses">
                                <ul>
                                    <li>
                                        <p class="active">Proses Interview</p>
                                    </li>
                                    <li>
                                        <p class="active">Lamaran Anda Sedang Dilihat</p>
                                    </li>
                                    <li>
                                        <p class="active">Lamaran Terkirim</p>
                                    </li>
                                    <li>
                                        <p class="">Proses Interview</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="garis-modal"></div>
                        <div class="interview">
                            <div class="head-interview">
                                <p>Type Interview</p>
                                <p>Tempat</p>
                                <p>Waktu</p>
                            </div>
                            <div class="isi-interview">
                                <p>: Online Interview</p>
                                <p class="link">: <a href="">https.zoomlink.here/interview</a></p>
                                <p>: Senin, 08 Maret 2023 | 09:45</p>
                            </div>
                        </div>
                        <div class="garis-modal"></div>
                        <div class="flex-close">
                            <button type="button" class="close-modal-interview" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endpush

@push('additional-script')
    <script>
        $(document).ready(function() {
            $('.card-lowongan').on('click', function() {
                const id = $(this).data('id');

                // Menghapus kelas 'active-card' dari semua elemen
                $('.card-lowongan').removeClass('active-card');

                // Menambahkan kelas 'active-card' ke elemen yang diklik
                $(this).addClass('active-card');

                $.ajax({
                    url: '/get-lowongan/' + id,
                    type: 'GET',
                    success: function(data) {
                        // Mengatur konten deskripsi berdasarkan data yang diterima
                        $('#judul').text(data.judul);
                        $('#lokasi').text(data.company.name);
                        $('#deskripsi').text(data.deskripsi);
                        $('#salary').text("Range Gaji : IDR " + data.range_gaji);
                        $('#experience').text("Pengalaman : " + data.experience);

                        // Memeriksa apakah pengguna telah melamar atau belum
                        if (data.has_applied) {
                            $('#lamar').text('Sudah Melamar').prop('disabled', true).css(
                                'background-color', '#cccccc');
                        } else {
                            $('#lamar').text('Lamar Sekarang').prop('disabled', false).css(
                                'background-color', '');;
                        }
                    },
                    error: function(error) {
                        console.error("Terjadi kesalahan:", error);
                    }
                });
            });

            // Pemicu event klik pada elemen pertama
            $('.card-lowongan').first().trigger('click');
        });

        $(document).ready(function() {
            $('.lamar').on('click', function(e) {
                e.preventDefault(); // Menghentikan aksi default tombol

                $.ajax({
                    url: '/check-user-data',
                    type: 'GET',
                    success: function(data) {
                        if (data.isComplete) {
                            // Jika data lengkap, tampilkan modal Kirim Lamaran
                            $('#modal-kirim-lamaran').modal('show');
                        } else {
                            // Jika data tidak lengkap, tampilkan modal Data Belum Lengkap
                            $('#data-belum-lengkap').modal('show');
                        }
                    },
                    error: function(error) {
                        console.error("Terjadi kesalahan:", error);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#lamaranForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#modal-kirim-lamaran').modal('hide');
                    },
                    error: function(error) {
                        alert('Terjadi kesalahan saat mengirim lamaran.');
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#berhasil-dikirim').on('hidden.bs.modal', function() {
                location.reload();
            });
        });
    </script>
@endpush

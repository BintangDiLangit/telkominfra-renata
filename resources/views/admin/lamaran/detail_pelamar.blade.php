@extends('admin.layouts.master')
@push('top-style')
    <link href="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        .masonry-grid {
            column-count: 2;
            column-gap: 1rem;
        }

        .masonry-grid>.card {
            display: inline-block;
            width: 100%;
            margin-bottom: 1rem;
        }

        hr {
            border-width: 1px;
            border: 1px dashed red;
            border-style: solid;
        }
    </style>
@endpush
@section('title')
    Detail Lamaran
@endsection
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Milestone - {{ $lamaran->lowongan->judul }} -
        {{ $lamaran->milestone->nama_milestone }} - {{ $lamaran->user->name }} </h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4 p-5">
        <div class="row">
            <div class="col">
                <button class="btn btn-primary mb-3" id="approve">Lanjutkan ke proses -
                    @if (isset($nextMilestone))
                        {{ $nextMilestone->nama_milestone }}
                    @else
                        Lamaran Selesai
                    @endif
                </button>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button class="btn btn-warning mb-3" id="reject">Tolak Lamaran
                </button>
            </div>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="lamaran-details">
            <h2>Detail Lamaran</h2>
            <div class="masonry-grid">
                <div class="card">
                    <h5 class="card-header">Data Diri</h5>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <td>
                                    <img src="{{ asset('/storage/profile_photos/' . $lamaran->profile_photo) }}"
                                        height="200px" alt="Profile Photo">
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Nama Lengkap</strong></td>
                                <td>: {{ $lamaran->user->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Ekspektasi Gaji</strong></td>
                                <td>: {{ $lamaran->ekspektasi_gaji }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal Kesiapan Bergabung</strong></td>
                                <td>: {{ $lamaran->tanggal_kesiapan_bergabung }}</td>
                            </tr>
                            <tr>
                                <td><strong>Benefit yang diharapkan</strong></td>
                                <td>: {{ $lamaran->benefit }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tempat / Tanggal Lahir</strong></td>
                                <td>: {{ $lamaran->tempat_lahir }} / {{ $lamaran->tanggal_lahir }}</td>
                            </tr>
                            <tr>
                                <td><strong>Alamat Lengkap</strong></td>
                                <td>: {{ $lamaran->alamat_lengkap }}</td>
                            </tr>
                            <tr>
                                <td><strong>Nomor Telepon</strong></td>
                                <td>: {{ $lamaran->nomor_telepon }}</td>
                            </tr>
                            <tr>
                                <td><strong>Sosial Media</strong></td>
                                <td>
                                    <ul>
                                        @foreach (json_decode($lamaran->sosmeds, true) as $sosmed)
                                            <li>{{ $sosmed['nama_sosmed'] }} - <a
                                                    href="{{ $sosmed['url_sosmed'] }}">{{ $sosmed['url_sosmed'] }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card">
                    <h5 class="card-header mb-3">Data Keluarga</h5>
                    <?php
                    $keluargas = json_decode($lamaran->keluargas);
                    ?>
                    @if (count($keluargas) <= 1 && ($keluargas[0]->nama == '' || $keluargas[0]->nama == null))
                        <p class="ml-3"><b>Keluarga #-</b></p>
                    @else
                        @foreach (json_decode($lamaran->keluargas, true) as $keluarga)
                            <p class="ml-3"><b>Keluarga #{{ $loop->iteration }}</b></p>
                            <table class="table">
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $keluarga['nama'] }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $keluarga['alamat'] }}</td>
                                </tr>
                                <tr>
                                    <td>Hubungan</td>
                                    <td>: {{ $keluarga['hubungan'] }}</td>
                                </tr>
                            </table>
                        @endforeach
                    @endif
                </div>
                <div class="card">
                    <h5 class="card-header mb-3">Data Kontak Darurat</h5>
                    <?php
                    $kontak_darurats = json_decode($lamaran->kontak_darurats);
                    ?>
                    @if (count(json_decode($lamaran->kontak_darurats)) <= 1 &&
                            ($kontak_darurats[0]->nama == '' || $kontak_darurats[0]->nama == null))
                        <p class="ml-3"><b>Kontak Daruruat #-</b></p>
                    @else
                        @foreach (json_decode($lamaran->kontak_darurats, true) as $kontak_darurat)
                            <p class="ml-3"><b>Kontak Daruruat #{{ $loop->iteration }}</b></p>
                            <table class="table">
                                <tr>
                                    <td>Nama</td>
                                    <td>: {{ $kontak_darurat['nama'] }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: {{ $kontak_darurat['alamat'] }}</td>
                                </tr>
                                <tr>
                                    <td>Hubungan</td>
                                    <td>: {{ $kontak_darurat['hubungan'] }}</td>
                                </tr>
                            </table>
                        @endforeach
                    @endif
                </div>
                <div class="card">
                    <h5 class="card-header mb-3">Data Pendidikan</h5>
                    <?php
                    $pendidikans = json_decode($lamaran->pendidikans);
                    ?>
                    @if (count(json_decode($lamaran->pendidikans)) <= 1 &&
                            ($pendidikans[0]->nama_institusi == '' || $pendidikans[0]->nama_institusi == null))
                        <p class="ml-3"><b>Pendidikan #-</b></p>
                    @else
                        @foreach (json_decode($lamaran->pendidikans, true) as $pendidikan)
                            <p class="ml-3"><b>Pendidikan #{{ $loop->iteration }}</b></p>
                            <table class="table">
                                <tr>
                                    <td>Nama Institusi</td>
                                    <td>: {{ $pendidikan['nama_institusi'] }}</td>
                                </tr>
                                <tr>
                                    <td>Jenjang Pendidikan</td>
                                    <td>: {{ $pendidikan['jenjang_pendidikan'] }}</td>
                                </tr>
                                <tr>
                                    <td>Jurusan</td>
                                    <td>: {{ $pendidikan['jurusan'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tahun Mulai</td>
                                    <td>: {{ $pendidikan['tahun_mulai'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tahun Selesai</td>
                                    <td>: {{ $pendidikan['tahun_selesai'] }}</td>
                                </tr>
                                <tr>
                                    <td>IPK</td>
                                    <td>: {{ $pendidikan['ipk'] }}</td>
                                </tr>
                            </table>
                        @endforeach
                    @endif
                    <hr>
                    <?php
                    $organisasis = json_decode($lamaran->pendidikan_organisasis);
                    ?>
                    @if (count(json_decode($lamaran->pendidikan_organisasis)) <= 1 &&
                            ($organisasis[0]->nama_institusi == '' || $organisasis[0]->nama_institusi == null))
                        <p class="ml-3"><b>Organisasi #-</b></p>
                    @else
                        @foreach (json_decode($lamaran->pendidikan_organisasis, true) as $organisasi)
                            <p class="ml-3"><b>Organisasi #{{ $loop->iteration }}</b></p>
                            <table class="table">
                                <tr>
                                    <td>Nama Organisasi</td>
                                    <td>: {{ $organisasi['nama_organisasi'] }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>: {{ $organisasi['deskripsi'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tahun Mulai</td>
                                    <td>: {{ $organisasi['tahun_mulai'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tahun Selesai</td>
                                    <td>: {{ $organisasi['tahun_lulus'] }}</td>
                                </tr>
                                <tr>
                                    <td>Bukti</td>
                                    <td>: {{ isset($organisasi['upload_bukti']) ? $organisasi['upload_bukti'] : '-' }}</td>
                                </tr>
                            </table>
                        @endforeach
                    @endif
                    <hr>
                    <?php
                    $prestasis = json_decode($lamaran->pendidikan_prestasis);
                    ?>
                    @if (count(json_decode($lamaran->pendidikan_prestasis)) <= 1 &&
                            ($prestasis[0]->nama_prestasi == '' || $prestasis[0]->nama_prestasi == null))
                        <p class="ml-3"><b>Prestasi #-</b></p>
                    @else
                        @foreach (json_decode($lamaran->pendidikan_prestasis, true) as $prestasi)
                            <p class="ml-3"><b>Prestasi #{{ $loop->iteration }}</b></p>
                            <table class="table">
                                <tr>
                                    <td>Nama Prestasi</td>
                                    <td>: {{ $prestasi['nama_prestasi'] }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi</td>
                                    <td>: {{ $prestasi['deskripsi'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Mendapat Prestasi</td>
                                    <td>: {{ $prestasi['tahun_prestasi'] }}</td>
                                </tr>
                                <tr>
                                    <td>Bukti</td>
                                    <td>: {{ isset($prestasi['upload_bukti']) ? $prestasi['upload_bukti'] : '-' }}</td>
                                </tr>
                            </table>
                        @endforeach
                    @endif

                </div>
                <div class="card">
                    <h5 class="card-header mb-3">Data Riwayat Pekerjaan</h5>
                    <?php
                    $riwayat_pekerjaans = json_decode($lamaran->riwayat_pekerjaans);
                    ?>
                    @if (count(json_decode($lamaran->riwayat_pekerjaans)) <= 1 &&
                            ($riwayat_pekerjaans[0]->nama_perusahaan == '' || $riwayat_pekerjaans[0]->nama_perusahaan == null))
                        <p class="ml-3"><b>Riwayat Pekerjaan #-</b></p>
                    @else
                        @foreach (json_decode($lamaran->riwayat_pekerjaans, true) as $riwayat_pekerjaan)
                            <p class="ml-3"><b>Riwayat Pekerjaan #{{ $loop->iteration }}</b></p>
                            <table class="table">
                                <tr>
                                    <td>Nama Perusahaan</td>
                                    <td>: {{ $riwayat_pekerjaan['nama_perusahaan'] }}</td>
                                </tr>
                                <tr>
                                    <td>Alamat Perusahaan</td>
                                    <td>: {{ $riwayat_pekerjaan['alamat'] }}</td>
                                </tr>
                                <tr>
                                    <td>Keahlian</td>
                                    <td>: {{ $riwayat_pekerjaan['keahlian'] }}</td>
                                </tr>
                                <tr>
                                    <td>Jabatan</td>
                                    <td>: {{ $riwayat_pekerjaan['jabatan'] }}</td>
                                </tr>
                                <tr>
                                    <td>Deskripsi Pekerjaan</td>
                                    <td>: {{ $riwayat_pekerjaan['deskripsi'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Mulai</td>
                                    <td>: {{ $riwayat_pekerjaan['tahun_mulai'] }}</td>
                                </tr>
                                <tr>
                                    <td>Tanggal Selesai</td>
                                    <td>: {{ $riwayat_pekerjaan['tahun_selesai'] }}</td>
                                </tr>
                            </table>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Lanjutkan -->
    <div class="modal fade" id="confirmApprove" tabindex="-1" role="dialog" aria-labelledby="confirmApproveLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmApproveLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.lamaran.approve', ['lamaran_id' => $lamaran->id]) }}" method="POST"
                    id="approvalForm">
                    @csrf
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin melanjutkan ke proses {{ $nextMilestone->nama_milestone }}?</p>


                        <div id="interviewInputs" style="display: none;">
                            <div class="form-group">
                                <label for="remarkInterview">Catatan : </label>
                                <input type="text" name="remarkInterview" class="form-control" id="remarkInterview">
                            </div>
                            <div class="form-group">
                                <label for="interviewURL">Tempat (URL Vicon / Kantor Pusat / Dsb.):</label>
                                <input type="text" name="interviewURL" class="form-control" id="interviewURL">
                            </div>
                            <div class="form-group">
                                <label for="interviewTime">Waktu Interview:</label>
                                <input type="datetime-local" name="interviewTime" class="form-control"
                                    id="interviewDateTime">
                            </div>
                        </div>

                        <div id="testInputs" style="display: none;">
                            <div class="form-group">
                                <label for="remarkTest">Catatan : </label>
                                <input type="text" name="remarkTest" class="form-control" id="remarkTest">
                            </div>
                            <div class="form-group">
                                <label for="testURL">Tempat (URL Vicon / Kantor Pusat / Dsb.):</label>
                                <input type="text" name="testURL" class="form-control" id="testURL">
                            </div>
                            <div class="form-group">
                                <label for="taskTest">Soal Test (URL Test):</label>
                                <input type="text" name="taskTest" class="form-control" id="taskTest">
                            </div>
                            <div class="form-group">
                                <label for="testTime">Waktu Test / Batas Waktu Pengerjaan:</label>
                                <input type="datetime-local" name="testTime" class="form-control" id="testDateTime">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Lanjutkan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Tolak -->
    <div class="modal fade" id="confirmReject" tabindex="-1" role="dialog" aria-labelledby="confirmRejectLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmRejectLabel">Konfirmasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.lamaran.reject', ['lamaran_id' => $lamaran->id]) }}" method="POST"
                    id="rejectForm">
                    @csrf
                    <div class="modal-body">
                        Apakah Anda yakin ingin menolak lamaran ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/admin/js/demo/datatables-demo.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#approve').on('click', function() {
                var nextStep =
                    "@if (isset($nextMilestone)) {{ $nextMilestone->id }} @else Lamaran Selesai @endif";

                // Atur teks di modal
                $('#nextMilestone').text(nextStep);

                // Jika milestone adalah Interview, tampilkan input tambahan
                console.log(nextStep === 2);
                if (nextStep == 2) {
                    $('#interviewInputs').hide();
                } else if (nextStep == 3) {
                    $('#interviewInputs').show();
                } else if (nextStep == 4) {
                    $('#interviewInputs').hide();
                } else if (nextStep == 5) {
                    $('#testInputs').show();
                } else {
                    $('#interviewInputs').hide();
                }

                // Tampilkan modal
                $('#confirmApprove').modal('show');
            });

            $('#reject').on('click', function() {
                $('#confirmReject').modal('show');
            });
        });
    </script>
@endpush

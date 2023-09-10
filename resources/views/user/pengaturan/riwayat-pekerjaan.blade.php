@extends('user.layouts.master')
@section('title')
    Riwayat Pekerjaan
@endsection
@section('styleHead')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/pengaturan-akun-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/modal-form-style.css') }}">
@endsection
@section('content')
    <div class="container flex-main">
        <div class="side-bar">
            @include('user.component-datadiri.component-sidenav')
        </div>
        <div class="content">
            <h2 class="name-content">Pengaturan Akun</h2>

            <div class="card-pengaturan">
                <!-- Pengaturan Navbar -->
                <div class="nav-pengaturan">
                    <ul>
                        @include('user.component-datadiri.component-pengaturan-akun')
                    </ul>
                </div>

                <!-- Isi Pengaturan -->
                <div class="isi-riwayat-pekerjaan">
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
                    <h2 class="header-pekerjaan">Riwayat Pekerjaan</h2>
                    @if (count($riwayatPekerjaans) > 0)
                        @foreach ($riwayatPekerjaans as $riwayatPekerjaan)
                            <div class="card-pekerjaan">
                                <div class="flex-header-pekerjaan">
                                    <div class="kiri">
                                        <h2 class="tenpat-kerja">{{ $riwayatPekerjaan->nama_perusahaan }}</h2>
                                        <p class="bidang">{{ $riwayatPekerjaan->keahlian }}</p>
                                        <p class="jabatan">{{ $riwayatPekerjaan->jabatan }}</p>
                                    </div>
                                    <div class="kanan">
                                        <div class="flex-action">
                                            <i class="fa-solid fa-pen-to-square update-icon"
                                                data-id="{{ $riwayatPekerjaan->id }}"
                                                data-nama_perusahaan="{{ $riwayatPekerjaan->nama_perusahaan }}"
                                                data-keahlian="{{ $riwayatPekerjaan->keahlian }}"
                                                data-jabatan="{{ $riwayatPekerjaan->jabatan }}"
                                                data-tahun_mulai="{{ $riwayatPekerjaan->tahun_mulai }}"
                                                data-tahun_selesai="{{ $riwayatPekerjaan->tahun_selesai }}"
                                                data-deskripsi="{{ $riwayatPekerjaan->deskripsi }}"
                                                data-alamat="{{ $riwayatPekerjaan->alamat }}"></i>
                                            <i class="fa-solid fa-trash-can delete-icon"
                                                data-id="{{ $riwayatPekerjaan->id }}"></i>
                                        </div>
                                        <p class="tanggal-bekerja">
                                            <?php
                                            $dateTimeStart = new DateTime($riwayatPekerjaan->tahun_mulai);
                                            $formattedDateStart = $dateTimeStart->format('M Y');
                                            
                                            $dateTimeEnd = new DateTime($riwayatPekerjaan->tahun_selesai);
                                            $formattedDateEnd = $dateTimeEnd->format('M Y');
                                            
                                            ?>
                                            {{ $formattedDateStart }} -
                                            {{ isset($riwayatPekerjaan->tahun_selesai) ? $formattedDateEnd : 'Saat Ini' }}
                                        </p>
                                    </div>
                                </div>
                                <h3 class="deksripsi-pekerjaan">Deskripsi Pekerjaan</h3>
                                <p class="isi-deskripsi">{{ $riwayatPekerjaan->deskripsi }}
                                <h3 class="alamat-pekerjaan">Alamat Perusahaan</h3>
                                <p class="isi-alamat">{{ $riwayatPekerjaan->alamat }}</p>
                            </div>
                        @endforeach
                    @else
                        <div class="card-pendidikan mb-2">
                            <b class="text-danger" style="font-size: 70%">*Data Riwayat Pekerjaan Not Found</b>
                        </div>
                    @endif
                    <div class="footer-riwayat-pekerjaan">
                        <p class="jumlah-riwayat-pekerjaan">
                        </p>

                        <button data-toggle="modal" data-target="#form-modal">
                            Tambah Data Riwayat Pekerjaan
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('additional-modal')
    <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="form-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="name-form">Tambah Riwayat Bekerja</h2>
                    <form action="{{ route('pengaturan.riwayat.pekerjaan.store') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <label for="">Nama Perusahaan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_perusahaan" placeholder="Masukkan Nama Perusahaan" required>
                        </div>
                        <div class="input-group">
                            <label for="">Keahlian <span class="text-danger">*</span></label>
                            <input type="text" name="keahlian" placeholder="Masukkan Keahlian" required>
                        </div>
                        <div class="input-group">
                            <label for="">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" name="jabatan" placeholder="Masukkan Jabatan" required>
                        </div>
                        <div class="flex-group">
                            <div class="input-group">
                                <label for="">Tanggal Mulai <span class="text-danger">*</span></label>
                                <div class="input-tahun">
                                    <input type="date" name="tahun_mulai" placeholder="e.g., 2023" required>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="">Tanggal Selesai</label>
                                <div class="input-tahun">
                                    <input type="date" name="tahun_selesai" placeholder="e.g., 2023" required>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="">Deskripsi <span class="text-danger">*</span></label>
                            <textarea name="deskripsi" id="deskripsi" cols="30" rows="80" required></textarea>
                        </div>
                        <div class="input-group">
                            <label for="">Alamat <span class="text-danger">*</span></label>
                            <input type="text" name="alamat" required placeholder="Masukkan Alamat">
                        </div>
                        <div class="button-action">
                            <p></p>
                            <div class="action-batal-simpan">
                                <button class="batal" type="button" data-dismiss="modal">Batal</button>
                                <button class="simpan" type="submit" id="modal-submit-button">
                                    Simpan
                                    <i class="fa-solid fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete -->
    <div class="modal fade" id="delete-confirmation-modal" tabindex="-1" role="dialog"
        aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item?
                </div>
                <div class="modal-footer">
                    <form id="delete-form" method="POST" action="">
                        @method('DELETE')
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endpush
@push('additional-script')
    <script>
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function openModal(mode, data = {}) {
            const baseUrl = '/pengaturan/riwayat-pekerjaan/';
            const updateUrlPattern = baseUrl + ':id';
            if (mode === 'add') {
                document.querySelector('.name-form').innerText = 'Tambah Riwayat Pekerjaan';
                document.getElementById('modal-submit-button').innerText = 'Simpan';
                // Set form action for adding
                document.querySelector('#form-modal form').action = '{{ route('pengaturan.kontak.darurat.store') }}';
            } else if (mode === 'update') {
                document.querySelector('.name-form').innerText = 'Update Riwayat Pekerjaan';
                document.getElementById('modal-submit-button').innerText = 'Update';
                // Replace :id with the actual id
                const updateUrl = updateUrlPattern.replace(':id', data.id);
                document.querySelector('#form-modal form').action = updateUrl;
                // Populate form fields
                document.querySelector('input[name="nama_perusahaan"]').value = data.nama_perusahaan || '';
                document.querySelector('input[name="keahlian"]').value = data.keahlian || '';
                document.querySelector('input[name="jabatan"]').value = data.jabatan || '';
                document.querySelector('input[name="tahun_mulai"]').value = data.tahun_mulai || '';
                document.querySelector('input[name="tahun_selesai"]').value = data.tahun_selesai || '';
                document.querySelector('textarea[name="deskripsi"]').value = data.deskripsi || '';
                document.querySelector('input[name="alamat"]').value = data.alamat || '';
            }
            $('#form-modal').modal('show');
        }


        document.addEventListener('DOMContentLoaded', function() {
            const updateIcons = document.querySelectorAll('.update-icon');

            updateIcons.forEach(function(icon) {
                icon.addEventListener('click', function() {
                    const data = {
                        id: this.getAttribute('data-id'),
                        nama_perusahaan: this.getAttribute('data-nama_perusahaan'),
                        keahlian: this.getAttribute('data-keahlian'),
                        jabatan: this.getAttribute('data-jabatan'),
                        tahun_mulai: this.getAttribute('data-tahun_mulai'),
                        tahun_selesai: this.getAttribute('data-tahun_selesai'),
                        deskripsi: this.getAttribute('data-deskripsi'),
                        alamat: this.getAttribute('data-alamat')
                    };

                    openModal('update', data);
                });
            });
        });

        $('#form-modal').on('hidden.bs.modal', function() {
            resetModal();
        });

        function resetModal() {
            document.querySelector('.name-form').innerText = 'Tambah Riwayat Pekerjaan';
            document.getElementById('modal-submit-button').innerText = 'Simpan';
            document.querySelector('#form-modal form').action = '{{ route('pengaturan.kontak.darurat.store') }}';

            // Reset all input fields
            document.querySelector('input[name="nama_perusahaan"]').value = '';
            document.querySelector('input[name="keahlian"]').value = '';
            document.querySelector('input[name="jabatan"]').value = '';
            document.querySelector('input[name="tahun_mulai"]').value = '';
            document.querySelector('input[name="tahun_selesai"]').value = '';
            document.querySelector('textarea[name="deskripsi"]').value = '';
            document.querySelector('input[name="alamat"]').value = '';
        }

        document.addEventListener('DOMContentLoaded', function() {
            const deleteIcons = document.querySelectorAll('.delete-icon');

            deleteIcons.forEach(function(icon) {
                icon.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const deleteForm = document.getElementById('delete-form');

                    // Set the form action to the correct delete URL
                    deleteForm.action = `/pengaturan/riwayat-pekerjaan/${id}`;

                    // Show the confirmation modal
                    $('#delete-confirmation-modal').modal('show');
                });
            });
        });
    </script>
@endpush

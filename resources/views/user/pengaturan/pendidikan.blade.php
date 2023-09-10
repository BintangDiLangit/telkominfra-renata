@extends('user.layouts.master')
@section('title')
    Pendidikan
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
                <div class="isi-pendidikan">
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
                    <h2 class="header-pendidikan">Data Pendidikan</h2>
                    @if (count($pendidikans) > 0)
                        @foreach ($pendidikans as $pendidikan)
                            <div class="card-pendidikan mb-2">
                                <div class="flex-header-pendidikan">
                                    <h1 class="tempat-pendidikan">{{ $pendidikan->nama_institusi }}</h1>
                                    <div class="flex-action">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                        <i class="fa-solid fa-trash-can"></i>
                                    </div>
                                </div>

                                <div class="flex-deskripsi-pendidikan">
                                    <div class="deskripsi">
                                        <p class="tingkatan">{{ $pendidikan->jenjang_pendidikan }}</p>
                                        <p class="jurusan">{{ $pendidikan->jurusan }}</p>
                                    </div>
                                    <div class="number">
                                        <p class="tahun">{{ $pendidikan->tahun_mulai }} - {{ $pendidikan->tahun_selesai }}
                                        </p>
                                        <p class="ipk">IPK {{ $pendidikan->ipk }}</p>
                                    </div>
                                    <div class="link-view">
                                        <a href="">
                                            <p>Lihat Pengalaman Organisasi</p>
                                        </a>
                                        <a href="">
                                            <p>Lihat Prestasi</p>
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    @else
                        <div class="card-pendidikan mb-2">
                            <b class="text-danger" style="font-size: 70%">*Data Pendidikan Not Found</b>
                        </div>
                    @endif

                    <div class="footer-pendidikan">
                        <p class="jumlah-pendidikan">
                        </p>
                        <button data-toggle="modal" data-target="#form-modal">
                            Tambah Data Pendidikan
                            <i class="fa-solid fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('additional-modal')
    <!-- Modal Add / Update -->
    <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="form-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <h2 class="name-form">Tambah Data Pendidikan</h2>
                    <form action="{{ route('pengaturan.pendidikan.store') }}" method="post" data-parsley-validate
                        enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <label for="">Nama Institusi Pendidikan <span class="text-danger">*</span></label>
                            <input type="text" name="nama_institusi" placeholder="Masukkan Nama Institusi Pendidikan">
                        </div>
                        <div class="input-group">
                            <label for="">Jenjang Pendidikan <span class="text-danger">*</span></label>
                            <select name="jenjang_pendidikan" id="">
                                <option value="S1">S1</option>
                                <option value="D3">D3</option>
                                <option value="D2">D2</option>
                                <option value="D1">D1</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="">Jurusan <span class="text-danger">*</span></label>
                            <input type="text" name="jurusan" placeholder="Masukkan Jurusan">
                        </div>
                        <div class="flex-group">
                            <div class="input-group">
                                <label for="">Tahun Mulai <span class="text-danger">*</span></label>
                                <div class="input-tahun">
                                    <input type="number" id="year" name="tahun_mulai_pend" min="1900"
                                        max="2099" placeholder="e.g., 2023">
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="">Tahun Selesai <span class="text-danger">*</span></label>
                                <div class="input-tahun">
                                    <input type="number" id="year" name="tahun_selesai_pend" min="1900"
                                        max="2099" placeholder="e.g., 2023">
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="">IPK <span class="text-danger">*</span></label>
                            <input type="text" name="ipk" placeholder="Masukkan IPK">
                        </div>

                        <!-- Organisasi -->
                        <h2 class="name-form">Pengalaman Berorganisasi</h2>
                        <div class="organisasi-container">
                            <div class="organisasi-form organisasi-template">

                                <div class="input-group">
                                    <label for="">Nama Organisasi</label>
                                    <input type="text" name="nama_organisasi[]"
                                        placeholder="Masukkan Nama Organisasi">
                                </div>


                                <div class="input-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="deskripsi_org[]" id="" cols="30" rows="80"></textarea>
                                </div>

                                <div class="flex-group">
                                    <div class="input-group">
                                        <label for="">Tahun Mulai</label>
                                        <div class="input-tahun">
                                            <input type="number" name="tahun_mulai_org[]" id="year" min="1900"
                                                max="2099" placeholder="e.g., 2023">
                                        </div>
                                    </div>
                                    <div class="input-group">
                                        <label for="">Tahun Selesai</label>
                                        <div class="input-tahun">
                                            <input type="number" name="tahun_lulus_org[]" id="year" min="1900"
                                                max="2099" placeholder="e.g., 2023">
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <label for="bukti-organisasi">Upload Bukti (Opsional)</label>
                                    <label for="bukti-organisasi" class="nama-file">Upload Bukti Organisasi</label>
                                    <input type="file" id="bukti-organisasi" accept="image/*" name="bukti_org[]"
                                        class="upload-file">
                                    <p id="selected-file-name-organisasi" style="font-size: 65%" class="text-center p-1">
                                        No
                                        file chosen</p>
                                </div>
                            </div>
                        </div>

                        <button class="button-tambah" id="button-tambah-organisasi">Tambah Pengalaman
                            Berorganisasi</button>

                        <!-- Prestasi -->
                        <h2 class="name-form">Prestasi</h2>

                        <div class="prestasi-container">
                            <div class="prestasi-form prestasi-template">
                                <div class="input-group">
                                    <label for="">Nama Prestasi</label>
                                    <input type="text" name="nama_prestasi[]" placeholder="Masukkan Nama Prestasi">
                                </div>


                                <div class="input-group">
                                    <label for="">Deskripsi</label>
                                    <textarea name="deskripsi_prestasi[]" id="" cols="30" rows="80"></textarea>
                                </div>

                                <div class="flex-group">
                                    <div class="input-group">
                                        <label for="">Tahun Mendapat Prestasi</label>
                                        <div class="input-tahun">
                                            <input type="number" id="year" name="tahun_prestasi[]" min="1900"
                                                max="2099" placeholder="e.g., 2023">
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <label for="bukti-prestasi">Bukti Prestasi</label>
                                    <label for="bukti-prestasi" class="nama-file">Upload Sertifikasi</label>
                                    <input type="file" id="bukti-prestasi" name="bukti_prestasi[]"
                                        class="upload-file" accept="image/*">
                                    <p id="selected-file-name-prestasi" style="font-size: 65%" class="text-center p-1">No
                                        file chosen</p>
                                </div>
                            </div>
                        </div>

                        <button class="button-tambah" id="button-tambah-prestasi">Tambah Prestasi</button>

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
            const baseUrl = '/pengaturan/pendidikan/';
            const updateUrlPattern = baseUrl + ':id';
            if (mode === 'add') {
                document.querySelector('.name-form').innerText = 'Tambah Pendidikan';
                document.getElementById('modal-submit-button').innerText = 'Simpan';
                // Set form action for adding
                document.querySelector('#form-modal form').action = '{{ route('pengaturan.pendidikan.store') }}';
            } else if (mode === 'update') {
                document.querySelector('.name-form').innerText = 'Update Pendidikan';
                document.getElementById('modal-submit-button').innerText = 'Update';
                // Replace :id with the actual id
                const updateUrl = updateUrlPattern.replace(':id', data.id);
                document.querySelector('#form-modal form').action = updateUrl;
                // Populate form fields
                document.querySelector('input[name="nama"]').value = data.nama || '';
                document.querySelector('textarea[name="alamat"]').value = data.alamat || '';
                document.querySelector('input[name="nomor_telepon"]').value = data.nomor_telepon || '';

                $('select[name="hubungan"]').val(data.hubungan);
            }
            $('#form-modal').modal('show');
        }


        document.addEventListener('DOMContentLoaded', function() {
            const updateIcons = document.querySelectorAll('.update-icon');

            updateIcons.forEach(function(icon) {
                icon.addEventListener('click', function() {
                    const data = {
                        id: this.getAttribute('data-id'),
                        hubungan: this.getAttribute('data-hubungan'),
                        nama: this.getAttribute('data-nama'),
                        alamat: this.getAttribute('data-alamat'),
                        nomor_telepon: this.getAttribute('data-nomor_telepon')
                    };

                    openModal('update', data);
                });
            });
        });

        $('#form-modal').on('hidden.bs.modal', function() {
            resetModal();
        });

        function resetModal() {
            document.querySelector('.name-form').innerText = 'Tambah Pendidikan';
            document.getElementById('modal-submit-button').innerText = 'Simpan';
            document.querySelector('#form-modal form').action = '{{ route('pengaturan.pendidikan.store') }}';

            // Reset all input fields
            document.querySelector('input[name="nama"]').value = '';
            document.querySelector('textarea[name="alamat"]').value = '';
            document.querySelector('input[name="nomor_telepon"]').value = '';
            $('select[name="hubungan"]').prop('selectedIndex', 0); // set first option as selected
        }

        document.addEventListener('DOMContentLoaded', function() {
            const deleteIcons = document.querySelectorAll('.delete-icon');

            deleteIcons.forEach(function(icon) {
                icon.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const deleteForm = document.getElementById('delete-form');

                    // Set the form action to the correct delete URL
                    deleteForm.action = `/pengaturan/pendidikan/${id}`;

                    // Show the confirmation modal
                    $('#delete-confirmation-modal').modal('show');
                });
            });
        });

        // Add More Organisasi
        document.addEventListener('DOMContentLoaded', function() {
            const addButton = document.querySelector('#button-tambah-organisasi');
            const container = document.querySelector(
                '.organisasi-container'); // Anda mungkin perlu menambahkan class ini ke container form Anda

            addButton.addEventListener('click', function(e) {
                e.preventDefault();

                const template = document.querySelector('.organisasi-template').cloneNode(
                    true); // Ganti dengan selector yang sesuai
                template.classList.remove('organisasi-template');
                container.appendChild(template);
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const addButton = document.querySelector('#button-tambah-prestasi');
            const container = document.querySelector(
                '.prestasi-container'); // Anda mungkin perlu menambahkan class ini ke container form Anda

            addButton.addEventListener('click', function(e) {
                e.preventDefault();

                const template = document.querySelector('.prestasi-template').cloneNode(
                    true); // Ganti dengan selector yang sesuai
                template.classList.remove('prestasi-template');
                container.appendChild(template);
            });
        });



        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('bukti-prestasi');
            const fileNameDisplay = document.getElementById('selected-file-name-prestasi');

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    fileNameDisplay.textContent = fileInput.files[0].name;
                } else {
                    fileNameDisplay.textContent = 'No file chosen';
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('bukti-organisasi');
            const fileNameDisplay = document.getElementById('selected-file-name-organisasi');

            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    fileNameDisplay.textContent = fileInput.files[0].name;
                } else {
                    fileNameDisplay.textContent = 'No file chosen';
                }
            });
        });
    </script>
@endpush

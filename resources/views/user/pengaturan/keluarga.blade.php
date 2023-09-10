@extends('user.layouts.master')
@section('title')
    Keluarga
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
                <div class="isi-keluarga">
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
                    <h2 class="keluarga-header">Data Keluarga</h2>

                    <div class="card-table-keluarga">
                        <table>
                            <tr class="header-card">
                                <th>Hubungan</th>
                                <th>Nama</th>
                                <th>Tempat & Tanggal Lahir</th>
                                <th>Pekerjaan</th>
                                <th class="alamat">Alamat</th>
                                <th>Nomor Telepon</th>
                                <th>Action</th>
                            </tr>
                            @if (count($keluargas) > 0)
                                @foreach ($keluargas as $keluarga)
                                    <tr>
                                        <td>{{ $keluarga->hubungan }}</td>
                                        <td>{{ $keluarga->nama }}</td>
                                        <td>{{ $keluarga->tempat_lahir . ', ' . $keluarga->tanggal_lahir }}</td>
                                        <td>{{ $keluarga->pekerjaan }}</td>
                                        <td>{{ $keluarga->alamat }}</td>
                                        <td>{{ $keluarga->nomor_telepon }}</td>
                                        <td>
                                            <i class="fa-solid fa-pen-to-square update-icon" data-id="{{ $keluarga->id }}"
                                                data-hubungan_keluarga="{{ $keluarga->hubungan }}"
                                                data-nama_lengkap="{{ $keluarga->nama }}"
                                                data-tempat_lahir="{{ $keluarga->tempat_lahir }}"
                                                data-tanggal_lahir="{{ $keluarga->tanggal_lahir }}"
                                                data-pekerjaan="{{ $keluarga->pekerjaan }}"
                                                data-alamat_lengkap="{{ $keluarga->alamat }}"
                                                data-nomor_telepon="{{ $keluarga->nomor_telepon }}"></i>
                                            <i class="fa-solid fa-trash-can delete-icon" data-id="{{ $keluarga->id }}"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="kolom-kosong">*Data Keluarga Not Found</td>
                                </tr>
                            @endif
                        </table>


                        <div class="table-footer">
                            <p class="jumlah-keluarga"></p>
                            <button data-toggle="modal" data-target="#form-modal">
                                Tambah Anggota Keluarga
                                <i class="fa-solid fa-angle-right"></i>
                            </button>
                        </div>
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
                    <h2 class="name-form">Tambah Anggota Keluarga</h2>
                    <form action="{{ route('pengaturan.keluarga.store') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <label for="">Hubungan Keluarga <span class="text-danger">*</span></label>
                            <select name="hubungan_keluarga" id="" required>
                                <option value=""> - Pilih -</option>
                                <option value="Kakak Kandung">Kakak Kandung</option>
                                <option value="Adik Kandung">Adik Kandung</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="">Nama Lengkap <span class="text-danger">*</span></label>
                            <input type="text" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" required>
                        </div>
                        <div class="input-group">
                            <label for="">Tempat & Tanggal Lahir <span class="text-danger">*</span></label>
                            <div class="input-flex">
                                <input type="text" class="tempat-lahir" name="tempat_lahir"
                                    placeholder="Masukkan Tempat Lahir" required>
                                <input type="date" class="tanggal-lahir" name="tanggal_lahir" placeholder="" required>
                            </div>
                        </div>
                        <div class="input-group">
                            <label for="">Pekerjaan <span class="text-danger">*</span></label>
                            <input type="text" name="pekerjaan" placeholder="Masukkan Pekerjaan" required>
                        </div>
                        <div class="input-group">
                            <label for="">Alamat Lengkap <span class="text-danger">*</span></label>
                            <textarea name="alamat_lengkap" id="" cols="30" rows="80" required></textarea>
                        </div>
                        <div class="input-group">
                            <label for="">Nomor Telepon <span class="text-danger">*</span></label>
                            <input type="text" name="nomor_telepon" placeholder="Masukkan Nomor Telepon" required>
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
        function openModal(mode, data = {}) {
            const baseUrl = '/pengaturan/keluarga/';
            const updateUrlPattern = baseUrl + ':id';
            if (mode === 'add') {
                document.querySelector('.name-form').innerText = 'Tambah Anggota Keluarga';
                document.getElementById('modal-submit-button').innerText = 'Simpan';
                // Set form action for adding
                document.querySelector('#form-modal form').action = '{{ route('pengaturan.keluarga.store') }}';
            } else if (mode === 'update') {
                document.querySelector('.name-form').innerText = 'Update Anggota Keluarga';
                document.getElementById('modal-submit-button').innerText = 'Update';
                // Replace :id with the actual id
                const updateUrl = updateUrlPattern.replace(':id', data.id);
                document.querySelector('#form-modal form').action = updateUrl;
                // Populate form fields
                document.querySelector('input[name="nama_lengkap"]').value = data.nama_lengkap || '';
                document.querySelector('input[name="tempat_lahir"]').value = data.tempat_lahir || '';
                document.querySelector('input[name="tanggal_lahir"]').value = data.tanggal_lahir || '';
                document.querySelector('input[name="pekerjaan"]').value = data.pekerjaan || '';
                document.querySelector('textarea[name="alamat_lengkap"]').value = data.alamat_lengkap || '';
                document.querySelector('input[name="nomor_telepon"]').value = data.nomor_telepon || '';

                $('select[name="hubungan_keluarga"]').val(data.hubungan_keluarga);
            }
            $('#form-modal').modal('show');
        }


        document.addEventListener('DOMContentLoaded', function() {
            const updateIcons = document.querySelectorAll('.update-icon');

            updateIcons.forEach(function(icon) {
                icon.addEventListener('click', function() {
                    const data = {
                        id: this.getAttribute('data-id'),
                        hubungan_keluarga: this.getAttribute('data-hubungan_keluarga'),
                        nama_lengkap: this.getAttribute('data-nama_lengkap'),
                        tempat_lahir: this.getAttribute('data-tempat_lahir'),
                        tanggal_lahir: this.getAttribute('data-tanggal_lahir'),
                        pekerjaan: this.getAttribute('data-pekerjaan'),
                        alamat_lengkap: this.getAttribute('data-alamat_lengkap'),
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
            document.querySelector('.name-form').innerText = 'Tambah Anggota Keluarga';
            document.getElementById('modal-submit-button').innerText = 'Simpan';
            document.querySelector('#form-modal form').action = '{{ route('pengaturan.keluarga.store') }}';

            // Reset all input fields
            document.querySelector('input[name="nama_lengkap"]').value = '';
            document.querySelector('input[name="tempat_lahir"]').value = '';
            document.querySelector('input[name="tanggal_lahir"]').value = '';
            document.querySelector('input[name="pekerjaan"]').value = '';
            document.querySelector('textarea[name="alamat_lengkap"]').value = '';
            document.querySelector('input[name="nomor_telepon"]').value = '';
            $('select[name="hubungan_keluarga"]').prop('selectedIndex', 0); // set first option as selected
        }


        document.addEventListener('DOMContentLoaded', function() {
            const deleteIcons = document.querySelectorAll('.delete-icon');

            deleteIcons.forEach(function(icon) {
                icon.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const deleteForm = document.getElementById('delete-form');

                    // Set the form action to the correct delete URL
                    deleteForm.action = `/pengaturan/keluarga/${id}`;

                    // Show the confirmation modal
                    $('#delete-confirmation-modal').modal('show');
                });
            });
        });
    </script>
@endpush

@extends('user.layouts.master')
@section('title')
    Kontak Darurat
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
                    <h2 class="keluarga-header">Kontak Darurat</h2>

                    <div class="card-table-keluarga">
                        <table>
                            <tr class="header-card">
                                <th>Hubungan</th>
                                <th>Nama</th>
                                <th>Nomor Telepon</th>
                                <th>Alamat</th>
                            </tr>
                            @if (count($kontakDarurats) > 0)
                                @foreach ($kontakDarurats as $kd)
                                    <tr>
                                        <td>{{ $kd->hubungan }}</td>
                                        <td>{{ $kd->nama }}</td>
                                        <td>{{ $kd->nomor_telepon }}</td>
                                        <td>{{ $kd->alamat }}</td>
                                        <td>
                                            <i class="fa-solid fa-pen-to-square update-icon" data-id="{{ $kd->id }}"
                                                data-hubungan="{{ $kd->hubungan }}" data-nama="{{ $kd->nama }}"
                                                data-alamat="{{ $kd->alamat }}"
                                                data-nomor_telepon="{{ $kd->nomor_telepon }}"></i>
                                            <i class="fa-solid fa-trash-can delete-icon" data-id="{{ $kd->id }}"></i>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" class="kolom-kosong">*Data Kontak Darurat Not Found</td>
                                </tr>
                            @endif
                        </table>

                        <div class="table-footer">
                            <p class="jumlah-keluarga"></p>
                            <button data-toggle="modal" data-target="#form-modal">
                                Tambah Kontak Darurat
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
                    <h2 class="name-form">Tambah Kontak Darurat</h2>
                    <form action="{{ route('pengaturan.kontak.darurat.store') }}" method="post">
                        @csrf
                        <div class="input-group">
                            <label for="">Hubungan</label>
                            <select name="hubungan" id="">
                                <option value=""> - Pilih -</option>
                                <option value="Kakak Kandung">Kakak Kandung</option>
                                <option value="Adik Kandung">Adik Kandung</option>
                            </select>
                        </div>
                        <div class="input-group">
                            <label for="">Nama Lengkap</label>
                            <input type="text" name="nama" placeholder="Masukkan Nama Lengkap">
                        </div>
                        <div class="input-group">
                            <label for="">Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" placeholder="Masukkan Nomor Telepon">
                        </div>
                        <div class="input-group">
                            <label for="">Alamat Lengkap</label>
                            <textarea name="alamat" id="" cols="30" rows="80"></textarea>
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
    <div class="modal fade" id="delete-confirmation-modal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
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
            const baseUrl = '/pengaturan/kontak-darurat/';
            const updateUrlPattern = baseUrl + ':id';
            if (mode === 'add') {
                document.querySelector('.name-form').innerText = 'Tambah Kontak Darurat';
                document.getElementById('modal-submit-button').innerText = 'Simpan';
                // Set form action for adding
                document.querySelector('#form-modal form').action = '{{ route('pengaturan.kontak.darurat.store') }}';
            } else if (mode === 'update') {
                document.querySelector('.name-form').innerText = 'Update Kontak Darurat';
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
            document.querySelector('.name-form').innerText = 'Tambah Kontak Darurat';
            document.getElementById('modal-submit-button').innerText = 'Simpan';
            document.querySelector('#form-modal form').action = '{{ route('pengaturan.kontak.darurat.store') }}';

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
                    deleteForm.action = `/pengaturan/kontak-darurat/${id}`;

                    // Show the confirmation modal
                    $('#delete-confirmation-modal').modal('show');
                });
            });
        });
    </script>
@endpush

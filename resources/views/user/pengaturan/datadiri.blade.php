@extends('user.layouts.master')
@section('title')
    Data Diri
@endsection
@section('styleHead')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/pengaturan-akun-style.css') }}">
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
                <div class="isi-data-diri">
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
                    <form action="{{ route('pengaturan.data.diri.update') }}" method="post" data-parsley-validate
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-kiri">
                            <div class="foto">
                                <img src="{{ isset($dataDiri->profile_photo) ? asset('storage/profile_photos/' . $dataDiri->profile_photo) : asset('assets/profil-besar.png') }}"
                                    alt="">
                                <label for="coba-foto" class="upload-foto">
                                    <input type="file" name="profile_photo" class="input-foto" id="coba-foto"
                                        accept="image/*">
                                    <p>Pilih Foto</p>
                                    <i class="fa-solid fa-angle-right"></i>
                                </label>
                                <p>Besar file : maksimum 10mb</p>
                                <p>Ekstensi file yang diperbolehkan. JPG, JPEG, PNG.</p>
                            </div>
                            {{-- <button class="ubah-sandi">Ubah Kata Sandi</button> --}}
                        </div>
                        <div class="form-kanan">
                            <h2 class="form-header">
                                Ubah Data Diri
                            </h2>

                            <div class="input-group">
                                <label for="">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" class="input-panjang" name="nama_lengkap"
                                    placeholder="Masukkan nama lengkap anda"
                                    value="{{ isset($dataDiri->name) ? $dataDiri->name : '' }}" required>
                            </div>
                            <div class="input-group">
                                <label for="">Tempat & Tanggal Lahir <span class="text-danger">*</span></label>
                                <div class="flex-input">
                                    <input type="text" class="tempat-lahir" name="tempat_lahir"
                                        value="{{ isset($dataDiri->tempat_lahir) ? $dataDiri->tempat_lahir : '' }}"
                                        placeholder="Masukkan tempat lahir anda">
                                    <input type="date" class="tanggal-lahir" name="tanggal_lahir" placeholder=""
                                        value="{{ isset($dataDiri->tanggal_lahir) ? $dataDiri->tanggal_lahir : '' }}"
                                        required>
                                </div>
                            </div>
                            <div class="input-group">
                                <label for="">Pekerjaan / Keahlian <span class="text-danger">*</span></label>
                                <select class="input-panjang" name="keahlian_id" required>
                                    <option value=""> - Pilih - </option>
                                    @foreach ($masterKeahlian as $keahlian)
                                        <option value="{{ $keahlian->id }}"
                                            {{ $keahlian->id == $dataDiri->keahlian_id ? 'selected' : '' }}>
                                            {{ $keahlian->nama_master_keahlian }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group">
                                <label for="">Posisi/ Jabatan Terakhir <span class="text-danger">*</span></label>
                                <select class="input-panjang" name="jabatan_id" required>
                                    <option value=""> - Pilih - </option>
                                    @foreach ($masterJabatan as $jabatan)
                                        <option value="{{ $jabatan->id }}"
                                            {{ $jabatan->id == $dataDiri->jabatan_id ? 'selected' : '' }}>
                                            {{ $jabatan->nama_master_jabatan }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group">
                                <label for="">Alamat Lengkap <span class="text-danger">*</span></label>
                                <textarea id="" name="alamat_lengkap" cols="30" rows="5" required>{{ isset($dataDiri->alamat_lengkap) ? $dataDiri->alamat_lengkap : '' }}</textarea>
                            </div>
                            <div class="input-group">
                                <label for="">Nomor Telepon <span class="text-danger">*</span></label>
                                <input type="text" name="nomor_telepon" class="input-panjang"
                                    placeholder="Masukkan nomor telephone anda"
                                    value="{{ isset($dataDiri->nomor_telepon) ? $dataDiri->nomor_telepon : '' }}" required>
                            </div>
                            <div class="input-group">
                                <label for="">Alamat Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="input-panjang" placeholder="Masukkan email anda"
                                    value="{{ isset($dataDiri->email) ? $dataDiri->email : '' }}" required>
                            </div>
                            <div class="input-group">
                                <label for="">Sosial Media <span class="text-danger">*</span></label>
                            </div>
                            @if ($dataDiri->sosmeds && count($dataDiri->sosmeds) > 0)
                                @foreach ($dataDiri->sosmeds as $sosmed)
                                    <div class="input-group" id="sosmed">
                                        <div class="flex-input">
                                            <select class="nama-sosial" name="nama_sosial[]" required>
                                                <option value=""> - Pilih - </option>
                                                <option value="LinkedIn"
                                                    {{ $sosmed->nama_sosmed == 'LinkedIn' ? 'selected' : '' }}>
                                                    LinkedIn
                                                </option>
                                                <option value="Facebook"
                                                    {{ $sosmed->nama_sosmed == 'Facebook' ? 'selected' : '' }}>
                                                    Facebook
                                                </option>
                                                <option value="Instagram"
                                                    {{ $sosmed->nama_sosmed == 'Instagram' ? 'selected' : '' }}>
                                                    Instagram
                                                </option>
                                                <option value="Tiktok"
                                                    {{ $sosmed->nama_sosmed == 'Tiktok' ? 'selected' : '' }}>
                                                    Tiktok
                                                </option>
                                            </select>
                                            <input type="text" name="url_sosial[]" class="url-sosial"
                                                placeholder="Masukkan url sosial media"
                                                value="{{ isset($sosmed->url_sosmed) ? $sosmed->url_sosmed : '' }}"
                                                required>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group" id="sosmed">
                                    <div class="flex-input">
                                        <select class="nama-sosial" name="nama_sosial[]" required>
                                            <option value=""> - Pilih - </option>
                                            <option value="LinkedIn">LinkedIn</option>
                                            <option value="Facebook">Facebook</option>
                                            <option value="Instagram">Instagram</option>
                                            <option value="Tiktok">Tiktok</option>
                                        </select>
                                        <input type="text" name="url_sosial[]" class="url-sosial"
                                            placeholder="Masukkan url sosial media" required>
                                    </div>
                                </div>
                            @endif

                            <div class="input-group">
                                <button class="button-tambah">
                                    <i class="fa-solid fa-circle-plus"></i>
                                    Tambah Sosial Media
                                </button>
                            </div>

                            <div class="flex-button-submit">
                                <button class="submit" type="submit">
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
@endsection
@push('additional-script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event listener for the "Tambah Sosial Media" button
            document.querySelector('.button-tambah').addEventListener('click', function(e) {
                e.preventDefault();

                // Clone the input-group
                let newInputGroup = document.getElementById('sosmed').cloneNode(true);

                // Clear the values in the cloned group
                let select = newInputGroup.querySelector('.nama-sosial');
                let input = newInputGroup.querySelector('.url-sosial');
                if (select) {
                    select.selectedIndex = 0;
                }
                if (input) {
                    input.value = "";
                }

                // Insert the cloned group before the button
                e.target.parentNode.insertBefore(newInputGroup, e.target);

                // Add event listener for the new "Hapus Sosial Media" button
                addRemoveEventListener(newInputGroup);
            });

            // Function to add an event listener for the "Hapus Sosial Media" button
            function addRemoveEventListener(inputGroup) {
                let removeButton = inputGroup.getElementById('btn-remove');
                if (removeButton) {
                    removeButton.addEventListener('click', function(e) {
                        e.preventDefault();
                        inputGroup.remove();
                    });
                }
            }

            // Add event listener for the existing "Hapus Sosial Media" button
            let initialInputGroup = document.getElementById('sosmed').cloneNode(true);
            addRemoveEventListener(initialInputGroup);
        });


        document.getElementById('coba-foto').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Setting the src of the image to the data URL, which represents the file's contents.
                    document.querySelector('.foto img').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endpush

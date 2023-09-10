@extends('user.layouts.master')
@section('title')
    Dokumen
@endsection
@section('styleHead')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/pengaturan-akun-style.css') }}">
@endsection
@section('content')
    <form action="{{ route('pengaturan.dokumen.store') }}" method="post" enctype="multipart/form-data">
        @csrf
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
                    <div class="isi-dokumen">
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
                        <h2 class="dokumen-header">Kelengkapan Dokumen</h2>
                        <div class="card-dokumen">
                            <img src="{{ $dokumens->cv ? asset('/storage/' . $dokumens->cv) : '../../assets/upload dokumen.png' }}"
                                alt="CV Preview">
                            <div class="deskripsi">
                                <div class="flex-header">
                                    <div class="judul-file">
                                        <h2 class="nama-file">
                                            {{ $dokumens->cv ? 'CV ' : 'Belum Ada CV' }}</h2>
                                        @if ($dokumens->cv)
                                            <a href="{{ asset('/storage/' . $dokumens->cv) }}" target="_blank">Lihat
                                                CV</a>
                                        @endif
                                        <a href="javascript:void(0);" onclick="triggerInput('fileInputCV');">Upload
                                            File</a>
                                        <input type="file" id="fileInputCV" name="cv"
                                            accept=".pdf, .jpg, .jpeg, .png" style="display: none;"
                                            data-url="{{ asset('/storage/' . $dokumens->cv) }}"
                                            onchange="previewFile(this, 'fileInputCV')">
                                    </div>
                                    <p class="tgl-upload">
                                        {{ $dokumens->cv ? 'Diupload: ' . date('d M Y', strtotime($dokumens->updated_at)) : '-' }}
                                    </p>
                                </div>
                                <p class="keterangan-file">Besar file : maksimum 10mb</p>
                                <p class="keterangan-file"> Ekstensi file yang diperbolehkan. PDF, JPG, JPEG, PNG.</p>
                            </div>
                        </div>

                        <div class="card-dokumen">
                            <img src="{{ $dokumens->ijazah ? asset('/storage/' . $dokumens->ijazah) : '../../assets/upload dokumen.png' }}"
                                alt="Ijazah Preview">
                            <div class="deskripsi">
                                <div class="flex-header">
                                    <div class="judul-file">
                                        <h2 class="nama-file">
                                            {{ $dokumens->ijazah ? 'Ijazah ' : 'Belum Ada Ijazah' }}
                                        </h2>
                                        @if ($dokumens->ijazah)
                                            <a href="{{ asset('/storage/' . $dokumens->ijazah) }}" target="_blank">Lihat
                                                Ijazah</a>
                                        @endif
                                        <a href="javascript:void(0);" onclick="triggerInput('fileInputIjazah');">Upload
                                            File</a>
                                        <input type="file" id="fileInputIjazah" name="ijazah"
                                            accept=".pdf, .jpg, .jpeg, .png" style="display: none;"
                                            data-url="{{ asset('/storage/' . $dokumens->ijazah) }}"
                                            onchange="previewFile(this, 'fileInputIjazah')">
                                    </div>
                                    <p class="tgl-upload">
                                        {{ $dokumens->cv ? 'Diupload: ' . date('d M Y', strtotime($dokumens->updated_at)) : '-' }}
                                    </p>
                                </div>
                                <p class="keterangan-file">Besar file : maksimum 10mb</p>
                                <p class="keterangan-file"> Ekstensi file yang diperbolehkan. PDF, JPG, JPEG, PNG.
                                </p>
                            </div>
                        </div>
                        <div class="card-dokumen">
                            <img src="{{ $dokumens->transkrip ? asset('/storage/' . $dokumens->transkrip) : '../../assets/upload dokumen.png' }}"
                                alt="Transkrip Preview">
                            <div class="deskripsi">
                                <div class="flex-header">
                                    <div class="judul-file">
                                        <h2 class="nama-file">
                                            {{ $dokumens->transkrip ? 'Transkrip ' : 'Belum Ada Transkrip' }}
                                        </h2>
                                        @if ($dokumens->transkrip)
                                            <a href="{{ asset('/storage/' . $dokumens->transkrip) }}" target="_blank">Lihat
                                                Transkrip</a>
                                        @endif
                                        <a href="javascript:void(0);" onclick="triggerInput('fileInputTranskrip');">Upload
                                            File</a>
                                        <input type="file" id="fileInputTranskrip" name="transkrip"
                                            accept=".pdf, .docx, .xls, .jpg, .jpeg, .png" style="display: none;"
                                            data-url="{{ $dokumens->transkrip ? asset('/storage/' . $dokumens->transkrip) : null }}"
                                            onchange="previewFile(this, 'fileInputTranskrip')">
                                    </div>
                                    <p class="tgl-upload">
                                        {{ $dokumens->cv ? 'Diupload: ' . date('d M Y', strtotime($dokumens->updated_at)) : '-' }}
                                    </p>
                                </div>
                                <p class="keterangan-file">Besar file : maksimum 10mb</p>
                                <p class="keterangan-file"> Ekstensi file yang diperbolehkan. PDF, JPG, JPEG, PNG.
                                </p>
                            </div>
                        </div>
                        <div class="card-dokumen">
                            <img src="{{ $dokumens->skck ? asset('/storage/' . $dokumens->skck) : '../../assets/upload dokumen.png' }}"
                                alt="SKCK Preview">
                            <div class="deskripsi">
                                <div class="flex-header">
                                    <div class="judul-file">
                                        <h2 class="nama-file">
                                            {{ $dokumens->skck ? 'SKCK ' : 'Belum Ada SKCK' }}
                                        </h2>
                                        @if ($dokumens->skck)
                                            <a href="{{ asset('/storage/' . $dokumens->skck) }}" target="_blank">Lihat
                                                SKCK</a>
                                        @endif
                                        <a href="javascript:void(0);" onclick="triggerInput('fileInputSKCK');">Upload
                                            SKCK</a>
                                        <input type="file" id="fileInputSKCK" name="skck"
                                            accept=".pdf, .jpg, .jpeg, .png" style="display: none;"
                                            data-url="{{ $dokumens->skck ? asset('/storage/' . $dokumens->skck) : null }}"
                                            onchange="previewFile(this, 'fileInputSKCK')">
                                    </div>
                                    <p class="tgl-upload">
                                        {{ $dokumens->cv ? 'Diupload: ' . date('d M Y', strtotime($dokumens->updated_at)) : '-' }}
                                    </p>
                                </div>
                                <p class="keterangan-file">Besar file : maksimum 10mb</p>
                                <p class="keterangan-file"> Ekstensi file yang diperbolehkan. PDF, JPG, JPEG, PNG.
                                </p>
                            </div>
                        </div>
                        <div class="footer-dokumen">
                            <p class="jumlah-dokumen">
                            </p>

                            <button data-toggle="modal" class="btn" style="background-color: #ed1c25; color:white"
                                data-target="#form-modal">
                                Simpan
                                <i class="fa-solid fa-angle-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
@push('additional-script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dokumenElements = document.querySelectorAll('.card-dokumen');

            dokumenElements.forEach(function(element) {
                const inputElement = element.querySelector('input[type="file"]');
                const imageUrl = inputElement.getAttribute('data-url');

                if (imageUrl) {
                    previewFile(inputElement, null, imageUrl);
                }
            });
        });

        function triggerInput(inputId) {
            document.getElementById(inputId).click();
        }

        function previewFile(inputElement, inputId, url = null) {
            const file = inputElement.files[0];
            const previewImage = inputElement.closest('.card-dokumen').querySelector('img');
            const fileNameElement = inputElement.closest('.card-dokumen').querySelector('.nama-file');

            // Clear previous preview
            previewImage.src = ''; // or set to a default image

            if (url) {
                // If a URL is provided, use it to display the preview
                if (url.endsWith('.pdf')) {
                    // Use pdf.js to display PDF preview
                    pdfjsLib.getDocument(url).promise.then(function(pdf) {
                        return pdf.getPage(1); // Get the first page
                    }).then(function(page) {
                        const scale = 1.5;
                        const viewport = page.getViewport({
                            scale: scale
                        });
                        const canvas = document.createElement('canvas');
                        canvas.width = viewport.width;
                        canvas.height = viewport.height;
                        const context = canvas.getContext('2d');

                        // Render the page on the canvas
                        page.render({
                            canvasContext: context,
                            viewport: viewport
                        }).promise.then(function() {
                            // Convert the canvas to PNG and set it as the source for the preview image
                            const pngDataUrl = canvas.toDataURL('image/png');
                            previewImage.src = pngDataUrl;
                        });
                    });
                    // fileNameElement.textContent = file.name;
                } else {
                    // Assume it's an image and display it directly
                    previewImage.src = url;
                }
            } else {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImage.src = e.target.result;
                        fileNameElement.textContent = file.name;
                    };
                    reader.readAsDataURL(file);
                } else if (file.type === 'application/pdf') {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const pdfData = new Uint8Array(reader.result);

                        // Using pdf.js to render the first page of the PDF
                        pdfjsLib.getDocument({
                            data: pdfData
                        }).promise.then(function(pdf) {
                            return pdf.getPage(1); // Get the first page
                        }).then(function(page) {
                            const scale = 1.5;
                            const viewport = page.getViewport({
                                scale: scale
                            });
                            const canvas = document.createElement('canvas');
                            canvas.width = viewport.width;
                            canvas.height = viewport.height;
                            const context = canvas.getContext('2d');

                            // Render the page on the canvas
                            page.render({
                                canvasContext: context,
                                viewport: viewport
                            }).promise.then(function() {
                                // Convert the canvas to PNG and set it as the source for the preview image
                                const pngDataUrl = canvas.toDataURL('image/png');
                                previewImage.src = pngDataUrl;
                            });
                        });
                        fileNameElement.textContent = file.name;
                    };
                    reader.readAsArrayBuffer(file);
                }
            }
        }
    </script>
@endpush

@extends('user.layouts.master')
@section('title')
    Renata - Lamaran Saya
@endsection
@section('styleHead')
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/modal-form-style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/lamaran-saya-style.css') }}">
@endsection
@section('content')
    <div class="container flex-main">
        <div class="side-bar">
            @include('user.component-datadiri.component-sidenav')
        </div>
        <div class="content">
            <h2 class="name-content">Lamaran Saya</h2>

            @foreach ($lamaranSaya as $ls)
                <div class="card-lamaran {{ $ls->status == 'NOT PASSED' ? 'belum-lolos' : '' }}" data-toggle="modal"
                    data-target="#form-modal" data-judul="{{ $ls->lowongan->judul }}"
                    data-company="{{ $ls->lowongan->company->name }}" data-status_lowongan="{{ $ls->lowongan->status }}"
                    data-created_at_lamaran="{{ $ls->created_at }}" data-lokasi="{{ $ls->lowongan->lokasi }}"
                    data-range_gaji="{{ $ls->lowongan->range_gaji }}" data-experience="{{ $ls->lowongan->experience }}"
                    data-ekspektasi_gaji="{{ $ls->ekspektasi_gaji }}"
                    data-tanggal_kesiapan_bergabung="{{ $ls->tanggal_kesiapan_bergabung }}"
                    data-milestone_lamaran="{{ $ls->milestoneLamaran }}" data-all_milestone="{{ $masterMilestone }}">
                    <div class="flex-header-lamaran">
                        <div class="posisi-lamaran">
                            <h2 class="posisi">{{ $ls->lowongan->judul }}</h2>
                            <p class="tempat">{{ $ls->lowongan->company->name }}</p>
                        </div>
                        <div class="status-lamaran">
                            @if ($ls->milestone_id == 1)
                                <div class="status aktif">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <p>{{ $ls->milestone->nama_milestone }}</p>
                                </div>
                            @elseif ($ls->milestone_id == 2)
                                <div class="status aktif">
                                    <i class="fa-solid fa-circle-check"></i>
                                    <p>{{ $ls->milestone->nama_milestone }}</p>
                                </div>
                            @elseif ($ls->milestone_id == 3)
                                <div class="status interview">
                                    <i class="fa-solid fa-dharmachakra"></i>
                                    <p>{{ $ls->milestone->nama_milestone }}</p>
                                </div>
                            @elseif ($ls->milestone_id == 4)
                                <div class="status diterima">
                                    <i class="fa-solid fa-face-grin-wide"></i>
                                    <p>{{ $ls->milestone->nama_milestone }}</p>
                                </div>
                            @elseif ($ls->milestone_id == 5)
                                <div class="status interview">
                                    <i class="fa-solid fa-dharmachakra"></i>
                                    <p>{{ $ls->milestone->nama_milestone }}</p>
                                </div>
                            @endif

                            <p class="waktu-status">
                                Status diupdate {{ $ls->updated_at->diffForHumans() }}
                            </p>
                        </div>
                    </div>
                    <div class="flex-isi-lamaran">
                        <div class="isi-lamaran1">
                            <div class="deskripsi">
                                <i class="fa-solid fa-location-dot"></i>
                                <p class="text-deskripsi">{{ $ls->lowongan->lokasi }}</p>
                            </div>
                            <div class="deskripsi">
                                <i class="fa-solid fa-dollar-sign"></i>
                                <p class="text-deskripsi">IDR {{ $ls->lowongan->range_gaji }}</p>
                            </div>
                            <div class="deskripsi">
                                <i class="fa-solid fa-briefcase"></i>
                                <p class="text-deskripsi">{{ $ls->lowongan->experience }}</p>
                            </div>
                        </div>
                        <div class="isi-lamaran-line"></div>
                        <div class="isi-lamaran2">
                            <div class="gaji">
                                <p>Harapan Gaji</p>
                                <p class="bold">{{ $ls->eksepektasi_gaji }}</p>
                            </div>
                            <div class="gabung">
                                <p>Kesediaan Bergabung</p>
                                <p class="bold">{{ $ls->tanggal_kesiapan_bergabung }}</p>
                            </div>
                        </div>
                        <div class="isi-lamaran-line"></div>
                        <div class="isi-lamaran3">
                            <p class="benefit">
                                {{ $ls->benefit }}
                            </p>
                        </div>
                    </div>
                    <div class="status-postingan-lamaran">
                        @if ($ls->lowongan->status == 'Aktif')
                            <p class="status aktif">Aktif</p>
                        @else
                            <p class="status tidak-aktif">Tidak Aktif</p>
                        @endif
                        <ul>
                            <li>
                                <p>Lowongan Diposting {{ $ls->lowongan->created_at->diffForHumans() }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            @endforeach

            {{-- <div class="halaman">
                <p class="status-halaman">
                    Menampilkan 5 dari 15 lamaran terbaru
                </p>
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
            </div> --}}
        </div>
    </div>
@endsection
@push('additional-modal')
    <div class="modal fade" id="form-modal" tabindex="-1" role="dialog" aria-labelledby="form-modalTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-body" id="lamaran-interview">
                    <h2 class="nama-lamaran" id="judul"></h2>
                    <div class="flex-header">
                        <p class="tempat" id="company"></p>
                        <div class="flex-status">
                            <p class="status-lowongan" id="status_lowongan"></p>
                            <ul>
                                <li>
                                    <p id="created_at_lamaran"></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex-keterangan-lamaran">
                        <div class="isi-lamaran1">
                            <div class="deskripsi">
                                <i class="fa-solid fa-location-dot"></i>
                                <p class="text-deskripsi" id="lokasi"></p>
                            </div>
                            <div class="deskripsi">
                                <i class="fa-solid fa-dollar-sign"></i>
                                <p class="text-deskripsi" id="range_gaji"></p>
                            </div>
                            <div class="deskripsi">
                                <i class="fa-solid fa-briefcase"></i>
                                <p class="text-deskripsi" id="experience"></p>
                            </div>
                        </div>
                        <div class="isi-lamaran-line"></div>
                        <div class="isi-lamaran2">
                            <div class="gaji">
                                <p>Harapan Gaji</p>
                                <p class="bold" id="ekspektasi_gaji"></p>
                            </div>
                            <div class="gabung">
                                <p>Kesediaan Bergabung</p>
                                <p class="bold" id="tanggal_kesiapan_bergabung"></p>
                            </div>
                        </div>
                    </div>
                    <div class="garis-modal"></div>
                    <p class="deskripsi" id="deskripsi_lowongan">
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
                                <li><i class="fa-solid fa-circle"></i></li>
                                <li><i class="fa-solid fa-circle"></i></li>
                                <li><i class="fa-solid fa-circle"></i></li>
                                <li><i class="fa-solid fa-circle"></i></li>
                                <li><i class="fa-solid fa-circle"></i></li>
                            </ul>
                        </div>
                        <div class="nama-proses">
                            <ul>
                                <li>
                                    <p class=""></p>
                                </li>
                                <li>
                                    <p class=""></p>
                                </li>
                                <li>
                                    <p class=""></p>
                                </li>
                                <li>
                                    <p class=""></p>
                                </li>
                                <li>
                                    <p class=""></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="garis-modal mt-5"></div>
                    <div class="interview">
                        <div class="head-interview">
                            <p>Catatan</p>
                            <p>Soal</p>
                            <p>Tempat</p>
                            <p>Waktu</p>
                        </div>
                        <div class="isi-interview">
                            <p>: <span id="remark"></span></p>
                            <p>: <span id="task"></span></p>
                            <p>: <span id="tempat"></span></p>
                            <p>: <span id="waktu"></span></p>
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
@endpush
@push('additional-script')
    <script>
        $('#form-modal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var judul = button.data('judul'); // Extract info from data-* attributes
            var company = button.data('company');
            var status_lowongan = button.data('status_lowongan');
            var created_at_lamaran = button.data('created_at_lamaran');
            var lokasi = button.data('lokasi');
            var range_gaji = button.data('range_gaji');
            var experience = button.data('experience');
            var ekspektasi_gaji = button.data('ekspektasi_gaji');
            var tanggal_kesiapan_bergabung = button.data('tanggal_kesiapan_bergabung');
            var milestone_lamaran = button.data('milestone_lamaran');
            var all_milestone = button.data('all_milestone');

            var modal = $(this);
            modal.find('#judul').text(judul);
            modal.find('#company').text(company);
            modal.find('#status_lowongan').text(status_lowongan);
            modal.find('#created_at_lamaran').text(created_at_lamaran);
            modal.find('#lokasi').text(lokasi);
            modal.find('#range_gaji').text(range_gaji);
            modal.find('#experience').text(experience);
            modal.find('#ekspektasi_gaji').text(ekspektasi_gaji);
            modal.find('#tanggal_kesiapan_bergabung').text(tanggal_kesiapan_bergabung);

            let lastMilestone = milestone_lamaran[milestone_lamaran.length - 1];

            let parsedData = JSON.parse(lastMilestone.remark);

            if (parsedData.remarkTest == null && parsedData.remarkInterview == null) {
                modal.find('#remark').text("-");
            } else if (parsedData.remarkTest == null) {
                modal.find('#remark').text(parsedData.remarkInterview);
            } else {
                modal.find('#remark').text(parsedData.remarkTest);
            }


            if (parsedData.taskTest == null) {
                modal.find('#task').text("-");
            } else {
                modal.find('#task').text(parsedData.taskTest);
            }

            console.log(parsedData);


            if (parsedData.interviewURL == null && parsedData.testURL == null) {
                modal.find('#tempat').text("-");
            } else if (parsedData.testURL == null) {
                modal.find('#tempat').text(parsedData.interviewURL);
            } else {
                modal.find('#tempat').text(parsedData.testURL);
            }

            if (parsedData.interviewTime == null && parsedData.testTime == null) {
                modal.find('#waktu').text("-");
            } else if (parsedData.testTime == null) {
                console.log(parsedData.interviewTime);
                modal.find('#waktu').text(parsedData.interviewTime);
            } else {
                modal.find('#waktu').text(parsedData.testTime);
            }



            // modal.find('#task').text(parsedData.remarkTest);
            // modal.find('#tempat').text(parsedData.testURL);
            // modal.find('#waktu').text(parsedData.testTime);
            updateModalWithAllMilestones(all_milestone, milestone_lamaran);
        });

        $('#form-modal').on('hidden.bs.modal', function() {
            $('#form-modal').modal('dispose');
        });


        function updateModalWithAllMilestones(all_milestone, milestone_lamaran) {
            let tanggalHTML = '';
            let iconHTML = '';
            let namaProsesHTML = '';

            let milestonesPassed = 0;

            all_milestone.forEach(milestone => {
                // Cek apakah milestone ini ada di milestone_lamaran
                let isPassed = milestone_lamaran.some(item => item.milestone_id == milestone.id);

                if (isPassed) milestonesPassed++;

                // Ambil tanggal dari milestone yang telah dilewati
                let date = isPassed ? new Date(milestone_lamaran.find(item => item.milestone_id == milestone.id)
                    .created_at).toLocaleDateString() : '';

                // Tambahkan ke HTML
                tanggalHTML += `<li><p>${date}</p></li>`;

                // Tambahkan icon berdasarkan status
                let iconClass = isPassed ? "fa-circle active" : "fa-circle";
                iconHTML += `<li><i class="fa-solid ${iconClass}"></i></li>`;

                // Ambil nama proses dari all_milestone
                let namaProses = milestone
                    .nama_milestone; // contoh, Anda harus menggantinya dengan data sebenarnya dari all_milestone
                namaProsesHTML +=
                    `<li><p class="${iconClass === "fa-circle active" ? "active" : ""}">${namaProses}</p></li>`;
            });

            // Update modal
            document.querySelector('.tanggal ul').innerHTML = tanggalHTML;
            document.querySelector('.bar-proses ul').innerHTML = iconHTML;
            document.querySelector('.nama-proses ul').innerHTML = namaProsesHTML;

            setTimeout(() => {
                let percentagePassed = (milestonesPassed / all_milestone.length) * 80;
                document.querySelector('.garis-proses').style.height = `80%`;
                document.querySelector('.persen').style.height = `${percentagePassed}%`;
            }, 100);

        }
    </script>
@endpush

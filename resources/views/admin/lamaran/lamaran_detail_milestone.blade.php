@extends('admin.layouts.master')
@push('top-style')
    <link href="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('title')
    Detail Milestone
@endsection
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Milestone - {{ $lowongan->judul }} - {{ $milestone->nama_milestone }} </h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 p-5">
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
        @if (count($lamarans) > 0)
            @foreach ($lamarans as $lamaran)
                <div class="card">
                    <h5 class="card-header">{{ $lamaran->user->name }}</h5>
                    <div class="card-body">
                        <h5 class="card-title">Keahlian : {{ $lamaran->keahlian->nama_master_keahlian }}</h5>
                        <p class="card-text">Email : {{ $lamaran->user->email }}</p>
                        <p class="card-text">Nomor Telepon : {{ $lamaran->nomor_telepon }}</p>
                        <a href="{{ route('admin.lamaran.milestone.lamaran.detail.pelamar', ['lamaran_id' => $lamaran->id]) }}"
                            class="btn btn-primary">Detail Lamaran</a>
                    </div>
                </div>
            @endforeach
        @else
            <div class="card">
                <div class="card-body">
                    <p class="card-text text-danger">Data tidak ditemukan</p>
                </div>
            </div>
        @endif
    </div>
@endsection
@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/admin/js/demo/datatables-demo.js') }}"></script>
@endpush

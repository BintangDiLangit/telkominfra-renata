@extends('admin.layouts.master')
@push('top-style')
    <link href="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('title')
    Milestone
@endsection
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Milestone Lowongan -
        {{ $lowongan->judul }}</h1>

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
        <div class="row">
            @foreach ($milestoneLamarans as $milestoneLamaran)
                <div class="col-md-3 mb-3">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top p-2" src="{{ '/storage/milestone_images/lamaran_terkirim.jpg' }}"
                            alt="Card image cap">
                        <div class="card-body">
                            <p class="card-title"><b>{{ $milestoneLamaran->nama_milestone }}</b></p>
                            <a href="{{ route('admin.lamaran.milestone.lamaran.detail', [
                                'lowongan_id' => isset($lowongan->id) ? $lowongan->id : 0,
                                'milestone_id' => $milestoneLamaran->id,
                            ]) }}"
                                class="btn btn-primary">Go</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('assets/admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('assets/admin/js/demo/datatables-demo.js') }}"></script>
@endpush

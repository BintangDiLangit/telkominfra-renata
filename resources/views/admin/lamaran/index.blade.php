@extends('admin.layouts.master')
@push('top-style')
    <link href="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('title')
    Lamaran
@endsection
@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Lamaran</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4 p-5">
        <form class="bd-search d-flex align-items-center mb-4">
            <span class="algolia-autocomplete algolia-autocomplete-left"
                style="position: relative; display: inline-block; direction: ltr;">
                <label for="">Cari Lowongan</label>
                <input type="search" class="form-control ds-input" id="search-input" placeholder="Search..."
                    aria-label="Search for..." autocomplete="off" spellcheck="false" role="combobox"
                    aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto"
                    style="position: relative; vertical-align: top;">
                <pre aria-hidden="true"
                    style="position: absolute; visibility: hidden; white-space: pre; font-family: -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;; font-size: 16px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: normal; text-indent: 0px; text-rendering: auto; text-transform: none;">search </pre><span class="ds-dropdown-menu ds-with-1" role="listbox"
                    id="algolia-autocomplete-listbox-0"
                    style="position: absolute; top: 100%; z-index: 100; left: 0px; right: auto; display: none;">
                    <div class="ds-dataset-1"></div>
                </span>
            </span>
            <button class="btn btn-link bd-search-docs-toggle d-md-none p-0 ml-3" type="button" data-toggle="collapse"
                data-target="#bd-docs-nav" aria-controls="bd-docs-nav" aria-expanded="false"
                aria-label="Toggle docs navigation"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30"
                    width="30" height="30" focusable="false">
                    <title>Menu</title>
                    <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10"
                        d="M4 7h22M4 15h22M4 23h22"></path>
                </svg>
            </button>
        </form>
        <div class="row">
            @foreach ($lowongans as $lowongan)
                <div class="col-md-3 mb-3">
                    <div class="card">
                        <div class="card-header">
                            {{ $lowongan->kategoriLowongan->name }} - {{ $lowongan->company->name }}
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ $lowongan->judul }}</h5>
                            <p class="card-text">{{ $lowongan->status }}</p>
                            <a href="{{ route('admin.lamaran.milestone.lamaran', ['lowongan_id' => $lowongan->id]) }}"
                                class="btn btn-primary">Detail</a>
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

    <script>
        $(document).ready(function() {
            $('#search-input').on('input', function() {
                const query = $(this).val();
                $.ajax({
                    url: '/admin/lamaran/search-lowongan',
                    data: {
                        q: query
                    },
                    success: function(data) {
                        renderLowongans(data);
                    }
                });
            });
        });

        function renderLowongans(lowongans) {
            let html = '';
            lowongans.forEach(lowongan => {
                html += `
            <div class="col-md-3 mb-3">
                <div class="card">
                    <div class="card-header">
                        ${lowongan.kategori_lowongan.name} - ${lowongan.company.name}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">${lowongan.judul}</h5>
                        <p class="card-text">${lowongan.status}</p>
                        <a href="/admin/lamaran/milestone-lamaran/${lowongan.id}" class="btn btn-primary">Detail</a>
                    </div>
                </div>
            </div>
        `;
            });
            $('.row').html(html);
        }
    </script>
@endpush

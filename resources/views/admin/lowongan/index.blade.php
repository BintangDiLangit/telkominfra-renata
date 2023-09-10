@extends('admin.layouts.master')
@push('top-style')
    <link href="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('title')
    Lowongan
@endsection
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Lowongan</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">List Lowongan</h6>
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
                        + Lowongan
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add Lowongan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.lowongan.store') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Kategori Lowongan <span
                                                    class="text-danger">*</span></label>
                                            <select name="kategori" class="form-control select2" style="width: 100%;"
                                                required>
                                                <option value=""> - Select an option - </option>
                                                @foreach ($kategoriLowongans as $kategori)
                                                    <option value="{{ $kategori->id }}">
                                                        {{ $kategori->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Perusahaan <span class="text-danger">*</span></label>
                                            <select name="companies" class="form-control select2" style="width: 100%;">
                                                <option value=""> - Select an option - </option>
                                                @foreach ($companies as $company)
                                                    <option value="{{ $company->id }}">
                                                        {{ $company->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Judul <span class="text-danger">*</span></label>
                                            <input type="text" required name="judul" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Lokasi <span class="text-danger">*</span></label>
                                            <input type="text" required name="lokasi" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Deskripsi Pekerjaan <span
                                                    class="text-danger">*</span></label>
                                            <textarea name="deskripsi" id="" cols="30" class="form-control" rows="10" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Experience <span class="text-danger">*</span></label>
                                            <select name="experience" class="form-control select2" style="width: 100%;"
                                                required>
                                                <option value=""> - Select an option - </option>
                                                <option value="Fresh Graduate">Fresh Graduate</option>
                                                <option value="1-3 Tahun">1-3 Tahun</option>
                                                <option value=">3 tahun">>3 tahun</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="">Range Gaji</label>
                                            <input type="text" name="range_gaji" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Status</label>
                                            <select name="status" class="form-control select2" style="width: 100%;"
                                                required>
                                                <option value=""> - Select an option - </option>
                                                <option value="Aktif">Aktif</option>
                                                <option value="Tidak Aktif">Tidak Aktif</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
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
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Perusahaan</th>
                            <th>Kategori</th>
                            <th>Judul</th>
                            <th>Lokasi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lowongans as $lowongan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $lowongan->company->name }}</td>
                                <td>{{ $lowongan->kategoriLowongan->name }}</td>
                                <td>{{ $lowongan->judul }}</td>
                                <td>{{ $lowongan->lokasi }}</td>
                                <td>
                                    <!-- Tombol Update (Modal) -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $lowongan->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Modal Update -->
                                    <div class="modal fade" id="editModal{{ $lowongan->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="editModalLabel{{ $lowongan->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $lowongan->id }}">Edit
                                                        Lowongan
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('admin.lowongan.update', $lowongan->id) }}"
                                                    method="post">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Kategori Lowongan <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="kategori" class="form-control select2"
                                                                style="width: 100%;" required>
                                                                <option value=""> - Select an option - </option>
                                                                @foreach ($kategoriLowongans as $kategori)
                                                                    <option value="{{ $kategori->id }}"
                                                                        {{ $lowongan->kategori_lowongans == $kategori->id ? 'selected' : '' }}>
                                                                        {{ $kategori->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Perusahaan <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="companies" class="form-control select2"
                                                                style="width: 100%;">
                                                                <option value=""> - Select an option - </option>
                                                                @foreach ($companies as $company)
                                                                    <option value="{{ $company->id }}"
                                                                        {{ $lowongan->companies == $company->id ? 'selected' : '' }}>
                                                                        {{ $company->name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Judul <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" required name="judul"
                                                                value="{{ isset($lowongan->judul) ? $lowongan->judul : '' }}"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Lokasi <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" required name="lokasi"
                                                                value="{{ isset($lowongan->lokasi) ? $lowongan->lokasi : '' }}"
                                                                class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Deskripsi Pekerjaan <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea name="deskripsi" id="" cols="30" class="form-control" rows="10" required>{{ isset($lowongan->deskripsi) ? $lowongan->deskripsi : '' }}</textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Experience <span
                                                                    class="text-danger">*</span></label>
                                                            <select name="experience" class="form-control select2"
                                                                style="width: 100%;" required>
                                                                <option value=""> - Select an option - </option>
                                                                <option value="Fresh Graduate"
                                                                    {{ $lowongan->experience == 'Fresh Graduate' ? 'selected' : '' }}>
                                                                    Fresh Graduate</option>
                                                                <option value="1-3 Tahun"
                                                                    {{ $lowongan->experience == '1-3 Tahun' ? 'selected' : '' }}>
                                                                    1-3 Tahun</option>
                                                                <option value=">3 Tahun"
                                                                    {{ $lowongan->experience == '>3 Tahun' ? 'selected' : '' }}>
                                                                    >3 Tahun</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Range Gaji</label>
                                                            <input type="text" name="range_gaji" class="form-control"
                                                                value="{{ isset($lowongan->range_gaji) ? $lowongan->range_gaji : '' }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Status</label>
                                                            <select name="status" class="form-control select2"
                                                                style="width: 100%;" required>
                                                                <option value=""> - Select an option - </option>
                                                                <option value="Aktif"
                                                                    {{ $lowongan->status == 'Aktif' ? 'selected' : '' }}>
                                                                    Aktif</option>
                                                                <option value="Tidak Aktif"
                                                                    {{ $lowongan->status == 'Tidak Aktif' ? 'selected' : '' }}>
                                                                    Tidak Aktif</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Tombol Delete (Modal) -->
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#deleteModal{{ $lowongan->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteModal{{ $lowongan->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="deleteModalLabel{{ $lowongan->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $lowongan->id }}">
                                                        Delete lowongan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('admin.lowongan.destroy', $lowongan->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this lowongan?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
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

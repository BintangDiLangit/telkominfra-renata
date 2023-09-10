@extends('admin.layouts.master')
@push('top-style')
    <link href="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('title')
    Kategori E-Learning
@endsection
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Kategori E-Learning</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">List Kategori E-Learning</h6>
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#kategoriLowonganModal">
                        + Kategori E-Learning
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="kategoriLowonganModal" tabindex="-1" role="dialog"
                        aria-labelledby="kategoriLowonganModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="kategoriLowonganModalLabel">Add Kategori E-Learning</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.kategori_elearning.store') }}" method="post"
                                    data-parsley-validate enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Nama Kategori <span class="text-danger">*</span></label>
                                            <input type="text" required name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Image <span class="text-danger">*</span></label>
                                            <input type="file" required name="image" class="form-control"
                                                accept="image/*">
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
                            <th>Nama Kategori</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kategoriElearnings as $kategori)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $kategori->name }}</td>
                                <td><img src="{{ asset('storage/kategori_lowongan_images/' . $kategori->image) }}"
                                        alt="" width="100px"></td>
                                <td>
                                    <!-- Tombol Update (Modal) -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $kategori->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Modal Update -->
                                    <div class="modal fade" id="editModal{{ $kategori->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="editModalLabel{{ $kategori->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $kategori->id }}">Edit
                                                        Kategori E-Learning
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form
                                                    action="{{ route('admin.kategori_elearning.update', $kategori->id) }}"
                                                    method="post" data-parsley-validate enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Nama Kategori <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" required value="{{ $kategori->name }}"
                                                                name="name" class="form-control">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Image</label>
                                                            <input type="file" name="image" class="form-control"
                                                                accept="image/*">
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
                                        data-target="#deleteModal{{ $kategori->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteModal{{ $kategori->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="deleteModalLabel{{ $kategori->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $kategori->id }}">
                                                        Delete Kategori E-Learning</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form
                                                    action="{{ route('admin.kategori_elearning.destroy', $kategori->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this kategori elearning?
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

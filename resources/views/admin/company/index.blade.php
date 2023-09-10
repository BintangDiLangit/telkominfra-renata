@extends('admin.layouts.master')
@push('top-style')
    <link href="{{ asset('assets/admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush
@section('title')
    Perusahaan
@endsection
@section('content')
    <h1 class="h3 mb-2 text-gray-800">Perusahaan</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col">
                    <h6 class="m-0 font-weight-bold text-primary">List Perusahaan</h6>
                </div>
                <div class="col d-flex justify-content-end">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#perusahaanModal">
                        + Perusahaan
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="perusahaanModal" tabindex="-1" role="dialog"
                        aria-labelledby="perusahaanModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="perusahaanModalLabel">Add Perusahaan</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.company.store') }}" method="post" data-parsley-validate
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="">Nama Perusahaan <span class="text-danger">*</span></label>
                                            <input type="text" required name="name" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Image </label>
                                            <input type="file" name="image" class="form-control" accept="image/*">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Link Perusahaan</label>
                                            <input type="url" name="link" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="">Deskripsi Perusahaan</label>
                                            <textarea name="description" class="form-control" id="" cols="30" rows="10"></textarea>
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
                            <th>Nama Perusahaan</th>
                            <th>Image</th>
                            <th>Link Perusahaan</th>
                            <th>Deskripsi</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($companies as $company)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $company->name }}</td>
                                <td><img src="{{ asset('storage/company_images/' . $company->image) }}" alt=""
                                        width="100px"></td>
                                <td>{{ $company->link }}</td>
                                <td>{{ $company->description }}</td>
                                <td>
                                    <!-- Tombol Update (Modal) -->
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $company->id }}">
                                        <i class="fas fa-edit"></i>
                                    </button>

                                    <!-- Modal Update -->
                                    <div class="modal fade" id="editModal{{ $company->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="editModalLabel{{ $company->id }}" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editModalLabel{{ $company->id }}">Edit
                                                        Perusahaan
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('admin.company.update', $company->id) }}"
                                                    method="post" data-parsley-validate enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label for="">Nama Perusahaan <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" required name="name"
                                                                class="form-control" value="{{ $company->name }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Image </label>
                                                            <input type="file" name="image" class="form-control"
                                                                accept="image/*">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Link Perusahaan</label>
                                                            <input type="url" name="link" class="form-control"
                                                                value="{{ $company->link }}">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="">Deskripsi Perusahaan</label>
                                                            <textarea name="description" class="form-control" id="" cols="30" rows="10">{{ $company->description }}</textarea>
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
                                        data-target="#deleteModal{{ $company->id }}">
                                        <i class="fas fa-trash"></i>
                                    </button>

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="deleteModal{{ $company->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="deleteModalLabel{{ $company->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $company->id }}">
                                                        Delete Perusahaan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="{{ route('admin.company.destroy', $company->id) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this Company?
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

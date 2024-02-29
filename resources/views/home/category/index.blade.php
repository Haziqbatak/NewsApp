@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h1>Category index</h1>
            <div class="d-flex justify-content-end">
                <a href="{{ route('category.create') }}" class="btn btn-primary rounded">Category index <i
                        class="bi bi-plus circle"></i></a>
            </div>

            <div class="continer mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data category</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @forelse ($category as $row)
                                <tbody>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->slug }}</td>
                                    <td>
                                        <img src="{{ url('storage/category', $row->image) }}" alt="image" width="100px">
                                    </td>
                                    <td>
                                        <!-- Basic Modal -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#basicModal{{ $row->id }}">
                                            Basic Modal
                                        </button>
                                        <div class="modal fade" id="basicModal{{ $row->id }}" tabindex="-1">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Category Name : <strong class="text-uppercase fw-bold">{{ $row->name }}</strong></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ url('storage/category', $row->image) }}" alt="image" class="img-thumbnail">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End Basic Modal-->
                                    </td>
                                </tbody>
                            @empty
                                <p>blum ada category</p>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection

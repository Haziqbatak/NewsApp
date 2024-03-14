@extends('home.parent')

@section('content')
    <div class="row">

        {{-- // alert jika ada error --}}

        {{-- //alert success --}}
        @if (session('succes'))
            <div class="alert alert-success">
                {{ session('succes') }}
            </div>
        @endif
        @if (session('errors'))
            <div class="alert alert-danger">
                {{ session('errors') }}
            </div>
        @endif

        <div class="card p-4">
            <h3 class="card-title">
                All User
            </h3>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->email }}</td>
                            <td>{{ $row->role }}</td>
                            <td>
                                <!-- Basic Modal -->

                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                    data-bs-target="#basicModal{{ $row->id }}">
                                    <i class="bi bi-pencil">
                                        Reset Password
                                    </i>
                                </button>
                                <div class="modal fade" id="basicModal{{ $row->id }}" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">
                                                    Reset Password <strong>{{ $row->name }}</strong>
                                                </h5>
                                                <button type="button" class="btn-primary" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Default Password become 123456
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-warning"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-warning">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Basic Modal-->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

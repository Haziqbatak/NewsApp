@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3 class="card-title">Change Password</h3>
            <form action="{{ route('profile.updatePassword') }}" method="post">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Current Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="current_password" class="form-control" placeholder="Current Password">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">New Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="password" class="form-control" placeholder="New Password">
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Confirm New Password</label>
                    <div class="col-sm-10">
                        <input type="password" name="confirm_password" class="form-control"
                            placeholder="Confirm New Password">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Change Password</button>

            </form>
        </div>
    </div>

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
@endsection

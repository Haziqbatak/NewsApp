@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3 class="card-title text-secondary">
                Create Profile {{ Auth::user()->name }}
            </h3>

            <form action="{{ route('updateProfile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col mb-3">
                    <label for="" class="form-table">First Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{ $user->profile->first_name }}">
                </div>
                <div class="col mb-3">
                    <label for="" class="form-table">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>

                <button type="submit" class="btn btn-warning" class="{{ route('editProfile') }}">
                    <i class="bi bi-pencil">
                        Update Profile
                    </i>
                </button>

            </form>

        </div>
    </div>
@endsection

@extends('home.parent')

@section('content')
    <div class="card p-4">
        <div class="row">
            <div
                class="col-md-6 flex justify-content-center text-center                                                                    ">
                @if (empty(Auth::user()->profile->image))
                    <img src="https://ui-avatars.com/api/?background=#fffff/?name={{ Auth::user()->name }}"
                        class="rounded-circle w-75" alt="">
                @else
                    <img src="{{ Auth::user()->profile->image }}" alt="ini profile image" class="rounded-5 w-50">
                @endif
            </div>
            <div class="col-md-6 text-center">
                <h3>Profile</h3>
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Name Account : <strong>Admin</strong></li>
                    <li class="list-group-item">Email Account : <strong>{{ Auth::user()->name }}</strong></li>
                    <li class="list-group-item">Your name : <strong>{{ Auth::user()->profile->first_name }}</strong></li>
                    <li class="list-group-item">Role Account : <strong>{{ Auth::user()->name }}</strong></li>
                    <li class="list-group-item disabled" aria-disabled="true">A disabled item</li>
                </ul>
                @if (empty(Auth::user()->profile->image))
                    <a href="{{ route('createProfile') }}" class="btn btn-primary mt-5">
                        Create<i class="bi bi-plus"></i>
                    </a>
                @else
                    <a href="{{ route('editProfile') }}" class="btn btn-warning mt-5">
                        <i class="bi bi-pencil"></i>Edit Profile
                    </a>
                @endif
            </div>
        </div>
    </div>
@endsection

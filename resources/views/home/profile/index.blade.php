@extends('home.parent')

@section('content')
    <div class="card p-4">
        <div class="row">
            <div class="col-md-6 flex justify-content-center">
                @if (@empty(Auth::user()->profile->image == ''))
                <img src="https://ui-avatars.com/api/?background=#fffff/?name={{ Auth::user()->name }}"
                class="rounded-circle w-75" alt="">
                @else
                    <img src="" alt="ini profile image">
                @endif
            </div>
            <div class="col-md-6 text-center">
                <h3>Profile</h3>
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Name Account : <strong>Admin</strong></li>
                    <li class="list-group-item">Email Account : <strong>{{ Auth::user()->name }}</strong></li>
                    <li class="list-group-item">Role Account : <strong>{{ Auth::user()->name }}</strong></li>
                    <li class="list-group-item disabled" aria-disabled="true">A disabled item</li>
                </ul>
                <a href="" class="btn btn-primary">
                    <i class="bi bi-pencil"></i>
                    Create Profile
                </a>
            </div>
        </div>
    </div>
@endsection

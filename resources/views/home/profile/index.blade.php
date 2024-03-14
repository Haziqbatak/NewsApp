@extends('home.parent')

@section('content')
    <div class="card p-4">
        <div class="row">
            <div class="col-md-6 flex justify-content-center">
                
            </div>
            <div class="col-md-6 text-center">
                <h3>Profile</h3>
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">Name Account : <strong>Admin</strong></li>
                    <li class="list-group-item">Email Account : <strong>{{ Auth::user()->name }}</strong></li>
                    <li class="list-group-item">Role Account : <strong>{{ Auth::user()->name }}</strong></li>
                    <li class="list-group-item disabled" aria-disabled="true">A disabled item</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

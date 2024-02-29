@extends('home.parent')

@section('content')
    <div class="container">
        <div class="row card p-4">
            <h1>
                Welcome {{ Auth::user()->name }}
            </h1>
        </div>
        <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="btn btn-danger">logout</button>
        </form>
    </div>
@endsection

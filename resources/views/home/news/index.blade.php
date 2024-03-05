@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>News Card</h3>
        </div>
        <form action="{{ route('news.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
        </form>
    </div>
@endsection
@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>News Card</h3>
        </div>
        
        <a href="{{ route('news.create') }}" class="btn btn-primer">Create</a>

    </div>
@endsection
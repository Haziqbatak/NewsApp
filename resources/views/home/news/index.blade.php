@extends('home.parent')

@section('content')

<div class="row">
    <div class="card p-4">
        <h2>News Index</h2>
        <div class="d-flex justify-content-end">
            <a href="{{ route('category.create') }}" class="btn btn-primary rounded"><i class="bi bi-plus circle"></i></a>
        </div>
    </div>
</div>

@endsection
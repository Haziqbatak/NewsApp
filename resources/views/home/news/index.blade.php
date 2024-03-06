@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>News Card</h3>
        </div>
        
        <a href="{{ route('news.create') }}" class="btn btn-primer">Create</a>

        <div class="container">
            <div class="card p-3">
                <h5 class="card-title p-3">Data news</h5>

                <table class="table-datatable"></table>
            </div>
        </div>

    </div>
@endsection
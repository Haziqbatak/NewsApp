@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-3">
            <h3>Ini halaman edit</h3>

            <hr>

            <form action="{{ route('category.update', $category->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="col-12">
                    <label for="inputNanme4" class="form-label">Category Name</label>
                    <input type="text" class="form-control" id="inputNanme" name="name" value="{{ $category->name }}">
                </div>
                <div class="col-12">
                    <label for="inputImage" class="form-label">Category Image</label>
                    <input type="file" class="form-control" id="inputEmail4" name="image">
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <a href="{{ route('category.index') }}" class="btn btn-primary">
                        <i class="bi bi-arrow-left"></i>
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-pencil-square">
                            <h1>category</h1>
                        </i>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

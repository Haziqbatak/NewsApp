@extends('home.parent')

@section('content')
    <div class="row">
        <h1>ini create</h1>

        <form action="{{ route('category.index') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="col-12">
                <label for="inputNanme4" class="form-label">Category Name</label>
                <input type="text" class="form-control" id="inputNanme" name="name" value="{{ old('name') }}">
            </div>
            <div class="col-12">
                <label for="inputImage" class="form-label">Category Image</label>
                <input type="file" class="form-control" id="inputEmail4" name="image">
            </div>
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary mt-2">
                    <i class="btn tbn-plus">
                        <h1>category</h1>
                    </i>
                </button>
            </div>
        </form>
    </div>
@endsection

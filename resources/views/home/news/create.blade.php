@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>News Card</h3>
        </div>
        <form action="{{ route('news.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')

            <div class="mb-2">
                <label for="inputName" class="form-label"><i class="bi bi-text"></i> News Title</label>
                <input type="text" class="form-control" id="inputNanme4" name="title" value="{{ old('title') }}">
            </div>
            <div class="mb-2">
                <label for="inputName" class="form-label">News image</label>
                <input type="file" class="form-control" id="inputNanme4" name="image" value="{{ old('image') }}">
            </div>
            <div class="mb-2">
                <label class="col-sm-2 col-form-label">Select</label>
                <div class="col-sm-10">
                    <select class="form-select" name="category_id" aria-label="Default select example">
                        <option selected>Open this select menu</option>
                        @foreach ($category as $row)
                        <option value="{{ $row->id 
                        }} " >{{ $row->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- menggunakan checkeditro --}}
            <textarea id="editor" name="content"></textarea>
            <script>
                ClassicEditor
                    .create(document.querySelector('#editor'))
                    .then(editor => {
                        console.log(editor);
                    })
                    .catch(error => {
                        console.error(error);
                    });
            </script>
        </form>
    </div>
@endsection
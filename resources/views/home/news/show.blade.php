@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h5 class="card-title">Ini halaman baru <span class="badge rounded bg-info" {{ $news->category->name }}>News
                    Category</span></h5>

            <p>
                <img src="{{ $news->image }}" alt="img" class="img-fluid d-flex text-center">
            </p>
            <textarea id="editor" disabled>
                {!! $news->content !!}
            </textarea>
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
        </div>
    </div>
@endsection

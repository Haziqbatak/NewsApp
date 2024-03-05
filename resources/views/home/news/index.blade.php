@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>News Card</h3>
        </div>
        <form action="{{ route('news.create') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div id="editor">
                <script>
                    ClassicEditor
                            .create( document.querySelector( '#editor' ) )
                            .then( editor => {
                                    console.log( editor );
                            } )
                            .catch( error => {
                                    console.error( error );
                            } );
            </script>
            </div>
        </form>
    </div>
@endsection
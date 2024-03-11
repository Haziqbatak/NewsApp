@extends('home.parent')




@section('content')
    <div class="row">
        <div class="card p-4">
            <h3>News</h3>
            <div class="d-flex justify-content-end ">
                <a href="{{ route('news.create') }}" class="btn btn-primary rounded ml-3 mx-2"> <i
                        class="bi bi-plus-circle mx-2"></i>Create </a>
            </div>
        </div>
        <div class="container">
            <div class="card p-3">
                <h5 class="card-title p-3">
                    Data News
                </h5>
                <table class="table datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>image category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($news as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->title }}</td>
                                <td>{{ $row->category->name }}</td>
                                <td>
                                    <img src="{{ $row->image }}" width="100px" alt="">
                                </td>
                                <td>
                                    <img src="{{ $row->category->image }}" width="100px" alt="">
                                </td>
                                <td><a href="{{ route('news.show', $row->id) }}" class="btn btn-info"><i
                                            class="bi bi-eye"></i></a></td>
                                <td><a href="{{ route('news.edit', $row->id) }}" class="btn btn-warning"><i
                                            class="bi bi-pencil"></i></a></td>
                                <td>
                                    <form action="{{ route('news.destroy', $row->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i
                                                class="bi bi-bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <p>masih kosong</p>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>



    @if (session('succes'))
        <div class="alert alert-success">
            <ul>
                {{ session('succes') }}
            </ul>
        </div>
    @endif
@endsection

@extends('home.parent')

@section('content')
    <div class="row">
        <div class="card p-4">
            <h1>Category index</h1>
            <div class="d-flex justify-content-end">
                <a href="{{ route('category.create') }}" class="btn btn-primary rounded"><i class="bi bi-plus circle"></i></a>
            </div>
            @if (session('succes'))
                <div class="alert alert-success mt-3">
                    <ul>
                        {{ session('succes') }}
                    </ul>
                </div>
            @endif

            <div class="continer mt-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Data category</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            @forelse ($category as $row)
                                <tbody>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->slug }}</td>
                                    <td>
                                        <img src="{{ url('storage/category', $row->image) }}" alt="image" width="100px">
                                    </td>
                                    <td>
                                        <!-- show using modal with id {{ $row->id }} -->
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#basicModal{{ $row->id }}">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        @include('home.category.include.modal-show')
                                        <!-- Button edit with route
                                        category.edit {{ $row->edit }} -->
                                        <a href="{{ route('category.edit', $row->id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        {{-- buutton delete with route category.destroy {{ $row->id }} --}}
                                        <form action="{{ route('category.destroy', $row->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>


                                    </td>
                                </tbody>
                            @empty
                                <p>blum ada category</p>
                            @endforelse
                        </table>
                        {{ $category->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
            @if (session('Nice'))
                <div class="alert alert-warning mt-3">
                    <ul>
                        {{ session('Nice') }}
                    </ul>
                </div>
            @endif
        </div>
    @endsection

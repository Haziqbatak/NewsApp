@extends('home.parent')

@section('content')
    <div class="container">
        <div class="row card p-4">
            <h1>
                Welcome {{ Auth::user()->name }}
            </h1>
            <hr>
            <div class="card">
                <!-- List group with active and disabled items -->
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true">An active item</li>
                    <li class="list-group-item">A second item</li>
                    <li class="list-group-item">A third item</li>
                    <li class="list-group-item">A fourth item</li>
                    <li class="list-group-item disabled" aria-disabled="true">A disabled item</li>
                </ul><!-- End ist group with active and disabled items -->

            </div>

        </div>
        
    </div>
@endsection

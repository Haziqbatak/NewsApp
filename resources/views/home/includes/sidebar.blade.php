<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('home') }}">
                <i class="bi bi-grid"></i>
                <span>Home</span>
            </a>
        </li>

        <!-- End Dashboard Nav -->

        @if (Auth::user()->role == 'admin')
            <li class="nav-item">
                <a class="nav-link " href="{{ route('allUser') }}">
                    <i class="bi bi-file-earmark-bar-graph-fill"></i>
                    <span>User</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link " href="{{ route('category.index') }}">
                    <i class="bi bi-basket2"></i>
                    <span>Category</span>
                </a>
            </li>
        @else
        @endif
        <li class="nav-item">
            <a class="nav-link " href="{{ route('news.index') }}">
                <i class="bi bi-newspaper"></i>
                <span>News</span>
            </a>
        </li>

    </ul>

</aside>

<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-white py-3 shadow-sm bg-body rounded">
    <div class="container-fluid">
        <a class="navbar-brand px-3" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                    <li class="nav-item">
                        <a class="nav-link">Current User</a>
                    </li>
                    <li class="nav-item">
{{--                        <a href="{{route('logout')}}" class="nav-link">Logout</a>--}}
                    </li>
{{--                @else--}}
                    <li class="nav-item">
{{--                        <a href="{{route('login')}}" class="nav-link">Login</a>--}}
                    </li>
{{--                @endif--}}
            </ul>
        </div>
    </div>
</nav>

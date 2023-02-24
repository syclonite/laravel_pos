<nav class="navbar navbar-expand-lg sticky-top navbar-light bg-white py-3 shadow-sm bg-body rounded">
    <div class="container-fluid">
        <a class="navbar-brand px-3" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <ul class="navbar-nav">
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
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary">Logout</button>
                    </form>
                </li>
                <li class="nav-item">
                    <a type="button" class="btn btn-outline-info btn-sm nav-link" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-bell"></i><sup>{{$countStock ?? ''}}</sup></a>
                </li>
                    <li class="nav-item">

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


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($stock_result as $data)
                        <tr>
                            <td>{{$data->product->product_name ?? ' '}}</td>
                            <td>{{$data->unit->unit_name ?? ' '}}</td>
                            <td>{{$data->total_quantity ?? ' '}}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

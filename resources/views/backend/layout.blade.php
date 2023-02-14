<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="{{url('css/backend_bootstrap_5.1.min.css')}}" rel="stylesheet"  crossorigin="anonymous">
    <script src="{{url('js/backend_popper.min.js')}}"  crossorigin="anonymous"></script>
    <script src="{{url('js/backend_bootstrap_5.1.3.min.js')}}"  crossorigin="anonymous"></script>
</head>
<body>
@include('backend.partials.navbar')
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class=" col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light shadow-lg bg-body rounded"> <!-- Sidebar -->
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-dark min-vh-100">
                <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline">Dashboard</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a href="#" class="nav-link align-middle px-0 text-dark">--}}
                    {{--                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    <li>
                        <a href="{{route('users.index')}}" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">User Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('customers.index')}}" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-speedometer2"></i> <span class="ms-1 d-none d-sm-inline">Customer Management</span></a>
                    </li>
                    <li>
                       <a href="{{route('roles.index')}}" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Role Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('categories.index')}}" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Category Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('subcategories.index')}}" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Subcategory Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('products.index')}}" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Product Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('suppliers.index')}}" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Suppliers Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('units.index')}}" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Unit Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('purchase.index')}}" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Purchase Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('sales.index')}}" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Sale Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('expenses.index')}}" class="nav-link px-0 align-middle text-dark">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Expense Management</span></a>
                    </li>
                    <li>
                        <a href="#submenu3" class="nav-link px-0 align-middle text-dark" data-bs-toggle="collapse">
                            <i class="fs-4 bi-people"></i> <span class="ms-1 d-none d-sm-inline">Reports</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100 text-dark">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Stock Report</span> 1</a>
                            </li>
                            <li class="text-dark">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Purchase Report</span> 2</a>
                            </li>
                            <li class="text-dark">
                                <a href="#" class="nav-link px-0"> <span class="d-none d-sm-inline">Sells Report</span> 3</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <br>
            </div>
        </div>

        <div class="col py-3 px-5">
            <h3 class="notice"></h3>
            <h3 class="alert"></h3>
            <main>
                @yield('content')

            </main>
        </div>
    </div>
</div>
</body>

</html>


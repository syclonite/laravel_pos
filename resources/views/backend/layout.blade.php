<!DOCTYPE html>
<html>
{{--<head>--}}
{{--    <title>Nowshad Enterprise</title>--}}
{{--    <meta name="viewport" content="width=device-width,initial-scale=1">--}}
{{--    <link href="{{url('css/backend_bootstrap_5.1.min.css')}}" rel="stylesheet"  crossorigin="anonymous">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
{{--    <script src="{{url('js/jquery.min.js')}}"></script>--}}
{{--    <script src="{{url('js/backend_popper.min.js')}}"  crossorigin="anonymous"></script>--}}
{{--    <script src="{{url('js/backend_bootstrap_5.1.3.min.js')}}"  crossorigin="anonymous"></script>--}}
{{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdn.datatables.net/datetime/1.3.0/css/dataTables.dateTime.min.css" rel="stylesheet" />--}}
{{--    <link href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css" rel="stylesheet" />--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}

{{--    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/datetime/1.3.0/js/dataTables.dateTime.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>--}}
{{--    <!--select 2 for bootstrap 5-->--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />--}}
{{--    <!-- Or for RTL support -->--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}
{{--</head>--}}
@include('backend.partials.all_links')
<body>
@include('backend.partials.navbar')
<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class=" col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-light shadow-lg bg-dark"> <!-- Sidebar -->
            <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="{{route('dashboard')}}" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                    <i class="fa fa-dashboard"></i><span class="fs-5 ms-1 d-none d-sm-inline">Dashboard</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a href="#" class="nav-link align-middle px-0 text-dark">--}}
                    {{--                            <i class="fs-4 bi-house"></i> <span class="ms-1 d-none d-sm-inline">Home</span>--}}
                    {{--                        </a>--}}
                    {{--                    </li>--}}
                    <li>
                        <a href="{{route('users.index')}}" class="nav-link px-0 align-middle text-white">
                            <i class="fa fa-user"></i> <span class="ms-1 d-none d-sm-inline">User Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('customers.index')}}" class="nav-link px-0 align-middle text-white">
                            <i class="fa fa-group"></i> <span class="ms-1 d-none d-sm-inline">Customer Management</span></a>
                    </li>
                    <li>
                       <a href="{{route('roles.index')}}" class="nav-link px-0 align-middle text-white">
                            <i class="fa fa-universal-access"></i> <span class="ms-1 d-none d-sm-inline">Role Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('categories.index')}}" class="nav-link px-0 align-middle text-white">
                            <i class="fa fa-align-justify"></i> <span class="ms-1 d-none d-sm-inline">Category Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('subcategories.index')}}" class="nav-link px-0 align-middle text-white">
                            <i class="fa fa-align-justify"></i> <span class="ms-1 d-none d-sm-inline">Subcategories</span></a>
                    </li>
                    <li>
                        <a href="{{route('products.index')}}" class="nav-link px-0 align-middle text-white">
                            <i class="fa fa-cubes"></i> <span class="ms-1 d-none d-sm-inline">Product Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('suppliers.index')}}" class="nav-link px-0 align-middle text-white">
                            <i class="fa fa-group"></i> <span class="ms-1 d-none d-sm-inline">Suppliers Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('units.index')}}" class="nav-link px-0 align-middle text-white">
                            <i class="fa fa-cube"></i> <span class="ms-1 d-none d-sm-inline">Unit Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('purchase.index')}}" class="nav-link px-0 align-middle text-white">
                            <i class="fa fa-tasks"></i> <span class="ms-1 d-none d-sm-inline">Purchase Management</span></a>
                    </li>
                    <li>
                        <a href="{{route('sales.index')}}" class="nav-link px-0 align-middle text-white">
                            <i class="fa fa-server"></i> <span class="ms-1 d-none d-sm-inline">Sale Management</span></a>
                    </li>
                    <li>
                        <a href="#expense" class="nav-link px-0 align-middle text-white" data-bs-toggle="collapse">
                           <span class="ms-1 d-none d-sm-inline">Expense Management</span> <i class="fa fa-angle-down"></i> </a>
                        <ul class="collapse nav flex-column ms-1" id="expense" data-bs-parent="#menu">
                            <li class="w-100 text-dark">
                                <a href="{{route('expenses.index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline">Expense Category</span></a>
                            </li>
                            <li class="text-dark">
                                <a href="{{route('expense_record.index')}}" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline">Expense Record</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#submenu3" class="nav-link px-0 align-middle text-white" data-bs-toggle="collapse">
                            <span class="ms-1 d-none d-sm-inline">Reports</span> <i class="fa fa-angle-down"></i>  </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100 text-white">
                                <a href="#" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline">Stock Report</span> 1</a>
                            </li>
                            <li class="text-white">
                                <a href="#" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline">Purchase Report</span> 2</a>
                            </li>
                            <li class="text-white">
                                <a href="#" class="nav-link px-0 text-white"> <span class="d-none d-sm-inline">Sells Report</span> 3</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <br>
            </div>
        </div>

        <div class="col py-2 px-3">
            <h3 class="notice"></h3>
            <h3 class="alert"></h3>
            <main>
                @yield('content')
            </main>
            <br>
            <br>
            @include('backend.partials.footer')
        </div>
    </div>
</div>
</body>

</html>

<style>
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
</style>

<script>
    var minDate, maxDate;
    // Custom filtering function which will search data in column four between two values
     $.fn.dataTable.ext.search.push(
        function( settings, data, dataIndex ) {
            var min = minDate.val();
            var max = maxDate.val();
            // console.log($('#created_at').siblings().length - 1);
            var count_header = $('#created_at').siblings().length - 1;
            var date = new Date( data[count_header]);

            if (
                ( min === null && max === null ) ||
                ( min === null && date <= max ) ||
                ( min <= date   && max === null ) ||
                ( min <= date   && date <= max )
            ) {
                return true;
            }
            return false;
        }

    );

    // $.fn.modal.Constructor.prototype.enforceFocus = function () {};

    $(document).ready(function() {
        // $("select").select2();
        $( 'select').select2( {
            theme: 'bootstrap-5'
        } );
        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'MMMM Do YYYY'
        });
        maxDate = new DateTime($('#max'), {
            format: 'MMMM Do YYYY'
        });

        // DataTables initialisation
        var table = $('#example').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'excel', 'pdf', 'print'
            ]
        });

        // Refilter the table
        $('#min, #max').on('change', function () {
            table.draw();
        });
    });

</script>


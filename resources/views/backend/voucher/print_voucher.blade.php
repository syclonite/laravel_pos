{{--@extends('backend.layout')--}}
<html>
<head>
    <title>Nowshad Enterprise</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="{{url('css/backend_bootstrap_5.1.min.css')}}" rel="stylesheet"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="{{url('js/jquery.min.js')}}"></script>
    <script src="{{url('js/backend_popper.min.js')}}"  crossorigin="anonymous"></script>
    <script src="{{url('js/backend_bootstrap_5.1.3.min.js')}}"  crossorigin="anonymous"></script>
    {{--    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />--}}
    <link href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/datetime/1.3.0/css/dataTables.dateTime.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.3.4/css/buttons.dataTables.min.css" rel="stylesheet" />
    {{--    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>--}}

    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js"></script>
    <script src="https://cdn.datatables.net/datetime/1.3.0/js/dataTables.dateTime.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.4/js/buttons.print.min.js"></script>
    <!--select 2 for bootstrap 5-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>
<div class="container-fluid">
    <section>
        <header class="clearfix">
            <div class="row">
                <div class="col-1">
                    <div class="d-flex justify-content-start">
                        <img src="{{url('images/nowshad_enterprise_edited.jpg')}}" style="height: 100px; width: 200px">
                    </div>
                </div>
                <div class="col-11">
                    <div class="d-flex justify-content-end">
                        <div class="row">
                            <div class="col-12"><h2 class="d-flex justify-content-center">Company Name</h2></div>
                            <div class="col-12"><h4 class="d-flex justify-content-center">Md. Sahan </h4></div>
                            <div class="col-12"><h5 class="d-flex justify-content-center">Hardware Shop</h5></div>
                            <div class="col-12"><h5 class="d-flex justify-content-center">Mobile:01676058955,01676058955,01676058955,01676058955</h5></div>
                            <div class="col-12"><h5 class="d-flex justify-content-center">Address:Desher Baire</h5></div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <hr>
    </section>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-9">
                    <div class="col-12 d-inline-flex"><strong>Customer Name: </strong> {{$customers->name}}</div>
                    <div class="col-12 d-inline-flex"><strong>Mobile: </strong> {{$customers->phone}}</div>
                    <div class="col-12 d-inline-flex"><strong>Address: </strong> {{$customers->address}}</div>
                </div>
                <div class="col-3">
                    <strong>Date: <span>{{$voucher->created_at->format('d F Y')}}</span></strong>
                </div>
            </div>
        </div>
    </div>
    <table class=" table table-bordered">
        <thead>
        <tr>
            <th>Serial No</th>
            <th>Product Name</th>
            <th>Unit</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Subtotal</th>
        </tr>
        </thead>
        <tbody>
        @foreach($voucher_details as $key=>$voucher_detail )
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$voucher_detail->product->product_name}}</td>
                <td>{{$voucher_detail->unit->unit_name}}</td>
                <td>{{$voucher_detail->product_price}}</td>
                <td>{{$voucher_detail->quantity}}</td>
                <td>{{$voucher_detail->subtotal}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <br>
    <div>
        <div class="row">
            <div class="offset-8 col-4">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">Discount: {{$voucher->discount??''}}</li>
                            <li class="list-group-item">Extra Charge :{{$voucher->extra_charge??''}}</li>
                            <li class="list-group-item">Total Bill: {{$voucher->billing_amount??''}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    window.onload = function () {
        window.print();
    }
</script>
</body>
</html>
{{--@section('content')--}}

{{--@endsection--}}

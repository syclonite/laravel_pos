@include('backend.partials.all_links')
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
                    <strong>Date: <span>{{$sale_order->created_at->format('d F Y')}}</span></strong>
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
        @foreach($sale_order_details as $key=>$sale_order_detail )
            <tr>
                <td>{{$key + 1}}</td>
                <td>{{$sale_order_detail->product->product_name}}</td>
                <td>{{$sale_order_detail->unit->unit_name}}</td>
                <td>{{$sale_order_detail->product_selling_price}}</td>
                <td>{{$sale_order_detail->quantity}}</td>
                <td>{{($sale_order_detail->quantity) * ($sale_order_detail->product_selling_price)}}</td>
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
                            <li class="list-group-item">Discount: {{$sale_order->discount??''}}</li>
                            <li class="list-group-item">Extra Charge :{{$sale_order->extra_charge??''}}</li>
                            <li class="list-group-item">Total Bill: {{$sale_order->billing_amount??''}}</li>
                            <li class="list-group-item">Paid Amount: {{$sale_order->paid_amount??''}}</li>
                            <li class="list-group-item">Change Amount: {{$sale_order->change_amount??''}}</li>
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

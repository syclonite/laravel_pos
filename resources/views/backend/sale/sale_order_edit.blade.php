@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Update Sale Orders</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('sales.index')}}"> Back</a>
            </div>
        </div>
    </div><br>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{--@dd($purchase_order->id)--}}
    {{--    <form action="{{route('purchase.store')}}" method="POST" enctype="multipart/form-data">--}}
    {{--        @csrf--}}
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Bill No:</strong>
                <input type="text" name="" class="form-control" id="bill_no" value="{{$sale_order->id}}" disabled>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Billing Amount:</strong>
                <input id="billing_amount" class="form-control" type="text" name="billing_amount" value="{{$sale_order->billing_amount}}" disabled>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Paid Amount:</strong>
                <input class="form-control" type="text" name="paid_amount" id="paid_amount"  value="{{$sale_order->paid_amount}}" disabled>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Extra Charge:</strong>
                <input class="form-control" type="text" name="extra_charge" id="extra_charge" onchange="subtotal_calculation()"  value="{{$sale_order->extra_charge}}" >
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Discount:</strong>
                <input class="form-control" type="text" name="discount" id="discount" onchange="subtotal_calculation()" value="{{$sale_order->discount}}" >
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Customer Name:</strong>
                <select name="customer_id" id="customer_id" class="form-control" >
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}"{{ $customer->id == $sale_order->customer_id ? 'selected' : '' }}>{{ $customer->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Status:</strong>
                <select name="status" id="" class="form-control" >
                    <option value='0' {{ $sale_order->status == '0' ? 'selected':'' }}>Disabled</option>
                    <option value='1' {{ $sale_order->status == '1' ? 'selected':'' }}>Enabled</option>
                </select>
            </div>
        </div>
    </div><br>
    <table id="myTable" class="table table-striped table-light table-bordered">
        <thead>
        <tr>
            <th>Serial No.</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Unit</th>
            <th>Subtotal </th>
        </tr>
        </thead>
        <tbody id="data">
        @foreach( $sale_order_details as $sale_order_detail)
            <tr>
                <td>{{++$i}}</td>
                <td>
                    <select name="product_id" id="product_id" class="form-control product_id" >
                        @foreach($products as $product)
                            <option value="{{ $product->id }}"{{ $product->id == $sale_order_detail->product_id ? 'selected' : '' }}>{{ $product->product_name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input id="product_price" class="form-control" type="text" name="product_price" onchange="subtotal_calculation()" value="{{$sale_order_detail->product_selling_price}}">
                </td>
                <td>
                    <input id="quantity" class="form-control quantity" type="text" name="quantity" onchange="subtotal_calculation()" value="{{$sale_order_detail->quantity}}">
                </td>
                <td>
                    <select id="unit_id" name="unit_id" id="" class="form-control unit_id" >
                        @foreach($units as $unit)
                            <option value="{{ $unit->id }}"{{ $unit->id == $sale_order_detail->unit_id ? 'selected' : '' }}>{{ $unit->unit_name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input id="subtotal" class="form-control" type="text" name="subtotal"  value="{{$sale_order_detail->quantity * $sale_order_detail->product_selling_price}}" disabled>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button type="button" class="btn btn-primary col-2 col-md-2 col-sm-2 savebtn" id="submit" >Update</button>
    {{--    </form>--}}

    <script>
        $("button#submit").click(function() {
            // alert('hello');
            var data = [];
            var product_id,quantity, product_price,unit_id;
            // return alert(payment_status);
            $("table > tbody  > tr").each(function(index, tr) {
                product_id = parseInt($(this).find('#product_id').val());
                quantity = parseInt($(this).find('#quantity').val());
                product_price = parseInt($(this).find('#product_price').val());
                unit_id = parseInt($(this).find('#unit_id').val());
                // console.log(index);
                // console.log(tr);
                data.push({
                    product_id,
                    unit_id,
                    quantity,
                    product_price,
                });
            });
            // return percentage_cal();
            // return console.log(data);
            if(data == ""){
                alert("Please Add list then try again ")
            }else{
                // percentage_cal(data)
                // submit_stock_order(data)
                submit_purchase(data)
            }

        });

        function subtotal_calculation(){
            var sum_subtotal = 0
            $("table > tbody  > tr").each(function(index, tr) {
                var subtotal = parseInt($(this).find('#product_price').val()) * parseInt($(this).find('#quantity').val());
                parseInt($(this).find('#subtotal').val(subtotal));
                sum_subtotal += subtotal;
            })
            // alert(sum_subtotal);
            var discount = $('#discount').val();
            var extra_charge = $('#extra_charge').val();
            var total_bill = sum_subtotal;
            if( discount != '' || extra_charge != ''){
                var result_1 = (total_bill + Number(extra_charge)) - discount;
                $("#billing_amount").val(result_1);
            }

        }

        function showmsg(){
            alert("Order Updated")
            window.location.reload();
        }


        function submit_purchase(data){
            // return console.log(data);
            // return console.log("percentage status_value:"+value)
            $.ajax({
                url: "{{route('sales.update',$sale_order->id)}}",
                type: "PUT",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                {{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
                data: {
                    "_token": "{{ csrf_token() }}",
                    sale_order_details: data,
                    sale_order: {
                        id: $("#bill_no").val(),
                        customer_id: $("#customer_id").val(),
                        paid_amount: $("#paid_amount").val(),
                        billing_amount: $("#billing_amount").val(),
                        extra_charge: $("#extra_charge").val(),
                        discount: $("#discount").val(),
                    },
                    success: function (data) {
                        console.log(data)
                        // showmsg()
                    }
                }
            })
        }
        // Get Products Routes
        // function get_product(){
        //     $.ajax({
        //         url: "http://localhost:3000/stock_orders/get_product",
        //         type: "GET",
        //         // contentType: "application/json",
        //         contentType: "application/x-www-form-urlencoded; charset=UTF-8",
        //         dataType: "json",
        //         data: {
        //             category_id: $("#category_id").val()
        //         },
        //         success:function(result){
        //             console.log(result)
        //             $("#product_id").empty();
        //             $("#product_id").append('<option>Select Product</option>');
        //             for(var i = 0; i < result.length; i++) {
        //                 $("#product_id").append('<option value="' + result[i]["id"] + '">' + result[i]["product_name"] + '</option>');
        //             }
        //         }
        //     })
        // }
    </script>
@endsection

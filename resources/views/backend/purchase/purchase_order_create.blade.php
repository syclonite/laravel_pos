@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Purchase New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('purchase.index')}}"> Back</a>
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

    {{--    <form action="{{route('purchase.store')}}" method="POST" enctype="multipart/form-data">--}}
    {{--        @csrf--}}

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4 mb-4">
            <div class="form-group">
                <strong>Products</strong>
                <select name="product_id" id="product_id" class="form-control" >
                    <option value=''>Please choose one...</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Units:</strong>
                <select name="unit_id" id="unit_id" class="form-control" >
                    <option value=''>Please choose one...</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Quantity</strong>
                <input type="number" name="quantity" class="form-control" placeholder="Quantity" id="quantity">
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Purchase Price</strong>
                <input type="number" name="purchase_price" class="form-control" placeholder="Purchase Price" id="purchase_price">
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Sale Price</strong>
                <input type="number" name="sale_price" class="form-control" placeholder="Sale Price" id="selling_price">
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Suppliers:</strong>
                <select name="supplier_id" id="supplier_id" class="form-control" >
                    <option>Please choose one...</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div><br><button type="button" class="btn btn-primary col-2 col-md-2 col-sm-2 savebtn" id="add_list" style="float:left">Add List</button></div>
        {{--            <div class="col-xs-6 col-sm-6 col-md-6">--}}
        {{--                <div class="form-group">--}}
        {{--                    <strong>Status:</strong>--}}
        {{--                    <select name="status" id="" class="form-control" >--}}
        {{--                        <option value="0">Disabled</option>--}}
        {{--                        <option value="1">Enabled</option>--}}
        {{--                    </select>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        <div class="container">
            <br>
            <table id="myTable" class="table table-striped table-light table-bordered">
                <thead>
                <tr>
                    <th>Serial No</th>
                    <th>Product Name</th>
                    <th>Unit</th>
                    <th>Quantity</th>
                    <th>Purchase Price</th>
                    <th>Subtotal</th>
                    <th>Selling Price</th>
                    <th>Action</th>
                </tr>
                </thead>

                <tbody id="data">

                </tbody>

            </table>
            <br>
            <div>
                <div class="row">
                    <div class="offset-8 col-4">
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item">Discount :<input class="form-control" type="number" id="discount" name="discount" onchange="bill_calculation()"></li>
                                    <li class="list-group-item">Extra Charge :<input class="form-control" type="number" id="extra_charge" name="extra_charge" onchange="bill_calculation()"></li>
                                    <li class="list-group-item">Total Bill: <span  id="total_bill"></span></li>
                                    <li class="list-group-item">Paid Amount :<input class="form-control" type="number" id="paid_amount" onchange="bill_calculation()"></li>
                                    <li class="list-group-item">Change :<span id="change_amount"></span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <br>
                    <button type="button" class="btn btn-primary col-2 col-md-2 col-sm-2 savebtn" id="submit" >Submit</button>
                    {{--                       <button type="button" class="btn btn-primary btn-lg"  >Submit</button>--}}
                </div>
            </div>
        </div>

        <br>
    </div>
    {{--    </form>--}}

{{--    <script src="{{url('js/jquery.min.js')}}"></script>--}}
    <script>
        // function selling_amount_cal(){
        //     var quantity = $("#quantity").val();
        //     var purchase_price = $("#purchase_price").val();
        //     var result = (purchase_amount/quantity );
        //     $("#selling_price").val(result);
        // };

        $("#add_list").click(function() {
            // alert('hello');
            var product_id = $("#product_id").val();
            var product_text = $("#product_id option:selected").text();
            var purchase_price = $("#purchase_price").val();
            var quantity = $("#quantity").val();
            var unit_id = $("#unit_id").val();
            var unit_text = $("#unit_id option:selected").text();
            var selling_price = $("#selling_price").val();
            var subtotal = $("#purchase_price").val() * $("#quantity").val();
            // return console.log(expiry_date);

            var new_row = '<tr>' +
                '<td>' + ($('table tbody tr').length+1) + '</td>'+
                '<td class="product_id" style="display: none">' + product_id + '</td>' +
                '<td class="product_text">' + product_text + '</td>' +
                '<td class="unit_id" style="display: none">' + unit_id + '</td>' +
                '<td class="unit_text">' + unit_text + '</td>' +
                '<td class="quantity">' + quantity + '</td>' +
                '<td class="purchase_price">' + purchase_price + '</td>'+
                '<td class="subtotal">' + subtotal + '</td>'+
                '<td class="selling_price">' + selling_price + '</td>'+
                '<td><input type="button" value="Delete" onclick="bill_calculation(this)"/></td>' + '</tr>';
            $("table tbody").append(new_row);
            bill_calculation();
        });
        function bill_calculation(value){
            $(value).parent().parent().remove()
            var sum_subtotal_amount = 0
            $(".subtotal").each(function(){
                 sum_subtotal_amount += parseFloat($(this).text());
                $("#total_bill").text(sum_subtotal_amount)
            })
            var discount = $('#discount').val();
            // var extra_charge = $('#extra_charge').val();
            var total_bill = sum_subtotal_amount;
            if( discount != '' || extra_charge != ''){
               var result_1 = (total_bill - discount);
               var result_2 =  parseInt(result_1) + Number($('#extra_charge').val());
               // console.log(result_2);
                $("#total_bill").text(result_2);
            }
            var paid_amount = $("#paid_amount").val();
            if (result_2 >= paid_amount){
               var change_amount = result_2 - paid_amount;
                $("#change_amount").text(change_amount);
            //     // alert("if condition");
            }else{
                change_amount = paid_amount - result_2;
                $("#change_amount").text(change_amount);
            }

        }
        $("#submit").click(function() {
            var data = [];
            var product_id,quantity, purchase_price,selling_price,unit_id;
            // return alert(payment_status);
            $('#myTable > tbody > tr').each(function(index,tr) {
                console.log(index)
                console.log(tr)
                product_id = parseInt($(this).find('.product_id').text());
                quantity = parseInt($(this).find('.quantity').text());
                purchase_price = parseFloat($(this).find('.purchase_price').text());
                selling_price = parseFloat($(this).find('.selling_price').text());
                unit_id = parseInt($(this).find('.unit_id').text());
                data.push({

                    product_id,
                    unit_id,
                    quantity,
                    purchase_price,
                    selling_price,
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

        function showmsg(){
            alert("New Order Created")
            window.location.reload();
        }

        // function percentage_cal(data){
        //     var total_bill = $("#total_bill").text();
        //     var paid_amount = $("#paid_amount").val()
        //     var percentage = Math.round((paid_amount/ total_bill) * 100);
        //     // return alert(percentage);
        //     if(percentage > 50 && percentage < 100){
        //         payment_status_value = 2; //payment_status is partails_payment
        //     }else if (percentage >= 100){
        //         payment_status_value = 0 //payment_status is paid
        //     }else if(percentage < 50){
        //         payment_status_value = 1; //payment_status is due
        //     };
        //     payment_status_value;
        //     submit_stock_order(data,payment_status_value)
        // }

        function submit_purchase(data){
            // return console.log(data);
            // return console.log("percentage status_value:"+value)
            $.ajax({
                url: "http://localhost:8000/purchase/store",
                type: "POST",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                {{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
                data: {
                    "_token": "{{ csrf_token() }}",
                    purchase_order_details: data,
                    purchase_order: {
                        supplier_id: $("#supplier_id").val(),
                        paid_amount: $("#paid_amount").val(),
                        billing_amount: parseFloat($("#total_bill").text()),
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

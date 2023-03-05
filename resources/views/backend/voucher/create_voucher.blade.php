@extends('backend.layout')

@section('content')
    <div class="container-fluid">
        <!-- Add Customer Modal -->
        <div class="modal fade " id="add_voucher_customer_modal" tabindex="-1" aria-labelledby="CustomerModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Customer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" >
                        <div class="form-group">
                            <strong>Customer Name:</strong>
                            <input type="text" name="name" class="form-control" placeholder="Name" id="new_customer_name"  required>
                        </div>

                        <div class="form-group">
                            <strong>Phone:</strong>
                            <input class="form-control" type="text" name="phone" placeholder="Phone" id="new_customer_phone" required>
                        </div>
                        <div class="form-group">
                            <strong>Address:</strong>
                            <textarea class="form-control" type="text" name="address" placeholder="Address" id="new_customer_address" cols="20" rows="5"></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="add_new_customer()">Save changes</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add Customer Modal -->

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

        <section>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <strong>Search Customers:</strong>
                                <div class="col-8 d-inline-flex">
                                    <select name="customer_id" id="voucher_customer_id" class="form-control" onchange="customer_info()">
                                        <option value=''>Please choose one...</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}|{{ $customer->phone}}|{{ $customer->address}}</option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_voucher_customer_modal">+</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="col-12 d-inline-flex"><strong>Customer Name:</strong> <p id="voucher_customer_name"></p></div>
                            <div class="col-12 d-inline-flex"><strong>Mobile:</strong><p id="voucher_customer_phone"></p></div>
                            <div class="col-12 d-inline-flex"><strong>Address:</strong><p id="voucher_customer_address"></p></div>
                        </div>
                        <div class="col-2">
                            <strong>Date: 1/3/2023</strong>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <br>
        <hr>
        <section>
            <div class="d-flex justify-content-center"><h1><u>Add Product List</u></h1></div>
            <br>
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
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
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Units:</strong>
                        <select name="unit_id" id="unit_id" class="form-control" onchange="get_product_price()">
                            <option value=''>Please choose one...</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->unit_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Selling Price</strong>
                        <input type="number" name="product_price" class="form-control" placeholder="Product Price" id="product_price" disabled>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                        <strong>Quantity</strong>
                        <input type="number" name="quantity" class="form-control" placeholder="Quantity" id="quantity">
                    </div>
                </div>

                <div><br><button type="button" class="btn btn-primary col-2 col-md-2 col-sm-2 savebtn" id="add_list" style="float:left">Add List</button></div>

                <div class="container">
                    <br>
                    <table id="myTable" class="table table-bordered">
                        <thead>
                        <tr>
{{--                            <th>Serial No</th>--}}
                            <th>Product Name</th>
                            <th>Unit</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                        </thead>

                        <tbody>
                        <tr>
{{--                            <td></td>--}}
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
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
                                            <li class="list-group-item">Total Bill: <input class="form-control" type="number" id="total_bill" name="total_bill" disabled></li>
{{--                                            <li class="list-group-item">Paid Amount :<input class="form-control" type="number" id="paid_amount" onchange="bill_calculation()"></li>--}}
{{--                                            <li class="list-group-item">Return Amount : <span id="change_amount" ></span>  </li>--}}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            <br>
                            <button type="button" class="btn btn-primary col-2 col-md-2 col-sm-2 savebtn" id="submit" >Submit</button>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </section>

    </div>

    <div class="container" id="your-element">

    </div>

    <script>

        function add_new_customer(){
            $.ajax({
                url: "{{route('voucher.add_customer_voucher')}}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                    customers:{
                        name: $('#new_customer_name').val(),
                        phone: $('#new_customer_phone').val(),
                        address: $('#new_customer_address').val(),
                    },

                },
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                }
            });
            all_ajax_customers()
        }

        function all_ajax_customers(){
            $.ajax({
                url: "{{route('voucher.all_voucher_customer_ajax')}}",
                type: "POST",
                cache: false,
                dataType: 'json',
                data:{
                    _token:'{{ csrf_token() }}',
                    id: "pass",
                },
                success: function(dataResult){
                    console.log(dataResult);
                    var data = dataResult.customer_data_ajax
                    var formoption = "";
                    $.each(data, function(v) {
                        var val = data[v]
                        formoption += "<option value='" + val.id + "'>" + val.name +'|'+ val.phone +"</option>";
                    });
                    $('#voucher_customer_id').html(formoption);

                }
            });
        }

        function customer_info(){
            var customer_id = $('#voucher_customer_id option:selected').val();
            $.ajax({
                url: "{{route('voucher.voucher_selected_customer')}}",
                type: "POST",
                data:{
                    _token:'{{ csrf_token() }}',
                    id: customer_id,
                },
                cache: false,
                dataType: 'json',
                success: function(dataResult){
                    console.log(dataResult);
                    var resultData = dataResult;
                    // var bodyData = '';
                    // var i=1;
                    $.each(resultData,function(index,row){
                        $('#voucher_customer_name').text(row.name);
                        $('#voucher_customer_phone').text(row.phone);
                        $('#voucher_customer_address').text(row.address);
                    })
                }
            });
        }

        // add list to the table
        var item = 0;

        $("button#add_list").click(function() {
            // alert('hello');
            item++;
            var product_id = $("#product_id").val();
            var product_text = $("#product_id option:selected").text();
            var product_price = $("#product_price").val();
            var quantity = $("#quantity").val();
            var unit_id = $("#unit_id").val();
            var unit_text = $("#unit_id option:selected").text();
            var subtotal = product_price * quantity;
            // return console.log(expiry_date);
            var new_row = '<tr>' +
                // '<td>' + ($('#myTable > tr').length + 1) + '</td>'+
                '<td class="product_id" style="display: none">' + product_id + '</td>' +
                '<td class="unit_id" style="display: none">' + unit_id + '</td>' +
                '<td class="product_text">' + product_text + '</td>' +
                '<td class="unit_text">' + unit_text + '</td>' +
                '<td class="product_price">' + product_price + '</td>'+
                '<td class="quantity">' + quantity + '</td>' +
                '<td class="subtotal">' + subtotal + '</td>' +
                '<td><input type="button" value="Delete" onclick="remove_cell(this)"/></td></tr>';
            var btn = document.createElement('tr');
            btn.innerHTML = new_row;
            document.getElementById('myTable').appendChild(btn);
            bill_calculation();
        });

        function remove_cell(value){
            $(value).parent().parent().remove()
            bill_calculation();
        }

        function bill_calculation(){
            var total =0;
            $('.subtotal').each(function(index, tr) {
                // debugger
                total =total+  parseInt($(this).text());
            });
            $('#total_bill').val(total);
            var discount = $('#discount').val();
            // var extra_charge = $('#extra_charge').val();
            var total_bill = total;
            if( discount != '' || extra_charge != ''){
                var result_1 = (total_bill - discount);
                var result_2 =  parseInt(result_1) + Number($('#extra_charge').val());
                // console.log(result_2);
                $("#total_bill").val(result_2);
            }
            // var paid_amount = $("#paid_amount").val();
            // if (result_2 >= paid_amount){
            //     var change_amount = result_2 - paid_amount;
            //     $("#change_amount").text("Due -"+ change_amount);
            //     //     // alert("if condition");
            // }else{
            //     change_amount = paid_amount - result_2;
            //     $("#change_amount").text(change_amount);
            // }
        };

        function get_product_price(){
           // var product_id = $('#product_id:selected').val();
           // var unit_id = $('#unit_id:selected').val();
            $.ajax({
                url: "{{route('voucher.all_voucher_product_price_ajax')}}",
                type: "POST",
                cache: false,
                dataType: 'json',
                data:{
                    _token:'{{ csrf_token() }}',
                    parameters:{
                        product_id: $("#product_id").val(),
                        unit_id: $("#unit_id").val(),
                    },
                },
                success: function(dataResult){
                    console.log(dataResult.product_price);
                    var data = dataResult.product_price
                    $('#product_price').val(data);

                }
            });

        }

        $("button#submit").click(function() {
            var data = [];
            var product_id,unit_id,quantity, product_price,subtotal;
            // return alert(payment_status);
            $("#myTable >tr").each(function(index) {
                product_id = $(this).find('.product_id').text();
                unit_id = $(this).find('.unit_id').text();
                quantity = $(this).find('.quantity').text();
                product_price = $(this).find('.product_price').text();
                subtotal = $(this).find('.subtotal').text();
                data.push({
                    product_id,
                    unit_id,
                    quantity,
                    product_price,
                    subtotal,
                });
            });
            // return percentage_cal();
            // return console.log(data);
            if(data == ""){
                alert("Please Add list then try again ")
            }else{
                // percentage_cal(data)
                // submit_stock_order(data)
                // return window.print();
                submit_voucher_details(data)
            }

        });

        // function showmsg(){
        //
        //     // window.location.reload();
        // }

        function submit_voucher_details(data){
            $.ajax({
                url: "{{route('voucher.voucher_store')}}",
                type: "POST",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                {{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
                data: {
                    "_token": "{{ csrf_token() }}",
                    item_list: data,
                    voucher_order: {
                        customer_id: $('#voucher_customer_id option:selected').val(),
                        billing_amount: $("#total_bill").val() || 0,
                        extra_charge: $("#extra_charge").val() || 0,
                        discount: $("#discount").val() || 0,
                    },
                    success: function (data) {
                        alert("New Voucher Created")
                        window.location.href = "{{route('voucher.voucher_index')}}"
                    }
                }
            })
        }
    </script>

    <style>
        button{
            font-size:18px;
        }
        .myTable {
            background-color:#ffaa56;
        }
        .myTable {
            border-collapse: collapse;
            border-spacing: 0;
            width:100%;
            height:100%;
            margin:0px;
            padding:0px;
        }
        .myTable tr:last-child td:last-child {
            -moz-border-radius-bottomright:0px;
            -webkit-border-bottom-right-radius:0px;
            border-bottom-right-radius:0px;
        }
        .myTable tr:first-child td:first-child {
            -moz-border-radius-topleft:0px;
            -webkit-border-top-left-radius:0px;
            border-top-left-radius:0px;
        }
        .myTable tr:first-child td:last-child {
            -moz-border-radius-topright:0px;
            -webkit-border-top-right-radius:0px;
            border-top-right-radius:0px;
        }
        .myTable tr:last-child td:first-child {
            -moz-border-radius-bottomleft:0px;
            -webkit-border-bottom-left-radius:0px;
            border-bottom-left-radius:0px;
        }
        .myTable tr:hover td {
        }
        #items_table tr:nth-child(odd) {
            background-color:#ffffff;
        }
        #items_table tr:nth-child(even) {
            background-color:#ffd0a3;
        }
        .myTable td {
            vertical-align:middle;
            border:1px solid #000000;
            border-width:0px 1px 1px 0px;
            text-align:left;
            padding:7px;
            font-size:10px;
            font-family:Arial;
            font-weight:normal;
            color:#000000;
        }
        .myTable tr:last-child td {
            border-width:0px 1px 0px 0px;
        }
        .myTable tr td:last-child {
            border-width:0px 0px 1px 0px;
        }
        .myTable tr:last-child td:last-child {
            border-width:0px 0px 0px 0px;
        }


    </style>
@endsection

@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Sale New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('sales.index')}}"> Back</a>
                <!-- Modal for Due Payment-->
                <div class="modal fade " id="customer_modal" tabindex="-1" aria-labelledby="CustomerModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Customer Details</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" >
                                <div class="form-group">
                                   <strong>Search Customer:</strong>
                                    <select name="customer_id" id="due_customer_id" class="form-control" onchange="get_customers(this)">
                                        <option value=''>Please choose one...</option>
{{--                                            @foreach($customers_due as $due_customer)--}}
{{--                                                <option value="{{ $due_customer->id }}">{{ $due_customer->name}}</option>--}}
{{--                                            @endforeach--}}
                                    </select>
                                </div>
                                <div class="form-group">
                                    <strong>Customer Name:</strong>
                                    <input type="text" name="name" class="form-control" placeholder="Name" id="due_customer_name">
                                </div>

                                <div class="form-group">
                                    <strong>Phone:</strong>
                                    <input class="form-control" type="text" name="phone" placeholder="Phone" id="due_customer_phone">
                                </div>
                                <div class="form-group">
                                    <strong>Address:</strong>
                                    <textarea class="form-control" type="text" name="address" placeholder="Address" cols="20" rows="5" id="due_customer_address"></textarea>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_customer_modal">Add Customer</button>
                                <button type="button" class="btn btn-primary" id="submit_due">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal for Add User-->
                <div class="modal fade " id="add_customer_modal" tabindex="-1" aria-labelledby="CustomerModalLabel" aria-hidden="true">
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#customer_modal" onclick="add_new_customer()">Save changes</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
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

    <div class="row">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Products</strong>
                <select name="product_id" id="product_id" class="form-control" >
                    <option value=''>Please choose one...</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Units:</strong>
                <select name="unit_id" id="unit_id" class="form-control" onchange="get_available_stock_price()">
                    <option value=''>Please choose one...</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Price</strong>
                <input type="text" name="product_price" class="form-control" placeholder="Product Price" id="product_price" disabled>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
              <strong>Quantity</strong>
                <input type="text" name="quantity" class="form-control" placeholder="Quantity" id="quantity">
                  <p>Available Stock: <span id="available_stock"></span></p>
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Customers:</strong>
                <select name="customer_id" id="customer_id" class="form-control" >
                    <option value=''>Please choose one...</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <strong>Status:</strong>
                <select name="status" id="status_id" class="form-control" onchange="check_payment_status(this)">
                    <option value="0">Cash</option>
                    <option value="1">Due</option>
                </select>
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
                                    <li class="list-group-item">Paid Amount :<input class="form-control" type="number" id="paid_amount" onchange="bill_calculation()"></li>
                                    <li class="list-group-item">Return Amount : <span id="change_amount" ></span>  </li>
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

    <script>

       function get_available_stock_price(){
           // var product_id = id.value;
            // alert(value);

           $.ajax({
               url: "{{route('sales.available_stock_price_ajax')}}",
               type: "POST",
               data:{
                   _token:'{{ csrf_token() }}',
                   product_id: $('#product_id option:selected').val(),
                   unit_id: $('#unit_id option:selected').val(),
               },
               cache: false,
               dataType: 'json',
               success: function(dataResult){
                   console.log(dataResult);
                   var available_stock = dataResult.available_stock_ajax;
                   var selling_price = dataResult.product_price;
                   $('#available_stock').html(available_stock);
                   $('#product_price').val(selling_price);
               }
           });

       }

        function add_new_customer(){
            $.ajax({
                url: "{{route('sales.add_new_customer')}}",
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
           var paid_amount = $("#paid_amount").val();
           if (result_2 >= paid_amount){
               var change_amount = result_2 - paid_amount;
               $("#change_amount").text("Due -"+ change_amount);
               //     // alert("if condition");
           }else{
               change_amount = paid_amount - result_2;
               $("#change_amount").text(change_amount);
           }
       }

        function check_payment_status(selectObject){
            var value = selectObject.value;
            // console.log(value);
            if(value == 1){
                all_ajax_customers();
                $('#customer_modal').modal('show');
            }
        }

        $("button#submit_due").click(function() {
            var data = [];
            var product_id,quantity, product_price,unit_id,customer_id
            // return alert(payment_status);
            $("#myTable >tr").each(function(index) {
                product_id = $(this).find('.product_id').text();
                quantity = $(this).find('.quantity').text();
                product_price = $(this).find('.product_price').text();
                unit_id = $(this).find('.unit_id').text();
                customer_id = $("#due_customer_id").val();
                data.push({
                    product_id,
                    unit_id,
                    quantity,
                    product_price,
                    customer_id,
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
                submit_sales(data)
            }

        });

       $("button#submit").click(function() {
           var data = [];
           var product_id,quantity, product_price,unit_id
           // return alert(payment_status);
           $("#myTable >tr").each(function(index) {
               product_id = $(this).find('.product_id').text();
               unit_id = $(this).find('.unit_id').text();
               quantity = $(this).find('.quantity').text();
               product_price = $(this).find('.product_price').text();
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
               // return window.print();
               submit_sales(data)
           }

       });

        function get_customers(customer_due_id){
            var customer_id = customer_due_id.value;
            $.ajax({
                url: "{{route('sales.customer_details')}}",
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
                        $('#due_customer_name').val(row.name);
                        $('#due_customer_phone').val(row.phone);
                        $('#due_customer_address').val(row.address);
                    })
                }
            });
        }

        function all_ajax_customers(){
            $.ajax({
                url: "{{route('sales.ajax_all_customer')}}",
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
                        formoption += "<option value='" + val.id + "'>" + val.name + "</option>";
                    });
                    $('#due_customer_id').html(formoption);
                }
            });
        }

        function showmsg(){
            alert("New Order Created")
            // window.location.reload();
        }

        function submit_sales(data){
            // return console.log(data);
            // return console.log("percentage status_value:"+value)
            $.ajax({
                url: "{{route('sales.store')}}",
                type: "POST",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                {{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
                data: {
                    "_token": "{{ csrf_token() }}",
                    sale_order_details: data,
                    sale_order: {
                        customer_id: $("#customer_id").val(),
                        paid_amount: $("#paid_amount").val(),
                        billing_amount: $("#total_bill").val(),
                        extra_charge: $("#extra_charge").val(),
                        discount: $("#discount").val(),
                        status: $("#status_id").val(),
                    },
                    success: function (data) {
                        console.log(data)
                        showmsg()
                    }
                }
            })
        }
    </script>
@endsection

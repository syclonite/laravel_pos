@extends('backend.layout')

@section('content')

{{--    <div class="row">--}}
{{--        <div class="col-lg-6 margin-tb">--}}
{{--            <div class="pull-left">--}}
{{--                <h2>Purchase New Product</h2>--}}
{{--            </div>--}}
{{--            <div class="pull-right">--}}
{{--                <a class="btn btn-primary" href="{{route('purchase.index')}}"> Back</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div><br>--}}

{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <strong>Whoops!</strong> There were some problems with your input.<br><br>--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

{{--    <div class="row">--}}
{{--        <div class="col-xs-4 col-sm-4 col-md-4 mb-4">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Products</strong>--}}
{{--                <select name="product_id" id="product_id" class="form-control" >--}}
{{--                    <option value=''>Please choose one...</option>--}}
{{--                    @foreach($products as $product)--}}
{{--                        <option value="{{ $product->id }}">{{ $product->product_name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Units:</strong>--}}
{{--                <select name="unit_id" id="unit_id" class="form-control" >--}}
{{--                    <option value=''>Please choose one...</option>--}}
{{--                    @foreach($units as $unit)--}}
{{--                        <option value="{{ $unit->id }}">{{ $unit->unit_name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Quantity</strong>--}}
{{--                <input type="number" name="quantity" class="form-control" placeholder="Quantity" id="quantity">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Purchase Price</strong>--}}
{{--                <input type="number" name="purchase_price" class="form-control" placeholder="Purchase Price" id="purchase_price">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Sale Price</strong>--}}
{{--                <input type="number" name="sale_price" class="form-control" placeholder="Sale Price" id="selling_price">--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Suppliers:</strong>--}}
{{--                <select name="supplier_id" id="supplier_id" class="form-control" >--}}
{{--                    <option>Please choose one...</option>--}}
{{--                    @foreach($suppliers as $supplier)--}}
{{--                        <option value="{{ $supplier->id }}">{{ $supplier->supplier_name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="col-xs-4 col-sm-4 col-md-4">--}}
{{--            <div class="form-group">--}}
{{--                <strong>Status:</strong>--}}
{{--                <select name="status" id="status_id" class="form-control" onchange="check_payment_status(this)">--}}
{{--                    <option value="0">Cash</option>--}}
{{--                    <option value="1">Due</option>--}}
{{--                </select>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div><br><button type="button" class="btn btn-primary col-2 col-md-2 col-sm-2 savebtn" id="add_list" style="float:left">Add List</button></div>--}}

{{--        <div class="container">--}}
{{--            <br>--}}
{{--            <table id="myTable" class="table table-striped table-light table-bordered">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Serial No</th>--}}
{{--                    <th>Product Name</th>--}}
{{--                    <th>Unit</th>--}}
{{--                    <th>Quantity</th>--}}
{{--                    <th>Purchase Price</th>--}}
{{--                    <th>Subtotal</th>--}}
{{--                    <th>Selling Price</th>--}}
{{--                    <th>Action</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}

{{--                <tbody id="data">--}}

{{--                </tbody>--}}

{{--            </table>--}}
{{--            <br>--}}
{{--            <div>--}}
{{--                <div class="row">--}}
{{--                    <div class="offset-8 col-4">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <ul class="list-group">--}}
{{--                                    <li class="list-group-item">Discount :<input class="form-control" type="number" id="discount" name="discount" onchange="bill_calculation()"></li>--}}
{{--                                    <li class="list-group-item">Extra Charge :<input class="form-control" type="number" id="extra_charge" name="extra_charge" onchange="bill_calculation()"></li>--}}
{{--                                    <li class="list-group-item">Total Bill: <span  id="total_bill"></span></li>--}}
{{--                                    <li class="list-group-item">Paid Amount :<input class="form-control" type="number" id="paid_amount" onchange="bill_calculation()"></li>--}}
{{--                                    <li class="list-group-item">Change :<span id="change_amount"></span></li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xs-12 col-sm-12 col-md-12 text-center">--}}
{{--                    <br>--}}
{{--                    <button type="button" class="btn btn-primary col-2 col-md-2 col-sm-2 savebtn" id="submit" >Submit</button>--}}
{{--                    --}}{{----}}{{--                       <button type="button" class="btn btn-primary btn-lg"  >Submit</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <div class="container">--}}
{{--            <br>--}}
{{--            <table id="myTable" class="table table-bordered">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Product Name</th>--}}
{{--                    <th>Unit</th>--}}
{{--                    <th>Price</th>--}}
{{--                    <th>Quantity</th>--}}
{{--                    <th>Subtotal</th>--}}
{{--                    <th>Action</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}

{{--                <tbody>--}}
{{--                <tr>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                    <td></td>--}}
{{--                </tr>--}}
{{--                </tbody>--}}
{{--            </table>--}}

{{--            <br>--}}
{{--            <div>--}}
{{--                <div class="row">--}}
{{--                    <div class="offset-8 col-4">--}}
{{--                        <div class="card">--}}
{{--                            <div class="card-body">--}}
{{--                                <ul class="list-group">--}}
{{--                                    <li class="list-group-item">Discount :<input class="form-control" type="number" id="discount" name="discount" onchange="bill_calculation()"></li>--}}
{{--                                    <li class="list-group-item">Extra Charge :<input class="form-control" type="number" id="extra_charge" name="extra_charge" onchange="bill_calculation()"></li>--}}
{{--                                    <li class="list-group-item">Total Bill: <input class="form-control" type="number" id="total_bill" name="total_bill" disabled></li>--}}
{{--                                    <li class="list-group-item">Paid Amount :<input class="form-control" type="number" id="paid_amount" onchange="bill_calculation()"></li>--}}
{{--                                    <li class="list-group-item">Return Amount : <span id="change_amount" ></span>  </li>--}}
{{--                                </ul>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xs-12 col-sm-12 col-md-12 text-center">--}}
{{--                    <br>--}}
{{--                    <button type="button" class="btn btn-primary col-2 col-md-2 col-sm-2 savebtn" id="submit" >Submit</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <br>--}}
{{--    </div>--}}

{{--    <script>--}}
{{--        // function selling_amount_cal(){--}}
{{--        //     var quantity = $("#quantity").val();--}}
{{--        //     var purchase_price = $("#purchase_price").val();--}}
{{--        //     var result = (purchase_amount/quantity );--}}
{{--        //     $("#selling_price").val(result);--}}
{{--        // };--}}

{{--        $("#add_list").click(function() {--}}
{{--            // alert('hello');--}}
{{--            var product_id = $("#product_id").val();--}}
{{--            var product_text = $("#product_id option:selected").text();--}}
{{--            var purchase_price = $("#purchase_price").val();--}}
{{--            var quantity = $("#quantity").val();--}}
{{--            var unit_id = $("#unit_id").val();--}}
{{--            var unit_text = $("#unit_id option:selected").text();--}}
{{--            var selling_price = $("#selling_price").val();--}}
{{--            var subtotal = $("#purchase_price").val() * $("#quantity").val();--}}
{{--            // return console.log(expiry_date);--}}

{{--            var new_row = '<tr>' +--}}
{{--                '<td>' + ($('table tbody tr').length+1) + '</td>'+--}}
{{--                '<td class="product_id" style="display: none">' + product_id + '</td>' +--}}
{{--                '<td class="product_text">' + product_text + '</td>' +--}}
{{--                '<td class="unit_id" style="display: none">' + unit_id + '</td>' +--}}
{{--                '<td class="unit_text">' + unit_text + '</td>' +--}}
{{--                '<td class="quantity">' + quantity + '</td>' +--}}
{{--                '<td class="purchase_price">' + purchase_price + '</td>'+--}}
{{--                '<td class="subtotal">' + subtotal + '</td>'+--}}
{{--                '<td class="selling_price">' + selling_price + '</td>'+--}}
{{--                '<td><input type="button" value="Delete" onclick="bill_calculation(this)"/></td>' + '</tr>';--}}
{{--            $("table tbody").append(new_row);--}}
{{--            bill_calculation();--}}
{{--        });--}}
{{--        function bill_calculation(value){--}}
{{--            $(value).parent().parent().remove()--}}
{{--            var sum_subtotal_amount = 0--}}
{{--            $(".subtotal").each(function(){--}}
{{--                 sum_subtotal_amount += parseFloat($(this).text());--}}
{{--                $("#total_bill").text(sum_subtotal_amount)--}}
{{--            })--}}
{{--            var discount = $('#discount').val();--}}
{{--            // var extra_charge = $('#extra_charge').val();--}}
{{--            var total_bill = sum_subtotal_amount;--}}
{{--            if( discount != '' || extra_charge != ''){--}}
{{--               var result_1 = (total_bill - discount);--}}
{{--               var result_2 =  parseInt(result_1) + Number($('#extra_charge').val());--}}
{{--               // console.log(result_2);--}}
{{--                $("#total_bill").text(result_2);--}}
{{--            }--}}
{{--            var paid_amount = $("#paid_amount").val();--}}
{{--            if (result_2 >= paid_amount){--}}
{{--               var change_amount = result_2 - paid_amount;--}}
{{--                $("#change_amount").text(change_amount);--}}
{{--            //     // alert("if condition");--}}
{{--            }else{--}}
{{--                change_amount = paid_amount - result_2;--}}
{{--                $("#change_amount").text(change_amount);--}}
{{--            }--}}

{{--        }--}}
{{--        $("#submit").click(function() {--}}
{{--            var data = [];--}}
{{--            var product_id,quantity, purchase_price,selling_price,unit_id;--}}
{{--            // return alert(payment_status);--}}
{{--            $('#myTable > tbody > tr').each(function(index,tr) {--}}
{{--                console.log(index)--}}
{{--                console.log(tr)--}}
{{--                product_id = parseInt($(this).find('.product_id').text());--}}
{{--                quantity = parseInt($(this).find('.quantity').text());--}}
{{--                purchase_price = parseFloat($(this).find('.purchase_price').text());--}}
{{--                selling_price = parseFloat($(this).find('.selling_price').text());--}}
{{--                unit_id = parseInt($(this).find('.unit_id').text());--}}
{{--                data.push({--}}

{{--                    product_id,--}}
{{--                    unit_id,--}}
{{--                    quantity,--}}
{{--                    purchase_price,--}}
{{--                    selling_price,--}}
{{--                });--}}
{{--            });--}}
{{--            // return percentage_cal();--}}
{{--            // return console.log(data);--}}
{{--            if(data == ""){--}}
{{--                alert("Please Add list then try again ")--}}
{{--            }else{--}}
{{--                // percentage_cal(data)--}}
{{--                // submit_stock_order(data)--}}
{{--                submit_purchase(data)--}}
{{--            }--}}

{{--        });--}}

{{--        function showmsg(){--}}
{{--            alert("New Order Created")--}}
{{--            window.location.reload();--}}
{{--        }--}}

{{--        // function percentage_cal(data){--}}
{{--        //     var total_bill = $("#total_bill").text();--}}
{{--        //     var paid_amount = $("#paid_amount").val()--}}
{{--        //     var percentage = Math.round((paid_amount/ total_bill) * 100);--}}
{{--        //     // return alert(percentage);--}}
{{--        //     if(percentage > 50 && percentage < 100){--}}
{{--        //         payment_status_value = 2; //payment_status is partails_payment--}}
{{--        //     }else if (percentage >= 100){--}}
{{--        //         payment_status_value = 0 //payment_status is paid--}}
{{--        //     }else if(percentage < 50){--}}
{{--        //         payment_status_value = 1; //payment_status is due--}}
{{--        //     };--}}
{{--        //     payment_status_value;--}}
{{--        //     submit_stock_order(data,payment_status_value)--}}
{{--        // }--}}

{{--        function submit_purchase(data){--}}
{{--            // return console.log(data);--}}
{{--            // return console.log("percentage status_value:"+value)--}}
{{--            $.ajax({--}}
{{--                url: "{{route('purchase.store')}}",--}}
{{--                type: "POST",--}}
{{--                contentType: "application/x-www-form-urlencoded; charset=UTF-8",--}}
{{--                dataType: "json",--}}
{{--                --}}{{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
{{--                data: {--}}
{{--                    "_token": "{{ csrf_token() }}",--}}
{{--                    purchase_order_details: data,--}}
{{--                    purchase_order: {--}}
{{--                        supplier_id: $("#supplier_id").val(),--}}
{{--                        paid_amount: $("#paid_amount").val(),--}}
{{--                        billing_amount: parseFloat($("#total_bill").text()),--}}
{{--                        extra_charge: $("#extra_charge").val(),--}}
{{--                        discount: $("#discount").val(),--}}
{{--                    },--}}
{{--                    success: function (data) {--}}
{{--                        console.log(data)--}}
{{--                        // showmsg()--}}
{{--                    }--}}
{{--                }--}}
{{--            })--}}
{{--        }--}}
{{--        // Get Products Routes--}}
{{--        // function get_product(){--}}
{{--        //     $.ajax({--}}
{{--        //         url: "http://localhost:3000/stock_orders/get_product",--}}
{{--        //         type: "GET",--}}
{{--        //         // contentType: "application/json",--}}
{{--        //         contentType: "application/x-www-form-urlencoded; charset=UTF-8",--}}
{{--        //         dataType: "json",--}}
{{--        //         data: {--}}
{{--        //             category_id: $("#category_id").val()--}}
{{--        //         },--}}
{{--        //         success:function(result){--}}
{{--        //             console.log(result)--}}
{{--        //             $("#product_id").empty();--}}
{{--        //             $("#product_id").append('<option>Select Product</option>');--}}
{{--        //             for(var i = 0; i < result.length; i++) {--}}
{{--        //                 $("#product_id").append('<option value="' + result[i]["id"] + '">' + result[i]["product_name"] + '</option>');--}}
{{--        //             }--}}
{{--        //         }--}}
{{--        //     })--}}
{{--        // }--}}
{{--    </script>--}}
{{--    --}}

<div class="row">
    <div class="col-lg-6 margin-tb">
        <div class="pull-left">
            <h2>Purchase Product</h2>
        </div>
        <div class="pull-right">
            <a class="btn btn-primary" href="{{route('purchase.index')}}"> Back</a>
            <!-- Modal for Due Payment Supplier-->
            <div class="modal fade " id="supplier_modal" tabindex="-1" aria-labelledby="SupplierModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Supplier Details</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" >
                            <div class="form-group">
                                <strong>Search Supplier:</strong>
                                <select name="supplier_id" id="due_supplier_id" class="form-control" onchange="get_suppliers(this)">
                                    <option value=''>Please choose one...</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <strong>Supplier Name:</strong>
                                <input type="text" name="name" class="form-control" placeholder="Name" id="due_customer_name" required>
                            </div>

                            <div class="form-group">
                                <strong>Phone:</strong>
                                <input class="form-control" type="text" name="phone" placeholder="Phone" id="due_customer_phone" required>
                            </div>
                            <div class="form-group">
                                <strong>Address:</strong>
                                <textarea class="form-control" type="text" name="address" placeholder="Address" cols="20" rows="5" id="due_customer_address"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#add_supplier_modal">Add Supplier</button>
                            <button type="button" class="btn btn-primary" id="submit_due">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Add Supplier-->
            <div class="modal fade " id="add_supplier_modal" tabindex="-1" aria-labelledby="SupplierModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Supplier</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" >
                            <div class="form-group">
                                <strong>Supplier Name:</strong>
                                <input type="text" name="supplier_name" class="form-control" placeholder="Name" id="new_supplier_name"  required>
                            </div>

                            <div class="form-group">
                                <strong>Phone:</strong>
                                <input class="form-control" type="number" name="supplier_phone" placeholder="Phone" id="new_supplier_phone" required>
                            </div>
                            <div class="form-group">
                                <strong>Address:</strong>
                                <textarea class="form-control" type="text" name="supplier_address" placeholder="Address" id="new_supplier_address" cols="20" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#supplier_modal" onclick="add_new_supplier()">Save changes</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal for Add new Unit -->
            <div class="modal fade " id="add_unit_modal" tabindex="-1" aria-labelledby="UnitModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Unit</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" >
                            <div class="form-group">
                                <strong>Unit Name:</strong>
                                <input type="text" name="unit_name" class="form-control" placeholder="Name" id="new_unit_name" required>
                            </div>

                            <div class="form-group">
                                <strong>Unit Description:</strong>
                                <textarea class="form-control" type="text" name="unit_des" placeholder="Address" id="new_unit_description" cols="20" rows="5"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" onclick="add_new_unit()">Save</button>
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
        <div class="form-group row">
             <strong>Products</strong>
             <div class="col d-inline-flex">
                 <select name="product_id" id="product_id" class="form-control" >
                     <option value=''>Please choose one...</option>
                     @foreach($products as $product)
                         <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                     @endforeach
                 </select>
             </div>
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group row">
            <strong>Units:</strong>
            <div class="col d-inline-flex">
                <select name="unit_id" id="unit_id" class="form-control">
                    <option value=''>Please choose one...</option>
                    @foreach($units as $unit)
                        <option value="{{ $unit->id }}">{{ $unit->unit_name}}</option>
                    @endforeach
                </select>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_unit_modal">+</button>
            </div>

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
            <strong>Quantity</strong>
            <input type="text" name="quantity" class="form-control" placeholder="Quantity" id="quantity">
            <p>Available Stock: <span id="available_stock"></span></p>
        </div>
    </div>

    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group row">
            <strong>Suppliers:</strong>
              <div class="col d-inline-flex">
               <select name="supplier_id" id="supplier_id" class="form-control" >
                 <option value=''>Please choose one...</option>
                    @foreach($suppliers as $supplier)
                     <option value="{{ $supplier->id }}">{{ $supplier->supplier_name}}</option>
                    @endforeach
               </select>
                  <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_supplier_modal">+</button>
              </div>
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
                <th>Purchase Price</th>
                <th>Quantity</th>
                <th>Selling Price</th>
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
    function add_new_supplier(){
        $.ajax({
            url: "{{route('purchase.add_new_supplier')}}",
            type: "POST",
            data:{
                _token:'{{ csrf_token() }}',
                suppliers:{
                   supplier_name: $('#new_supplier_name').val(),
                   supplier_phone: $('#new_supplier_phone').val(),
                   supplier_address: $('#new_supplier_address').val(),
                },

            },
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                console.log(dataResult);
            }
        });
        all_ajax_supplier()
    }

    function all_ajax_supplier(){
        alert('Supplier Added');
        $('#add_supplier_modal').modal('hide');
        $.ajax({
            url: "{{route('purchase.ajax_all_supplier')}}",
            type: "POST",
            cache: false,
            dataType: 'json',
            data:{
                _token:'{{ csrf_token() }}',
                id: "pass",
            },
            success: function(dataResult){
                console.log(dataResult);
                var data = dataResult.supplier_data_ajax
                var formoption = "";
                $.each(data, function(v) {
                    var val = data[v]
                    formoption += "<option value='" + val.id + "'>" + val.supplier_name + "</option>";
                });
                $('#due_supplier_id').html(formoption);
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
        var purchase_price = $("#purchase_price").val();
        var selling_price = $("#selling_price").val();
        var quantity = $("#quantity").val();
        var unit_id = $("#unit_id").val();
        var unit_text = $("#unit_id option:selected").text();
        var subtotal = purchase_price * quantity;
        // return console.log(expiry_date);
        var new_row = '<tr>' +
            // '<td>' + ($('#myTable > tr').length + 1) + '</td>'+
            '<td class="product_id" style="display: none">' + product_id + '</td>' +
            '<td class="unit_id" style="display: none">' + unit_id + '</td>' +
            '<td class="product_text">' + product_text + '</td>' +
            '<td class="unit_text">' + unit_text + '</td>' +
            '<td class="purchase_price">' + purchase_price + '</td>'+
            '<td class="quantity">' + quantity + '</td>' +
            '<td class="selling_price">' + selling_price + '</td>' +
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
            all_ajax_supplier();
            $('#supplier_modal').modal('show');
        }
    }

    $("button#submit_due").click(function() {
        var data = [];
        var product_id,quantity, product_price,unit_id,supplier_id
        // return alert(payment_status);
        $("#myTable >tr").each(function(index) {
            product_id = $(this).find('.product_id').text();
            quantity = $(this).find('.quantity').text();
            product_price = $(this).find('.product_price').text();
            unit_id = $(this).find('.unit_id').text();
            supplier_id = $("#due_supplier_id").val();
            data.push({
                product_id,
                unit_id,
                quantity,
                product_price,
                supplier_id,
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
            submit_purchase(data)
        }

    });

    $("button#submit").click(function() {
        var data = [];
        var product_id,quantity, purchase_price,unit_id,selling_price
        // return alert(payment_status);
        $("#myTable >tr").each(function(index) {
            product_id = $(this).find('.product_id').text();
            unit_id = $(this).find('.unit_id').text();
            quantity = $(this).find('.quantity').text();
            purchase_price = $(this).find('.purchase_price').text();
            selling_price = $(this).find('.selling_price').text();
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
            // return window.print();
            submit_purchase(data)
        }

    });

    function get_suppliers(supplier_due_id){
        var supplier_id = supplier_due_id.value;
        $.ajax({
            url: "{{route('sales.customer_details')}}",
            type: "POST",
            data:{
                _token:'{{ csrf_token() }}',
                id: supplier_id,
            },
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                console.log(dataResult);
                var resultData = dataResult;
                // var bodyData = '';
                // var i=1;
                $.each(resultData,function(index,row){
                    $('#due_supplier_name').val(row.name);
                    $('#due_supplier_phone').val(row.phone);
                    $('#due_supplier_address').val(row.address);
                })
            }
        });
    }

    function showmsg(){
        alert("Supplier Order Created")
        // window.location.reload();
    }

    function submit_purchase(data){
        // return console.log(data);
        // return console.log("percentage status_value:"+value)
        $.ajax({
            url: "{{route('purchase.store')}}",
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

    function add_new_unit(){
        $.ajax({
            url: "{{route('purchase.add_new_unit')}}",
            type: "POST",
            data:{
                _token:'{{ csrf_token() }}',
                units:{
                    unit_name: $('#new_unit_name').val(),
                    unit_des: $('#new_unit_description').val(),
                },

            },
            cache: false,
            dataType: 'json',
            success: function(dataResult){
                console.log(dataResult);
            }
        });
        all_ajax_unit()
    }
    function all_ajax_unit(){
        alert('Unit Added')
        $('#add_unit_modal').modal('hide');
        $.ajax({
            url: "{{route('purchase.get_units_all_ajax')}}",
            type: "POST",
            cache: false,
            dataType: 'json',
            data:{
                _token:'{{ csrf_token() }}',
                id: "pass",
            },
            success: function(dataResult){
                console.log(dataResult);
                var data = dataResult.units_data_ajax
                var formoption = "";
                $.each(data, function(v) {
                    var val = data[v]
                    formoption += "<option value='" + val.id + "'>" + val.unit_name + "</option>";
                });
                $('#unit_id').html(formoption);
            }
        });
    }
</script>



@endsection

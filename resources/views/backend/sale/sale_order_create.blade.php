@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Sale New Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('sales.index')}}"> Back</a>
                <a class="btn btn-primary" href="#" onclick="generatePDF()"> PDF</a>
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
                <strong>Price</strong>
                <input type="text" name="product_price" class="form-control" placeholder="Product Price" id="product_price">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
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
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Quantity</strong>
                <input type="text" name="quantity" class="form-control" placeholder="Quantity" id="quantity">
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
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
                    <th>Customer</th>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Unit</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
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
                                    <li class="list-group-item">Return Amount :<span id="change_amount"></span></li>
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
    {{--    </form>--}}
    <script src="https://unpkg.com/jspdf-invoice-template@1.4.0/dist/index.js"></script>
    <script>
        function generatePDF() {
            var myTableArray = [];
            $("#myTable tbody tr").each(function() {
                var arrayOfThisRow = [];
                var removal_from_index = [0,1,3,6,10];
                var tableData = $(this).find('td');
                if (tableData.length > 0) {
                    tableData.each(function() { arrayOfThisRow.push($(this).text());});
                    for (var i = removal_from_index.length -1; i >= 0; i--)
                        arrayOfThisRow.splice(removal_from_index[i],1);
                    myTableArray.push(arrayOfThisRow);
                }
            });
            console.log(myTableArray);
            var props = {
                outputType: jsPDFInvoiceTemplate.OutputType.Save,
                returnJsPDFDocObject: true,
                fileName: "Invoice#{{$sale_order_bill_no + 1}}",
                orientationLandscape: false,
                printable: true,
                compress: true,
                logo: {
                    src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/logo.png",
                    type: 'PNG', //optional, when src= data:uri (nodejs case)
                    width: 53.33, //aspect ratio = width/height
                    height: 26.66,
                    margin: {
                        top: 0, //negative or positive num, from the current position
                        left: 0 //negative or positive num, from the current position
                    }
                },
                stamp: {
                    inAllPages: true, //by default = false, just in the last page
                    src: "https://raw.githubusercontent.com/edisonneza/jspdf-invoice-template/demo/images/qr_code.jpg",
                    type: 'JPG', //optional, when src= data:uri (nodejs case)
                    width: 20, //aspect ratio = width/height
                    height: 20,
                    margin: {
                        top: 0, //negative or positive num, from the current position
                        left: 0 //negative or positive num, from the current position
                    }
                },
                business: {
                    name: "Nawshad Enterprise",
                    address: "Albania, Tirane ish-Dogana, Durres 2001",
                    phone: "(+355) 069 11 11 111",
                    email: "email@example.com",
                    email_1: "info@example.al",
                    website: "www.example.al",
                },
                contact: {
                    label: "Invoice issued for:",
                    name: "Client Name",
                    address: "Albania, Tirane, Astir",
                    phone: "(+355) 069 22 22 222",
                    email: "client@website.al",
                    otherInfo: $("#total_bill").text(),
                },
                invoice: {
                    label: "Invoice #:",
                    num:  {{$sale_order_bill_no + 1 }},
                    // invDate: "Payment Date: 01/01/2021 18:12",
                    // invGenDate: "Invoice Date: 02/02/2021 10:17",
                    headerBorder: true,
                    tableBodyBorder: false,
                    header: [
                        {
                            title: "#",
                            style: {
                                width: 5
                            }
                        },
                        { title: "Customer"},
                        { title: "Product"},
                        { title: "Price"},
                        { title: "Unit"},
                        { title: "Quantity"},
                        { title: "Subtotal"},
                    ],

                    table: Array.from(myTableArray, (item, index)=>([
                        index + 1,
                        item[0],
                        item[1],
                        item[2],
                        item[3],
                        item[4],
                        item[5],
                    ])),
                    invDescLabel: "Invoice Note",
                    invDesc: "There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary.",
                },
                footer: {
                    text: "The invoice is created on a computer and is valid without the signature and stamp.",
                },
                pageEnable: true,
                pageLabel: "Page ",
            };

            var pdfObject = jsPDFInvoiceTemplate.default(props);
            console.log(pdfObject);

        }

        $("button#add_list").click(function() {
            // alert('hello');
            var product_id = $("#product_id").val();
            var product_text = $("#product_id option:selected").text();
            var product_price = $("#product_price").val();
            var quantity = $("#quantity").val();
            var unit_id = $("#unit_id").val();
            var unit_text = $("#unit_id option:selected").text();
            var customer_id = $("#customer_id").val();
            var customer_text = $("#customer_id option:selected").text();
            var subtotal = $("#product_price").val() * $("#quantity").val();
            // return console.log(expiry_date);

            var new_row = '<tr><td>' + ($('table tbody tr').length + 1) + '</td>'+
                '<td class="customer_id" style="display: none">' + customer_id + '</td>' +
                '<td class="customer_text">' + customer_text + '</td>' +
                '<td class="product_id" style="display: none">' + product_id + '</td>' +
                '<td class="product_text">' + product_text + '</td>' +
                '<td class="product_price">' + product_price + '</td>'+
                '<td class="unit_id" style="display: none">' + unit_id + '</td>' +
                '<td class="unit_text">' + unit_text + '</td>' +
                '<td class="quantity">' + quantity + '</td>' +
                '<td class="subtotal">' + subtotal + '</td>' +
                '<td><input type="button" value="Delete" onclick="bill_calculation(this)"/></td></tr>';
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

        $("button#submit").click(function() {
            var data = [];
            var product_id,quantity, product_price,unit_id;
            // return alert(payment_status);
            $("#myTable > tbody >tr").each(function(index) {
                product_id = parseInt($(this).find('.product_id').text());
                quantity = parseInt($(this).find('.quantity').text());
                product_price = parseFloat($(this).find('.product_price').text());
                unit_id = parseInt($(this).find('.unit_id').text());
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
                submit_purchase(data)
            }

        });

        function showmsg(){
            alert("New Order Created")
            window.location.reload();
        }

        function submit_purchase(data){
            // return console.log(data);
            // return console.log("percentage status_value:"+value)
            $.ajax({
                url: "http://localhost:8000/sales",
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
    </script>
@endsection

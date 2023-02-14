@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Add New Expense</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{route('expense_record.index')}}"> Back</a>
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
                <strong>Expense Category Name</strong>
                <select name="expense_category_id" id="expense_category_id" class="form-control" >
                    <option value=''>Please choose one...</option>
                    @foreach($expense_category as $value)
                        <option value="{{ $value->id }}">{{ $value->expense_category_name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Amount</strong>
                <input type="number" name="amount" class="form-control" placeholder="Amount" id="amount">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Remarks</strong>
                <input type="text" name="remarks" class="form-control" placeholder="Remarks" id="remarks">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Bill Type</strong>
                <select name="type" id="type" class="form-control" >
                    <option value="1">General</option>
                    <option value="0">Important</option>
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Status</strong>
                <select name="type" id="status" class="form-control" >
                    <option value="1">Enable</option>
                    <option value="0">Disable</option>
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
                    <th>Expense Category</th>
                    <th>Amount</th>
                    <th>Status</th>
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
                                    <li class="list-group-item">Total Bill: <span  id="total_bill"></span></li>
                                    <li class="list-group-item">Paid Amount :<input class="form-control" type="number" id="paid_amount" onchange="bill_calculation()"></li>
                                    <li class="list-group-item">Return Amount :<span id="return_amount"></span></li>
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

    <script src="{{url('js/jquery.min.js')}}"></script>
    <script>

        $("button#add_list").click(function() {
            // alert('hello');
            var expense_category_id = $("#expense_category_id").val();
            var expense_category_text = $("#expense_category_id option:selected").text();
            var amount = $("#amount").val();
            var status = $("#status").val();
            // return console.log(expiry_date);

            var new_row = '<tr><td>' + ($('table tbody tr').length+1) + '</td>'+
                '<td class="expense_category_id" style="display: none">' + expense_category_id + '</td>' +
                '<td class="expense_category_text">' + expense_category_text + '</td>' +
                '<td class="amount" >' + amount + '</td>' +
                '<td class="status">' + status + '</td>' +
                '<td><input type="button" value="Delete" onclick="bill_calculation(this)"/></td></tr>';
            $("table tbody").append(new_row);
            bill_calculation();
        });
        function bill_calculation(value){
            $(value).parent().parent().remove()
            var sum_purchase_amount = 0
            $(".amount").each(function(){
                sum_purchase_amount += parseFloat($(this).text());
                console.log(sum_purchase_amount);
                $("#total_bill").text(sum_purchase_amount)
            })
        }

        $("button#submit").click(function() {
            var data = [];
            var expense_category_id,amount, status;
            // return alert(payment_status);
            $("table tbody tr").each(function(index) {
                expense_category_id = parseInt($(this).find('.expense_category_id').text());
                amount = parseInt($(this).find('.amount').text());
                status = parseFloat($(this).find('.status').text());
                data.push({
                    expense_category_id,
                    amount,
                    status,
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

        function submit_purchase(data){
            // return console.log(data);
            // return console.log("percentage status_value:"+value)
            $.ajax({
                url: "{{route('expense_record.store')}}",
                type: "POST",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                {{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
                data: {
                    "_token": "{{ csrf_token() }}",
                    expense_record_details: data,
                    expense_record: {
                        type: $("#type").val(),
                        billing_amount: parseFloat($("#total_bill").text()),
                        remarks: $("#remarks").val(),
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

@extends('backend.layout')

@section('content')

    <div class="row">
        <div class="col-lg-6 margin-tb">
            <div class="pull-left">
                <h2>Update Expense Record</h2>
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
    {{--@dd($purchase_order->id)--}}
    {{--    <form action="{{route('purchase.store')}}" method="POST" enctype="multipart/form-data">--}}
    {{--        @csrf--}}
    <div class="row">
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Bill No:</strong>
                <input type="text" name="" class="form-control" id="bill_no" value="{{$expense_record->id}}"  >
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Amount:</strong>
                <input id="expense_record_amount" class="form-control" type="number" name="amount" value="{{$expense_record->amount}}" >
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Remarks:</strong>
                <input class="form-control" type="text" name="remarks" id="remarks"  value="{{$expense_record->remarks}}">
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Type:</strong>
                <select name="type" id="type" class="form-control" >
                    <option value='0' {{ $expense_record->type == '0' ? 'selected':'' }}>Important</option>
                    <option value='1' {{ $expense_record->type == '1' ? 'selected':'' }}>General</option>
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <strong>Status:</strong>
                <select name="status" id="status" class="form-control" >
                    <option value='0' {{ $expense_record->status == '0' ? 'selected':'' }}>Disabled</option>
                    <option value='1' {{ $expense_record->status == '1' ? 'selected':'' }}>Enabled</option>
                </select>
            </div>
        </div>
    </div><br>
    <table id="myTable" class="table table-striped table-light table-bordered">
        <thead>
        <tr>
            <th>Serial No.</th>
            <th>Expense Category Name</th>
            <th>Amount</th>
            <th>Status </th>
        </tr>
        </thead>
        <tbody id="data">
        @foreach( $expense_record_details as $expense_record_detail)
            <tr>
                <td>{{++$i}}</td>
                <td>
                    <select name="expense_category_id" id="expense_category_id" class="form-control expense_category_id" >
                        @foreach($expense_categories as $category)
                            <option value="{{ $category->id }}"{{ $category->id == $expense_record_detail->expense_category_id ? 'selected' : '' }}>{{ $category->expense_category_name}}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <input id="amount" class="form-control" type="text" name="amount"  value="{{$expense_record_detail->amount}}">
                </td>
                <td>
                    <select name="expense_record_status" id="expense_record_status" class="form-control" >
                        <option value='0' {{ $expense_record_detail->status == '0' ? 'selected':'' }}>Disabled</option>
                        <option value='1' {{ $expense_record_detail->status == '1' ? 'selected':'' }}>Enabled</option>
                    </select>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <button type="button" class="btn btn-primary col-2 col-md-2 col-sm-2 savebtn" id="submit" >Update</button>
    {{--    </form>--}}

    <script src="{{url('js/jquery.min.js')}}"></script>
    <script>
        $("button#submit").click(function() {
            // alert('hello');
            var data = [];
            var expense_category_id,amount, status;
            // return alert(payment_status);
            $("table > tbody  > tr").each(function(index, tr) {
                expense_category_id = parseInt($(this).find('#expense_category_id').val());
                amount = parseInt($(this).find('#amount').val());
                status = parseInt($(this).find('#expense_record_status').val());
                // console.log(index);
                // console.log(tr);
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
            alert("Order Updated")
            window.location.reload();
        }

        function submit_purchase(data){
            // return console.log(data);
            // return console.log("percentage status_value:"+value)
            $.ajax({
                url: "{{route('expense_record.update',$expense_record->id)}}",
                type: "PUT",
                contentType: "application/x-www-form-urlencoded; charset=UTF-8",
                dataType: "json",
                {{--data:{"_token": "{{ csrf_token() }}","postal":data},--}}
                data: {
                    "_token": "{{ csrf_token() }}",
                    expense_record_details: data,
                    expense_record: {
                        type: $("#type").val(),
                        status: $("#status").val(),
                        billing_amount: $("#expense_record_amount").val(),
                        remarks: $("#remarks").val(),
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

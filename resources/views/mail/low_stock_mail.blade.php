<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tumass Tech Management</title>
</head>
<body>
<h1>Hello</h1>
<p>Current Stock</p>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Unit</th>
            <th>Quantity</th>
        </tr>
    </thead>
    <tbody>
    @foreach($data as $d)
        <tr>
            <td>{{$d->product_name}}</td>
            <td>{{$d->unit_name}}</td>
            <td>{{$d->total_quantity}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
<p>Thank you</p>
</body>
</html>

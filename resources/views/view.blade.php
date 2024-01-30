<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Invoice</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>From:</h5>
                            <address>
                                ABC Company <br>
                                123 Main Street<br>
                                Ahmedabad<br>
                                Email: admin@admin.com
                            </address>
                        </div>
                        <div class="col-md-6 text-right">
                            <h5>To:</h5>
                            <address>
                                {{$sales->customer_name}}<br>
                                123 Main Street<br>
                                Ahmedabad<br>
                                Email: customer@customer.com
                            </address>
                        </div>
                    </div>
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales->saleItems as $key=>$value)
                                    <tr>
                                        <td>{{$value->product->name}}</td>
                                        <td>{{$value->qty}}</td>
                                        <td>${{$value->total}}</td>
                                        <td>${{ number_format($value->total * $value->qty,2)}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="3" class="text-right">Subtotal</td>
                                    <td>${{ $sales->total}}</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">CGST</td>
                                    <td>{{$sales->cgst}}%</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right">SGST</td>
                                    <td>{{$sales->sgst}}%</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-right"><strong>Total</strong></td>
                                    <td><strong>${{$sales->grand_total}}</strong></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="card-footer text-muted text-right">
                    Invoice Date: {{$sales->created_at}} <br>
                    <a href="{{route('sale.list')}}" class="btn btn-secondary btn-sm">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>

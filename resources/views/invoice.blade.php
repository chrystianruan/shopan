<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nota fiscal</title>
    <link rel="stylesheet" type="text/css" href="/css/invoice.css">
</head>
<style>
.bordered {
    border: 1px solid black;
    padding: 10px;
    margin: 15px 5px;
}

table, td, th {
  border: 1px solid;
}

table {
  width: 100%;
  border-collapse: collapse;
}

th {
    padding: 1px 10px;
}


</style>
<body>
    <div class="container">
        <div class="bordered">
            <p>SHOPAN Tecnologies</p>
            <p></p>
        </div>
        <div class="bordered">
            <h4>Produtos:</h4>
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Quantidade</th>
                        <th>Preço unitário (R$)</th>
                        <th>Preço total (R$)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invoice->products_quantity as $product)
                    <tr>
                        <td> <ul> <li>{{ $product['product_name']}}</li></ul></td>
                        <td style="text-align: center"> {{ $product['quantity']}} </td>
                        <td  style="text-align: center"> R$ {{ number_format($product['price'], 2, ",", ".") }} </td>
                        <td  style="text-align: center"> R$ {{ number_format($product['price'] * $product['quantity'], 2, ",", ".") }} </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="bordered">
            <p>Subtotal: R$ @if($invoice->payment_id == 1) {{ number_format($invoice->total_value * 100 / 98, 2, ",", "." ) }} @elseif($invoice->payment_id == 2) {{  number_format($invoice->total_value * 100 / 95, 2, ",", "." ) }} @else {{ number_format($invoice->total_value, 2, ",", ".") }} @endif</p>
            <p>Desconto: R$ @if($invoice->payment_id == 1) {{ number_format(($invoice->total_value * 100 / 98) * 2/100, 2, ",", ".") }} @elseif($invoice->payment_id == 2) {{ number_format(($invoice->total_value * 100 / 95) * 5/100, 2, ",", ".") }}@else 0,00 @endif</p>
            <hr>
            <p>Valor total da NF: R$ {{ number_format($invoice->total_value, 2, ",", ".") }}</p>
            <p></p>
        </div>
        <div class="bordered">
            <p>  <img src="barcodeimage.php?code=CODE39EXTENDED&
                text=Hello%20World!&showtext=1&rotate=90& 
                backcolor=002288&forecolor=12345&width=250&
                height=430&borderwidth=50&borderheight=25"></p>
            <p></p>
        </div>
    </div>
    
</body>
</html>
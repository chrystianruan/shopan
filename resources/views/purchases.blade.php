@extends('layouts.navbar',  ['categories' => App\Models\Category::all()])
@section('content')
<link rel="stylesheet" type="text/css" href="/css/purchases.css">


<div class="container">
    @foreach($purchases as $p)
   <div class="items">
        <h3>{{date('d/m/Y', strtotime($p->created_at)) }} às {{ date('H:i:s', strtotime($p->created_at)) }}: ({{ $p->name }}) <span style="color: #272727;float:right">Cód.: #{{ $p->id }}</span> </h3>
        <hr>
        <div class="items-products-infos">
            <div class="products-quantity">
                <ul>
                    @foreach($p->products_quantity as $prod) 
                    <li> <img width=40 src="{{ url('storage/'.$prod['product_image']) }}">{{ mb_strimwidth($prod['product_name'], 0,55, "...")}} <span style="color: blue;font-weight:bolder">( {{ $prod['quantity'] }} unid.)</span></li> 
                    @endforeach
                </ul>
            </div>
            <div class="infos-purchased">
                <h3>Valor Total @if($p->payment_id == 2)(5% desc.)@elseif($p->payment_id == 1)(2% desc.) @endif: R$ {{ number_format($p->total_value, 2, ",", ".") }} @if($p->installments) ({{$p->installments}}x de R$ {{number_format($p->total_value / $p->installments, 2, ",", ".")}}) @endif </h3>
                <p>@if(strtotime(date('Y-m-d H:i:s')) - strtotime($p->created_at) >= 120) <span style="font-weight: bolder;color: green">Compra aprovada!</span> @else Compra pendente (aguarde 2 min)... @endif</p>
                <a href="/invoice/{{ $p->id }}">Ver nota fiscal</a>
                @if($p->payment_id == 1)<a href="/nota">Ver boleto</a>@endif
            </div>
        </div>
       
   </div>

   @endforeach
    <div class="links-center">
        {{$purchases->links()}}
    </div>
</div>

@endsection
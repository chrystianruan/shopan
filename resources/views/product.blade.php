@extends('layouts.navbar',  ['categories' => App\Models\Category::all()])
@section('content')
<link rel="stylesheet" type="text/css" href="/css/product.css">
<div class="main">
    <div class="container">
        <div class="div-image">
            <img src="{{ url('storage/'.$product->image) }}" alt="" class="img-product">
        </div>
        <div class="div-features-product">
            <p class="title" id="product-name">{{$product->name}}</p>
            <div class="infos-price">
                <p class="price">R$ {{ number_format($product->price, 2, ',', '.') }}</p>
                <p class="installments">Ou até 10x de R$ {{ number_format($product->price/10, 2, ',', '.') }}</p>
            </div>
            <form action="/add-product/cart" method="POST">
                @csrf
                <div class="btns-purchase">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <button class="btn-buy"><i style="font-size: 1.6em" class="bx bxs-cart"></i></button>

                    <i style="font-size: 2em; margin: 10px; cursor: pointer" id="favorite" class="bx bx-heart"></i>
                </div>
            </form>
        </div>
    </div>

    <div class="description">
        <h4>Descrição</h4>
        <hr>
        <p> {{ $product->description }}</p>
    </div>

</div>
<script>
    let favorite = document.getElementById("favorite");

    favorite.addEventListener("click", function() {
        if (favorite.className == "bx bx-heart") {
            favorite.className = "bx bxs-heart";
        } else {
            favorite.className = "bx bx-heart"
        }
    });
</script>
@endsection
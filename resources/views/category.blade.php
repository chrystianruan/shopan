@extends('layouts.navbar',  ['categories' => App\Models\Category::all()])
@section('content')
<link rel="stylesheet" type="text/css" href="/css/category.css">
<div class="principal">
    <div class="category">
            <h3>{{ $categoryName->name }}</h3>
    </div>
   
    <div class="container">
       
        @foreach($products as $prod)
        <a class="product-link" href="/product/{{ $prod->id }}={{ str_replace(" ", "-", mb_strimwidth(strtolower($prod->name), 0, 45)) }}">
        <div class="card">
            <img style="width: 220px; height: 190px" class="image" src="{{ url('storage/'.$prod -> image) }}">
            <div class="title">
                <h4 class="h4-title">{{ mb_strimwidth($prod->name, 0, 45, "...") }}</h4>
                <p class="p-title">{{ $prod->category->name }}</p>
            </div>

            <div class="price">
                <h3> R$ {{ number_format($prod->price, 2, ',','.') }}</h3>
                <p>Ou 10x de R$ {{ number_format($prod->price / 10, 2, ',','.') }}</p>
            </div>
            @if(Auth::check())
            <form action="/add/cart" method="POST">
                @csrf
            <div @if($productsOnCart->contains('product_id', $prod->id) == false) class="buy" @endif>
               
                    
                    <input type="hidden" name="product_id" value="{{ $prod -> id }}">
                    @if($productsOnCart->contains('product_id', $prod->id)) <p class="added">Adicionado ao carrinho</p> @else <button class="btnBuy"type="submit" > Adicionar ao <i class="bx bxs-cart"></i></button> @endif 
             
            </div>
        </form>
            @else
            <a href="/login">
                <div class="buy">
                <button class="btnBuy"> Adicionar ao <i class="bx bxs-cart"></i></button>
                </div>
            </a>
            @endif
        </div>
    </a>
        @endforeach
    </div>

</div>
@endsection
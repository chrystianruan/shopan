@extends('layouts.navbar',  ['categories' => App\Models\Category::all()])
@section('content')

<link rel="stylesheet" type="text/css" href="/css/cart.css">
<div class="container">
    @if(Auth::check())
        @if($productsOnCart->count() <= 0)

        <div class="empty">
            <i class="bx bxs-cart"></i>
            <h2>Nenhum item no carrinho :( </h2>
        </div>  

        @else
          @if(session('invalid-quantity'))
                    <p id="invalid" class="invalid-quantity"> <i class="bx bx-error-alt"></i> {{session('invalid-quantity')}}</p>
                 @endif
        <div class="items-purchase">
            <div class="items">
                @foreach($productsOnCart as $ponc)
                <div class="product">
                    <img style="margin: 5px;" width=100 height=100 src="{{ url('storage/'.$ponc -> image) }}">
                    <div class="product-description">
                        <div class="name-and-trash">
                            <h3> {{ mb_strimwidth($ponc -> name , 0, 40, "...") }} <span style="color: #272727; font-size: 14px">(R$ {{ number_format($ponc -> price, 2, ',', '.') }})</span> </h3>
                            <div>
                                <form action="/cart/{{ $ponc->cart_id }}" method="POST"> @csrf @method('DELETE') <button> <i class="bx bx-trash"></i></button> </form>
                            </div>
                        </div>
                        <p class="small-description">Ref.: {{$ponc->id}}</p>
                        <p>@foreach($categories as $c) @if($c->id == $ponc->category_id) {{$c->name}} @endif @endforeach </p>
                        <div class="purchase">
                            <div class="amount">
                                <h5>Quantidade: </h5>
                                <form action="/cart/{{ $ponc->cart_id }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button class="minus" name="minus" value="1"> 
                                        <i class="bx bx-minus-circle"></i>
                                    </button>
                                        <p class="number-amount">{{ $ponc->quantity}}</p>
                                    <button  class="plus" value="1" name="plus">
                                        <i class="bx bx-plus-circle"></i>
                                    </button>
                                </form>
                     
                            </div>
                            <div class="number-price">
                                <h5>Total: <span style="color: red; font-size: 16px">R$ {{ number_format($ponc->price * $ponc->quantity, 2, ',', '.') }}</span></h5>
    
                            </div>
                          
                        </div>
                    </div>

                </div>
                @endforeach
            </div>
          

            <div class="container-purchase">

                <h2>Total: R$ {{ number_format($productsOnCart -> sum('total_value'), 2, ',', '.') }}</h2>
                <hr>
                <ul>
                <li>R$ {{ number_format($productsOnCart -> sum('total_value'), 2, ',', '.') }} em 1x no cartão (ou até 10x de R$ {{ number_format($productsOnCart -> sum('total_value') / 10, 2, ",", ".")}} sem juros)</li>
                <li>R$ {{ number_format($productsOnCart -> sum('total_value') - ($productsOnCart -> sum('total_value')* 2/100), 2, ',', '.') }} no boleto bancário (2% de desconto)</li>
                <li>R$ {{ number_format($productsOnCart -> sum('total_value') - ($productsOnCart -> sum('total_value')* 5/100), 2, ',', '.') }} no PIX (5% de desconto)</li>
                </ul>
                
                <div class="buy">
                    <button id="myBtn">Comprar</button>
                </div>
              
            </div>
         
    </div>

    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
          <span class="close">&times;</span>
          <h3>Selecione a forma de pagamento: </h3>
          <form action="/add/purchase" method="POST"> 
            @csrf
            <div class="radios">
        
                @foreach($payments as $p)
                <div class="inputs-radio">
                    <input type="radio" class="type" id="radio-{{ $p->id }}"required name="payment" value="{{ $p->id }}">
                    <label> @if($p->id != 2)<i @if($p->id == 3) class="bx bx-credit-card" @else class="bx bx-barcode" @endif"></i>{{ $p->name }}@else <img width="120" src="/images/logo_pix.png">@endif </label>
                </div>
                @endforeach
            
            </div>

            <div class="infos-card">
                <div class="inputs-card">

                    <div class="icard">
                        <label>N° do cartão</label>
                        <input type="number" class="infos">
                    </div>

                    <div class="icard">
                        <label>CVV</label>
                        <input type="number" class="infos">
                    </div>

                    <div class="icard">
                        <label>Validade</label>
                        <input type="number" class="infos">  
                    </div>
                    <div class="icard">
                        <label>Parcelas</label>
                        <select class="infos" name="installments">
                            <option selected value="" disabled>Selecionar</option>
                            @for ($i = 10; $i >= 1; $i--)
                            <option value="{{ $i }}"> {{$i}}x de R$ {{ number_format($productsOnCart -> sum('total_value') / $i, 2, ',', '.') }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

  
  
            </div>
            <div id="button-confirm" class="button-purchase">
                <button class="btn-confirm">Confirmar compra</button>
            </div>
           
            </form>
        </div>
      
      </div>

    <div class="recommendations">
        <h3>Talvez você tenha interesse...</h3>
        <div class="cards">
        @foreach($productsRecommended as $prod)
        <div class="card-recommendations">
            <div class="card">
            <img style="margin: 10px;" width=70 height=70 src="{{url('storage/'.$prod->image)}}">
                <div class="card-description">
                    <p>{{mb_strimwidth($prod->name, 0, 20, "...")}}</p>
                    <p class="small-description">@foreach($categories as $c) @if($c->id == $ponc->category_id) {{ $c->name }} @endif @endforeach </p>
                    <p style="font-weight: bolder">R$ {{ number_format($prod->price, 2, ',', '.') }}</p>
                    <p class="small-description">ou 10x de R$ {{ number_format($prod->price/10, 2, ',', '.') }}</p>
                </div>
            </div>

                <div class="buy" style="margin: 5%">
                    <form action="/add/cart" method="POST">
                        @csrf
     
                        <input type="hidden" name="product_id" value="{{ $prod -> id }}">
                        <button><i class="bx bxs-cart"></i></button>
                    </form>
                </div>                 

        </div>

       
    
        @endforeach
       
    </div>
    </div>
        @endif

    @else 

    <div class="empty">
        <i class="bx bxs-cart"></i>
        <h2>Opa! Parece que você ainda não fez login na Shopan, faça <a href="/login">login</a> (ou <a href="/register">cadastra-se</a>) agora mesmo.</h2>
    </div>  


    @endif
    <script src="/js/cart.js"></script>
</div>
@endsection
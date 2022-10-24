<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
   <!-- <title> Responsive Drop Down Navigation Menu | CodingLab </title>-->
    <link rel="stylesheet" href="/css/navbar.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>

<body>
  <nav class="nav-navbar">
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="logo"><a href="/"><img src="/images/logoGeral.png" width="110"></a></div>
      <div class="nav-links">
        <div class="sidebar-logo">
          <span class="logo-name"><img src="/images/logoGeral.png" width="100"></span>
          <i class='bx bx-x' ></i>
        </div>
        <ul class="links">

         <li><a href="/">INÍCIO</a></li>
        
          <li>
            <a href="#">CATEGORIAS</a>
            <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
           
            <ul class="htmlCss-sub-menu sub-menu">
             
                  @foreach($categories as $category)
                  <li><a href="/category/{{$category->id}}?{{str_replace(" ", "-", strtolower($category->name))}}">{{ $category->name }}</a></li>
                  @endforeach
      
            </ul>
        
          </li>
          <li><a href="/about">SOBRE</a></li>
          @if(Auth::check())
          <li>
            <a href="#" id="name"></a>
            <i class='bx bxs-chevron-down js-arrow arrow'></i>
            <ul class="js-sub-menu sub-menu" >
              @if(auth()->user()->role_id === 1)<li><a href="/admin/new/product" style="color: blue">Admin</a></li>@endif
              <li><a class="user-sub" href="#">Meus dados</a></li>
              <li><a class="user-sub" href="/purchases">Minhas compras</a></li>
              <li><form action="/logout" method="POST">@csrf <button style="background: none; border: none; cursor:pointer; color: red; font-weight: bold" type="submit" class="user-sub"> <i class="bx bxs-exit"> </i> SAIR </button></li></form>
            </ul>
          </li>
          @else
          <li><a href="/login" style="color: rgb(135, 12, 235)">FAZER LOGIN/CADASTRO</a></li>
          @endif
        
        </ul>
      </div>

      <div class="search-box">
        <a href="/cart"><i class='bx bxs-cart'></i></a>
        @if(Auth::check())<span class="counter-products-cart">{{ $productsOnCart->sum('quantity') }}</span> @endif 
      </div>

      <div class="search-box">
        <i class='bx bx-search'></i>
        <div class="input-box">
          <form action="/search" id="form-search" method="GET">
            @csrf
            <input name="search" type="text" id="input-search" placeholder="Pesquisar produtos...">
          </form>
        </div>
      </div>
    </div>
  </nav> 
  <div class="main">
   @yield('content')
  </div>
   <script src="/js/navbar.js"></script>
   @if(Auth::check())
   <script>
    var name = '{{auth()->user()->name}}';
    var firstName = name.split(' ')[0];

    document.getElementById("name").textContent = "@" + firstName;


   </script>
   @endif
</body>
</html>

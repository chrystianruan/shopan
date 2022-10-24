<!DOCTYPE html>
<!-- Created By CodingNepal - www.codingnepalweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
   <!-- <title> Responsive Drop Down Navigation Menu | CodingLab </title>-->
    <link rel="stylesheet" href="/css/navbar2.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
  <nav>
    <div class="navbar">
      <i class='bx bx-menu'></i>
      <div class="logo"><a href="/"><img src="/images/logo2.png" width="110"></a></div>
      <div class="nav-links">
        <div class="sidebar-logo">
          <span class="logo-name"><img src="/images/logo2.png" width="100"></span>
          <i class='bx bx-x' ></i>
        </div>
        <ul class="links">
          <li><a href="/">INÍCIO</a></li>
         <li><a href="/">DASHBOARD</a></li>
        
          <li>
            <a href="#">NOVO</a>
            <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
            <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="/admin/new/category">Categoria</a></li>
              <li><a href="/admin/new/product">Produto</a></li>
            </ul>
          </li>

          <li>
            <a href="#">FILTRO</a>
            <i class='bx bxs-chevron-down htmlcss-arrow arrow  '></i>
            <ul class="htmlCss-sub-menu sub-menu">
              <li><a href="/admin/filter/category">Categoria</a></li>
              <li><a href="/admin/filter/product">Produto</a></li>
            </ul>
          </li>

          @if(Auth::check())
          <li>
            <a href="#" id="name"></a>
            <i class='bx bxs-chevron-down js-arrow arrow '></i>
            <ul class="js-sub-menu sub-menu">
              <li><a href="#">Meus dados</a></li>
              <li><a href="#">Sair</a></li>
            </ul>
          </li>
          @endif
          <li><a href="/about">SOBRE</a></li>
        </ul>
      </div>
      <div class="search-box">
        <i class='bx bx-search'></i>
        <div class="input-box">
          <input type="text" placeholder="Pesquisar produtos...">
        </div>
      </div>

    
    </div>
  </nav>

  <div>
    @if(session('msg'))
        <p class="msg">{{session('msg')}}</p>
    @endif
    @if(session('msg2'))
        <p class="msg2" >{{session('msg2')}}</p>
    @endif
  </div>
   @yield('content')
   <script src="/js/navbar.js"></script>
   @if(Auth::check())
   <script>
    var name = '{{auth()->user()->name}}';
    var firstName = name.split(' ')[0];

    document.getElementById("name").textContent = firstName;

   </script>
   @endif
</body>
</html>

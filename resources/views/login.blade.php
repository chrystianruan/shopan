<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <title>Login</title>
</head>
<body>
  @if(session('msg-permission'))
    <p class="msg-permission">{{session('msg-permission')}}</p>
  @endif
    <div class="container">
        <div class="wrapper">
          <div class="title"><span><img width=200 src="images/logoGeral.png"></span></div>
          <form action="/login" method="POST">
            @csrf
            <div class="row">
              <i class="fas fa-user"></i>
              <input type="text" name="email" placeholder=" Digite seu Email" required>
            </div>
            <div class="row">
              <i class="fas fa-lock" id="lock" onclick="showPassword()"></i>
              <input type="password" name="password" id="password" placeholder="Digite sua Senha" required>
             
            </div>
            <div class="pass" style="font-size:13px"><p>Clique no <span class="fas fa-lock"></span> para ver a senha</p></div>
            
            <div class="row button">
              <input type="submit" value="Login">
            </div>
            <div class="pass"><a href="#">Esqueceu a senha?</a></div>
            <div class="signup-link">Ainda não registrado? <a href="/register">Registre-se</a></div>
          </form>
        </div>
      </div>

<script src="js/login.js"></script>
    
</body>
</html>
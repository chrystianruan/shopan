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
    <div class="container">
        <div class="wrapper">
          <div class="title"><span><img width=200 src="images/logoGeral.png"></span></div>
          <form action="#">
            <div class="row">
                <i class="fas fa-id-card"></i>
                <input type="text" placeholder="Nome" required>
              </div>
            <div class="row">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Email" required>
            </div>
            <div class="row">
              <i class="fas fa-lock" id="lock"></i>
              <input type="password" id="password" placeholder="Senha" required>
             
            </div>
            <div class="pass" style="font-size:13px"><p>Clique no <span class="fas fa-lock"></span> para ver a senha</p></div>
            
            <div class="row button">
              <input type="submit" value="Cadastrar-se">
            </div>

            <div class="signup-link">Já possui conta? <a href="/login">Fazer login</a></div>
          </form>
        </div>
      </div>

<script src="js/login.js"></script>
    
</body>
</html>
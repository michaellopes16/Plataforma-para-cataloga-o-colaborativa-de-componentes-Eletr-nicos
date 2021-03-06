<?php 
#session_start();
include_once 'loginFacebook.php';
if(isset($_SESSION['face_access_token'])){
  echo "apagando informações do token...";
  unset($_SESSION['face_access_token']);
  $_SESSION['nomeUser'] = "";  
  $_SESSION['logado'] = false;
}else
{
  $_SESSION['nomeUser'] = "";  
  $_SESSION['logado'] = false;
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/compiler/style.css">


    <title>Eletronics Component Catalog MDI</title>
  </head>
  <body>

      <div class="container mt-2 ml-5" align="start">
        <img src="img/logo2.png" class="img" align="center">
      </div>
  	<div class="container-fluid  d-flex align-items-center flex-column bd-highlight  quadradoLogin">
  		
  		<form method="POST" action="ControleLoginUsuario.php" data-toggle="validator" role="form">
  		  <h5 class="modal-title mb-3 mt-4" align="center"><b>Entrar no sistema</b></h5>
  		  
        <div class="form-group" align="start">
  		    <label for="exampleInputEmail1"><b>Login</b></label>
  		    <input type="text" class="form-control" name="nomeUsuario" id="ID_Campo_login" aria-describedby="emailHelp" placeholder="Digite seu login">
  		    <small id="emailHelp" class="form-text text-muted">Caso não tenha cadastro, realize um ou entre com uma das contas sugeridas</small>
  		  </div>
  		  
        <div class="form-group" align="start">
  		    <label for="exampleInputPassword1"><b>Senha</b></label>
  		    <input type="password" class="form-control" name="senha" id="ID_Campo_senha" placeholder="Senha">
  		  </div>
  		  <div class="form-group form-check">
  		    <input type="checkbox" class="form-check-input" id="CheckLembrar">
  		    <label class="form-check-label" for="exampleCheck1">Lembrar</label>
  		  </div>
  		  <div class="container mt-4" align="center">
	  		  <button type="submit" class="btn btn-primary ">Entrar</button>
      </form> 
	  		  <a href="<?php echo $loginUrl; ?>">
              <button type="button" class="btn btn-outline-primary">Entrar com <b>Facebook</b>
              </button>
          </a>
          <!--
	  		  <button type="submit" class="btn btn-outline-dark"><b>Google<b/></button>
          -->
  		    </div>
  		   <div class="container mt-4" align="center">
  		  		<a href="TelaCadastro.html"  class= "btn btn-link ml-5 mb-3">ou <b>Cadastre-se</b></a>
  		   </div>
  	
  	</div>
  	<div class="container-fluid  d-flex align-items-start flex-column bd-highlight mb-3 mt-5">
  		<a href="index.php" class="btn btn-primary mr-2">Voltar</a>
  	</div>
  	  <!-- <button type="button" class="btn btn-primary">Primary</button> -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/dist/jQuery.js"></script>
    <script src="popper.js/dist/umd/popper.js"></script>
    <script src="bootstrap/dist/js/bootstrap.js"></script>
  </body>
</html>
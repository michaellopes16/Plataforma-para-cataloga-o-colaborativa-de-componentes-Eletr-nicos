<?php session_start();?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/compiler/style.css">


    <title>Eletronics Component Catalog</title>
  </head>
  <body>
    
      <div class="container d-flex bd-highlight mb-3">
        <img src="img/logo2.png" class="img mr-auto p-2 bd-highlight" align="center">
          <label class="mt-5"><h4> <strong>Bem vindo:</strong> <?php echo $_SESSION["nomeUser"];  ?></h4> </label>
          <a href="TelaLogin.php" class="btn btn-primary p-2 bd-highlight tamanhoBTNS mt-5 ml-4">
            <svg id="i-signout" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M28 16 L8 16 M20 8 L28 16 20 24 M11 28 L3 28 3 4 11 4"  />
            </svg>
            Sair
          </a>
      </div>

       <nav class="navbar navbar-expand-lg bg-gradient-primary d-flex bd-highlight mb-3 ">
         <a href="index.php" class="btn btn-primary mr-0  p-2 bd-highlight"> 
           <svg  id="i-home" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
               <path d="M12 20 L12 30 4 30 4 12 16 2 28 12 28 30 20 30 20 20 Z" />
           </svg>   
           Início
         </a>
         <a href="TelaFavoritos.php" class="btn btn-primary  mr-2 ml-2 mr-auto p-2 bd-highlight">
          <svg  id="i-star" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
              <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
          </svg>  
         Favoritos</a>
         <form class="form-inline">
           <input class="form-control ml-4 mr-2" type="search" placeholder="Buscar...">
           <a href="#" class="btn btn-primary p-2 ml-2 bd-highlight">
            <svg  id="i-star" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
               <circle cx="14" cy="14" r="12" />
                <path d="M23 23 L30 30"  />
            </svg>  
           Buscar</a>
         </form>
       </nav>
     <div class="container-fluid  d-flex align-items-center flex-column bd-highlight  quadradoGerenciamento">
      <div class="container">
           <h5 class="modal-title mb-3 mt-4" align="center"><b>Gerenciar Componentes</b></h5>
          <div class="row mt-5">
            <div id="quem-somos" class="col-md-4 col-md-push-3">
                  <a href="TelaGerenciarMicrocontroladores.php"  class="btn btn-primary btn-lg tamanhoBTN">Microcontroladores</a>
            </div>
            <div id="nossos-trabalhos" class="col-md-4 col-md-pull-2">
                  <a  href="TelaGerenciarBaterias.php" class="btn btn-primary btn-lg tamanhoBTN">Baterias</a>
            </div>
            <div id="nossos-trabalhos" class="col-md-4 col-md-pull-3">
                  <a href="TelaGerenciarShields.php"  class="btn btn-primary btn-lg tamanhoBTN">Shields</a>
            </div>

          </div>

          <div class="row mt-5">
            <div id="nossos-trabalhos" class="col-md-4 col-md-pull-2">
                  <a  href="TelaGerenciarSensores.php" class="btn btn-primary btn-lg tamanhoBTN">Sensores</a>
            </div>
            <div id="nossos-trabalhos" class="col-md-4 col-md-pull-3">
                  <a href="TelaGerenciarAtuadores.php"  class="btn btn-primary btn-lg tamanhoBTN">Atuadores</a>
            </div>
            <div id="nossos-trabalhos" class="col-md-4 col-md-pull-3">
                  <a href="TelaGerenciarProjeto.php"  class="btn btn-primary btn-lg tamanhoBTN">Projetos</a>
            </div>
          </div>
      </div>


    </div>



      <!-- <button type="button" class="btn btn-primary">Primary</button> -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/dist/jQuery.js"></script>
    <script src="popper.js/dist/umd/popper.js"></script>
    <script src="bootstrap/dist/js/bootstrap.js"></script>
  </body>
</html>
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

<!--   ======================== Cabeçalho =============================================-->  

<?php if($_SESSION["logado"] == 1){ ?>
      <div class="container d-flex bd-highlight mb-3">
        <img src="img/logo2.png" class="img mr-auto p-2 bd-highlight" align="center">
         <div class="mt-2">
           <svg align="center" id="i-user" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                  <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" />
            </svg>
          <label class=" bd-highlight mt-5 mr-3">
          <h4><?php echo $_SESSION["nomeUser"];  ?></h4> 
          </label>
          </div>
          <a href="TelaLogin.php" class="btn btn-primary p-2 bd-highlight tamanhoBTNS mt-5 ml-4">
            <svg id="i-signout" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M28 16 L8 16 M20 8 L28 16 20 24 M11 28 L3 28 3 4 11 4"  />
            </svg>
          Sair
          </a>
      </div>
 <?php } ?>
       <nav class="navbar navbar-expand-lg bg-gradient-primary d-flex bd-highlight mb-3 ">
         <a href="index.php" class="btn btn-primary mr-0  p-2 bd-highlight"> 
           <svg  id="i-home" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
               <path d="M12 20 L12 30 4 30 4 12 16 2 28 12 28 30 20 30 20 20 Z" />
           </svg>   
           Início
         </a>
         <?php if($_SESSION["logado"] == 1){ ?>
         <a href="TelaGerenciarComponentes.php" class="btn btn-primary mr-0 ml-2  p-2 bd-highlight"> 
           <svg  id="i-portfolio" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
               <path d="M29 17 L29 28 3 28 3 17 M2 8 L30 8 30 16 C30 16 24 20 16 20 8 20 2 16 2 16 L2 8 Z M16 22 L16 18 M20 8 C20 8 20 4 16 4 12 4 12 8 12 8" />
           </svg>   
           Gerenciar
         </a>
          <?php } ?>
         <a href="#" class="btn btn-primary  mr-2 ml-2 mr-auto p-2 bd-highlight">
          <svg  id="i-star" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
              <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
          </svg>  
         Favoritos</a>
         <form class="form-inline">
           <input class="form-control ml-4 mr-2" type="search" placeholder="Buscar...">
           <a href="TelaFavoritos.php" class="btn btn-primary p-2 ml-2 bd-highlight">
            <svg  id="i-star" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
               <circle cx="14" cy="14" r="12" />
                <path d="M23 23 L30 30"  />
            </svg>  
           Buscar</a>
         </form> 
       </nav>

<!--   ==================== Início do corpo principal=======================================   -->


  <h5 class="modal-title mb-3 mt-4" align="center"><b>Gerenciar Projeto</b></h5>
     <div data-spy="scroll" class="container-fluid  d-flex align-items-center flex-column bd-highlight  quadradoGerenciamentoItem scrollspy-example" >
      
      <div data-spy="scroll" class="container" >

          <div class="divScroll" data-spy="scroll" data-offse="0">
              <!-- Inserir componentes dessa lista em um for do tamanho do retorno -->
              <li class="list-group-item list-group-item-primary d-flex bd-highlight mb-3">
                
                <img src="img/ItemTeste.png" class="img mt-1" align="center" width="90" height="65">

                <a href="TelaExibirProjeto.php"  class="btn btn-link tamanhoBTNS mr-auto ml-2 mb-3 " align="center" ">  
                  <h6 style="text-align:center;">
                   Microcontrolador ATMEL ATMEGA328, dispositivo 8 bits da família AVR TISC <br/>
                   Microcontrolador ATMEL ATMEGA328, dispositivo 8 bits da família AVR TISC
                 </h6> 
                </a>

                <div>
                <a href="TelaEditarProjeto.php" class="btn btn-primary mt-2 mr-0 p-2 bd-highlight tamanhoBTNS p-2 bd-highlight"> 
                  <svg id="i-edit" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path  d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z"  />
                  </svg>   
                  Editar
                </a>
                <a href="index.php" class="btn btn-primary mt-2 mr-0 ml-2  p-2 bd-highlight tamanhoBTNS p-2 bd-highlight"> 
                  <svg id="i-trash" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                  </svg>    
                  Excluir
                </a>
                </div>
              </li>
<!--Fim da informações do Primeiro Item da Lista. Os outros deverão ser retirados e a geração deve vir a partir de um laço -->
              <li class="list-group-item list-group-item-primary d-flex bd-highlight mb-3">
                
                <img src="img/ItemTeste.png" class="img mt-1" align="center" width="90" height="65">

                <a href="TelaExibirProjeto.php"  class="btn btn-link tamanhoBTNS mr-auto ml-2 mb-3 " align="center" ">  
                  <h6 style="text-align:center;">
                   Microcontrolador ATMEL ATMEGA328, dispositivo 8 bits da família AVR TISC <br/>
                   Microcontrolador ATMEL ATMEGA328, dispositivo 8 bits da família AVR TISC
                 </h6> 
                </a>

                <div>
                <a href="TelaEditarProjeto.php" class="btn btn-primary mt-2 mr-0 p-2 bd-highlight tamanhoBTNS p-2 bd-highlight"> 
                  <svg id="i-edit" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path  d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z"  />
                  </svg>   
                  Editar
                </a>
                <a href="index.php" class="btn btn-primary mt-2 mr-0 ml-2  p-2 bd-highlight tamanhoBTNS p-2 bd-highlight"> 
                  <svg id="i-trash" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                  </svg>    
                  Excluir
                </a>
                </div>
              </li>

              <li class="list-group-item list-group-item-primary d-flex bd-highlight mb-3">
                
                <img src="img/ItemTeste.png" class="img mt-1" align="center" width="90" height="65">

                <a href="TelaExibirProjeto.php"  class="btn btn-link tamanhoBTNS mr-auto ml-2 mb-3 " align="center" ">  
                  <h6 style="text-align:center;">
                   Microcontrolador ATMEL ATMEGA328, dispositivo 8 bits da família AVR TISC <br/>
                   Microcontrolador ATMEL ATMEGA328, dispositivo 8 bits da família AVR TISC
                 </h6> 
                </a>

                <div>
                <a href="TelaEditarProjeto.php" class="btn btn-primary mt-2 mr-0 p-2 bd-highlight tamanhoBTNS p-2 bd-highlight"> 
                  <svg id="i-edit" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path  d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z"  />
                  </svg>   
                  Editar
                </a>
                <a href="index.php" class="btn btn-primary mt-2 mr-0 ml-2  p-2 bd-highlight tamanhoBTNS p-2 bd-highlight"> 
                  <svg id="i-trash" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                  </svg>    
                  Excluir
                </a>
                </div>
              </li>

              <li class="list-group-item list-group-item-primary d-flex bd-highlight mb-3">
                
                <img src="img/ItemTeste.png" class="img mt-1" align="center" width="90" height="65">

                <a href="TelaExibirProjeto.php"  class="btn btn-link tamanhoBTNS mr-auto ml-2 mb-3 " align="center" ">  
                  <h6 style="text-align:center;">
                   Microcontrolador ATMEL ATMEGA328, dispositivo 8 bits da família AVR TISC <br/>
                   Microcontrolador ATMEL ATMEGA328, dispositivo 8 bits da família AVR TISC
                 </h6> 
                </a>

                <div>
                <a href="TelaEditarProjeto.php" class="btn btn-primary mt-2 mr-0 p-2 bd-highlight tamanhoBTNS p-2 bd-highlight"> 
                  <svg id="i-edit" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path  d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z"  />
                  </svg>   
                  Editar
                </a>
                <a href="index.php" class="btn btn-primary mt-2 mr-0 ml-2  p-2 bd-highlight tamanhoBTNS p-2 bd-highlight"> 
                  <svg id="i-trash" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                  </svg>    
                  Excluir
                </a>
                </div>
              </li>
              <li class="list-group-item list-group-item-primary d-flex bd-highlight mb-3">
                
                <img src="img/violao.jpg" class="img mt-1" align="center" width="90" height="65">

                <a href="TelaExibirProjeto.php"  class="btn btn-link tamanhoBTNS mr-auto ml-2 mb-3 " align="center" ">  
                  <h6 style="text-align:center;">
                   Microcontrolador ATMEL ATMEGA328, dispositivo 8 bits da família AVR TISC <br/>
                   Microcontrolador ATMEL ATMEGA328, dispositivo 8 bits da família AVR TISC
                 </h6> 
                </a>

                <div>
                <a href="index.php" class="btn btn-primary mt-2 mr-0 p-2 bd-highlight tamanhoBTNS p-2 bd-highlight"> 
                  <svg id="i-edit" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path  d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z"  />
                  </svg>   
                  Editar
                </a>
                <a href="index.php" class="btn btn-primary mt-2 mr-0 ml-2  p-2 bd-highlight tamanhoBTNS p-2 bd-highlight"> 
                  <svg id="i-trash" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                  </svg>    
                  Excluir
                </a>
                </div>
              </li>
           
          </div>
          <a href="TelaInserirProjeto.php" class="btn btn-primary p-2 bd-highlight mt-4 mb-3 ml-4">
            <svg id="i-compose" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <path d="M27 15 L27 30 2 30 2 5 17 5 M30 6 L26 2 9 19 7 25 13 23 Z M22 6 L26 10 Z M9 19 L13 23 Z"  />
            </svg>
          Inserir Novo
          </a>
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
<?php session_start();
if(isset($_SESSION['logado']) && empty($_SESSION['logado'])){
  $_SESSION["logado"] = 0;
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


    <title>Eletronics Component Catalog</title>
  </head>
  <body>
     

      <?php 
        if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
          if($_SESSION["logado"] == 1){ ?>
            <div class="container mb-5">
                 <div class="d-flex flex-row-reverse mb-4">
                    
                    <a href="TelaLogin.php" class="btn btn-primary p-2 bd-highlight tamanhoBTNS ml-4">
                      <svg id="i-signout" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                          <path d="M28 16 L8 16 M20 8 L28 16 20 24 M11 28 L3 28 3 4 11 4"  />
                      </svg>
                    Sair
                    </a>
                     <div>
                         <svg align="center" id="i-user" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" />
                          </svg>
                        <label class=" bd-highlight mt mr-3">
                        <h4><?php echo $_SESSION["nomeUser"];  ?></h4> 
                        </label>
                    </div>
                </div> 
            </div> 
      <?php }else{
              ?>
               <div class="container mb-4 ">
                      <div class="d-flex flex-row-reverse">
                          <a href="TelaLogin.php" class="btn btn-primary mr-2">Entrar</a>
                      </div> 
                </div>
                <?php
            }
      }else{ ?>
            <div class="container mb-4 ">
                  <div class="d-flex flex-row-reverse">
                      <a href="TelaLogin.php" class="btn btn-primary mr-2">Entrar</a>
                  </div> 
            </div>      
      <?php }?>
      <div class="container mt-5" align="center">
        <img src="img/logo1.png" class="img" align="center">
      </div>
      <!-- -->
      <div class="container mt-5" align="center">
            <div class="d-flex justify-content-center ">
              <form class="form-inline" method="POST" action="TelaListarComponente.php" data-toggle="validator" role="form">
                <input class="form-control p-2" type="search" name="busca" size="80" maxlength="90" placeholder="Buscar...">
                <button type="submit" class="btn btn-primary"  id="button-pesquisar">
                  <svg  id="i-star" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                     <circle cx="14" cy="14" r="12" />
                      <path d="M23 23 L30 30"  />
                  </svg>  
                  Buscar
                </button>
              </form>
            </div>
      </div>

      <div class="container mt-4" align="center">
        <div class="d-flex justify-content-center ">
         <div class="d-flex align-items-baseline">
            <input class="mr-3"  type="radio" aria-label="RadioBox1">Todos os campos</input>
            <input class="ml-4 mr-2" type="radio" aria-label="RadioBox2"> Nome</input>
            <input class="ml-4" type="radio" aria-label="RadioBox3"> Tipo</input>
          </div>
        </div>
        <div class="d-flex justify-content-center ">
         <div class="d-flex align-items-baseline">
            <input  type="radio" aria-label="RadioBox5">Projetos</input>
            <input class="ml-4" type="radio" aria-label="RadioBox6"> Descrição</input>
            <input class="ml-4" type="radio" aria-label="RadioBox7"> Palavra-Chave</input>
          </div>
        </div>
      </div>
       <div class="container-fluid  d-flex align-items-center flex-column bd-highlight mb-3 mt-5"></div>
       <div class="container-fluid  d-flex align-items-center flex-column bd-highlight mb-3 mt-5"></div>
       <div class="container-fluid  d-flex align-items-center flex-column bd-highlight mb-3 mt-5"></div>
       <div class="container-fluid  d-flex justify-content-center align-items-baseline mb-3 mt-3">
          <label class= "btn btn-link ml-5 p-2 bd-highlight" for="male" data-toggle="modal" data-target=".modal-contato">Contato</label>
          <label class= "btn btn-link ml-5 p-2 bd-highlight" for="male" data-toggle="modal" data-target=".modal-informacoes">Informações do Projeto</label>
       </div>
        <!-- Modal Dos Contatos -->
          <div class="modal fade modal-contato" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"">
              <div class="modal-content">
                 <div class="modal-header">
                  <h5 class="modal-title">Contatos</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body">
                  <p>
                    <br /> <b>Desenvolvido por:</b> Michael Lopes Bastos {mlb@cin.ufpe.br} <br />
                           <b>Supervisionado por:</b> Giordano Ribeiro Eulalio Cabral {grec@cin.ufpe.br}<br />
                           Centro de Informática(CIn) - Universidade Federal de Pernambuco (UFPE)
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal Informações do Projeto -->
          <div class="modal fade modal-informacoes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                 <div class="modal-header">
                  <h5 class="modal-title">Informações do Projeto</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body">
                  <p>
                    <br />  Este projeto tem como objetivo manter uma plataforma para catalogação colaborativa das principais tecnologias que podem ser utilizadas nos novos instrumentos digitais musicais (MDI), realizando um registro desde componentes para comunicação sem fio até os diversos meios de armazenamento de energia existentes atualmente. 
                    <br /> 
                    Este é um trabalho colaborativo, logo, sinta-se a vontade para adicionar informações no nosso acervo e compatilhar seus projetos e conhecimento adiquiridos ao longo de suas experiências profissionais e acadêmicas.
                  </p>
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
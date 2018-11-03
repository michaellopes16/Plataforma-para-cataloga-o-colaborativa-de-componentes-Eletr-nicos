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


 <h5 class="modal-title mb-3 mt-4" align="center"><b>Características do Sensor</b></h5>
 <img src="img/ItemTeste.png" class="img rounded mx-auto d-block" width="200" height="130" align="center">
   <!--   ============================= Info gerais =======================================   -->
 <table class="table table-striped">
 <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
   <tbody>
     <tr class="table-primary">
       <th scope="row">Nome</th>
       <td>...</td>
     </tr>
     <tr>
       <th scope="row">Modelo</th>
       <td>...</td>
     </tr>
     <tr class="table-primary" >
       <th scope="row">Temperatura de Operação</th>
       <td>...</td>
     </tr>
     <tr>
       <th scope="row">Dimensões</th>
       <td>...</td>
     </tr>
     <tr class="table-primary" >
       <th scope="row">Preço Médio</th>
       <td>...</td>
     </tr>
     <tr >
       <th scope="row">DataSheet</th>
       <td>
          <a href="https://www.farnell.com/datasheets/1682209.pdf" class="btn button-link">https://www.farnell.com/datasheets/1682209.pdf
          </a>
       </td>
     </tr>
     <tr class="table-primary" >
       <th scope="row">Palavras-Chave</th>
       <td>
          <td>...</td>
       </td>
     </tr>
     <tr >
       <th scope="row">Função Principal</th>
       <td></td>
     </tr>
     <tr  class="table-primary">
       <th scope="row">Compatível com:</th>
       <td></td>
     </tr>
   </tbody>
 </table>
 <table class="table table-striped" >

    <!--   ============================= Informações Elétricas  =======================================   -->
 <table class="table table-striped" >
 <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Elétricas</h4>
   <tbody>
     <tr class="table-primary">
       <th scope="row">Tensão Nominal (operação)</th>
       <td>5V</td>
     </tr>
     <tr>
       <th scope="row">Tensão de saída</th>
       <td></td>
     </tr>
   </tbody>
 </table>
     <!--   =============================Componentes Adicionais=======================================   -->
 <table class="table table-striped" >
 <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Adicionais</h4>
   <thead>
     <tr>
       <th scope="col" >Descrição</th>
     </tr>
   </thead>
   <tbody>
     <tr class="table-primary">
       <td>
         <p>
           Arduino
           Arduino Uno logo.png
           Arduino-uno-perspective-transparent.png
           Arduino Uno
           Desenvolvedor  • Massimo Banzi, David Cuartielles, Tom Igoe, Gianluca Martino e David Mellis.
            • Baseado no Processing, de Casey Reas e Ben Fry.
            • Comunidade Código aberto.
           Plataforma  C/C++
           Lançamento  2005
           Versão estável  1.8.2 (22 de março de 2017; há 11 meses [1])
           Versão em teste 1.5.8 (10 de janeiro de 2014; há 4 anos[1])
           Linguagem Java
           Sistema operacional Microsoft Windows, Linux, Mac OS X[2][3]
           Gênero(s) Ambiente de desenvolvimento integrado
           Licença  • Software em LGPL ou GPL
            • Hardware em Creative Commons
           Estado do desenvolvimento Ativo
           Página oficial  http://www.arduino.cc/en/ (em inglês)
           Arduíno[2][4][5] é uma plataforma de prototipagem eletrônica de hardware livre e de placa única,[6] projetada com um microcontrolador Atmel AVR com suporte de entrada/saída embutido, uma linguagem de programação padrão,[7] a qual tem origem em Wiring, e é essencialmente C/C++.[8] O objetivo do projeto é criar ferramentas que são acessíveis, com baixo custo, flexíveis e fáceis de se usar por principiantes e profissionais. Principalmente para aqueles que não teriam alcance aos controladores mais sofisticados e ferramentas mais complicadas.[9]
         </p>
       </td>
     </tr>
   </tbody>
 </table>
 <!--   =============================   Botão Editar  =========================================   -->       

       <!--  Sò deve aparecer se o usuário estiver logado    -->        
      <a href="TelaEditarSensor.php" class="btn btn-primary mt-5 mb-3 ml-2" align="center">
       <svg id="i-edit" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
           <path  d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z"  />
       </svg> 
      Editar Conteúdo
      </a>
   <!--   =============================Projetos Relacionados=======================================   -->
 <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Projetos Relacionados</h4>

 <!-- Cards referentes aos projetos sugeridos para cada componente ao componente 1-->
 <div>
 <div class="row" align="center">
   <!-- Tamnho da imagem do projeto .../100px180/ style="width: 180px; height: 100px;-->
   <div class="card col-md-3 ml-3" style="width: 18rem;">
     <img class="card-img-top" width="100" height="180" src="img\violao.jpg" alt="Card image cap">
     <div class="card-body">
       <h5 class="card-title">Violão LED</h5>
       <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
       <a href="TelaExibirProjeto.php" class="btn btn-primary">Ver o projeto</a>
     </div>
   </div>
   <!-- Tamnho da imagem do projeto .../100px180/ style="width: 180px; height: 100px;-->
   <div class="card col-md-3 ml-3" style="width: 18rem;">
     <img class="card-img-top" width="100" height="180" src="img\violao.jpg" alt="Card image cap">
     <div class="card-body">
       <h5 class="card-title">Violão LED</h5>
       <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
       <a href="TelaExibirProjeto.php" class="btn btn-primary">Ver o projeto</a>
     </div>
   </div>
   <!-- Tamnho da imagem do projeto .../100px180/ style="width: 180px; height: 100px;-->
   <div class="card col-md-3 ml-3" style="width: 18rem;">
     <img class="card-img-top" width="100" height="180" src="img\violao.jpg" alt="Card image cap">
     <div class="card-body">
       <h5 class="card-title">Violão LED</h5>
       <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
       <a href="TelaExibirProjeto.php" class="btn btn-primary">Ver o projeto</a>
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
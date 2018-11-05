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
    <script language="JavaScript">
      function Mudarestado(el) {
        var display = document.getElementById(el).style.display;
        if(display == "none")
            document.getElementById(el).style.display = 'block';
          //carregar a página e só depois exibir o conteudo
    }

    </script>

    <title>Eletronics Component Catalog</title>
  </head>
  <body>


 <!--   ============================ Cabeçalho ===============================================--> 

<div class="container d-flex bd-highlight mb-3">
  <img src="img/logo2.png" class="img mr-auto p-2 bd-highlight" align="center">
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
</div>

       <nav class="navbar navbar-expand-lg bg-gradient-primary d-flex bd-highlight mb-3 ">
         <a href="index.php" class="btn btn-primary mr-0  p-2 bd-highlight"> 
           <svg  id="i-home" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
               <path d="M12 20 L12 30 4 30 4 12 16 2 28 12 28 30 20 30 20 20 Z" />
           </svg>   
           Início
         </a>
         <?php 
       if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
         if($_SESSION["logado"] == 1){ ?>
         <a href="TelaGerenciarComponentes.php" class="btn btn-primary mr-0 ml-2  p-2 bd-highlight"> 
           <svg  id="i-portfolio" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
               <path d="M29 17 L29 28 3 28 3 17 M2 8 L30 8 30 16 C30 16 24 20 16 20 8 20 2 16 2 16 L2 8 Z M16 22 L16 18 M20 8 C20 8 20 4 16 4 12 4 12 8 12 8" />
           </svg>   
           Gerenciar
         </a>
          <?php } }?>
         <a href="TelaFavoritos.php" class="btn btn-primary  mr-2 ml-2 mr-auto p-2 bd-highlight">
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

<!--   ===================  Início do corpo principal=======================================   -->


 <h5 class="modal-title mb-3 mt-4" align="center"><b>Adicionar componentes para comparação</b></h5>
 <div  class="container-fluid  d-flex align-items-center flex-column bd-highlight  quadradoCompararItem" >

<div class="row mt-5" style=" width: 900px;">
    <div class="col-md-4 mr-3" style='position:relative; top:0px; left:0px;'>
      <img src="img/Item.png" border=0>
      <div style='position:absolute; top:80px; left:30px;'>
       <form class="form-inline">
        <input class="form-control ml-4 mr-2" type="search" size="25" placeholder="Buscar...">
       </form>
      </div>
      <div style='position:absolute; top:70px; left:320px;'>
          <h1><b>+</b></h1>
      </div>
    </div>
    <div class="col-md-4 ml-3" style='position:relative; top:0px; left:0px;'>
      <img src="img/Item.png" border=0>
      <div style='position:absolute; top:80px; left:30px;'>
       <form class="form-inline">
        <input class="form-control ml-2 mr-2" type="search" size="25" placeholder="Buscar...">
       </form>
      </div>
    </div>
    <div class="col-md-2 ml-1 mt-5">
      <button type="button" onclick="Mudarestado('minhaDiv')"class="btn btn-outline-primary mt-5 ml-2  tamanhoBTNS">  
        Comparar
      </button>
    </div>
 
  </div>
</div>
   <!--   =========================Início da listagem da comparação =======================================   -->

<div id="minhaDiv" style="display: none">
<table class="table table-striped">
<h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
  <thead>
    <tr>
      <th scope="col"></th>
      <th scope="col">Componente 1</th>
      <th scope="col">Componente 2</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-primary">
      <th scope="row">Nome</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th scope="row">Modelo</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr class="table-primary" >
      <th scope="row">Temperatura de Operação</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th scope="row">Dimensões</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr  class="table-primary">
      <th scope="row">Preço Médio</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th scope="row">Linguagem de Programação</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr  class="table-primary" >
      <th scope="row">Plataform de Desenvolvimento</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th scope="row">DataSheet</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr  class="table-primary">
      <th scope="row">Site</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th scope="row">Desenho da pinagem</th>
      <td>...</td>
      <td>...</td>
    </tr>
  </tbody>
</table>
<table class="table table-striped" >
<h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Técnincas</h4>
  <thead>
    <tr>
      <th scope="col"> </th>
      <th scope="col" >Componente 1</th>
      <th scope="col">Componente 2</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-primary">
      <th scope="row">Processador</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th scope="row">Tempo de Clock</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr class="table-primary" >
      <th scope="row">GPIOs-Analógicos</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th scope="row">GPIO-Digitais</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr  class="table-primary">
      <th scope="row">Memória RAM</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th scope="row">Memória Flhash</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr  class="table-primary" >
      <th scope="row">Microcontrolador</th>
      <td>...</td>
      <td>...</td>
    </tr>
  </tbody>
</table>

<table class="table table-striped" >
<h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Interfaces de Comunicação</h4>
  <thead>
    <tr>
      <th scope="col"> </th>
      <th scope="col" >Componente 1</th>
      <th scope="col">Componente 2</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-primary">
      <th scope="row">Comunicação sem Fio</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th scope="row">Comunicação Serial</th>
      <td>...</td>
      <td>...</td>
    </tr>
  </tbody>
</table>
<table class="table table-striped" >
<h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Componentes Adicionais</h4>
  <thead>
    <tr>
      <th scope="col"> </th>
      <th scope="col" >Componente 1</th>
      <th scope="col">Componente 2</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-primary">
      <th scope="row">Interfaces de Entrada</th>
      <td>...</td>
      <td>...</td>
    </tr>
    <tr>
      <th scope="row">Sensores</th>
      <td>...</td>
      <td>...</td>
    </tr>
  </tbody>
</table>
<table class="table table-striped" >
<h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Adicionais</h4>
  <thead>
    <tr>
      <th scope="col"> </th>
      <th scope="col" >Componente 1</th>
      <th scope="col">Componente 2</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-primary">
      <th scope="row">Descrição</th>
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
<h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Projetos Relacionados</h4>

<!-- Cards referentes aos projetos sugeridos para cada componente ao componente 1-->
<div>
<h5>Componente 1</h5>
<div class="row" align="center">
  <!-- Tamnho da imagem do projeto .../100px180/ style="width: 180px; height: 100px;-->
  <div class="card col-md-3 ml-3" style="width: 18rem;">
    <img class="card-img-top" width="100" height="180" src="img\violao.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Violão LED</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="#" class="btn btn-primary">Ver o projeto</a>
    </div>
  </div>
  <!-- Tamnho da imagem do projeto .../100px180/ style="width: 180px; height: 100px;-->
  <div class="card col-md-3 ml-3" style="width: 18rem;">
    <img class="card-img-top" width="100" height="180" src="img\violao.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Violão LED</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="#" class="btn btn-primary">Ver o projeto</a>
    </div>
  </div>
  <!-- Tamnho da imagem do projeto .../100px180/ style="width: 180px; height: 100px;-->
  <div class="card col-md-3 ml-3" style="width: 18rem;">
    <img class="card-img-top" width="100" height="180" src="img\violao.jpg" alt="Card image cap">
    <div class="card-body">
      <h5 class="card-title">Violão LED</h5>
      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
      <a href="#" class="btn btn-primary">Ver o projeto</a>
    </div>
  </div>
</div>
  <!-- Cards referentes aos projetos sugeridos para cada componente ao componente 1-->

  <h5 class="mt-5">Componente 2</h5>
  <div class="row" align="center">
  <!-- Tamnho da imagem do projeto .../100px180/ style="width: 180px; height: 100px;-->
      <div class="card col-md-3 ml-3" style="width: 18rem;">
        <img class="card-img-top" width="100" height="180" src="img\violao.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Violão LED</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-primary">Ver o projeto</a>
        </div>
      </div>
      <!-- Tamnho da imagem do projeto .../100px180/ style="width: 180px; height: 100px;-->
      <div class="card col-md-3 ml-3" style="width: 18rem;">
        <img class="card-img-top" width="100" height="180" src="img\violao.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Violão LED</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-primary">Ver o projeto</a>
        </div>
      </div>
      <!-- Tamnho da imagem do projeto .../100px180/ style="width: 180px; height: 100px;-->
      <div class="card col-md-3 ml-3" style="width: 18rem;">
        <img class="card-img-top" width="100" height="180" src="img\violao.jpg" alt="Card image cap">
        <div class="card-body">
          <h5 class="card-title">Violão LED</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-primary">Ver o projeto</a>
        </div>
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
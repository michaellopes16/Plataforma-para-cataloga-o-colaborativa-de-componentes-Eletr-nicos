<?php 

include_once("conexao/Fachada.class.php");
include_once("conexao/MicrocontroladorVO.class.php");

session_start();
if(isset($_POST["ItemPesquisa"])){

  $idItem = $_POST["ItemPesquisa"];
  echo "Item pesquisa no Tela Exibir: ".$idItem;
} 


$idItem = $_SESSION["itemAtual"];

echo "ID Item inserido: ".$idItem;

$fachada = new Fachada;
#$micro = new MicrocontroladorVO;

$arrayResult  = $fachada->exibirMicrocontrolador($idItem);
echo "Nome Item result: ".$arrayResult['nomeItem'];
$_SESSION["itemAtual"]

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

<!--   ===================  Início do corpo principal=======================================   -->


 <h5 class="modal-title mb-3 mt-4" align="center"><b>Características do Microcontrolador</b></h5>
 <img src="<?php echo $arrayResult['img_componente']; ?>" class="img rounded mx-auto d-block" width="200" height="130" align="center">
 <!--   ============================= Info gerais =======================================   -->

 <table class="table table-striped">
 <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
   <tbody>
    <tr>
      <th scope="row">Inserido pelo Usuário:</th>
      <td><?php echo $arrayResult['nomeUsuario']; ?> </td>
    </tr>
     <tr class="table-primary">
       <th scope="row">Nome</th>
       <td><?php echo $arrayResult['tipo']; ?></td>
     </tr>
     <tr>
       <th scope="row">Modelo</th>
       <td><?php echo $arrayResult['nome']; ?></td>
     </tr>
     <tr class="table-primary" >
       <th scope="row">Temperatura de Operação</th>
       <td><?php echo $arrayResult['temperatura_operacao']; ?></td>
     </tr>
     <tr>
       <th scope="row">Dimensões</th>
       <td><?php echo $arrayResult['dimensao']; ?> </td>
     </tr>
     <tr  class="table-primary">
       <th scope="row">Preço Médio</th>
       <td><?php echo "R$ ". $arrayResult['precoMedio']; ?> </td>
     </tr>
     <tr>
       <th scope="row">Linguagem de Programação</th>

       <td><?php echo substr($arrayResult['linguagem_de_prograrmacao'],1);#mudar isso, tá prograrmacao ?> </td>
     </tr>
     <tr  class="table-primary" >
       <th scope="row">Plataform de Desenvolvimento</th>
       <td><?php echo substr($arrayResult['plataforma_de_desenvolvimento'],1);?></td>
     </tr>
     <tr>
       <th scope="row">DataSheet</th>
       <td>
          <a href="<?php $arrayResult['linkDataSheet']; ?>" class="btn button-link">
            <?php echo $arrayResult['linkDataSheet']; ?>
          </a>
       </td>
     </tr>
     <tr  class="table-primary">
       <th scope="row">Palavras-Chave</th>
       <td>
          <?php echo $arrayResult['palavraChave']; ?>
       </td>
     </tr>
     <tr>
       <th scope="row">Desenho da pinagem</th>
       <td>
           <img src="<?php echo $arrayResult['img_legenda']; ?>" class="img mr-auto p-2 bd-highlight" width="600" height="700" align="center">
       </td>
     </tr>
   </tbody>
 </table>
 <table class="table table-striped" >

<!--   =============================Infor técnincas =======================================   -->
 <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Técnincas</h4>
   <tbody>
     <tr class="table-primary">
       <th scope="row">Processador</th>
       <td><?php echo $arrayResult['processador']; ?></td>
     </tr>
     <tr>
       <th scope="row">Tempo de Clock</th>
       <td><?php echo $arrayResult['tempo_de_clock']; ?></td>
     </tr>
     <tr class="table-primary" >
       <th scope="row">GPIOs-Analógicos</th>
       <td><?php echo $arrayResult['GPIO_A']; ?></td>
     </tr>
     <tr>
       <th scope="row">GPIO-Digitais</th>
       <td><?php echo $arrayResult['GPIO_D']; ?></td>
     </tr>
     <tr  class="table-primary">
       <th scope="row">Memória RAM</th>
       <td><?php echo $arrayResult['memoria_ram']; ?></td>
     </tr>
     <tr>
       <th scope="row">Memória Flhash</th>
       <td><?php echo $arrayResult['memoria_flash']; ?></td>
     </tr>
     <tr  class="table-primary" >
       <th scope="row">Microcontrolador</th>
       <td><?php echo $arrayResult['microcontrolador']; ?></td>
     </tr>
   </tbody>
 </table>

    <!--   ============================= Informações Elétricas  =======================================   -->
 <table class="table table-striped" >
 <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Elétricas</h4>
   <tbody>
     <tr class="table-primary">
       <th scope="row">Tensão de Operação</th>
       <td><?php echo $arrayResult['tensao_operacao']; ?></td>
     </tr>
     <tr>
       <th scope="row">Tensão de entrada</th>
       <td><?php echo $arrayResult['tensao_entrada']; ?></td>
     </tr>
   <tr class="table-primary">
       <th scope="row">Modo de Consumo</th>
       <td><?php echo $arrayResult['modo_consumo']; ?></td>
     </tr>
   </tbody>
 </table>

   <!--   ============================= Comunicação =======================================   -->
 <table class="table table-striped" >
 <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Interfaces de Comunicação</h4>
   <tbody>
     <tr class="table-primary">
       <th scope="row">Comunicação sem Fio</th>
       <td><?php echo substr($arrayResult['sem_fio'],1); ?></td>
     </tr>
     <tr>
       <th scope="row">Comunicação Serial</th>
       <td><?php echo substr($arrayResult['serial_'],1); ?></td>
     </tr>
   </tbody>
 </table>

    <!--   =============================Componentes Adicionais=======================================   -->
 <table class="table table-striped" >
 <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Componentes Adicionais</h4>
   <tbody>
     <tr class="table-primary">
       <th scope="row">Interfaces de Entrada</th>
       <td><?php echo substr($arrayResult['interface_entrada'],1); ?></td>
     </tr>
     <tr>
       <th scope="row">Sensores</th>
       <td><?php echo substr($arrayResult['sensores'],1); ?></td>
     </tr>
   </tbody>
 </table>
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
          <?php echo $arrayResult['infoAdicionais']; ?>
         </p>
       </td>
     </tr>
   </tbody>
 </table>

 <!--   =============================   Botão Editar  =========================================   -->       

       <!--  Sò deve aparecer se o usuário estiver logado    -->        
      <a href="TelaEditarMicrocontrolador.php" class="btn btn-primary mt-5 mb-3 ml-2" align="center">
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
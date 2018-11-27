<?php 


include_once("conexao/Fachada.class.php");
include_once("conexao/MicrocontroladorVO.class.php");

session_start();
$itemAtual  = $_POST['busca'];
#$itemAtual = $_SESSION["itemAtual"]; 

$fachada = new Fachada;
#$micro = new MicrocontroladorVO;

$arrayResult  = $fachada->exibirItem($itemAtual);

$linkCategoria = '#';



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

  <!--   ============================ Cabeçalho ===================================================--> 
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

<!--   =============================Início do corpo principal=======================================   -->

 <h5 class="modal-title mb-3 mt-4" align="center"><b>Lista de resultados</b></h5>
 <div  class="container-fluid  d-flex align-items-center flex-column bd-highlight  quadradoListarItens" >
  
   <!--   =============================  =======================================   -->     
      <div class="container" >

          <div class="divScroll" data-spy="scroll" data-offse="0">
              <!-- Inserir componentes dessa lista em um for do tamanho do retorno -->
             
         <?php  
             
           #echo "Itens retornados: ".count($arrayResult);
         while ($row =  mysqli_fetch_array($arrayResult,MYSQLI_ASSOC)) {# echo "Palavra chave:".$row['palavraChave'];?>
            
              <li class="list-group-item list-group-item-primary d-flex bd-highlight mb-3 mr-2">
                 <!-- Adicionar comportamento de salvar na lista de favoritos -->
                
                <a href="#" class="btn btn-outline-primary tamanhoBTStar mt-3 mr-3 ml-2  p-2 bd-highlight  p-2 bd-highlight"> 
                  <svg id="i-star" viewBox="0 0 43 43" width="30" height="25" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                  </svg>    
                </a>
                <img src="<?php echo  $row['img_componente']; ?>" 
                class="img mt-1" align="center" width="90" height="65">
          <?php switch ($row['categoria']) {
            case 'microcontrolador':
               $linkCategoria = "TelaExibirMicrocontrolador.php";
              break;
            case 'bateria':
               $linkCategoria = "TelaExibirBateria.php";
              break;
            case 'sensor':
                $linkCategoria = "TelaExibirSensor.php";
                break;
            case 'atuador':
                $linkCategoria = "TelaExibirAtuador.php";
                break;
            case 'shield':
                $linkCategoria = "TelaExibirShield.php";
                break;
            case 'projeto':
                $linkCategoria = "TelaExibirProjeto.php";
                break;
          } ?>

          <form class="form-inline  mr-auto" method="POST" action="<?php echo $linkCategoria;?>" data-toggle="validator" role="form">
            <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $row['ID_Item']; ?>"/> 
               <button  type="submit" class="btn btn-outline-primary mr-auto ml-3 mb-1 mt-2 border-0 " align="center" ">  
                  <h6 style="text-align:center;">
                    <p>
                    <?php echo  "<b>Nome Item:</b> ".$row['nomeItem']." <b> Preço Médio: </b> R$ ". $row['precoMedio']."</br> <b> Palavras Chave:</b> ". $row['palavraChave'];?> 
                   </p>
                 </h6> 
                </button>
            </form> 
                <div>
                <a href="TelaCompararComponentes.php" class="btn btn-primary mt-2 mr-0 p-2 bd-highlight tamanhoBTNS p-2 bd-highlight">  
                  Comparar
                </a>
                </div>
              </li>
             <?php } mysqli_free_result($arrayResult); ?>  
           
<!--Fim da informações do Primeiro Item da Lista. Os outros deverão ser retirados e a geração deve vir a partir de um laço -->           
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
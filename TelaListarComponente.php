<?php 

session_start();
include_once("conexao/Fachada.class.php");
include_once("conexao/MicrocontroladorVO.class.php");


$_SESSION["adicionou"] = false;
$fachada = new Fachada;
$resulFavorito = '';
$_SESSION['buscaAtual'] = '';
$_SESSION['tipoBusca'];
if(isset($_POST['busca'])){
  #echo "Busca atual...".$_POST['busca'];
  $itemAtual  = $_POST['busca'];
  $_SESSION['tipoBusca']= $_POST['tipoBusca'];
  $_SESSION['buscaAtual'] = $itemAtual;
}

if(isset($_POST['ItemAdicionado'])){
  $itemFavorito = $_POST['ItemAdicionado']; 

        if($_SESSION['tipoBusca'] == 1){
        $resulFavorito = $fachada->inserirFavorito($itemFavorito, $_SESSION["nomeUser"],null);
        }else if($_SESSION['tipoBusca'] == 2)
        {
          echo "Vai inserir o projeto";
          $resulFavorito = $fachada->inserirFavorito(null, $_SESSION["nomeUser"],$itemFavorito);
        }else if($_SESSION['tipoBusca'] == 3)
        {
          if(isset($_POST['tipoEnviado'])){
            
            $tipo = $_POST['tipoEnviado'];
            echo "Tipo Adicionado:".$tipo;
            if($tipo == 'item'){
            #echo "Vai inserir o projeto";
            $resulFavorito = $fachada->inserirFavorito($itemFavorito, $_SESSION["nomeUser"],null);
            }else if ($tipo == 'projeto')
            {

            $resulFavorito = $fachada->inserirFavorito(null, $_SESSION["nomeUser"],$itemFavorito);
            }
            else
            {
              echo "Erro ao inserir";
            }
          } 
        }

   # echo "Retorno do inserir Favoritos:".$resulFavorito;

       if ($resulFavorito == -1) {
         $_SESSION["adicionou"] = true;
          $imprimir = "Item Já adicionado!";
          $tipoAlert = "alert alert-warning alert-dismissible fade show";
          $labelAlerta = 'Atenção! ';
       }else if ($resulFavorito == -2) {
          $_SESSION["adicionou"] = true;
          $imprimir = "Erro ao adicionado item!";
          $tipoAlert = "alert alert-danger";
          $labelAlerta = 'Erro! ';
       }else if($resulFavorito == 0)
       {
         # header("Refresh: 0");
          $_SESSION["adicionou"] = true;
          $imprimir = " Componente adicionado com sucesso!";
          $tipoAlert = "alert alert-success";
          $labelAlerta = 'Sucesso! ';
       } 
}

#$micro = new MicrocontroladorVO;
#echo "Busca Atual".$_SESSION['buscaAtual'];
if($_SESSION['tipoBusca'] == 1){
  #echo "Tipo  busca == 1";
  $arrayResult  = $fachada->exibirItem($_SESSION['buscaAtual']);
}else if($_SESSION['tipoBusca'] == 2)
{
 # echo "Tipo  busca == 2";
  $arrayResult  = $fachada->listarProjeto($_SESSION['buscaAtual']);
}else if($_SESSION['tipoBusca'] == 3)
{ 
    $arrayResult  = $fachada->exibirItemPorPalavraChave($_SESSION['buscaAtual']);
    $arrayResult2  = $fachada->listarProjetoPorPalavraChave($_SESSION['buscaAtual']);
}

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
    <script type="text/javascript">
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
      }, 4000);
    </script>
     <script>
     function setaDadosModal(valor,valor2,tipo) {
        document.getElementById('Nome_Item_ADD').innerHTML = valor2;
        document.getElementById('ID_Item_ADD').value = valor;
        document.getElementById('ItemParaAdicionar').value = valor;
        document.getElementById('ID_tipoEnviado').value = tipo;       
    }
    </script>

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

          <?php if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
         if($_SESSION["logado"] == 1){ ?> 
         <a href="TelaFavoritos.php" class="btn btn-primary  mr-2 ml-2 mr-auto p-2 bd-highlight">
          <svg  id="i-star" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
              <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
          </svg>  
         Favoritos</a>
          <?php } }?>
         <form class="form-inline mt-2" method="POST" action="TelaListarComponente.php" data-toggle="validator" role="form">
            <input class="form-control p-2" type="search" name="busca" size="40" maxlength="50" placeholder="Buscar..." id="ID_Campo_Busca">
           <input type="hidden" name="tipoBusca" value="<?php echo $_SESSION['tipoBusca']; ?>">
           <button type="submit" class="btn btn-primary"  id="button-pesquisar">
             <svg  id="i-star" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                <circle cx="14" cy="14" r="12" />
                 <path d="M23 23 L30 30"  />
             </svg>  
             Buscar
           </button>   
         </form> 
       </nav>

<!--   =============================Início do corpo principal=======================================   -->
<?php  
if(isset($_SESSION["adicionou"]) || !empty($_SESSION["adicionou"]))
{
  #echo "Valor variável excluiu: ".$_SESSION["excluiu"];
   if($_SESSION["adicionou"] == true ){
   ?>
      <div class="<?php echo($tipoAlert) ?>" role="alert" align="center">
        <strong><?php echo($labelAlerta) ?></strong> <?php echo($imprimir) ?>
        <button type="button" class="close" data-dismiss="alert" arial-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <?php
    $_SESSION["adicionou"] = false;
    }
}
?>

  
<!--   =============================  =======================================   -->     
<?php if($_SESSION['tipoBusca'] == 1){ ?> 
 <h5 class="modal-title mb-3 mt-4" align="center"><b>Lista de resultados</b></h5>
 <div  class="container-fluid  d-flex align-items-center flex-column bd-highlight  quadradoListarItens" > 
   <div class="container" >
      <div class="divScroll" data-spy="scroll" data-offse="0">
         <?php              
           #echo "Itens retornados: ".count($arrayResult);
         while ($row =  mysqli_fetch_array($arrayResult,MYSQLI_ASSOC)) {# echo "Palavra chave:".$row['palavraChave'];?>
           <div class="d-flex justify-content-around">
              <li class="list-group-item list-group-item-primary d-flex bd-highlight mb-3 mr-2">
                 <!-- Adicionar comportamento de salvar na lista de favoritos -->
               
                <a class="btn btn-outline-primary tamanhoBTStar mt-3 mr-3 ml-2  p-2 bd-highlight  p-2 bd-highlight" data-toggle="modal" data-target="#ID_Modal_ADD" onclick="setaDadosModal('<?php echo $row['ID_Item']; ?>','<?php echo $row['nomeItem']; ?>','item')"> 
                  <svg id="i-star" viewBox="0 0 43 43" width="30" height="25" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                  </svg>    
                </a>
                <img src="<?php echo  $row['img_componente']; ?>" 
                class="img mt-1" align="center" width="90" height="65">
          <?php 
          switch ($row['categoria']) {
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
            case 'srojeto':
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
            <form class="form-inline  mr-auto" method="POST" action="TelaCompararComponentes.php" data-toggle="validator" role="form">
                <div>
                  <input type="hidden" name="Item1" id="cod_processo" value="<?php echo $row['ID_Item']; ?>"/> 
                <button type="submit"  class="btn btn-primary mt-2 mr-0 p-2 bd-highlight tamanhoBTNS p-2 bd-highlight">  
                  Comparar
                </button>
                </div>
            </form> 
          </div>
        </li>
             <?php } mysqli_free_result($arrayResult); ?>            
    </div>
</div>
    <?php 
      }else if($_SESSION['tipoBusca'] == 2){
      ?>
      <h5 class="modal-title mb-3 mt-4" align="center"><b>Lista de resultados</b></h5>
      <div  class="container-fluid  d-flex align-items-center flex-column bd-highlight  quadradoListarItens" >
       <div class="container" >
          <div class="divScroll" data-spy="scroll" data-offse="0">
               <?php  
               # echo "Itens retornados: ".count($arrayResult);
             while ($row2 =  mysqli_fetch_array($arrayResult,MYSQLI_ASSOC)) {
               #echo "Palavra chave:".$row2['palavra_chave'];?> 
                <li class="list-group-item list-group-item-primary d-flex bd-highlight mb-3 mr-2">
                  <a class="btn btn-outline-primary tamanhoBTStar mt-3 mr-3 ml-2  p-2 bd-highlight  p-2 bd-highlight" data-toggle="modal" data-target="#ID_Modal_ADD" onclick="setaDadosModal('<?php echo $row2['ID_Projeto']; ?>','<?php echo $row2['nome']; ?>','projeto')"> 
                        <svg id="i-star" viewBox="0 0 43 43" width="30" height="25" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                        </svg>    
                  </a>
                <img src="<?php echo  $row2['img_projeto']; ?>" 
                      class="img mt-1" align="center" width="90" height="65">

                <form class="form-inline  mr-auto" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                  <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $row2['ID_Projeto']; ?>"/> 
                     <button  type="submit" class="btn btn-outline-primary mr-auto ml-3 mb-1 mt-2 border-0 " align="center" ">  
                        <h6 style="text-align:center;">
                          <p>
                          <?php echo  "<b>Nome Item:</b> ".$row2['nome']." <b> Autor Prncipal: </b>". $row2['autor_principal']."</br> <b> Palavras Chave:</b> ". $row2['palavra_chave'];?> 
                         </p>
                       </h6> 
                      </button>
                  </form> 
               </li>
                   <?php } mysqli_free_result($arrayResult); ?>        
          </div>
      </div>
      <?php 
        }else if($_SESSION['tipoBusca'] == 3)
        {
        if(mysqli_num_rows($arrayResult) > 0)
        {       
      ?>
 <h5 class="modal-title mb-3 mt-4" align="center"><b>Componentes</h5>     
 <div class="d-flex justify-content-center">
  <div class="d-flex flex-column bd-highlight "> 
        <div class="p-2 bd-highlight quadradoFavoritos m5-2 ml-2" data-spy="scroll"  data-target="#list-example" data-offset="0" class="scrollspy-example">
            <div class="rounded p-2 bd-highlight " style="width: 990px; height: 480px; overflow-y: scroll;" data-spy="scroll" data-offse="0">
                   <?php              
                     #echo "Itens retornados: ".count($arrayResult);
             while ($row =  mysqli_fetch_array($arrayResult,MYSQLI_ASSOC)) {# echo "Palavra chave:".$row['palavraChave'];?>
              <div class="d-flex justify-content-around">
                        <li class="list-group-item list-group-item-primary d-flex bd-highlight mb-3 mr-2">
                           <!-- Adicionar comportamento de salvar na lista de favoritos -->
                         
                          <a class="btn btn-outline-primary tamanhoBTStar mt-3 mr-3 ml-2  p-2 bd-highlight  p-2 bd-highlight" data-toggle="modal" data-target="#ID_Modal_ADD" onclick="setaDadosModal('<?php echo $row['ID_Item']; ?>','<?php echo $row['nomeItem']; ?>','item')"> 
                            <svg id="i-star" viewBox="0 0 43 43" width="30" height="25" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                            </svg>    
                          </a>
                          <img src="<?php echo  $row['img_componente']; ?>" 
                          class="img mt-1" align="center" width="90" height="65">
                    <?php 
                    switch ($row['categoria']) {
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
                      case 'srojeto':
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
                      <form class="form-inline  mr-auto" method="POST" action="TelaCompararComponentes.php" data-toggle="validator" role="form">
                          <div>
                            <input type="hidden" name="Item1" id="cod_processo" value="<?php echo $row['ID_Item']; ?>"/> 
                          <button type="submit"  class="btn btn-primary mt-2 mr-0 p-2 bd-highlight tamanhoBTNS p-2 bd-highlight">  
                            Comparar
                          </button>
                          </div>
                      </form>                    
                  </li>
               </div>
             <?php } mysqli_free_result($arrayResult); ?> 
             </div>
          </div>
          <?php 
          }
          ?>
<!-- Projetos listados --> 
<?php 
     if(mysqli_num_rows($arrayResult2) > 0)
        { 
 ?>
<h5 class="modal-title mb-3 mt-4" align="center"><b>Projetos</h5>     
<div class="d-flex justify-content-center">
 <div class="d-flex flex-column bd-highlight "> 
       <div class="p-2 bd-highlight quadradoFavoritos m5-2 ml-2" data-spy="scroll"  data-target="#list-example" data-offset="0" class="scrollspy-example">
             
             <div class=" rounded" style="width: 990px; height: 480px; overflow-y: scroll;"data-spy="scroll" data-offse="0">
                 <?php  
                         # echo "Itens retornados: ".count($arrayResult);
              while ($row2 =  mysqli_fetch_array($arrayResult2,MYSQLI_ASSOC)) {
                  ?> 
              <div class="d-flex justify-content-around">
              <li class="list-group-item list-group-item-primary d-flex bd-highlight mb-3 mr-2">
                  <a class="btn btn-outline-primary tamanhoBTStar mt-3 mr-3 ml-2  p-2 bd-highlight  p-2 bd-highlight" data-toggle="modal" data-target="#ID_Modal_ADD" onclick="setaDadosModal('<?php echo $row2['ID_Projeto']; ?>','<?php echo $row2['nome']; ?>','projeto')"> 
                    <svg id="i-star" viewBox="0 0 43 43" width="30" height="25" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                       <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                    </svg>    
                  </a>
                  <img src="<?php echo  $row2['img_projeto']; ?>" 
                                class="img mt-1" align="center" width="90" height="65">

                    <form class="form-inline  mr-auto" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                    <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $row2['ID_Projeto']; ?>"/> 
                      <button  type="submit" class="btn btn-outline-primary mr-auto ml-3 mb-1 mt-2 border-0 " align="center" ">  
                       <h6 style="text-align:center;">
                          <p>
                            <?php echo  "<b>Nome Item:</b> ".$row2['nome']." <b> Autor Prncipal: </b>". $row2['autor_principal']."</br> <b> Palavras Chave:</b> ". $row2['palavra_chave'];?> 
                          </p>
                      </h6> 
                      </button>
                    </form> 
                  </li>        
                </div>
              <?php } mysqli_free_result($arrayResult2); ?>
            </div>
       </div>
    </div>
  </div>
  <?php 
    }
}
   ?>
<!--   ========================= Modal ADD ========================   -->
        <div class="modal fade" id="ID_Modal_ADD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
             <div class="modal-dialog" role="document">
              
              
                  <div class="modal-content"  >
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Favoritar Item?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group">
                            <input type="hidden" id="ID_Item_ADD" name="Nome_Item_ADD">
                            <label for="recipient-name" class="col-form-label">Tem certeza que deseja adicionar o Componente aos favoritos? <label id="Nome_Item_ADD" name="Item_ADD">?</label>
                            </label>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <form method="POST" action="TelaListarComponente.php" >
                        <input type="hidden" name="ItemAdicionado" id="ItemParaAdicionar"/>
                        <input type="hidden" name="tipoEnviado" id="ID_tipoEnviado"/>
                        <button type="submit" class="btn btn-primary mt-1">        
                        <svg id="i-archive" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M4 10 L4 28 28 28 28 10 M2 4 L2 10 30 10 30 4 Z M12 15 L20 15"  />
                        </svg>
                            Adicionar
                        </button>
                      </form>
                      </div>
                  </div>
              </div>
         </div>
      <!--   =============================== Fim Modal =========================================   -->


      <!-- <button type="button" class="btn btn-primary">Primary</button> -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/dist/jQuery.js"></script>
    <script src="popper.js/dist/umd/popper.js"></script>
    <script src="bootstrap/dist/js/bootstrap.js"></script>
  </body>
</html>
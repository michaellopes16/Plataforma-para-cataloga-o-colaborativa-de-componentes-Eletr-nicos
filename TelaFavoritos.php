<?php 
session_start();
include_once("conexao/Fachada.class.php");
include_once("conexao/MicrocontroladorVO.class.php");

$ID_ItemAtual = $_SESSION["nomeUser"] ;
$_SESSION["excluiu"] = false;

$fachada = new Fachada;
$_SESSION['itemClicado']= null;
$_SESSION['tipo'] = null;
$temComponente = false;
$ID_Item_Atual = '';
$itemAtual;
$tipo = null;
$exclusaoResult = 0;
$imprimir = "";
$tipoAlert = "alert alert-success";
$labelAlerta = '';

if(isset($_POST['ItemExcluir']) || !empty($_POST['ItemExcluir']))
{     
      $itemAtual =  $_POST['ItemExcluir'];
      $tipo = $_POST['tipoExcluir'];
      $_SESSION['tipo'] = $tipo;

      #echo "Nome item atual: ".$itemAtual. "</br> DO tipo: ".$tipo;
       $exclusaoResult  = $fachada->excluirFavorito($itemAtual,$tipo); 
       if ($exclusaoResult == 1) {
          $imprimir = "Item Já cadastrado!";
          $tipoAlert = "alert alert-warning alert-dismissible fade show";
          $labelAlerta = 'Atenção! ';
       }else if ($exclusaoResult == 2) {
          $imprimir = "Erro ao excluir item!";
          $tipoAlert = "alert alert-danger";
          $labelAlerta = 'Erro! ';
       }else if($exclusaoResult != 0 && $exclusaoResult >2)
       {
         # header("Refresh: 0");
          $_SESSION["excluiu"] = true;
          $imprimir = " Componente excluido com sucesso!";
          $tipoAlert = "alert alert-success";
          $labelAlerta = 'Sucesso! ';
       } 

}else
{
  #echo "Erro ao excluir ";
}
#$micro = new MicrocontroladorVO;
$linkCategoria = "#";
$arrayResultItem  = $fachada->exibirFavoritoPorUsuario($_SESSION["nomeUser"]);

$arrayResultProjeto = $fachada->exibirProjetoFavoritosPorUsuario( $_SESSION["nomeUser"]);

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
     function setaDadosModal(ID_Item,nome,tipo) {
        alert(nome);
        document.getElementById('Nome_Item_Ex').innerHTML = nome;
        document.getElementById('ID_Item_Excluir').value = ID_Item;
        document.getElementById('tipo').value = tipo;
        
    }
    </script>

    <title>Eletronics Component Catalog</title>
  </head>
  <body>

<!--   ============================ Cabeçalho ===============================================--> 
<?php  
if(isset($_SESSION["excluiu"]) || !empty($_SESSION["excluiu"]))
{
  #echo "Valor variável excluiu: ".$_SESSION["excluiu"];
   if($_SESSION["excluiu"] == true ){
   ?>
      <div class="<?php echo($tipoAlert) ?>" role="alert" align="center">
        <strong><?php echo($labelAlerta) ?></strong> <?php echo($imprimir) ?>
        <button type="button" class="close" data-dismiss="alert" arial-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <?php
    $_SESSION["excluiu"] = false;
    }
}
?>

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
         <a href="#" class="btn btn-secondary  mr-2 ml-2 mr-auto p-2 bd-highlight"  disabled="true">
          <svg  id="i-star" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
              <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
          </svg>  
         Favoritos</a>
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

<!--   ===================  Início do corpo principal=======================================   -->

<?php  
if(isset($_SESSION["excluiu"]) || !empty($_SESSION["excluiu"]))
{
  #echo "Valor variável excluiu: ".$_SESSION["excluiu"];
   if($_SESSION["excluiu"] == true ){
   ?>
      <div class="<?php echo($tipoAlert) ?>" role="alert" align="center">
        <strong><?php echo($labelAlerta) ?></strong> <?php echo($imprimir) ?>
        <button type="button" class="close" data-dismiss="alert" arial-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
  <?php
    $_SESSION["excluiu"] = false;
    }
}
?>


 <h5 class="modal-title mb-3 mt-4" align="center"><b>Componentes Favoritos</h5>
 <div class="d-flex justify-content-center">
  <div class="d-flex flex-column bd-highlight "> 
      <div class="p-2 bd-highlight quadradoFavoritos m5-2 ml-2" data-spy="scroll"  data-target="#list-example" data-offset="0" class="scrollspy-example">
          
      <div class="rounded p-2 bd-highlight " style="width: 990px; height: 480px; overflow-y: scroll;" data-spy="scroll" data-offse="0">
      <?php 
      
      while ($row =  mysqli_fetch_array($arrayResultItem,MYSQLI_ASSOC)) { 
        ?>
  <div class="d-flex justify-content-around">
       <li class="list-group-item list-group-item-primary d-flex bd-highlight mt-2 mr-2 rounded">
            <label for="recipient-name" class="col-form-label mt-2" >
                  <svg  id="i-star" viewBox="0 0 43 43" width="40" height="40" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" >
                      <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                  </svg>    
                </label>
                <img src="<?php echo  $row['img_componente']; ?>"  class="img mt-1" align="center" width="90" height="65">
                <?php 
                #$linkCategoria= '';
                if(isset($row['categoria']))
                {
                    $_SESSION['tipo'] = "item";
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
                  } 
                }
                ?>
           <form class="form-inline  mr-auto" method="POST" action="<?php echo $linkCategoria;?>" data-toggle="validator" role="form">
            <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $row['ID_Item']; ?>"/> 
            <input type="hidden" name="tipo" id="ID_Tipo" value="<?php echo "item"; ?>"/> 
               <button  type="submit" class="btn btn-outline-primary mr-auto ml-3 mb-1 mt-2 border-0 " align="center" ">  
                  <h6 style="text-align:center;">
                    <p>
                    <?php echo  "<b>Nome Item:</b> ".$row['nomeItem']." <b> Preço Médio: </b> R$ ". $row['precoMedio']."</br> <b> Palavras Chave:</b> ". $row['palavraChave'];?> 
                   </p>
                 </h6> 
                </button>
            </form> 
            <div>
                 <button class="btn btn-danger mt-3 tamanhoBTNS" data-toggle="modal" data-target="#ID_Modal_Excluir_Projeto" onclick="setaDadosModal('<?php echo $row['ID_Item']; ?>','<?php echo $row['nomeItem']; ?>',1)">    
                  <svg id="i-trash" viewBox="0 0 33 30" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                  </svg> 
                  Excluir
                </button>
            </div>
          </li>
      </div>
          <?php } mysqli_free_result($arrayResultItem); ?>
       </div>
    </div>

<!-- Projetos favoritos --> 

     <h5 class="modal-title mb-3 mt-4" align="center"><b>Projetos Favoritos</h5>
    <div class="p-2 bd-highlight  quadradoFavoritos mr-2 ml-2" data-spy="scroll"  data-target="#list-example" data-offset="0" class="scrollspy-example">
          
      <div class=" rounded" style="width: 990px; height: 480px; overflow-y: scroll;"data-spy="scroll" data-offse="0">
      <?php 
      while ($row =  mysqli_fetch_array($arrayResultProjeto,MYSQLI_ASSOC)) { #echo "Palavra chave:".$row['palavraChave'];
        ?>
        <!-- Inserir componentes dessa lista em um for do tamanho do retorno -->
    <div class="d-flex justify-content-around">
       <li class="list-group-item list-group-item-primary d-flex bd-highlight mt-2 mr-2 rounded">
            <label for="recipient-name" class="col-form-label mt-2" >
                  <svg  id="i-star" viewBox="0 0 43 43" width="40" height="40" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" >
                      <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                  </svg>    
            </label>
            <img src="<?php echo  $row['img_projeto']; ?>"  class="img mt-1" align="center" width="90" height="65">
        <form class="form-inline  mr-auto" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $row['ID_Projeto']; ?>"/>
                <input type="hidden" name="tipo" id="ID_Tipo" value="<?php echo "projeto"; ?>"/>  
                 <button  type="submit" class="btn btn-outline-primary mr-auto ml-3 mb-1 mt-2 border-0 " align="center" ">  
                  <h6 style="text-align:center;">
                    <?php echo  "<b>Nome Projeto:</b> ".$row['nome']." <br><b> Autor principal: </b> R$ ". $row['autor_principal']."</br> <b> Palavras Chave:</b> ". $row['palavra_chave'];?> 
                 </h6> 
                </button>
        </form>
              <div>
                <button class="btn btn-danger mt-3 tamanhoBTNS" data-toggle="modal" data-target="#ID_Modal_Excluir_Projeto" onclick="setaDadosModal('<?php echo $row['ID_Projeto']; ?>','<?php echo $row['nome']; ?>',2)">  
                  <svg id="i-trash" viewBox="0 0 33 30" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                      <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                  </svg> 
                  Excluir
                </button>
                </div>
              </li>
          </div>
          <?php } mysqli_free_result($arrayResultProjeto); ?>
       </div>
    </div>
</div>
</div>   
<!--   ========================= Modal Excluir ========================   -->
        <div class="modal fade" id="ID_Modal_Excluir_Projeto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
             <div class="modal-dialog" role="document">
                  <div class="modal-content"  >
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Excluir o Item?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form>
                          <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Tem certeza que deseja retirar <label id="Nome_Item_Ex" name="Item_ADD">?</label> dos favoritos?
                            </label>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <form method="POST" action="TelaFavoritos.php" >
                        <input type="hidden" name="ItemExcluir" id="ID_Item_Excluir"/>
                        <input type="hidden" name="tipoExcluir" id="tipo"/>

                        <button type="submit" class="btn btn-danger mt-1">        
                                <svg id="i-trash" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                                </svg>
                                 Excluir
                        </button>
                      </form>
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

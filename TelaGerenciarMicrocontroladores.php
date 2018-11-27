<?php 
session_start();
include_once("conexao/Fachada.class.php");

$ID_ItemAtual = $_SESSION["nomeUser"] ;
$_SESSION["excluiu"] = false ;

$fachada = new Fachada;
#$micro = new MicrocontroladorVO;
$temComponente = false;
$ID_Item_Atual = '';
$itemAutal;
$exclusaoResult = 0;
$imprimir = "";
$tipoAlert = "alert alert-success";
$labelAlerta = '';

if(isset($_POST['ItemExcluir']) || !empty($_POST['ItemExcluir']))
{     

      $itemAutal =  $_POST['ItemExcluir'];
     # echo "Nome item atual: ".$itemAutal. "</br>";
       $exclusaoResult  = $fachada->excluirMicrocontrolador($itemAutal); 
       if ($exclusaoResult == 1) {
          $imprimir = "Item Já cadastrado!";
          $tipoAlert = "alert alert-warning alert-dismissible fade show";
          $labelAlerta = 'Atenção! ';
       }else if ($exclusaoResult == 2) {
          $imprimir = "Erro ao inserir item!";
          $tipoAlert = "alert alert-danger";
          $labelAlerta = 'Erro! ';
       }else if($exclusaoResult != 0 && $exclusaoResult >2)
       {
          $_SESSION["excluiu"] = true;
          $imprimir = " Componente excluido com sucesso!";
          $tipoAlert = "alert alert-success";
          $labelAlerta = 'Sucesso! ';
       } 

}else
{
  #echo "Erro ao excluir ";
}

$arrayResult  = $fachada->exibirMicroPorCategoria($ID_ItemAtual);


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
    $_SESSION["excluiu"] = false ;
    }
}
?>

  <h5 class="modal-title mb-3 mt-4" align="center"><b>Gerenciar Microcontroladores</b></h5>
     <div data-spy="scroll" class="container-fluid  d-flex align-items-center flex-column bd-highlight  quadradoGerenciamentoItem scrollspy-example" >
      
      <div data-spy="scroll" class="container" >

          <div class="divScroll" data-spy="scroll" data-offse="0" style="background-image: url(img/bg.png); background-repeat: no-repeat; background-position: 120px 20px;">
              <!-- Inserir componentes dessa lista em um for do tamanho do retorno -->
               <?php 

      while ($row =  mysqli_fetch_array($arrayResult,MYSQLI_ASSOC)) { #echo "Palavra chave:".$row['palavraChave'];
         
        ?>
           
          <li class="list-group-item list-group-item-primary  mb-3 mr-2" >
                 <!-- Adicionar comportamento de salvar na lista de favoritos -->   
          <div class="row" align="start">
            <div class="col-md-2.5 ml-2 ">     
                  <a href="#" class="btn btn-outline-primary tamanhoBTStar mt-3 mb-3" align="center"> 
                    <svg id="i-star" viewBox="0 0 40 40" width="20" height="22" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
                    </svg>    
                  </a>
                  <img src="<?php echo  $row['img_componente']; ?>" 
                  class="img mt-1 ml-2" align="center" width="90" height="65">
            </div>

            <div class="col-md-6 mr-4 ml-5">
              <form method="POST" action="TelaExibirMicrocontrolador.php" data-toggle="validator" role="form" align="center" >
                <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $row['ID_Item']; ?>"/> 
                   <button  type="submit" class="btn btn-outline-primary  mb-1 mt-2 border-0 ">  
                      <h6 style="text-align:center;">
                        <p>
                        <?php echo  "<b>Nome Item:</b> ".$row['nomeItem']." <b> Preço Médio: </b> R$ ". $row['precoMedio']."</br> <b> Palavras Chave:</b> ". $row['palavraChave'];?> 
                       </p>
                     </h6> 
                    </button>
              </form>
            </div>
            
            <div class="col-md-1 ml-0 mr-2" align="end">
              <form  class="" method="POST" action="TelaEditarMicrocontrolador.php" data-toggle="validator" role="form">
                  <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $row['ID_Item']; ?>"/> 
                     <button  type="submit" class="btn btn-primary mt-3  tamanhoBTNS" align="center" ">  
                           <svg id="i-edit" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                            <path  d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z"  />
                        </svg>   
                        Editar
                      </button>
              </form> 
             </div>
             
             <div class="col-md-1 ml-3" align="center">


              <button class="btn btn-danger mt-3 tamanhoBTNS" data-toggle="modal" data-target="#ID_Modal_Excluir" action="<?php $ID_ItemAtual = $row['ID_Item']; $itemAutal =  $row; ?>">  
                    <svg id="i-trash" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                    </svg>    
                 Excluir
              </button>
            </div>
          </div>
      <?php } mysqli_free_result($arrayResult); ?>  
<!--Fim da informações do Primeiro Item da Lista. Os outros deverão ser retirados e a geração deve vir a partir de um laço -->       
      </div>
  </div>
      <a href="TelaInserirMicrocontrolador.php" class="btn btn-primary p-2 bd-highlight mt-4 mb-3 ml-4">
      <svg id="i-compose" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
          <path d="M27 15 L27 30 2 30 2 5 17 5 M30 6 L26 2 9 19 7 25 13 23 Z M22 6 L26 10 Z M9 19 L13 23 Z"  />
      </svg>
    Inserir Novo
    </a>
</div>             
 </div>
<!--   ========================= Modal Excluir =========================================   -->
                <div class="modal fade" id="ID_Modal_Excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
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
                            <label for="recipient-name" class="col-form-label">Tem certeza que deseja excluir o Componente <?php echo $itemAutal['nomeItem']?>?</label>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">

                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <form method="POST" action="TelaGerenciarMicrocontroladores.php" >
                          <input type="hidden" name="ItemExcluir" id="ItemExcluir" value="<?php echo $ID_ItemAtual; ?>"/> 
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
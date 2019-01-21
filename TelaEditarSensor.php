<?php session_start();
include_once("conexao/Fachada.class.php");

$_SESSION["ID_Item"]= array();
$_SESSION["Nome_Item"]= array();
$_SESSION['Excluir'] = '';

if(isset($_POST["ItemPesquisa"])){

  $idItem = $_POST["ItemPesquisa"];
  $_SESSION["itemAtual"] = $idItem; 
  #echo "Item pesquisa no Tela Exibir: ".$idItem."</br>";
} 


if( isset($_SESSION["itemAtual"]))
{
  $idItem = $_SESSION["itemAtual"];
}

$fachada = new Fachada;

$arrayResult  = $fachada->exibirSensor($idItem);

$_SESSION["itemAtual"] = $idItem;
$ID_Micro_Compativeis = '';

$resultCompativel = $fachada->SensorGetCompativel($idItem);
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/compiler/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
     <script type="text/javascript">
        $("#ID_Campo_PM").mask("#.##0,00", {reverse: true});
     </script>

    <title>Eletronics Component Catalog</title>
  </head>
  <body>

<!--   ============================ Cabeçalho ===================================================-->  
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


 <h5 class="modal-title mb-3 mt-4" align="center"><b>Editar Informações do Sensor</b></h5>
  <!--   
   <div class="form-row"> 

    
     <div id="list-example" class="list-group col-md-2 mt-4" align="start">
       <a class="list-group-item list-group-item-action" href="#list-item-1">Informações Gerais</a>
       <a class="list-group-item list-group-item-action" href="#list-item-2">Informações Técnincas</a>
       <a class="list-group-item list-group-item-action" href="#list-item-3">Informações Elétricas</a>
       <a class="list-group-item list-group-item-action" href="#list-item-4">Interfaces de Comunicação</a>
       <a class="list-group-item list-group-item-action" href="#list-item-5">Componentes Adicionais</a>
     </div>
   -->

     <div class="container-fluid  d-flex flex-column bd-highlight  quadradoInserirShield  col-md-10" data-spy="scroll"  data-target="#list-example" data-offset="0" class="scrollspy-example">
      
      <div class="container-fluid  align-items-center ">
       <form  class="tamnhoForm" method="POST" action="ControleSensorUpdate.php" role="form" enctype="multipart/form-data" data-toggle="validator">

 <!--   =============================   Informações Gerais   ============================================   -->
         <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
        
        <!--   ====================== Carregamento das imagens =========================================   -->
       
        <div class="form-row" align="start">

          <div class="form-group col-md-5" align="start">
            
            <img src="<?php echo $arrayResult['img_componente']; ?>" id="ID_IMG_Componente"  class="img mt- border border-primary rounded" width="130" height="80">
            <input type="file" name="caminho_img_componente" class="form-control-file" id="ID_Enviar_Foto">
            <label class="custom-file-label" for="ID_Enviar_Foto">Imagem do Componente</label>
          </div>  
        </div>
<!--   =============================== Linha 1 ================================   -->

 <div class="form-row" align="center">
   <div class="form-group col-md-4" align="start">
     <label for="ID_Campo_Nome" >Nome</label>
     <input type="text" class="form-control" name="nome" value="<?php echo $arrayResult['nome']; ?>" id="ID_Campo_Nome" placeholder="">
   </div>
   <div class="form-group col-md-4" align="start">
     <label for="ID_Campo_Modelo">Modelo</label>
     <input type="text" class="form-control" name="tipo" value="<?php echo $arrayResult['tipo']; ?>" id="ID_Campo_Modelo" placeholder="">
   </div>
   <div class="form-group col-md-4" align="start">
     <label for="ID_Campor_TO">Temperatura de operação</label>
     <input type="text" class="form-control" name="temperatura_ope" value="<?php echo $arrayResult['temperaturaOperacao']; ?>" id="ID_Campor_TO" placeholder="Temp. Mínima e Máxima em Cº">
   </div>
 </div>
          <!--   =============================== Linha 2 =========================================   -->
      
           <div class="form-row">
            <div class="form-group col-md-4" align="start">
              <label for="ID_Dimensoes">Dimensões</label>
              <input type="text" class="form-control" name="dimensao" value="<?php echo $arrayResult['dimensao']; ?>" id="ID_Dimensoes" placeholder="00cm X 00cm X 00 cm">
            </div>
            <div class="form-group col-md-4" align="start">
                <label for="ID_Data_Sheet" >Link DataSheet</label>
                <input type="link" class="form-control" name="link_DS" value="<?php echo $arrayResult['linkDataSheet']; ?>" id="ID_Data_Sheet" placeholder="https:// ...">
            </div>
           <div class="form-group col-md-4" align="start">
             <label for="inputPassword4">Preço Médio</label>
             <input type="text" class="form-control" name="preco_medio" value="<?php echo "R$ ". $arrayResult['precoMedio']; ?>" id="ID_Campo_PM" placeholder="R$ 0,00">
           </div>
            </div>

<!--   =============================== Linha 3 ==============================   -->
  

         <!--   =============================== Linha 4 =========================================   -->
         <div class="form-row">
           <div class="form-group col-md-4" align="start">
             <label for="ID_Campo_Palavra-Chave">Palavras-Chave</label>
             <input type="text" class="form-control" name="palavra_chave" value="<?php echo $arrayResult['palavraChave']; ?>" id="ID_Campo_Palavra-Chave" placeholder="Palavra1, Palavra2, ..">
           </div>
            <div class="form-group col-md-4" align="start">
              <label for="ID_funcao">Funsão Principal</label>
              <input type="text" class="form-control" name="funcao" value="<?php echo $arrayResult['funcao']; ?>" id="ID_funcao">
            </div>                  
         </div>
        <div class="form-row">
         <input type="hidden" name="compativel" value="<?php echo $ID_Micro_Compativeis ?> "/>
            <a href="#" class="btn btn-outline-primary mt-4 mr-3 ml-3 p-2 col-md-2" style="height: 45px;" data-toggle="modal" data-target="#ID_Modal_Adicionar_Item">  
                    Adicionar Item
            </a>
            <div class="form-group col-md-4">
               <label for="ID_Campo_Funcao" >Compatível com:</label>
                  <div id="e_compativel" class="divScrolComp rounded" data-spy="scroll" data-offse="0">
                          <!-- Inserir componentes dessa lista em um for do tamanho do retorno -->
                   <?php      

                    while ($row =  mysqli_fetch_array($resultCompativel,MYSQLI_ASSOC)) {
                      array_push($_SESSION['ID_Item'],$row ['ID_Item']);
                      array_push($_SESSION['Nome_Item'],$row ['nomeItem']);
                                
                  ?>
                        <li class="list-group-item list-group-item-primary d-flex bd-highlight mt-2 mr-2 rounded" style="height: 60px;">
                         <h6 style="text-align:center;" mr-auto ml-3 mb-3 mt-3 " align="center">                                  
                        <?php echo $row['nomeItem']; ?> 
                        </h6> 
                        <div>
                          <a href="#" id="<?php echo $row['ID_Item'] ?>" class="btn btn-danger mt-0 mr-0 ml-2"  data-toggle="modal" data-target="#ID_Modal_Excluir_Item">  
                          <svg id="i-trash" viewBox="0 0 33 30" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                          <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                         </svg> 
                         </a>
                        </div>
                       </li>                      
                    <?php } mysqli_free_result($resultCompativel); ?>  
                           
                    </div>
              </div>        
          </div>
 <!--   =============================   Informações Elétricas   ============================================   -->       
      <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-3" align="start">Informações Elétricas</h4>
<!--   =============================== Linha 1 =========================================   -->
       <div class="form-row">
          <div class="form-group col-md-6" align="start">
            <label for="ID_Tensao_Nominal">Tensão Nominal (operação)</label>
            <input type="link" class="form-control" name="tensao_nom" value="<?php echo $arrayResult['tensaoOperacao']; ?>" id="ID_Tensao_Nominal" placeholder="Em Volts">
          </div>
          <div class="form-group col-md-6" align="start">
               <label for="ID_Dimensoes">Tensão de Saída</label>
               <input type="text" class="form-control" name="tensaoSaida" value="<?php echo $arrayResult['tensaoSaida']; ?>" id="ID_TensaoSaida" placeholder="em volts">         
          </div>
       </div>          

<!--   =============================   Componentes Adicionais   =========================================   -->              
       <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-5" align="start">Informações Adicionais</h4>

         <div class="form-group" align="start">
             <label for="exampleFormControlTextarea1">Informações Adicionais</label>
             <textarea class="form-control" name="info_add" id="ID_Campo_Ind_Add" rows="10" style="resize: none" placeholder="Digite aqui alguma informação sobre o componete que não está em um dos campos acima...">
               <?php echo $arrayResult['infoAdicionais']; ?>
             </textarea>

      </div>

<!--   =============================   Botão Salvar  =========================================   -->                
     <button type="submit" class="btn btn-primary mt-5 mb-3 ml-4" align="center">
       <svg id="i-archive" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
           <path d="M4 10 L4 28 28 28 28 10 M2 4 L2 10 30 10 30 4 Z M12 15 L20 15"  />
       </svg>
     Atualizar
     </button>
<!--   =============================   Fim do formulário =========================================   -->
    </form>
  </div>
</div>

<!--   =============================== Modal ADD Item =========================================   -->
    <div class="modal fade" id="ID_Modal_Adicionar_Item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="ID_laberAddItem">Adicionar Novo Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Insira o nome do novo Item</label>
                <input type="text" class="form-control mb-3" id="ID_Busca_Item">

                <div data-spy="scroll" id="resultado" style="width: 100%;"></div>
                
                <div data-spy="scroll" id="adicionados" style="width: 100%;border:1px solid #222;"> </div>

                <script>
                  $("#ID_Busca_Item").keyup(function(){
                    $.ajax({
                        url : 'ControleBuscaItem.php',
                        type: 'POST',
                        data:{ID_Busca_Item:$('#ID_Busca_Item').val()},
                       
                        success: function(data)
                        {
                            $("#resultado").html(data); 
                        }, error:function()
                        {
                          $("#resultado").html("Houve um erro!");
                        }
                    });
                  });
            </script>
            <script>
                  $("body").on('click', '#resultado button', function(){
                   
                    var id = $(this).attr('id');
                    var item = id.split(':');


                    $.ajax({
                        url : 'ControleBuscaItem.php',
                        type: 'POST',
                        data:{ID_Item:item[0], Nome_Item:item[1] },
                       
                        success: function(retorno)
                        {
                            if(retorno == -1)
                            {
                              alert("Item já adicionado!");
                            }else{
                              $("#adicionados").html(retorno);
                            } 
                        }, error:function()
                        {
                          $("#adicionados").html("Houve um erro ao adicionar!");
                        }
                    });
                  });
                                      
                </script>

              </div>
            </form>

          </div>
          <div id="fechar" class="modal-footer">
            <button type="button" id="ok" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
          </div>

          <script>
            $("body").on('click', '#fechar button', function(){
               var id = $(this).attr('id');

               $.ajax({
                   url : 'ControleBuscaItem.php',
                   type: 'POST',
                   data:{ID_Fechar:id },
                  
                   success: function(retorno)
                   {
                       if(retorno == -1)
                       {
                         alert("Item já adicionado!");
                       }else{
                         $("#e_compativel").html(retorno);
                       } 
                   }, error:function()
                   {
                     $("#e_compativel").html("Houve um erro ao adicionar!");
                   }
               });
             });                  
          </script>
        </div>
      </div>
    </div>
<!--   =============================== Modal ADD Excluir =========================================   -->
     <div class="modal fade" id="ID_Modal_Excluir_Item" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="ID_laberExcluir_Item">Excluir Item</h5>
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
             </button>
           </div>
           <div class="modal-body">
             <form>
               <div class="form-group">
                 <label for="recipient-name" class="col-form-label">Tem certeza que deseja Excluir o Item?</label>
               </div>
             </form>

           </div>
           <div id="ID_DIV_Excluir" class="modal-footer">
            <!-- ver se dá pra tirar esses botões depois-->
             <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
             <button id="bt_excluir" type="button" class="btn btn-danger" data-dismiss="modal">Sim</button>
             <script>
               $("body").on('click', '#ID_DIV_Excluir button', function(){
                  var id = $(this).attr('id');

                  if(id == "bt_excluir"){

                    alert("CLicou no sim:"+id);

                      $.ajax({
                          url : 'ControleBuscaItem.php',
                          type: 'POST',
                          data:{ID_TirarDaLista:id },
                         
                          success: function(retorno)
                          {
                              if(retorno == -1)
                              {
                                alert("Item já adicionado!");
                              }else{
                                $("#e_compativel").html(retorno);
                              } 
                          }, error:function()
                          {
                            $("#e_compativel").html("Houve um erro ao adicionar!");
                          }
                      });
                   } 
                });      

             </script>

             <script>
               $("body").on('click', '#e_compativel a', function(){
                  var id = $(this).attr('id');
                  
                  $.ajax({
                      url : 'ControleBuscaItem.php',
                      type: 'POST',
                      data:{ID_Excluir:id },
                     
                      success: function(retorno)
                      {
                          if(retorno == -1)
                          {
                            alert("Item já adicionado!");
                          }else{
                            $("#ID_DIV_Excluir").html(retorno);
                          } 
                      }, error:function()
                      {
                        $("#ID_DIV_Excluir").html("Houve um erro ao adicionar!");
                      }
                  });
                });                  
             </script>
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
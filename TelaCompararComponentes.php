<?php 
session_start();
include_once("conexao/Fachada.class.php");
include_once("conexao/MicrocontroladorVO.class.php");


$fachada = new Fachada;

;
$_SESSION['componente1'] = array();
$_SESSION['componente2'] = array();
$_SESSION['categoriaAtual'] = null;
$imgComponente1 = 'img/item.png';
if(isset($_POST['Item1'])){
 $itemAtual  = $_POST['Item1'];
$_SESSION['ID_Item'] = $itemAtual ;
#$_SESSION['ID_Item2'] = null;
#echo "ID Item1- Session: ".$_SESSION['ID_Item'];
#$micro = new MicrocontroladorVO;
$_SESSION['componente1'] = null;
$arraySegundoItem = null;
$resultCompativel = null;
$arrayResult  = $fachada->exibirItemPorID($itemAtual);
$_SESSION['categoriaAtual'] =$arrayResult['categoria'];

  switch ($arrayResult['categoria']) {
    case 'microcontrolador':
       $_SESSION['componente1'] = $fachada->exibirMicrocontrolador($itemAtual);
      break;
    case 'bateria':
       $_SESSION['componente1'] = $fachada->exibirBateria($itemAtual);
      break;
    case 'sensor':
        $_SESSION['componente1'] = $fachada->exibirSensor($itemAtual);
        $resultCompativel = $fachada->sensorGetCompativel($itemAtual);
        break;
    case 'atuador':
        $_SESSION['componente1'] = $fachada->exibirAtuador($itemAtual);
        $resultCompativel = $fachada->atuadorGetCompativel($itemAtual);
        break;
    case 'shield':
       $_SESSION['componente1'] = $fachada->exibirShield($itemAtual);
       $resultCompativel = $fachada->shieldGetCompativel($itemAtual);
        break;
  }

  $_SESSION['projetosItem1'] = $fachada->buscarProjetosRelacionados($itemAtual);
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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

<!--   ===================  Início do corpo principal=======================================   -->


 <h5 class="modal-title mb-3 mt-4" align="center"><b>Adicionar componentes para comparação</b></h5>
<div  class="container-fluid  d-flex align-items-center flex-column bd-highlight  quadradoCompararItem" >
  <?php
    $nomeCampo1 = '';
  if (isset($arrayResult['nomeItem'])) {
     $nomeCampo1 = $arrayResult['nomeItem'];
     $imgComponente1 = $arrayResult['img_componente'];

   } 
   ?>
    <div class="row mt-5" style=" width: 900px;">
        <div class="col-md-4 mr-3" style='position:relative; top:20px; left:0px;'>
          <img src="<?php echo $imgComponente1; ?>" id="ID_IMG1" width="200" height="150"  border=0>
          <form class="form-inline">  
            <div style='position:absolute; top:60px; left:30px;'>    
              <input class="form-control ml-4 mr-2" id="ID_Busca_Item1" value="<?php echo $nomeCampo1;?>" type="search" size="25" placeholder="Buscar..." >
              <div data-spy="scroll" id="resultadoCampo1" style="width: 100%;"></div>      
               <script>
                    var count = 0;
                    $("#ID_Busca_Item1").keyup(function(event){
                      var valorBuscar1 = $(this).val();
                      var KeyID = event.keyCode;
                      if(KeyID==8 || KeyID == 46){
                        count = count+1;
                        if(count > 4)
                        {
                          document.getElementById('ID_Busca_Item1').value = '';
                          count =0;
                        }
                      }

                      if(valorBuscar1.length >= 3)
                      {

                         document.getElementById("ID_Busca_Item2").disabled = false;
                         document.getElementById("ID_BT_Comparar").disabled = false;
                       
                      $.ajax({
                          url : 'ControleBuscaComparar.php',
                          type: 'POST',
                          data:{ID_Busca_Item:$('#ID_Busca_Item1').val()},
                         
                          success: function(data)
                          {
                              $("#resultadoCampo1").html(data); 
                          }, error:function()
                          {
                            $("#resultadoCampo1").html("Houve um erro!");
                          }
                      });

                      }else
                      {
                        document.getElementById("ID_Busca_Item2").value = "";
                        document.getElementById("ID_IMG2").src = "img/item.png";
                        document.getElementById("ID_Busca_Item2").disabled = true; 
                        document.getElementById("minhaDiv").style.display = "none";
                        document.getElementById("ID_BT_Comparar").disabled = true; 
          
                      }

                    });
              </script> 
              <script>
                    $("body").on('click', '#resultadoCampo1 button', function(){
                     
                      var id = $(this).attr('id');
                      var item = id.split(':');

                      document.getElementById("ID_Busca_Item1").value =item[1] ;
                      document.getElementById("ID_Busca_Item2").disabled = false;
                      document.getElementById("ID_IMG1").src = item[2];
                      $.ajax({
                          url : 'ControleBuscaComparar.php',
                          type: 'POST',
                          data:{ID_Item:item[0], Nome_Item:item[1],c1:item[3]},
                         
                          success: function(retorno)
                          {
                              if(retorno == -1)
                              {
                                alert("Item já adicionado!");
                              }else{
                                $("#minhaDiv").html(retorno);
                                $("#resultadoCampo1").html("");
                              } 
                          }, error:function()
                          {
                            $("#minhaDiv").html("Houve um erro ao adicionar!");
                          }
                      });
                    });
                                        
                  </script> 
            </div>
          </form>
          <div style='position:absolute; top:70px; left:320px;'>
              <h1><b>+</b></h1>
          </div>
        </div>
        <div class="col-md-4 ml-3" style='position:relative; top:20px; left:0px;' style="height: 170px;">
            <img src="img/Item.png" id="ID_IMG2" width="190" height="150"  border=0>
              <form class="form-inline">  
                <div style='position:absolute; top:60px; left:30px;'>    
                <?php if(isset($itemAtual)){ ?>
                    <input class="form-control ml-2 mr-2" id="ID_Busca_Item2" type="search" size="25" placeholder="Buscar..." > 
                    <?php
                     }else{ 
                     ?>
                     <input class="form-control ml-2 mr-2" id="ID_Busca_Item2" type="search" size="25" placeholder="Buscar..." disabled="">
                   <?php } ?>
                   <input type="hidden" name="ItemPesquisa" id="ID_Categoria" value="<?php echo $_SESSION['categoriaAtual']; ?>"/>
                   <div data-spy="scroll" id="resultadoCampo2" style="width: 100%; height: 50%;"></div>
                     <script>
                          $("#ID_Busca_Item2").keyup(function(){
                            var valorBuscar2 = $(this).val();
                            var categoria = document.getElementById("ID_Categoria").value;

                            if(valorBuscar2.length >= 2)
                            { 
                              document.getElementById("ID_BT_Comparar").disabled = false;
                            $.ajax({
                                url : 'ControleBuscaComparar.php',
                                type: 'POST',
                                data:{ID_Busca_Item2:$('#ID_Busca_Item2').val()},
                               
                                success: function(data)
                                {
                                    $("#resultadoCampo2").html(data); 
                                }, error:function()
                                {
                                  $("#resultadoCampo2").html("Houve um erro!");
                                }
                            });
                            }
                          });
                    </script> 
                    <script>
                          $("body").on('click', '#resultadoCampo2 button', function(){
                           
                            var id = $(this).attr('id');
                            var item = id.split(':');

                            document.getElementById("ID_Busca_Item2").value =item[1] ;
                            document.getElementById("ID_IMG2").src = item[2];
                            $.ajax({
                                url : 'ControleBuscaComparar.php',
                                type: 'POST',
                                data:{ID_Item2:item[0], Nome_Item2:item[1],c2:item[3]},
                               
                                success: function(retorno)
                                {
                                    if(retorno == -1)
                                    {
                                      alert("Item já adicionado!");
                                    }else{
                                      $("#minhaDiv").html(retorno);
                                      $("#resultadoCampo2").html("");
                                    } 
                                }, error:function()
                                {
                                  $("#minhaDiv").html("Houve um erro ao adicionar!");
                                }
                            });
                          });
                                              
                        </script> 
                   </div>
             </form>
          </div>
          <div class="col-md-2 ml-1 mt-5">
            <button type="button" id="ID_BT_Comparar" onclick="Mudarestado('minhaDiv')"class="btn btn-outline-primary mt-5 ml-2  tamanhoBTNS">  
              Comparar
            </button>
          </div>
      </div>
</div>
   <!--   =========================Início da listagem da comparação =========== style="display: none;" ============================   -->
<div id="minhaDiv" style="display: none;">
  <?php 
    if($_SESSION['componente1']['categoria'] == 'microcontrolador'){
   ?>
    <!--   ============================= Info gerais =======================================   -->

    <table class="table table-striped">
    <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
      <tbody>
        <thead>
          <tr>
            <th scope="col"> </th>
            <th scope="col" >Componente 1</th>
            <th scope="col">Componente 2</th>
          </tr>
        </thead>
       <tr>
         <th scope="row">Atualidado por:</th>
         <td><?php echo $_SESSION['componente1']['primeiroNome']." ".$_SESSION['componente1']['sobreNome']." (".$_SESSION['componente1']['nomeUsuario'].")"; ?> <b>  em:  </b> <?php echo " ".$_SESSION['componente1']['dataCadastro']; ?>
         </td>
         <td><?php echo $arraySegundoItem['primeiroNome']." ".$arraySegundoItem['sobreNome']." (".$arraySegundoItem['nomeUsuario'].")"; ?> <b>  em:  </b> <?php echo " ".$arraySegundoItem['dataCadastro']; ?>
         </td>
       </tr>
        <tr class="table-primary">
          <th scope="row">Nome</th>
          <td><?php echo $_SESSION['componente1']['tipo']; ?></td>
          <td><?php echo $arraySegundoItem['tipo']; ?></td>
        </tr>
        <tr>
          <th scope="row">Modelo</th>
          <td><?php echo $_SESSION['componente1']['nome']; ?></td>
          <td><?php echo $arraySegundoItem['nome']; ?></td>
        </tr>
        <tr class="table-primary" >
          <th scope="row">Temperatura de Operação</th>
          <td><?php echo $_SESSION['componente1']['temperatura_operacao']; ?></td>
          <td><?php echo $arraySegundoItem['temperatura_operacao']; ?></td>
        </tr>
        <tr>
          <th scope="row">Dimensões</th>
          <td><?php echo $_SESSION['componente1']['dimensao']; ?> </td>
          <td><?php echo $arraySegundoItem['dimensao']; ?> </td>
        </tr>
        <tr  class="table-primary">
          <th scope="row">Preço Médio</th>
          <td><?php echo "R$ ". $_SESSION['componente1']['precoMedio']; ?> </td>
          <td><?php echo "R$ ". $arraySegundoItem['precoMedio']; ?> </td>
        </tr>
        <tr>
          <th scope="row">Linguagem de Programação</th>

          <td><?php echo substr($_SESSION['componente1']['linguagem_de_prograrmacao'],1);#mudar isso, tá prograrmacao ?> </td>
          <td><?php echo substr($arraySegundoItem['linguagem_de_prograrmacao'],1);#mudar isso, tá prograrmacao ?> </td>
        </tr>
        <tr  class="table-primary" >
          <th scope="row">Plataform de Desenvolvimento</th>
          <td><?php echo substr($_SESSION['componente1']['plataforma_de_desenvolvimento'],1);?> 
          </td>
          <td><?php echo substr($arraySegundoItem['plataforma_de_desenvolvimento'],1);?> 
          </td>
        </tr>
        <tr>
          <th scope="row">DataSheet</th>
          <td>
             <a href="<?php echo $_SESSION['componente1']['linkDataSheet']; ?>" class="btn button-link">
               <?php echo $_SESSION['componente1']['linkDataSheet']; ?>
             </a>
          </td>
          <td>
             <a href="<?php echo $_SESSION['componente1']['linkDataSheet']; ?>" class="btn button-link">
               <?php echo $arraySegundoItem['linkDataSheet']; ?>
             </a>
          </td>
        </tr>
        <tr  class="table-primary">
          <th scope="row">Palavras-Chave</th>
          <td>
             <?php echo $_SESSION['componente1']['palavraChave']; ?>
          </td>
          <td>
             <?php echo $arraySegundoItem['palavraChave']; ?>
          </td>
        </tr>
        <tr>
          <th scope="row">Desenho da pinagem</th>
          <td>
              <img src="<?php echo $_SESSION['componente1']['img_legenda']; ?>" class="img mr-auto p-2 bd-highlight" width="600" height="700" align="center">
          </td>
          <td>
              <img src="<?php echo $arraySegundoItem['img_legenda']; ?>" class="img mr-auto p-2 bd-highlight" width="600" height="700" align="center">
          </td>
        </tr>
      </tbody>
    </table>
    <table class="table table-striped" >

   <!--   =============================Infor técnincas =======================================   -->
    <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Técnincas</h4>
      <tbody>
        <thead>
          <tr>
            <th scope="col"> </th>
            <th scope="col" >Componente 1</th>
            <th scope="col">Componente 2</th>
          </tr>
        </thead>
        <tr class="table-primary">
          <th scope="row">Processador</th>
          <td><?php echo $_SESSION['componente1']['processador']; ?></td>
          <td><?php echo $arraySegundoItem['processador']; ?></td>
        </tr>
        <tr>
          <th scope="row">Tempo de Clock</th>
          <td><?php echo $_SESSION['componente1']['tempo_de_clock']; ?></td>
          <td><?php echo $arraySegundoItem['tempo_de_clock']; ?></td>
        </tr>
        <tr class="table-primary" >
          <th scope="row">GPIOs-Analógicos</th>
          <td><?php echo $_SESSION['componente1']['GPIO_A']; ?></td>
          <td><?php echo $arraySegundoItem['GPIO_A']; ?></td>
        </tr>
        <tr>
          <th scope="row">GPIO-Digitais</th>
          <td><?php echo $_SESSION['componente1']['GPIO_D']; ?></td>
          <td><?php echo $arraySegundoItem['GPIO_D']; ?></td>
        </tr>
        <tr  class="table-primary">
          <th scope="row">Memória RAM</th>
          <td><?php echo $_SESSION['componente1']['memoria_ram']; ?></td>
          <td><?php echo $arraySegundoItem['memoria_ram']; ?></td>
        </tr>
        <tr>
          <th scope="row">Memória Flhash</th>
          <td><?php echo $_SESSION['componente1']['memoria_flash']; ?></td>
          <td><?php echo $arraySegundoItem['memoria_flash']; ?></td>
        </tr>
        <tr  class="table-primary" >
          <th scope="row">Microcontrolador</th>
          <td><?php echo $_SESSION['componente1']['microcontrolador']; ?></td>
           <td><?php echo $arraySegundoItem['microcontrolador']; ?></td>
        </tr>
      </tbody>
    </table>

       <!--   ============================= Informações Elétricas  =======================================   -->
    <table class="table table-striped" >
    <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Elétricas</h4>
      <tbody>
        <thead>
          <tr>
            <th scope="col"> </th>
            <th scope="col" >Componente 1</th>
            <th scope="col">Componente 2</th>
          </tr>
        </thead>
        <tr class="table-primary">
          <th scope="row">Tensão de Operação</th>
          <td><?php echo $_SESSION['componente1']['tensao_operacao']; ?></td>
          <td><?php echo $arraySegundoItem['tensao_operacao']; ?></td>
        </tr>
        <tr>
          <th scope="row">Tensão de entrada</th>
          <td><?php echo $_SESSION['componente1']['tensao_entrada']; ?></td>
          <td><?php echo $arraySegundoItem['tensao_entrada']; ?></td>
        </tr>
      <tr class="table-primary">
          <th scope="row">Modo de Consumo</th>
          <td><?php echo $_SESSION['componente1']['modo_consumo']; ?></td>
          <td><?php echo $arraySegundoItem['modo_consumo']; ?></td>
        </tr>
      </tbody>
    </table>

      <!--   ============================= Comunicação =======================================   -->
    <table class="table table-striped" >
    <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Interfaces de Comunicação</h4>
      <tbody>
        <thead>
          <tr>
            <th scope="col"> </th>
            <th scope="col" >Componente 1</th>
            <th scope="col">Componente 2</th>
          </tr>
        </thead>
        <tr class="table-primary">
          <th scope="row">Comunicação sem Fio</th>
          <td><?php echo substr($_SESSION['componente1']['sem_fio'],1); ?></td>
          <td><?php echo substr($arraySegundoItem['sem_fio'],1); ?></td>
        </tr>
        <tr>
          <th scope="row">Comunicação Serial</th>
          <td><?php echo substr($_SESSION['componente1']['serial_'],1); ?></td>
          <td><?php echo substr($arraySegundoItem['serial_'],1); ?></td>
        </tr>
      </tbody>
    </table>

       <!--   =============================Componentes Adicionais=======================================   -->
    <table class="table table-striped" >
    <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Componentes Adicionais</h4>
      <tbody>
        <thead>
          <tr>
            <th scope="col"> </th>
            <th scope="col" >Componente 1</th>
            <th scope="col">Componente 2</th>
          </tr>
        </thead>
        <tr class="table-primary">
          <th scope="row">Interfaces de Entrada</th>
          <td><?php echo substr($_SESSION['componente1']['interface_entrada'],1); ?></td>
          <td><?php echo substr($arraySegundoItem['interface_entrada'],1); ?></td>
        </tr>
        <tr>
          <th scope="row">Sensores</th>
          <td><?php echo substr($_SESSION['componente1']['sensores'],1); ?></td>
          <td><?php echo substr($arraySegundoItem['sensores'],1); ?></td>
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
      <thead>
          <tr>
            <th scope="col"> </th>
            <th scope="col" >Componente 1</th>
            <th scope="col">Componente 2</th>
          </tr>
        </thead>
        <tr class="table-primary">
          <td>
              <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="10" cols="50" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  > <?php echo $_SESSION['componente1']['infoAdicionais']; ?></textarea>
          </td>
          <td>
              <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="10" cols="50" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  > <?php echo $arraySegundoItem['infoAdicionais']; ?></textarea>
          </td>
        </tr>
      </tbody>
    </table>

<!--   =============================Projetos Relacionados===================   -->
<table class="table table-striped" >
<h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Projetos Relacionados</h4>
  
    <thead>
      <tr>       
        <th scope="col" >Componente 1</th>
        <th scope="col">Componente 2</th>
      </tr>
    </thead>
    <tbody>
      <tr>  
        <td>
        <div>
            <div class="row" align="center">
              <!-- Tamnho da imagem do projeto .../100px180/ style="width: 180px; height: 100px;-->
              <div class="card col-md-3 ml-3" style="width: 20rem;">
                <img class="card-img-top" width="100" height="100" src="img\violao.jpg" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Violão LED</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="TelaExibirProjeto.php" class="btn btn-primary">Ver o projeto</a>
                </div>
              </div>
            </div>
        </div>
        </td>
        <td>
        <div>
            <div class="row" align="center">
              <!-- Tamnho da imagem do projeto .../100px180/ style="width: 180px; height: 100px;-->
              <div class="card col-md-3 ml-3" style="width: 20rem;">
                <img class="card-img-top" width="100" height="100" src="img\violao.jpg" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Violão LED</h5>
                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                  <a href="TelaExibirProjeto.php" class="btn btn-primary">Ver o projeto</a>
                </div>
              </div>
            </div>
        </div>
        </td>
      </tr>
  </tbody>
</table>

  <?php 
    }else if($_SESSION['componente1']['categoria'] == 'bateria'){
  ?>
       <!--   ============================= Info gerais =======================================   -->
     <table class="table table-striped">
     <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
       <tbody>
        <tr>
          <th scope="row">Atualidado por:</th>
          <td><?php echo $_SESSION['componente1']['primeiroNome']." ".$_SESSION['componente1']['sobreNome']." (".$_SESSION['componente1']['nomeUsuario'].")"; ?> <b>  em:  </b> <?php echo " ".$_SESSION['componente1']['dataCadastro']; ?> </td>
        </tr>
         <tr class="table-primary">
           <th scope="row">Nome</th>
           <td><?php echo $_SESSION['componente1']['nome']; ?></td>
         </tr>
         <tr>
           <th scope="row">Tipo</th>
           <td><?php echo $_SESSION['componente1']['tipo']; ?></td>
         </tr>
         <tr class="table-primary" >
           <th scope="row">Temperatura de Operação</th>
           <td><?php echo $_SESSION['componente1']['temperatura_operacao']; ?></td>
         </tr>
         <tr>
           <th scope="row">Dimensões</th>
           <td><?php echo $_SESSION['componente1']['dimensao']; ?></td>
         </tr>
         <tr  class="table-primary">
           <th scope="row">Peso</th>
            <td><?php echo $_SESSION['componente1']['peso']; ?></td>
         </tr>
         <tr>
           <th scope="row">Tamanho</th>
            <td><?php echo $_SESSION['componente1']['tamanho']; ?></td>
         </tr>
         <tr  class="table-primary" >
           <th scope="row">Preço Médio</th>
           <td><?php echo "R$ ". $_SESSION['componente1']['precoMedio']; ?> </td>
         </tr>
         <tr>
           <th scope="row">DataSheet</th>
           <td>
              <a href="<?php echo $_SESSION['componente1']['linkDataSheet']; ?>" class="btn button-link">
                <?php echo $_SESSION['componente1']['linkDataSheet']; ?>
              </a>
           </td>
         </tr>
         <tr  class="table-primary">
           <th scope="row">Palavras-Chave</th>
         <td>
            <?php echo $_SESSION['componente1']['palavraChave']; ?>
         </td>
         </tr>
       </tbody>
     </table>
     <table class="table table-striped" >

    <!--   ============================= Informações Elétricas  ================================   -->
     
     <table class="table table-striped" >
     <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Elétricas</h4>
       <tbody>
         <tr class="table-primary">
           <th scope="row">Tensão de Operação (nominal)</th>
           <td><?php echo $_SESSION['componente1']['tensao_nom']; ?></td>
         </tr>
         <tr>
           <th scope="row">Tipo de Carga</th>
           <td><?php echo $_SESSION['componente1']['tipo_carga']; ?></td>
         </tr>

    <?php 
          if ($_SESSION['componente1']['tipo_carga'] == "Recarregável")
          {
    ?>
         <!--  Se recarregável  -->  
         <tr>
           <th scope="row">Manutenção</th>
           <td><?php echo $_SESSION['componente1']['manutencao']; ?></td>
         </tr>
         <tr class="table-primary">
           <th scope="row">Densidade</th>
           <td><?php echo $_SESSION['componente1']['densidade']; ?></td>
         </tr>
         <tr>
           <th scope="row">Resistência Interna</th>
           <td><?php echo $_SESSION['componente1']['resistencia_Int']; ?></td>
         </tr>
         <tr class="table-primary">
           <th scope="row">Ciclo de Vida</th>
           <td><?php echo $_SESSION['componente1']['ciclo_de_vida']; ?></td>
         </tr>
         <tr>
           <th scope="row">Tempo para Carga Rápida</th>
           <td><?php echo $_SESSION['componente1']['tempo_carga_rapida']; ?></td>
         </tr>
         <tr class="table-primary">
           <th scope="row">Tolerância para sobrecarga</th>
            <td><?php echo $_SESSION['componente1']['tolerancia_sobrecarga']; ?></td>
         </tr>
         <tr>
           <th scope="row">Auto-Descarga Mensal</th>
            <td><?php echo $_SESSION['componente1']['auto_desc_mensal']; ?></td>
         </tr>
         <tr class="table-primary">
           <th scope="row">Corrente de Carga</th>
            <td><?php echo $_SESSION['componente1']['corrente_carga']; ?></td>
         </tr>

    <?php 
          }
          else
          { 
    ?>
         <!--  Se não recarregável  --> 
              <tr>
               <th scope="row">Química Utilizada</th>
                <td><?php echo $_SESSION['componente1']['quimica']; ?></td>
             </tr>

           </tbody>
         </table>
         <table class="table table-striped" >
               <h5 class="mt-4 mb-4 ml-4 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-4" align="start">Capacidade de descarga</h5>
             <tbody>
              <tr class="table-primary">
                <th scope="row">Tempo Médio</th>
                 <td><?php echo $_SESSION['componente1']['tempo_medio']; ?></td>
              </tr>
               <tr>
                <th scope="row">Resistor de Descarga</th>
                <td><?php echo $_SESSION['componente1']['resistor_descarga']; ?></td>
              </tr>
               <tr class="table-primary">
                <th scope="row">Voltagem Mínima</th>
                <td><?php echo $_SESSION['componente1']['voltagem_minima']; ?></td>
              </tr>
        <?php 
          } 
        ?>
            </tbody>
        </table>  
<!--   =============================Projetos Relacionados===================   -->

        <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Projetos Relacionados</h4>
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
            </div>
        </div>        

  <?php 
  }else if($_SESSION['componente1']['categoria'] == 'shield'){ 
  ?>
       <!--   ============================= Info gerais =======================================   -->


     <table class="table table-striped">
     <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
       <tbody>
        <tr>
          <th scope="row">Atualidado por:</th>
          <td><?php echo $_SESSION['componente1']['primeiroNome']." ".$_SESSION['componente1']['sobreNome']." (".$_SESSION['componente1']['nomeUsuario'].")"; ?> <b>  em:  </b> <?php echo " ".$_SESSION['componente1']['dataCadastro']; ?>
          </td>
        </tr>
         <tr class="table-primary">
           <th scope="row">Nome</th>
           <td><?php echo $_SESSION['componente1']['nome']; ?></td>
         </tr>
         <tr>
           <th scope="row">Modelo</th>
           <td><?php echo $_SESSION['componente1']['tipo']; ?></td>
         </tr>
         <tr class="table-primary" >
           <th scope="row">Temperatura de Operação</th>
           <td><?php echo $_SESSION['componente1']['temperaturaOperacao']; ?></td>
         </tr>
         <tr>
           <th scope="row">Dimensões</th>
           <td><?php echo $_SESSION['componente1']['dimensao']; ?></td>
         </tr>
         <tr  class="table-primary">
           <th scope="row">Peso</th>
           <td><?php echo $_SESSION['componente1']['peso']; ?></td>
         </tr>
         <tr >
           <th scope="row">Preço Médio</th>
           <td><?php echo "R$ ". $_SESSION['componente1']['precoMedio']; ?> </td>
         </tr>
         <tr class="table-primary" >
           <th scope="row">DataSheet</th>
           <td>
              <a href="<?php echo $_SESSION['componente1']['linkDataSheet'];?>" class="btn button-link" target="_blank">
                <?php echo $_SESSION['componente1']['linkDataSheet']; ?>
              </a>
           </td>
         </tr>
         <tr >
           <th scope="row">Palavras-Chave</th>
           <td>
              <?php echo $_SESSION['componente1']['palavraChave']; ?>
           </td>
         </tr>
         <tr  class="table-primary">
           <th scope="row">Função Principal</th>
            <td><?php echo $_SESSION['componente1']['funcao']; ?></td>
         </tr>
         <tr>
           <th scope="row">Compatível com:</th>
           <!-- buscar os microcontroladores compatíveis com os IDs -->
          <td>
          <?php 
          while ($row =  mysqli_fetch_array($resultCompativel,MYSQLI_ASSOC)) { #echo "Palavra  
            #echo $_SESSION['componente1']['ID_Item'];
          ?>
           
              <form method="POST" action="TelaExibirMicrocontrolador.php" data-toggle="validator" role="form" align="start" >
                <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $row['ID_Item']; ?>"/>
                <input type="hidden" name="ItemAnterior" id="cod_processo" value="<?php echo $_SESSION['componente1']['ID_Item']; ?>"/>  
                  <button  type="submit" class="btn btn-outline-primary border-0 " target="_blank">  
                    <h6 style="text-align:center;">
                      <p>
                         <?php echo  "-".$row['nomeItem'];?> 
                      </p>
                    </h6> 
                  </button>
              </form>
          <?php } mysqli_free_result($resultCompativel); ?> 

         </tr>
       </tbody>
     </table>
     <table class="table table-striped" >

        <!--   ============================= Informações Elétricas  =======================================   -->
     <table class="table table-striped" >
     <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Elétricas</h4>
       <tbody>
         <tr class="table-primary">
           <th scope="row">Tensão de Operação (nominal)</th>
           <td><?php echo $_SESSION['componente1']['tensaoOperacao']; ?></td>
         </tr>
         <tr>
           <th scope="row">Modo de Consumo</th>
           <td><?php echo $_SESSION['componente1']['modo_consumo']; ?></td>
         </tr>
       </tbody>
     </table>
    <!--   =============================Componentes Adicionais=====================================   -->
     
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
               <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="15" cols="200" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  > <?php echo $_SESSION['componente1']['infoAdicionais']; ?></textarea>
           </td>
         </tr>
       </tbody>
     </table>

<!--   =============================Projetos Relacionados=========================   -->

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
    </div>
  <div>
  <?php 
  } else if($_SESSION['componente1']['categoria'] == 'atuador'){
  ?>
     <!--   ============================= Info gerais =======================================   -->
   <table class="table table-striped">
   <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
     <tbody>
      <tr>
        <th scope="row">Atualizado por:</th>
        <td><?php echo $_SESSION['componente1']['primeiroNome']." ".$_SESSION['componente1']['sobreNome']." (".$_SESSION['componente1']['nomeUsuario'].")"; ?> <b>  em:  </b> <?php echo " ".$_SESSION['componente1']['dataCadastro']; ?>
        </td>
      </tr>
       <tr class="table-primary">
         <th scope="row">Nome</th>
          <td><?php echo $_SESSION['componente1']['nome']; ?></td>
       </tr>
       <tr>
         <th scope="row">Modelo</th>
         <td><?php echo $_SESSION['componente1']['tipo']; ?></td>
       </tr>
       <tr class="table-primary" >
         <th scope="row">Temperatura de Operação</th>
         <td><?php echo $_SESSION['componente1']['temperaturaOperacao']; ?></td>
       </tr>
       <tr>
         <th scope="row">Dimensões</th>
         <td><?php echo $_SESSION['componente1']['dimensao']; ?></td>
       </tr>
       <tr class="table-primary" >
         <th scope="row">Preço Médio</th>
         <td><?php echo "R$ ". $_SESSION['componente1']['precoMedio']; ?> </td>
       </tr>
       <tr >
         <th scope="row">DataSheet</th>
         <td>
            <a href="<?php echo $_SESSION['componente1']['linkDataSheet'];?>" class="btn button-link" target="_blank">
              <?php echo $_SESSION['componente1']['linkDataSheet']; ?>
            </a>
         </td>
       </tr>
       <tr class="table-primary" >
         <th scope="row">Palavras-Chave</th>
            <td>
               <?php echo $_SESSION['componente1']['palavraChave']; ?>
            </td>
       </tr>
       <tr >
         <th scope="row">Cor</th>
          <td>
               <?php echo $_SESSION['componente1']['cor']; ?>
          </td>
       </tr>
       <tr  class="table-primary">
         <th scope="row">Compatível com:</th>
         <td>
           <?php 
           while ($row =  mysqli_fetch_array($resultCompativel,MYSQLI_ASSOC)) { #echo "Palavra  
             #echo $_SESSION['componente1']['ID_Item'];
           ?>    
               <form method="POST" action="TelaExibirMicrocontrolador.php" data-toggle="validator" role="form" align="start" >
                 <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $row['ID_Item']; ?>"/>
                 <input type="hidden" name="ItemAnterior" id="cod_processo" value="<?php echo $_SESSION['componente1']['ID_Item']; ?>"/>  
                   <button  type="submit" class="btn btn-outline-primary border-0 " target="_blank">  
                     <h6 style="text-align:center;">
                       <p>
                          <?php echo  "-".$row['nomeItem'];?> 
                       </p>
                     </h6> 
                   </button>
               </form>
           <?php } mysqli_free_result($resultCompativel); ?> 
         </td>
       </tr>
       <tr >
         <th scope="row">Controlador</th>
         <td>
         <?php echo $_SESSION['componente1']['controlador']; ?>
         </td>
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
         <td><?php echo $_SESSION['componente1']['tensaoOperacao']; ?></td>
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
          <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="15" cols="200" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  > <?php echo $_SESSION['componente1']['infoAdicionais']; ?>
          </textarea>
         </td>
       </tr>
     </tbody>
   </table>
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
   </div> 
</div>

  <?php 
  } else if($_SESSION['componente1']['categoria'] == 'sensor'){ 
  ?>

     <!--   ============================= Info gerais =======================================   -->
   <table class="table table-striped">
   <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
     <tbody>
      <tr>
        <th scope="row">Atualizado por:</th>
        <td><?php echo $_SESSION['componente1']['primeiroNome']." ".$_SESSION['componente1']['sobreNome']." (".$_SESSION['componente1']['nomeUsuario'].")"; ?> <b>  em:  </b> <?php echo " ".$_SESSION['componente1']['dataCadastro']; ?>
        </td>
      </tr>
       <tr class="table-primary">
         <th scope="row">Nome</th>
          <td><?php echo $_SESSION['componente1']['nome']; ?></td>
       </tr>
       <tr>
         <th scope="row">Modelo</th>
         <td><?php echo $_SESSION['componente1']['tipo']; ?></td>
       </tr>
       <tr class="table-primary" >
         <th scope="row">Temperatura de Operação</th>
         <td><?php echo $_SESSION['componente1']['temperaturaOperacao']; ?></td>
       </tr>
       <tr>
         <th scope="row">Dimensões</th>
         <td><?php echo $_SESSION['componente1']['dimensao']; ?></td>
       </tr>
       <tr class="table-primary" >
         <th scope="row">Preço Médio</th>
         <td><?php echo "R$ ". $_SESSION['componente1']['precoMedio']; ?> </td>
       </tr>
       <tr >
         <th scope="row">DataSheet</th>
         <td>
            <a href="<?php echo $_SESSION['componente1']['linkDataSheet'];?>" class="btn button-link" target="_blank">
              <?php echo $_SESSION['componente1']['linkDataSheet']; ?>
            </a>
         </td>
       </tr>
       <tr class="table-primary" >
         <th scope="row">Palavras-Chave</th>
            <td>
               <?php echo $_SESSION['componente1']['palavraChave']; ?>
            </td>
       </tr>
       <tr>
         <th scope="row">Compatível com:</th>
         <td>
           <?php 
           while ($row =  mysqli_fetch_array($resultCompativel,MYSQLI_ASSOC)) { #echo "Palavra  
             #echo $_SESSION['componente1']['ID_Item'];
           ?>    
               <form method="POST" action="TelaExibirMicrocontrolador.php" data-toggle="validator" role="form" align="start" >
                 <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $row['ID_Item']; ?>"/>
                 <input type="hidden" name="ItemAnterior" id="cod_processo" value="<?php echo $_SESSION['componente1']['ID_Item']; ?>"/>  
                   <button  type="submit" class="btn btn-outline-primary border-0 " target="_blank">
                     <h6 style="text-align:center;">
                       <p>
                          <?php echo  "-".$row['nomeItem'];?> 
                       </p>
                     </h6> 
                   </button>
               </form>
           <?php } mysqli_free_result($resultCompativel); ?> 
         </td>
       </tr>
       <tr class="table-primary">
         <th scope="row">Função Principal</th>
         <td>
         <?php echo $_SESSION['componente1']['funcao']; ?>
         </td>
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
         <td><?php echo $_SESSION['componente1']['tensaoOperacao']; ?></td>
       </tr>
       <tr >
         <th scope="row">Tensao de Saída</th>
          <td>
               <?php echo $_SESSION['componente1']['tensaoSaida']; ?>
          </td>
       </tr>
     </tbody>
   </table>
<!--   =============================Componentes Adicionais=====================   -->
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
          <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="15" cols="200" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  > <?php echo $_SESSION['componente1']['infoAdicionais']; ?></textarea>
         </td>
       </tr>
     </tbody>
   </table>
<!--   ==========================Projetos Relacionados===================================   -->

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
    </div>
</div>
  <?php 
  }
  ?>
</div>

      <!-- <button type="button" class="btn btn-primary">Primary</button> -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="jquery/dist/jQuery.js"></script>
    <script src="popper.js/dist/umd/popper.js"></script>
    <script src="bootstrap/dist/js/bootstrap.js"></script>
  </body>
</html>
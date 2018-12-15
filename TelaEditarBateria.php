<?php session_start();
include_once("conexao/Fachada.class.php");
include_once("conexao/BateriaVO.class.php");

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

$arrayResult  = $fachada->exibirBateria($idItem);

$_SESSION["itemAtual"] = $idItem;


$styleDivR = '';
$styleDivNR = '';

if($arrayResult['tipo'] != "Recarregável") 
{
    $styleDivR = 'display: none';
    $styleDivNR = 'display: block';
}else
{
    $styleDivR = 'display: block';
    $styleDivNR = 'display: none';
}
?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- onclick="Mudarestado('minhaDiv') -->

<!-- Bootstrap CSS   onclick="Mudarestado('minhaDiv') -->
    <link rel="stylesheet" href="bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/compiler/style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
     <script type="text/javascript">
        $("#ID_Campo_PM").mask("#.##0,00", {reverse: true});
     </script>

    <script language="JavaScript">

      function Mudarestado(el) {
        var valor = document.getElementById(el).value;
        var dispDiv1 = document.getElementById("ID_div_principal").style.display;
        if(valor == "Recarregável"){
            document.getElementById("n_recaregavel").style.display = "none";
            document.getElementById("recaregavel").style.display = "block";
            document.getElementById("ID_div_principal").style.height = '1420px';

        }else
        {
            document.getElementById("recaregavel").style.display = "none";
            document.getElementById("n_recaregavel").style.display = "block";
            document.getElementById("ID_div_principal").style.height = '1400px';
        }
          //carregar a página e só depois exibir o conteudo
    }
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
          <a href="TelaLogin.php"  class="btn btn-primary p-2 bd-highlight tamanhoBTNS mt-5 ml-4">
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

<!--   =========================Início do corpo principal=======================================   -->


 <h5 class="modal-title mb-3 mt-4" align="center"><b>Inserir Bateria</b></h5>

     <div class="container-fluid  d-flex flex-column bd-highlight  quadradoInserirItem  col-md-10 scrollspy-example" id="ID_div_principal" data-spy="scroll"  data-target="#list-example" data-offset="0" style="height: 1400px;">
      
      <div class="container-fluid  align-items-center ">
       <form  class="tamnhoForm" method="POST" action="ControleBateriaUpdate.php" role="form" enctype="multipart/form-data" data-toggle="validator">

<!--   =============================   Informações Gerais   =================================   -->
     <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
        
<!--   ====================== Carregamento das imagens ======================================   -->
       
         <div class="form-row" align="start">

           <div class="form-group col-md-5" align="start">
             <img src="<?php echo $arrayResult['img_componente']; ?>" id="ID_IMG_Componente"  class="img mt- border border-primary rounded" width="130" height="80">
              <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
             <input type="file" name="imgComponente"   class="form-control-file" id="ID_Enviar_Foto">
             <label class="custom-file-label" for="ID_Enviar_Foto">Imagem do Componente</label>
           </div>  

         </div>
<!--   =============================== Linha 1 =========================================   -->

         <div class="form-row" align="center">
           <div class="form-group col-md-4" align="start">
             <label for="ID_Campo_Nome" >Nome</label>
             <input type="text" name="nome" value="<?php echo $arrayResult['nome']; ?>" class="form-control"  id="ID_Campo_Nome" placeholder="">
           </div>
          <div class="form-group col-md-4" align="start">
               <label for="ID_Tipo_Carga">Tipo de Carga</label>
               <select id="ID_Comu_SF" name="tipo_carga" class="form-control" onchange="Mudarestado('ID_Comu_SF')">
                 <?php if($arrayResult['tipo'] == "Recarregável"){?> 
                 <option>Não Recaregável</option>
                 <option selected>Recarregável</option> 
               <?php }else{ ?>
                  <option selected>Não Recaregável</option>
                 <option>Recarregável</option> 
               <?php } ?>

               </select>
           </div>
           <div class="form-group col-md-4" align="start">
             <label for="ID_Campor_TO">Temperatura de operação</label>
             <input type="text" name="temperatura_ope" value="<?php echo $arrayResult['temperatura_operacao']; ?>" class="form-control" id="ID_Campor_TO"  placeholder="Temp. Mínima e Máxima em Cº">
           </div>
         </div>
<!--   =============================== Linha 2 =========================================   -->
      
           <div class="form-row">
             <div class="form-group col-md-4" align="start">
               <label for="ID_Dimensoes">Dimensões</label>
               <input type="text" name="dimensao" value="<?php echo $arrayResult['dimensao']; ?>" class="form-control" id="ID_Dimensoes" placeholder="00cm X 00cm X 00 cm">
             </div>
            <div class="form-group col-md-4" align="start">
              <label for="ID_Campo_Peso" >Peso</label>
              <input type="link" name="peso" value="<?php echo $arrayResult['peso']; ?>" class="form-control" id="ID_Campo_Peso" placeholder="20 gm">
            </div>
              <div class="form-group col-md-4" align="start">
                <label for="ID_Tamanho">Tamanho</label>
                <input type="text" name="tamanho" value="<?php echo $arrayResult['tamanho']; ?>" class="form-control" id="ID_Tamanho" placeholder="AA ou AAA ou...">
              </div>
            </div>

 <!--   =============================== Linha 3 =========================================   -->
         <div class="form-row">
           <div class="form-group col-md-4" align="start">
             <label for="ID_Data_Sheet" >Link DataSheet</label>
             <input type="text" name="link_DS" value="<?php echo $arrayResult['linkDataSheet']; ?>" class="form-control" id="ID_Data_Sheet" placeholder="https:// ...">
           </div>
         
           <div class="form-group col-md-4" align="start">
             <label for="inputPassword4">Preço Médio R$</label>
             <input type="text" name="preco_medio" value="<?php echo $arrayResult['precoMedio']; ?>" class="form-control" id="ID_Campo_PM" placeholder="0,00" required>
           </div>

           <div class="form-group col-md-4" align="start">
             <label for="ID_Campo_Palavra-Chave">Palavras-Chave</label>
             <input type="text" name="palavra_chave" value="<?php echo $arrayResult['palavraChave']; ?>" class="form-control" id="ID_Campo_Palavra-Chave" placeholder="Palavra1, Palavra2, ..">
           </div>
        </div>
        <div class="form-row">           
          <div class="form-group col-md-4" align="start">
            <label for="ID_Tensao_Nominal">Tensão Nominal</label>
            <input type="link" name="tensao_nom" value="<?php echo $arrayResult['tensao_nom']; ?>" class="form-control" id="ID_Tensao_Nominal" placeholder="Em Volts">
          </div>
         </div>

 <!--   =============================   Informações Elétricas   ===========================   -->       
      <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-3" align="start">Informações Elétricas</h4>
<!--   =============================== Linha 1 =========================================   -->
      <div id="recaregavel" style="<?php echo $styleDivR;?>">          <!--  Se recarregável  -->  

        <div class="form-row">
          <div class="form-group col-md-4" align="start">
             <label for="ID_Campo_Manuten">Manutenção</label>
             <input type="text" name="manutencao" value="<?php echo $arrayResult['manutencao']; ?>" class="form-control" id="ID_Campo_Manuten" placeholder="">
           </div>
          <div class="form-group col-md-4" align="start">
            <label for="ID_Campo_Densidade" >Densidade</label>
            <input type="number" name="densidade" value="<?php echo $arrayResult['densidade']; ?>" class="form-control" id="ID_Campo_Densidade" placeholder="">
          </div>
          <div class="form-group col-md-4" align="start">
              <label for="ID_Campo_Resistensia_interna">Resistência Interna</label>
              <input type="number" name="resistencia_int" value="<?php echo $arrayResult['resistencia_Int']; ?>" class="form-control" id="ID_Campo_Resistensia_interna" placeholder="">
          </div>
        </div>
<!--   =============================== Linha 2 =========================================   -->       
                   
           <div class="form-row">

            <div class="form-group col-md-4" align="start">
               <label for="ID_Campo_Ciclo_De_Vida">Ciclo de Vida</label>
               <input type="text" name="ciclo_de_vida" value="<?php echo $arrayResult['ciclo_de_vida']; ?>" class="form-control" id="ID_Campo_Ciclo_De_Vida" placeholder="">
             </div>
            <div class="form-group col-md-4" align="start">
              <label for="ID_Campo_Tempo_CR" >Tempo para Carga Rápida</label>
              <input type="number" name="tempo_carga_rapida" value="<?php echo $arrayResult['tempo_carga_rapida']; ?>" class="form-control" id="ID_Campo_Tempo_CR" placeholder="">
            </div>
            <div class="form-group col-md-4" align="start">
                <label for="ID_Campo_Tole_sobre">Tolerância para sobrecarga</label>
                <input type="number" name="tolerancia_sobrecarga" value="<?php echo $arrayResult['tolerancia_sobrecarga']; ?>" class="form-control" id="ID_Campo_Tole_sobre" placeholder="">
            </div>
          </div>
           <div class="form-row">
            <div class="form-group col-md-4" align="start">
               <label for="ID_Campo_Auto-DM">Auto-Descarga Mensal</label>
               <input type="text" name="auto_descarga_mensal" value="<?php echo $arrayResult['auto_desc_mensal']; ?>" class="form-control" id="ID_Campo_Auto-DM" placeholder="">
             </div>
            <div class="form-group col-md-4" align="start">
              <label for="ID_Campo_Corrente_C" >Corrente de Carga</label>
              <input type="number" name="corrente_carga" value="<?php echo $arrayResult['corrente_carga']; ?>" class="form-control" id="ID_Campo_Corrente_C" placeholder="">
            </div>
          </div>
        </div>

          <!--  Se não recarregável  --> 
        <div id="n_recaregavel" style="<?php echo $styleDivNR;?>"> <!--  Se não recarregável  --> 

           <div class="form-row">
            <div class="form-group col-md-4" align="start">
               <label for="ID_Campo_Quimica">Química Utilizada</label>
               <input type="text" name="quimica" value="<?php echo $arrayResult['quimica']; ?>" class="form-control" id="ID_Campo_Quimica" placeholder="">
             </div>
           </div>
           
           <h5 class="mt-4 mb-4 ml-4 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-4" align="start">Capacidade de descarga</h5>
           
           <div class="form-row">
            <div class="form-group col-md-4" align="start">
              <label for="ID_Campo_Tempo_Medio" >Tempo médio</label>
              <input type="number" name="tempo_medio" value="<?php echo $arrayResult['tempo_medio']; ?>" class="form-control" id="ID_Campo_Tempo_Medio" placeholder="">
            </div>
            <div class="form-group col-md-4" align="start">
              <label for="ID_Campo_Resistor_D" >Resistor de Descarga</label>
              <input type="number" name="resistor_descarga" value="<?php echo $arrayResult['resistor_descarga']; ?>" class="form-control" id="ID_Campo_Resistor_D" placeholder="">
            </div>
            <div class="form-group col-md-4" align="start">
              <label for="ID_Campo_Volt_Mini" >Voltagem Mínima</label>
              <input type="number"  name="voltagem_minima" value="<?php echo $arrayResult['voltagem_minima']; ?>" class="form-control" id="ID_Campo_Volt_Mini" placeholder="">
            </div>
         </div>
      </div>

<!--   ============================= Componentes Adicionais ==============================   -->              
       <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-5" align="start">Informações Adicionais</h4>

         <div class="form-group" align="start">
             <label for="exampleFormControlTextarea1">Informações Adicionais</label>
             <textarea class="form-control" name="info_add" id="ID_Campo_Ind_Add" rows="10" style="resize: none" placeholder="Digite aqui alguma informação sobre o componete que não está em um dos campos acima..."> <?php echo $arrayResult['infoAdicionais']; ?></textarea>

        </div>

<!--   ========================= Botão Salvar  =========================================   -->                
     <button type="submit" class="btn btn-primary mt-5 mb-3 ml-4" align="center">
       <svg id="i-archive" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
           <path d="M4 10 L4 28 28 28 28 10 M2 4 L2 10 30 10 30 4 Z M12 15 L20 15"  />
       </svg>
     Atualizar
     </button>
<!--   ======================  Fim do formulário =========================================   -->
    </form>
  </div>
</div>

<!--   =============================== Modal ADD Plataforma ==============================   -->
    
    <div class="modal fade" id="ID_Modal_Adicionar_Plat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Adicionar Novo</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form>
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">Insira o nome da nova Plataforma</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
            </form>
          </div>
<!--   =============================   Botão Atualizar MOdal =====================================   -->                
     <button type="submit" class="btn btn-primary mt-5 mb-3 ml-4" align="center">
       <svg id="i-archive" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
           <path d="M4 10 L4 28 28 28 28 10 M2 4 L2 10 30 10 30 4 Z M12 15 L20 15"  />
       </svg>
     Atualizar
     </button>

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
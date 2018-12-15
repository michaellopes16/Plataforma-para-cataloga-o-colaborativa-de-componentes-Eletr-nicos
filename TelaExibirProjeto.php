<?php session_start();
include_once("conexao/Fachada.class.php");

$_SESSION["ItemAnterior"] = '';


if(isset($_SESSION["ItemAnterior"])){

  if(isset($_POST["ItemPesquisa"])){

    $idItem = $_POST["ItemPesquisa"];
    $_SESSION["itemAtual"] = $idItem; 
    $_SESSION["ProjetoAtual"] = $idItem;
    #echo "Item pesquisa no Tela Exibir: ".$idItem."</br>";
  } 
}else
{
  echo "Tá vazio o ItemAnterior";
  $_SESSION["itemAtual"] = $_SESSION["ItemAnterior"];
}

if( isset($_SESSION["ProjetoAtual"]))
{
  $idItem = $_SESSION["ProjetoAtual"];
}

$fachada = new Fachada;

$arrayResult  = $fachada->exibirProjeto($idItem);

$_SESSION["ProjetoAtual"] = $idItem;
$_SESSION["itemAtual"] = $idItem;

$idUsuario =  $fachada->getIdUsuario($_SESSION['nomeUser']);
$_SESSION["ID_Usuario"] = $idUsuario[0];
#echo "ID Usuario atual: ".$idUsuario[0];

$resultCompativel = $fachada->projetoGetCompativel($idItem);
#echo "id projeto".$idItem;

?>
<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta http-equiv="Expires" content="-1">

<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/compiler/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script type="text/javascript">
      function mudarCor(id)
      { 
        document.getElementById(id).style.backgroundColor = '#FFFF0080';
      }
      function mudarCor2(id)
      { 
        document.getElementById(id).style.backgroundColor = '#0000';
      }
      function mudarImg(id)
      { 
        switch(id){
          case'img1':
            document.getElementById('img1').src = 'img/estrela1.png';
            document.getElementById('img2').src = 'img/estrela0.png';
            document.getElementById('img3').src = 'img/estrela0.png'; 
            document.getElementById('img4').src = 'img/estrela0.png';
            document.getElementById('img5').src = 'img/estrela0.png'; 
            document.getElementById('ID_Avaliacao').value = 1;
            break;
          case 'img2':
            document.getElementById('img1').src = 'img/estrela1.png';
            document.getElementById('img2').src = 'img/estrela1.png';
            document.getElementById('img3').src = 'img/estrela0.png'; 
            document.getElementById('img4').src = 'img/estrela0.png';
            document.getElementById('img5').src = 'img/estrela0.png'; 
            document.getElementById('ID_Avaliacao').value = 2;
            break; 
          case 'img3':
            document.getElementById('img1').src = 'img/estrela1.png';
            document.getElementById('img2').src = 'img/estrela1.png';
            document.getElementById('img3').src = 'img/estrela1.png'; 
            document.getElementById('img4').src = 'img/estrela0.png';
            document.getElementById('img5').src = 'img/estrela0.png'; 
            document.getElementById('ID_Avaliacao').value = 3;
            break;
          case 'img4':
            document.getElementById('img1').src = 'img/estrela1.png';
            document.getElementById('img2').src = 'img/estrela1.png';
            document.getElementById('img3').src = 'img/estrela1.png'; 
            document.getElementById('img4').src = 'img/estrela1.png';
            document.getElementById('img5').src = 'img/estrela0.png'; 
            document.getElementById('ID_Avaliacao').value = 4;
            break;
          case 'img5':
            document.getElementById('img1').src = 'img/estrela1.png';
            document.getElementById('img2').src = 'img/estrela1.png';
            document.getElementById('img3').src = 'img/estrela1.png'; 
            document.getElementById('img4').src = 'img/estrela1.png';
            document.getElementById('img5').src = 'img/estrela1.png';
            document.getElementById('ID_Avaliacao').value = 5; 
            break;
        } 
      }
    </script>
    <script type="text/javascript">
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
            $(this).remove(); 
        });
      }, 5000);
    </script>
    <title>Eletronics Component Catalog</title>
  </head>
  <body>
<!--   ======================== Cabeçalho =============================================-->  
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

<!--   ==================== Início do corpo principal=======================================   -->

 <h5 class="modal-title mb-3 mt-4" align="center"><b>Descrição do Projeto</b></h5>

    
     <div class="container-fluid  d-flex flex-column bd-highlight  quadradoExibirProjeto  col-md-10" data-spy="scroll"  data-target="#list-example" data-offset="0" class="scrollspy-example">
      
      <div class="container-fluid  align-items-center ">
 

 <!--   =============================   Informações Gerais   ============================================   -->
         <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
        
        <!--   ====================== Carregamento das imagens =========================================   -->
       
        <div class="form-row" align="center">
            <div class="form-group col-md-3 ml-5" align="center">          
              <img src="<?php echo $arrayResult['img_projeto']; ?>" class="img rounded mx-auto d-block" width="220" height="170" align="center">
            </div>   
            <div class="form-group col-md-8 ml-0" align="start">

               <h3>
                  <b>
                  <?php echo $arrayResult['nome']."</br>"; ?>                   
                 </b>
               </h3> 
            
              <h5>Autores: <strong><?php echo $arrayResult['autor_principal']; ?> *</strong>,<?php echo $arrayResult['nome_demais_autores']."</br>"; ?> 
              </h5>
              <h5>*<?php echo $arrayResult['email_autor_principal'] ?></h5>
           </div>
        </div>


 <!--   =============================   Metodologia Utilizada   ============================================   -->       
       <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start"> Metodologia Utilizada</h4>
       
       <div class="form-group rounded" style="background-color: #FFFFE0; height: 400px;overflow-y:scroll;width:950px; " align="start">
           <p class="ml-2 mr-3 mt-2 mb-2" style="text-align: justify;">
              <?php echo $arrayResult['metodologia'] ?>
           </p>
      </div>
 <!--   =============================   Vídeo Demonstrativo   ============================================   -->       
       <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start"> Vídeo Demonstrativo</h4>
        <!-- https://www.youtube.com/watch?v=6lnilz-bem8 -->
        <?php 
        $link =  strstr($arrayResult['link_video'], '=');
        $link = str_replace("=","",$link); 
        $link_src = "https://www.youtube.com/embed/".$link ;

         ?>
       <div>
          <iframe width="500" height="300" 
          src="<?php echo $link_src; ?>" 
          frameborder="0" allow="autoplay; encrypted-media" 
          allowfullscreen>
          </iframe>
       </div>

  <!--   =============================   Links úteis  ============================================   -->
       <div class="">       
         <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Links úteis</h4>

         <table class="table table-striped">
           <tbody>
               <tr>
               <th scope="row">Repositório do projeto</th>
                 <td>
                    <a href="<?php echo $arrayResult['link_repo']; ?>" class="btn button-link"><?php echo $arrayResult['link_repo']; ?>
                    </a>
                 </td>
               </tr>
                 <tr  class="table-primary">
                  <th scope="row">Site relacionado</th>
                    <td>
                       <a href="<?php echo $arrayResult['link_site']; ?>" class="btn button-link"><?php echo $arrayResult['link_site']; ?>
                       </a>
                    </td>
                </tr>
           </tbody>
         </table>
       </div>
       <!--   =============================   Componentes Utilizados   ============================================   -->       
            <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-3" align="start">Componentes Utilizados</h4>
              <div class="divScrollItens rounded" data-spy="scroll" data-offse="0">
                    
                <?php 
                while ($row =  mysqli_fetch_array($resultCompativel,MYSQLI_ASSOC)) { #echo "Palavra  
                 # echo $row['ID_Item']." Categoria:".$row['categoria'];
                ?>    
                <li class="list-group-item list-group-item-primary d-flex bd-highlight mt-2 mr-2 rounded" style="height: 65px">
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
                 } 
                 #<?php echo $linkCategoria;
                 ?>            
                    <form method="POST" action="<?php echo $linkCategoria;?>" data-toggle="validator" role="form" align="start" >
                      <img src="<?php echo $row['img_componente'];?>" class="img  mb-3" align="center" width="60" height="45">
                      <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $row['ID_Item']; ?>"/>
                      <input type="hidden" name="ItemAnterior" id="cod_processo" value="<?php echo $arrayResult['ID_Projeto']; ?>"/>  
                        <button  type="submit" class="btn btn-outline-primary border-0 " target="_blank">  
                          <h6 style="text-align:center;">
                            <p>
                               <?php echo $row['nomeItem'];?> 
                            </p>
                          </h6> 
                        </button>
                    </form>
                    </li>
                <?php } mysqli_free_result($resultCompativel); ?> 
                  <!-- Inserir componentes dessa lista em um for do tamanho do retorno -->
             </div>
        </div>
    </div>

<!--   =============================   Botão Editar  =========================================   -->                             <!--  Sò deve aparecer se o usuário estiver logado    -->        

<!--   =============================   Fim do formulário =========================================   -->
    
    <?php 
      if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
        if($_SESSION["logado"] == 1){ 
      ?>
           <!--  Sò deve aparecer se o usuário estiver logado    --> 
           <div id="ID_DIV_Alert" align="center"></div>        
          <form  align="center" class="" method="POST" action="TelaEditarProjeto.php" data-toggle="validator" role="form">
            <input type="hidden" name="ItemPesquisa" id="cod_processo" value="<?php echo $_SESSION["itemAtual"] ?>"/> 
                <button  type="submit" class="btn btn-primary mt-3  tamanhoBTNS" align="center" ">  
                   <svg id="i-edit" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                   <path  d="M30 7 L25 2 5 22 3 29 10 27 Z M21 6 L26 11 Z M5 22 L10 27 Z"  />
                   </svg>   
                 Editar Conteúdo
                </button>
                <button  type="button" id="BT_Avaliar" class="btn btn-outline-success mt-3 ml-1" data-toggle="modal" data-target="#ID_Modal_Avaliar">  
                 Avaliar
                </button>
          </form>

<div>

  <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-3" align="start">Comentários</h4>
      <div id="ID_DivComent">
           <div class="form-group ml-3 mr-3" align="start">
               <label for="exampleFormControlTextarea1"><strong><?php echo $_SESSION['nomeUser']; ?></strong></label>
               <textarea class="form-control" name="info_add" id="ID_Campo_Comentario" rows="5" style="resize: none" placeholder="Digite aqui seu comentário sobre este projeto..."> </textarea>
          </div>
          <?php 

           $idCometar = $idUsuario[0].':'.$arrayResult['ID_Projeto']; 
          ?>
            <button  type="button" id="<?php echo $idCometar;?>" style='display: block;' class="btn btn-primary mt-1 ml-4 mr-2 tamanhoBTNS">  
              <svg id="i-msg" viewBox="0 0 32 32" width="24" height="24" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                  <path d="M2 4 L30 4 30 22 16 22 8 29 8 22 2 22 Z" />
              </svg>
             Comentar
            </button>
      </div>
      <script>
              $("body").on('click', '#ID_DivComent button', function(){
                var textComent = document.getElementById("ID_Campo_Comentario").value; 
                var id = $(this).attr('id');
                var item = id.split(':');
               
                $.ajax({
                    url : 'ControleComentarios.php',
                    type: 'POST',
                    data:{TextComentario:textComent, ID_Usuario:item[0],ID_Projeto:item[1]},
                   
                    success: function(retorno)
                    {
                      textComent = '';
                        if(retorno == -1)
                        {
                          alert("erro!");
                        }else{
                          $("#divListaComents").html(retorno);
                          window.location.reload(); 
                          window.location.href = "#divListaComents";

                        } 
                    }, error:function()
                    {
                      $("#divListaComents").html("Houve um erro ao adicionar!");
                    }
                });
              });                                
        </script>
 <?php
   } 
 }
 ?>     
      <div id="divListaComents" class="mt-3 ml-3 mr-3" >

        <?php 
        $comentarios = $fachada->buscarComentario($idItem);
        while ($row =  mysqli_fetch_array($comentarios,MYSQLI_ASSOC)) {
        ?>
         <div>
           <label for="exampleFormControlTextarea1" class="mt-2">
            <svg align="center" id="i-user" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                   <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" />
             </svg>
           <strong><?php echo $row['nomeUsuario'];?></strong>: Data: <?php echo $row['dataComentario'];?></label>
          </div>
           <textarea id="<?php echo $row['ID_Comentarios'];?>" class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="5" style="resize: none;"  ><?php echo $row['descricao'];?>  
           </textarea>
       
        <?php 
         $idBtEditar = "BT_Editar_comentario:".$row['ID_Comentarios'].":".$row['ID_Usuario_FK'].":".$idItem;
         #echo "ID Usuario Atual:". $idUsuario[0]."<br>";
        # echo "ID Usuario comentario: ".$row['ID_Usuario_FK'];
        if($idUsuario[0] == $row['ID_Usuario_FK']){
         ?>

        <button type="button" id="<?php echo $idBtEditar;?>" class="btn btn-link">Editar</button>
        <?php 
         $idBtExcluir = "BT_Excluir_comentario:".$row['ID_Comentarios'].":".$row['ID_Usuario_FK'].":".$idItem; 
         #echo "ID BT Exlucir :".$idBtExcluir; 
         ?>
        <button type="button" id="<?php echo $idBtExcluir;?>" class="btn btn-link">Excluir</button>
        <?php 
         $idBtSalvar = "BT_Salvar_comentario:".$row['ID_Comentarios'].":".$row['ID_Usuario_FK'].":".$idItem; 
         #echo "ID usuario FK:".$row['ID_Usuario_FK']; 
         ?>
        <button type="button" id="<?php echo $idBtSalvar;?>" value='ok' class="btn btn-link" style="display: none;" >Salvar</button>
         <?php 
            }
        } mysqli_free_result($comentarios);
         ?>
         
      </div>
      <script>
              $("body").on('click', '#divListaComents button','#divListaComents textarea', function(){ 

                var id = $(this).attr('id');
                var item = id.split(':');  
                
               
                var textareaC = document.getElementById(item[1]);
                if(!textareaC)
                {
                  alert("Elemento com o id: "+item[1]+" não econtrado ");
                } 

                var idEditar  = "BT_Editar_comentario:"+item[1]+":"+item[2]+":"+item[3];
                var idSalvar  = "BT_Salvar_comentario:"+item[1]+":"+item[2]+":"+item[3];
                var idExcluir = "BT_Excluir_comentario:"+item[1]+":"+item[2]+":"+item[3];
                var btExluir = document.getElementById(idExcluir);
                var btEditar = document.getElementById(idEditar);
                var btSalvar = document.getElementById(idSalvar);
               
                if(id == idEditar){
                  
                  textareaC.removeAttribute("readonly");
                  editou = true;
                  btSalvar.style.display = "block";
                  btExluir.style.display = "none";
                  btEditar.style.display = "none";
                }else

                if(id == idSalvar){
                  editou = false;
                  textareaC.readOnly = 'readonly';
                  $.ajax({
                      url : 'ControleComentariosUpdate.php',
                      type: 'POST',
                      data:{TextComentario:textareaC.value,ID_Comentario:item[1], ID_Usuario:item[2],ID_Projeto:item[3]},
                     
                      success: function(retorno)
                      {
                          if(retorno == -1)
                          {
                            alert("erro!");
                          }else{
                            $("#divListaComents").html(retorno);
                             window.location.reload(); 
                             window.location.href = "#divListaComents";

                          } 
                      }, error:function()
                      {
                        $("#divListaComents").html("Houve um erro ao adicionar!");
                      }
                  });
               }else if(id == idExcluir){
                  
                  $.ajax({
                      url : 'ControleComentariosUpdate.php',
                      type: 'POST',
                      data:{ID_Comentario_Excluir:item[1], ID_Projeto:item[3]},
                     
                      success: function(retorno)
                      {
                          if(retorno == -1)
                          {
                            alert("erro!");
                          }else{
                            $("#divListaComents").html(retorno);
                             window.location.reload(); 
                             window.location.href = "#divListaComents";
                            
                          } 
                      }, error:function()
                      {
                        $("#divListaComents").html("Houve um erro ao adicionar!");
                      }
                  });
                }
              });                                
        </script>
</div>
  <!--   ========================= Modal ADD ========================   -->
          <div class="modal fade" id="ID_Modal_Avaliar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
               <div class="modal-dialog" role="document">
                
                
                    <div class="modal-content"  >
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Avaliação de projeto!</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <label for='s1' class="ml-5"><h6>0 estrelas = Não gostei muito! - 5 estrelas = Exelente!</h6></label>
                          <form method="POST" action="#" >
                            <input type="hidden" name="avaliacao" id="ID_Avaliacao" value="0" />
                              <button type="button" id="s1" onmouseout="mudarCor2('s1')" onmouseover="mudarCor('s1');" onclick="mudarImg('img1')" class="mt-1 ml-5" style="background-color: #0000; border-color: #0000">        
                                  <img src="img/estrela0.png" id="img1">
                              </button>
                              <button type="button" id="s2" onmouseout="mudarCor2('s2')" onmouseover="mudarCor('s2');" onclick="mudarImg('img2')" class="mt-1" style="background-color: #0000; border-color: #0000">        
                                  <img src="img/estrela0.png" id="img2">
                              </button>
                              <button type="button" id="s3" onmouseout="mudarCor2('s3')" onmouseover="mudarCor('s3');" onclick="mudarImg('img3')" class="mt-1" style="background-color: #0000; border-color: #0000">        
                                  <img src="img/estrela0.png" id="img3">
                              </button>
                              <button type="button" id="s4" onmouseout="mudarCor2('s4')" onmouseover="mudarCor('s4');" onclick="mudarImg('img4')" class="mt-1" style="background-color: #0000; border-color: #0000">        
                                  <img src="img/estrela0.png" id="img4">
                              </button>
                              <button type="button" id="s5" onmouseout="mudarCor2('s5')" onmouseover="mudarCor('s5');" onclick="mudarImg('img5')" class="mt-1" style="background-color: #0000; border-color: #0000">        
                                  <img src="img/estrela0.png" id="img5">
                              </button>
                          </form>
                        </div>

                        <div class="modal-footer" id="div_avaliar">
                          <button type="button" id='ID_Cancelar' class="btn btn-secondary" data-dismiss="modal">Cancelar
                          </button>
                          
                          <button type="button" class="btn btn-primary" data-dismiss="modal" id="<?php echo $idUsuario[0].':'.$arrayResult['ID_Projeto']; ?>">Avaliar</button>
                    <script>
                      $("body").on('click','#div_avaliar button',function(){
                         var id = $(this).attr('id');
                         var item = id.split(':');
                         alert("ID: "+id);
                         if(id != 'ID_Cancelar'){ 
                         var aval = document.getElementById('ID_Avaliacao').value;
                         alert("Avaliação atual"+item[0]+" ID Projeto: "+item[1]); 
                   
                      $.ajax({
                          url : 'ControleAvaliacao.php',
                          type: 'POST',
                          data:{ID_Usuario:item[0], ID_Projeto:item[1],Avaliacao:aval},
                        
                        success: function(retorno)
                        {
                           if(retorno == -1)
                        {
                             alert("Item já adicionado!");
                        }else{
                          $("#ID_DIV_Alert").html(retorno);
                        } 
                        }, error:function()
                        {
                         $("#ID_DIV_Alert").html("Houve um erro ao adicionar!");
                       }
                      });
                     }         
                    });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
<!--   ======================= Fim Modal =======================   -->
    
    <script src="jquery/dist/jQuery.js"></script>
    <script src="popper.js/dist/umd/popper.js"></script>
    <script src="bootstrap/dist/js/bootstrap.js"></script>
  </body>
</html>
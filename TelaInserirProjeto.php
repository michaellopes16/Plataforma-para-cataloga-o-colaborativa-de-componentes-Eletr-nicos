<?php session_start();

$ID_Micro_Compativeis = '';
$_SESSION["ID_Item"]= array();
$_SESSION["Nome_Item"]= array();
$_SESSION['Excluir'] = '';


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
         <a href="TelaFavoritos.php" class="btn btn-primary  mr-2 ml-2 mr-auto p-2 bd-highlight">
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

 <h5 class="modal-title mb-3 mt-4" align="center"><b>Inserir Projeto</b></h5>

    
     <div class="container-fluid  d-flex flex-column bd-highlight  quadradoInserirProjeto  col-md-10" data-spy="scroll"  data-target="#list-example" data-offset="0" class="scrollspy-example">
      
      
      <div class="container-fluid  align-items-center ">
       <form  class="tamnhoForm" method="POST" action="ControleProjeto.php" role="form" enctype="multipart/form-data" data-toggle="validator">

 <!--   =============================   Informações Gerais   =======================   -->

         <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
        
<!--   ====================== Carregamento das imagens ================================   -->
       
         <div class="form-row" align="start">

           <div class="form-group col-md-5" align="start">
             
             <img src="img/ItemTeste.png" id="ID_IMG_Componente"  class="img mt- border border-primary rounded" width="130" height="80">
             <input type="file" name="caminho_img_componente" class="form-control-file" id="ID_Enviar_Foto" required>
             <label class="custom-file-label" for="ID_Enviar_Foto">Imagem do Componente</label>
           </div>  
         </div>

<!--   =============================== Linha 1 =========================================   -->
         
         <div class="form-row" align="center">
           <div class="form-group col-md-6" align="start">
             <label for="ID_Campo_Titulo" >Título do Pojeto</label>
             <input type="text" name="nome" class="form-control" id="ID_Campo_Nome" placeholder="Título"required>
           </div>
           <!-- colocar um campo perguntando a quantidade de autores, e adicionar outros campos de acordo com a quantidade de autores -->
           <div class="form-group col-md-6" align="start">
             <label for="ID_Campo_Nome_autorP">Nome do autor principal</label>
             <input type="text" name="autor_principal" class="form-control" id="ID_Campo_Nome_autorP" placeholder="Nome Completo" required>
           </div>
         </div>
          <!--   =============================== Linha 2 =========================================   -->
         <div class="form-row">
          <div class="form-group col-md-6" align="start">
            <label for="ID_Campo_Email_autorP">E-mail autor principal</label>
            <input type="email" name="email_autor_principal" class="form-control" id="ID_Campo_Email_autorP" placeholder="fulano@beltrano.com.br" required>
          </div>
           <div class="form-group col-md-6" align="start">
             <label for="ID_Campo_Nome_demaisA">Nome demais autores</label>
             <input type="text" name="nome_demais_autores" class="form-control" id="ID_Campo_Nome_demaisA" placeholder="Fulano de Sá, Beltrano Lopes...">
           </div>
         </div>

   <!--   =============================== Linha 3 =========================================   -->   
      <div class="form-row">
         <div class="form-group col-md-6" align="start">
           <label for="ID_Campo_Email_demaisA">Emails demais autores</label>
           <input type="text" name="email_demais_autores" class="form-control" id="ID_Campo_Email_demaisA" placeholder="fulano@beltrano.com, lopes@santos.com,...">
         </div>
         <div class="form-group col-md-6" align="start">
           <label for="ID_campo_Palavra_Chave">Palavras Chave para o projeto</label>
           <input type="text" name="palavra_chave" class="form-control" id="ID_campo_Palavra_Chave" placeholder="Projeto Tal, Tecnologia Tal, Placa tal...">
         </div>
      </div>
   <!--   =============================== Linha 4 =========================================   -->
         
         <div class="form-row">
          <div class="form-group col-md-6" align="start">
            <label for="ID_Campo_Repositorio" >Link para repositório</label>
            <input type="link" name="link_repo" class="form-control" id="ID_Campo_Repositorio" placeholder="https:// ...">
          </div>
          <div class="form-group col-md-6" align="start">
            <label for="ID_Campo_Video">Link para vídeo Demonstrativo</label>
            <input type="link" name="link_video" class="form-control" id="ID_Campo_Video" placeholder="https:// ...">
          </div>
         </div>
  <!--   =============================== Linha 5 =========================================   -->      
         <div class="form-row">
          <div class="form-group col-md-6" align="start">
            <label for="ID_Campo_Repositorio" >Link do site do projeto (opcional)</label>
            <input type="link" name="link_site" class="form-control" id="ID_Campo_Repositorio" placeholder="https:// ...">
          </div>
         </div>
 <!--   =============================   Metodologia Utilizada   ============================================   -->       
       <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start"> Metodologia Utilizada</h4>
       
       <div class="form-group" align="start">
           <textarea class="form-control" name="metodologia" id="ID_Campo_Ind_Add" rows="16" style="resize: none" placeholder="Descreva o passo a passo para construção do seu projeto."></textarea>
      </div>
 <!--   =============================   Componentes Utilizados   ============================================   -->       
      <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-3" align="start">Componentes Utilizados</h4>
    <div class="form-row">
  
           <?php if(isset($_SESSION['ID_Item'])) {?>
            <input type="hidden" name="compativel[]" value="<?php $_SESSION['ID_Item'];?> "/>
          <?php } ?>

             <div class="form-group col-md-4" align="start">
                  <a href="#" for="ID_Campo_Funcao" class="btn btn-outline-primary " style="height: 45px;" data-toggle="modal" data-target="#ID_Modal_Adicionar_Item">  
                          Adicionar Item
                   </a> 
                  <div  id="e_compativel" class="divScrollItens rounded" data-spy="scroll" data-offse="0">
                        
                        <!-- Inserir componentes dessa lista em um for do tamanho do retorno -->
                 <?php   
                 $novoArrayNome = array();
                 $novoArrayID = array();

                    foreach($_SESSION['Nome_Item'] as $list):
                        if(isset($_SESSION['ID_Item']) && isset($_SESSION['Nome_Item'])){
                                array_push($novoArrayID,$row ['ID_Item']);
                                array_push($novoArrayNome,$row ['nomeItem']);
                               }
                          $_SESSION['Nome_Item'] = $novoArrayNome;
                          $_SESSION['ID_Item'] = $novoArrayID;
                 ?>
                      <li class="list-group-item list-group-item-primary d-flex bd-highlight mt-2 mr-2 rounded" style="height: 60px;">
                          <a href="#"  class="btn btn-link tamanhoBTNS mr-auto ml-3 mb-3 " align="center">  
                            <h6 style="text-align:center;">
                               <?php echo $list; ?>
                           </h6> 
                          </a>
                          <div>
                          <a href="#" class="btn btn-primary mt-0 mr-0"  data-toggle="modal" data-target="#ID_Modal_Excluir_Item">  
                            <svg id="i-trash" viewBox="0 0 33 30" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                            </svg> 
                            Excluir
                            <!-- Esse excluir só tira da lista, não do Banco de dados -->
                          </a>
                          </div>
                        </li>
                          <?php  
                               endforeach;  
                         ?>
                   </div>
               </div>
         </div>

<!--   =============================   Botão Salvar  =========================================   -->     <button type="submit" class="btn btn-primary mt-5 mb-3 ml-4" align="center">
       <svg id="i-archive" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
           <path d="M4 10 L4 28 28 28 28 10 M2 4 L2 10 30 10 30 4 Z M12 15 L20 15"  />
       </svg>
     Salvar
     </button>
<!--   =============================   Fim do formulário =========================================   -->
    </form>
  </div>
</div>

<<!--   =============================== Modal ADD Item =========================================   -->
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

                <div data-spy="scroll" id="resultado" style="width: 100%; height:50%;"></div>
                
                <div data-spy="scroll" id="adicionados" style="width: 100%;border:1px solid #222; height:50%;"> </div>

            <script>
                $("#ID_Busca_Item").keyup(function(){
                    $.ajax({
                        url : 'ControleBuscaComparar.php',
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
                        url : 'ControleBuscaProjeto.php',
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
                   url : 'ControleBuscaProjeto.php',
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
                      $.ajax({
                          url : 'ControleBuscaProjeto.php',
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
                      url : 'ControleBuscaProjeto.php',
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
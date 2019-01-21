<?php session_start();
include_once("conexao/Fachada.class.php");
$_SESSION['tipoBusca'] = 1;

if(isset($_SESSION['logado']) && empty($_SESSION['logado'])){
  $_SESSION["logado"] = 0;
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
        if(display == "none"){
            document.getElementById(el).style.display = 'block';
        }     
    }
    function Mudarestado2(el)
    {
       var display = document.getElementById(el).style.display;
        if(display == "block"){
            document.getElementById(el).style.display = 'none';
        }  
    }
    </script>
    <title>Eletronics Component Catalog</title>
  </head>
  <body>
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
                      <a href="TelaGerenciarComponentes.php" class="btn btn-outline-primary mr-0 ml-2  p-2 bd-highlight"> 
                         <svg align="center" id="i-user" viewBox="0 0 30 30" width="25" height="18" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" />
                          </svg>
                       <?php echo $_SESSION["nomeUser"];  ?>
                      </a>
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
      <div class="container mt-5" align="center">
        <img src="img/logo3.png" class="img" align="center">
      </div>
      <!-- -->
      <div class="d-flex justify-content-center" align="center">
        <div class="d-flex flex-column bd-highlight mb-3">

         <form method="POST" action="TelaListarComponente.php" data-toggle="validator" role="form">
            <div class="input-group mb-3">
              <input class="form-control p-2" type="search" name="busca" size="80" maxlength="90" placeholder="Buscar..." id="ID_Campo_Busca">
              <div class="input-group-append">
                <select class="custom-select" for="ID_Campo_Busca" id="ID_TipoDeBusca" name="tipoBusca">
                  <option value="1" selected>Por nome</option>
                  <option value="2">Por projeto</option>
                  <option value="3">Por Palavra-chave</option>
                </select>
               </div>
            </div>   
                <button type="submit" class="btn btn-primary"  id="button-pesquisar">
                  <svg  id="i-star" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                     <circle cx="14" cy="14" r="12" />
                      <path d="M23 23 L30 30"  />
                  </svg>  
                  Buscar
                </button>        
            </form>
          </div>
        </div>
<div class="d-flex justify-content-center" id="divBotoes">
    <button id="1:microcontrolador" class="btn btn-outline-primary mr-2" style="width: 180px;height: 90px;" onclick="Mudarestado('divListarItens')"  ondblclick="Mudarestado2('divListarItens')">
      <img src="img/microIcon.png" class="mb-2" style="width: 100px;height: 80px;">
    </button>

    <button id="2:bateria" class="btn btn-outline-primary mr-2" style="width: 180px;height: 90px;" onclick="Mudarestado('divListarItens')" ondblclick="Mudarestado2('divListarItens')">
      <img src="img/bateriaIcon.png" class="mb-2" style="width: 100px;height: 80px;">
    </button>

    <button id="3:shield" class="btn btn-outline-primary mr-2" style="width: 180px;height: 90px;" onclick="Mudarestado('divListarItens')"ondblclick="Mudarestado2('divListarItens')">
      <img src="img/shieldIcon.png" class="mb-2" style="width: 100px;height: 80px;">
    </button>

    <button id="4:atuador" class="btn btn-outline-primary mr-2" style="width: 180px;height: 90px;" onclick="Mudarestado('divListarItens')" ondblclick="Mudarestado2('divListarItens')">
      <img src="img/atuadorIcon.png" class="mb-2" style="width: 100px;height: 80px;">
    </button>

    <button id="5:sensor" class="btn btn-outline-primary mr-2" style="width: 180px;height: 90px;" onclick="Mudarestado('divListarItens')" ondblclick="Mudarestado2('divListarItens')">
      <img src="img/sensorIcon.png" class="mb-2" style="width: 100px;height: 80px;">
    </button>
    
    <button id="6:projeto" class="btn btn-outline-primary mr-2" style="width: 180px;height: 90px;" onclick="Mudarestado('divListarItens')" ondblclick="Mudarestado2('divListarItens')">
      <img src="img/projetoIcon.png" class="mb-2" style="width: 100px;height: 80px;">
    </button>
    <script>
      $("body").on('click', '#divBotoes button', function(){
           
        var id = $(this).attr('id');
        var item = id.split(':');
        $.ajax({
          url : 'ControleListageral.php',
          type: 'POST',
          data:{categoria:item[1]},
             
          success: function(retorno)
          {
            if(retorno == -1)
            {
              alert("Item já adicionado!");
            }else{
              $("#divListarItens").html(retorno);
            } 
          }, error:function()
          {
              $("#divListarItens").html("Houve um erro ao adicionar!");
          }
          });
        });                      
        </script>
</div>
<!--   ====================Listagem geral ===================   -->
 <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start"></h4> <!-- Cards referentes aos projetos sugeridos para cada componente ao componente 1-->
      <?php 
      
       ?>
      <div id="divListarItens" style="display: none;">
      </div>

       <div class="container-fluid  d-flex align-items-center flex-column bd-highlight mb-3 mt-5" style="height: 120px;"></div>
       <div class="container-fluid  d-flex align-items-center flex-column bd-highlight mb-3 mt-5"></div>
       <div class="container-fluid  d-flex align-items-center flex-column bd-highlight mb-3 mt-5"></div>
       <div class="container-fluid  d-flex justify-content-center align-items-baseline mb-3 mt-3">
          <label class= "btn btn-link ml-5 p-2 bd-highlight" for="male" data-toggle="modal" data-target=".modal-contato">Contato</label>
          <label class= "btn btn-link ml-5 p-2 bd-highlight" for="male" data-toggle="modal" data-target=".modal-informacoes">Informações do Projeto</label>
       </div>
        <!-- Modal Dos Contatos -->
          <div class="modal fade modal-contato" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg"">
              <div class="modal-content">
                 <div class="modal-header">
                  <h5 class="modal-title">Contatos</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body">
                  <p>
                    <br /> <b>Desenvolvido por:</b> Michael Lopes Bastos {mlb@cin.ufpe.br} <br />
                           <b>Supervisionado por:</b> Giordano Ribeiro Eulalio Cabral {grec@cin.ufpe.br}<br />  e 
                           Felipe Calegário <br/>
                           Centro de Informática(CIn) - Universidade Federal de Pernambuco (UFPE)
                  </p>
                </div>
              </div>
            </div>
          </div>
          <!-- Modal Informações do Projeto -->
          <div class="modal fade modal-informacoes" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                 <div class="modal-header">
                  <h5 class="modal-title">Informações do Projeto</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body">
                  <p>
                    <br />  Este projeto tem como objetivo manter uma plataforma para catalogação colaborativa das principais tecnologias que podem ser utilizadas nos novos instrumentos digitais musicais (MDI), realizando um registro desde componentes para comunicação sem fio até os diversos meios de armazenamento de energia existentes atualmente. 
                    <br /> 
                    Este é um trabalho colaborativo, logo, sinta-se a vontade para adicionar informações no nosso acervo e compatilhar seus projetos e conhecimento adiquiridos ao longo de suas experiências profissionais e acadêmicas.
                  </p>
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
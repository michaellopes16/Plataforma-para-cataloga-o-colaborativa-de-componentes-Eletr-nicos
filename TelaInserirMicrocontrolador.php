<?php session_start();?>
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

<!--   ========================= Cabeçalho ===================================================--> 

<div class="container d-flex bd-highlight mb-3">
  <img src="img/logo2.png" class="img mr-auto p-2 bd-highlight" align="center">
<?php 
    if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
    if($_SESSION["logado"] == 1){ ?>
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
<?php } }?>
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


 <h5 class="modal-title mb-3 mt-4" align="center"><b>Inserir Microcontrolador</b></h5>
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

     <div class="container-fluid  d-flex flex-column bd-highlight  quadradoInserirItem  col-md-10" data-spy="scroll"  data-target="#list-example" data-offset="0" class="scrollspy-example">
      
      <div class="container-fluid  align-items-center ">
       <form  class="tamnhoForm " method="POST" action="ControleMicrocontrolador.php" role="form" enctype="multipart/form-data" data-toggle="validator">

 <!--   =============================   Informações Gerais   =============================   -->
       
         <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
        
<!--   ====================== Carregamento das imagens ===================================   -->
       
         <div class="form-row" align="start">

           <div class="form-group col-md-5" align="start">
             <img src="#" id="ID_IMG_Componente"  class="img mt- border border-primary rounded" width="130" height="80">
              <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
             <input type="file" name="imgComponente" class="form-control-file" id="ID_Enviar_Foto" required>
             <label class="custom-file-label" for="ID_Enviar_Foto">Imagem do Componente</label>
           </div>  
           <div class="form-group col-md-5" align="start">
             <img src="#" id="ID_IMG_Legenda"  class="img mt- border border-primary  rounded" width="130" height="80">
             <input type="hidden" name="MAX_FILE_SIZE" value="99999999"/>
             <input type="file" name="imgLegenda" class="form-control-file" id="ID_Enviar_Pinagem" required>
             <label class="custom-file-label" for="ID_Enviar_Pinagem">Legenda de Sinais (pinagem)</label>
           </div>  
           <div class="form-group col-md-2 mt-5" align="end">
              <!-- Adicionar imagem no frames e salva-las-->
             <a href="#" class="btn btn-outline-primary mr-2">Carregar Imagens</a>
           </div>

         </div>

<!--   =============================== Linha 1 =========================================   -->

         <div class="form-row" align="center">
           <div class="form-group col-md-4" align="start">
             <label for="ID_Campo_Nome" >Nome</label>
             <input type="text" name="nome" class="form-control" id="ID_Campo_Nome" placeholder="Ex.: Arduino" required>
           </div>
           <div class="form-group col-md-4" align="start">
             <label for="ID_Campor_Modelo">Modelo</label>
             <input type="text" name="modelo" class="form-control" id="ID_Campor_Modelo" placeholder="Ex.: Uno R3" required>
           </div>
           <div class="form-group col-md-4" align="start">
             <label for="ID_Campor_TO">Temperatura de operação</label>
             <input type="text" name="temperatura_ope" class="form-control" id="ID_Campor_TO" placeholder="Temp. Mínima e Máxima em Cº">
           </div>
         </div>
 <!--   =============================== Linha 2 =========================================   -->

         <div class="form-row">
           <div class="form-group col-md-4" align="start">
             <label for="ID_Data_Sheet" >Link DataSheet</label>
             <input type="link" name="link_DS" class="form-control" id="ID_Data_Sheet" placeholder="https:// ...">
           </div>
           <div class="form-group col-md-4" align="start">
             <label for="ID_Palavra_chave">Palavra-chave</label>
             <input type="link" name="palavra_chave" class="form-control" id="ID_Palavra_chave" placeholder="Palavra1, Palavra2 ...">
           </div>
           <div class="form-group col-md-4" align="start">
             <label for="inputPassword4">Preço Médio</label>
             <input type="number" name="preco_medio" class="form-control" id="ID_Campor_PM" placeholder="R$ 0,00">
           </div>
         </div>

         <!--   =============================== Linha 3 =========================================   -->
         <div class="form-row">
           <div class="form-group col-md-4" align="start">
             <label for="ID_Dimensoes">Dimensões</label>
             <input type="text" name="dimensao" class="form-control" id="ID_Dimensoes" placeholder="00cm X 00cm X 00 cm">
           </div>
           <div class="form-group col-md-4" align="start">
             <label for="inputState">Plataforma de Desenvolvimento</label>
             <select id="inputState" name="plataforma_desen[]" multiple class="form-control">
               <option selected>Arduino</option>
               <option>Eclipse</option>
               <option>Keil uVision5</option>
               <option>mbede</option>
               <option>Code Blocks</option>
               <option>Outros</option>
             </select>
             <a href="#" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#ID_Modal_Adicionar_Plat">Adicionar</a>
           </div>

           <div class="form-group col-md-4" align="start">
             <label for="inputState">Linguagem Utilizada</label>
             <select id="inputState" name="linguagem_utili[]" multiple class="form-control">
               <option selected>C</option>
                <option>C++</option>
                <option>C#</option>
                <option>Java Script</option>
                <option>Phyton</option>
             </select>
             <a href="#" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#ID_Modal_Adicionar_Ling">Adicionar</a>
           </div>
         </div>
        
 <!--   =============================   Informações Técnicnas   ============================================   -->       
       <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start"> Informações Técnicas</h4>
       
       <div class="form-row">
         <div class="form-group col-md-4" align="start">
           <label for="ID_Processador" >Processador</label>
           <input type="text" name="processador" class="form-control" id="ID_Processador" placeholder="">
         </div>
         <div class="form-group col-md-4" align="start">
           <label for="ID_Memoria_Ram" >Memória RAM</label>
           <input type="text" name="memoria_RAM" class="form-control" id="ID_Memoria_Ram" placeholder="">
         </div>
         <div class="form-group col-md-4" align="start">
           <label for="ID_Memoria_Flash">Memória Flash</label>
           <input type="text" name="memoria_FLASH" class="form-control" id="ID_Memoria_Flash" placeholder="">
         </div>
       </div>
       <div class="form-row">
         <div class="form-group col-md-4" align="start">
           <label for="ID_Microcontro">Microcontrolador</label>
           <input type="text" name="microcontrolador" class="form-control" id="ID_Microcontro" placeholder="">
         </div>
         <div class="form-group col-md-4" align="start">
           <label for="ID_Clock">Velocidade de Clock</label>
           <input type="text" name="vel_clock" class="form-control" id="ID_Clock" placeholder="">
         </div>
         <div class="form-group col-md-2" align="start">
           <label for="ID_GPIO_A">GPIO- Analógicas</label>
           <input type="number" name="GPIO_A" class="form-control" id="ID_GPIO_A" placeholder="Nº">
         </div>
         <div class="form-group col-md-2" align="start">
           <label for="ID_GPIO_D">GPIO- Digitais</label>
           <input type="number" name="GPIO_D" class="form-control" id="ID_GPIO_D" placeholder="Nº">
         </div>
       </div>
 <!--   =============================   Informações Elétricas   ============================================   -->       
      <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-3" align="start">Informações Elétricas</h4>

       <div class="form-row">
         <div class="form-group col-md-4" align="start">
           <label for="ID_Tensao_Ope">Tensão de Operação</label>
           <input type="text" name="tensao_Ope" class="form-control" id="ID_Tensao_Ope" placeholder="Em voltes">
         </div>
         <div class="form-group col-md-4" align="start">
           <label for="ID_Tensao_Entr">Tensão de Entrada</label>
           <input type="text" name="tensao_Entr" class="form-control" id="ID_Tensao_Entr" placeholder="Em voltes">
         </div>
         <div class="form-group col-md-4" align="start">
           <label for="ID_M_Consumo">Modo de Consumo</label>
           <input type="text" name="modo_consumo" class="form-control" id="ID_M_Consumo">
         </div>
       </div>
<!--   =============================   Interfaces de Comunicação   =========================================   -->       
       <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-4" align="start">Interfaces de Comunicação</h4>
       
       <div class="form-row">

           <div class="form-group col-md-4" align="start">
             <label for="ID_Comu_SF">Sem Fio</label>
             <select id="ID_Comu_SF" name="sem_fio[]" multiple class="form-control">
               <option selected>Nenhuma</option>
               <option>Bluethoth</option>
               <option>Zeg-bee</option>
               <option>WI-FI</option> 
             </select>
             <a href="#" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#ID_Modal_Adicionar_SF">Adicionar</a>
           </div>
           <div class="form-group col-md-4" align="start">
             <label for="ID_Comu_Se">Serial</label>
             <select id="ID_Comu_Se" name="serial[]" multiple class="form-control">
               <option selected>Nenhuma</option>
               <option>I2C</option>
               <option>UART</option>
             </select>
             <a href="#" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#ID_Modal_Adicionar_Se">Adicionar</a>
           </div>
        </div>
       
<!--   =============================   Componentes Adicionais   =========================================   -->              
       <h4 class="mt-4 mb-4  border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-5" align="start">Componentes Adicionais</h4>
       <div class="form-row">
         <div class="form-group col-md-4" align="start">
          <!-- Tem que ser uma Lista de multipla escolha -->
           <label for="ID_Inter_E">Interface de Entrada</label>
           <select id="ID_Inter_E" name="inter_E[]" multiple class="form-control">
             <option selected>Nenhum</option>
             <option>Micro USB</option>
             <option>HDMI</option>
             <option>Ethernet</option>
           </select>
           <a href="#" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#ID_Modal_Adicionar_IE">Adicionar</a>
         </div>
         <div class="form-group col-md-4" align="start">
          <!-- Tem que ser uma Lista de multipla escolha -->
           <label for="ID_Sensores">Sensores</label>
           <select id="ID_Sensores" name="sensores[]" multiple class="form-control">
             <option selected>Nenhum</option>
             <option>Temperatura</option>
             <option>Luminosidade</option>
             <option>Toque</option>
           </select>
           <a href="#" class="btn btn-outline-primary mr-2" data-toggle="modal" data-target="#ID_Modal_Adicionar_Sensores">Adicionar</a>
         </div>
       </div>
       <div class="form-group" align="start">
           <label for="exampleFormControlTextarea1">Informações Adicionais</label>
           <textarea class="form-control" name="info_add" id="ID_Campo_Ind_Add" rows="8" style="resize: none" placeholder="Digite aqui alguma informação sobre o componete que não está em um dos campos acima..."></textarea>
      </div>

<!--   =============================   Botão Salvar  =========================================   -->                
     <button type="submit" class="btn btn-primary mt-5 mb-3 ml-4" align="center">
       <svg id="i-archive" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
           <path d="M4 10 L4 28 28 28 28 10 M2 4 L2 10 30 10 30 4 Z M12 15 L20 15"  />
       </svg>
     Salvar
     </button>
<!--   =============================   Fim do formulário =========================================   -->
    </form>
  </div>
</div>

<!--   =============================   Botão Voltar  =========================================   -->
    <div class="container-fluid  d-flex align-items-start flex-column bd-highlight mb-3 mt-5">
      <a href="#" class="btn btn-primary mr-2">Voltar</a>
    </div>

<!--   =============================== Modal ADD Plataforma=========================================   -->
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
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary">Salvar Informação</button>
          </div>
        </div>
      </div>
    </div>
<!--   =============================== Modal ADD Linguagem =========================================   -->
    <div class="modal fade" id="ID_Modal_Adicionar_Ling" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <label for="recipient-name" class="col-form-label">Insira o nome da nova Linguagem</label>
                <input type="text" class="form-control" id="recipient-name">
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            <button type="button" class="btn btn-primary">Salvar Informação</button>
          </div>
        </div>
      </div>
    </div>
    <!--   =============================== Modal ADD Sem Fio =========================================   -->
        <div class="modal fade" id="ID_Modal_Adicionar_SF" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <label for="recipient-name" class="col-form-label">Insira a nova Interface de Comunicação sem fio</label>
                    <input type="text" class="form-control" id="recipient-name">
                  </div>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar Informação</button>
              </div>
            </div>
          </div>
        </div>
  <!--   =============================== Modal ADD Serial =========================================   -->
            <div class="modal fade" id="ID_Modal_Adicionar_Se" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <label for="recipient-name" class="col-form-label">Insira a nova Interface de Comunicação serial</label>
                        <input type="text" class="form-control" id="recipient-name">
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary">Salvar Informação</button>
                  </div>
                </div>
              </div>
            </div>
  <!--   ========================= Modal ADD Interface de Entrada =========================================   -->
                <div class="modal fade" id="ID_Modal_Adicionar_IE" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label for="recipient-name" class="col-form-label">Insira a nova Interface de Entrada</label>
                            <input type="text" class="form-control" id="recipient-name">
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary">Salvar Informação</button>
                      </div>
                    </div>
                  </div>
                </div>
  <!--   ========================= Modal ADD Sensor =========================================   -->
                <div class="modal fade" id="ID_Modal_Adicionar_Sensores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <label for="recipient-name" class="col-form-label">Insira o novo tipo de Sensor</label>
                            <input type="text" class="form-control" id="recipient-name">
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-primary">Salvar Informação</button>
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
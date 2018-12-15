<?php session_start();
include_once("conexao/Fachada.class.php");
#include_once("TelaInserirShield.php");
include_once("conexao/MicrocontroladorVO.class.php");
$ID_Busca_Item ='';
$ID_Busca_Item2 ='';
$ID_Item2 = '';
$arraySegundoItem = null;
$resultCompativel = null;
$resultCompativel2 = null;
$Nome_item = '';
$fachada = new Fachada;
$retorno = '';
$_SESSION['resultCompativel'] = array();

if(isset($_POST["ID_Busca_Item"])){
  $ID_Busca_Item = $_POST["ID_Busca_Item"];
}

$arrayResult  = $fachada->getItensGeral($ID_Busca_Item);
$countBusca =  mysqli_num_rows($arrayResult);

if($countBusca <=0 || $ID_Busca_Item == "" )
{
    #$_SESSION['categoriaAtual']  = null;
    if(!isset($_POST["ID_Item"])){
         echo $ID_Busca_Item;
    }
}else{
         $nome = '';
         while ($row =  mysqli_fetch_array($arrayResult,MYSQLI_ASSOC)) 
         {
           # $_SESSION["ID_Item"] = $row['ID_Item'];
           if(!isset($_POST["ID_Item"])){
              
              if(strlen($row['nomeItem']) >= 22) 
              {
                $nome = substr($row['nomeItem'],0,22)."...";
              }else
              {
                $nome =$row['nomeItem'];
              }
               echo '
               <li class="list-group-item" style="height: 50px;" align="center"> 
                  <button type="button" id="'.$row['ID_Item'].':'.$row['nomeItem'].':'.$row['img_componente'].':c1" class="btn btn-link" >'.$nome.'</button>                
              </li>
              ';
            }         
         }
         mysqli_free_result($arrayResult);
} 

if(isset($_POST["ID_Busca_Item2"])){
  $ID_Busca_Item2 = $_POST["ID_Busca_Item2"];
  
  #echo "categoria a ser pesquisada: ".$_SESSION['categoriaAtual'];
  $arraySegundoItem  = $fachada->getItenPorCategoria($ID_Busca_Item2,  $_SESSION['categoriaAtual']);
   $countBusca2 =  mysqli_num_rows($arraySegundoItem);

}else
{
  echo '';
}

if($arraySegundoItem != null){
  if($countBusca2 <=0 || $ID_Busca_Item2 == "" )
  {
            if(!isset($_POST["ID_Item2"])){
             echo '';
            }
  }else{
           $nome2 = '';
           while ($row2 =  mysqli_fetch_array($arraySegundoItem,MYSQLI_ASSOC)) 
           {
           # $_SESSION["ID_Item"] = $row['ID_Item'];
           if(!isset($_POST["ID_Item2"])){
              
              if(strlen($row2['nomeItem']) >= 22) 
              {
                $nome2 = substr($row2['nomeItem'],0,22)."...";
              }else
              {
                $nome2 =$row2['nomeItem'];
              }
               echo '
               <li class="list-group-item" style="height: 50px;" align="center"> 
                  <button type="button" id="'.$row2['ID_Item'].':'.$row2['nomeItem'].':'.$row2['img_componente'].':c1" class="btn btn-link" >'.$nome2.'</button>                
              </li>
              ';
            }
              
           }
           mysqli_free_result($arraySegundoItem);
            #echo "Item pesquisa no Tela Exibir: ".$ID_Busca_Item."</br>"  <input type="hidden" name="ID_Item_Clicado" value="'.$row['ID_Item'].'"/>;
  } 
}

if(isset($_POST["ID_Item"])){

    $result2 ='';
    $result3 ='';
    $result4 ='';
    $result = '';
    $recarregavel = '';
    $naoRecarregavel = '';
    $ID_Item = $_POST["ID_Item"];
    $_SESSION['ID_Item'] = $ID_Item;  
    $_SESSION['categoriaAtual'] = null;
    #$_SESSION['resultCompativel2'] = array();
    #$_SESSION['resultCompativel'] = array();
   echo "Categoria no ID_Item: ".$_SESSION['categoriaAtual'];
    
    if($_SESSION['categoriaAtual'] == null){

        $arrayResult  = $fachada->exibirItemPorID($ID_Item);

        $_SESSION['categoriaAtual'] = $arrayResult['categoria'];
        $_SESSION['componente1'] = $arrayResult;
       #$_SESSION['componente2'] = null;
        echo "entrou no IF categoria NULA. Categoria nova: ".$_SESSION['categoriaAtual'];
    } 


    if($_SESSION['componente1']['categoria'] == 'microcontrolador'){
        
        $_SESSION['componente1'] = $fachada->exibirMicrocontrolador($ID_Item);
        $_SESSION['projetosItem1'] = $fachada->buscarProjetosRelacionados($ID_Item);
        mostrarDivMicro();
    }else if($_SESSION['componente1']['categoria'] == 'bateria')
    {

          $_SESSION['componente1'] = $fachada->exibirBateria($ID_Item);
           $_SESSION['projetosItem1'] = $fachada->buscarProjetosRelacionados($ID_Item);
          mostrarDivBateria(); 
    }else if($_SESSION['componente1']['categoria'] == 'sensor')
    {
          $_SESSION['componente1'] = $fachada->exibirSensor($ID_Item);
          $_SESSION['resultCompativel'] = $fachada->sensorGetCompativel($ID_Item);
           $_SESSION['projetosItem1'] = $fachada->buscarProjetosRelacionados($ID_Item);
         # $_SESSION['resultCompativel2'] = $fachada->sensorGetCompativel($_SESSION['ID_Item2'] );
         mostrarDivSensor();

    }else if($_SESSION['componente1']['categoria'] == 'shield'){
          
          echo "ID ITem 1: ".$_SESSION['ID_Item']."<br>";
          echo "ID ITem 2: ".$_SESSION['ID_Item2'];
           $_SESSION['componente1'] = $fachada->exibirShield($_SESSION['ID_Item']);
           $_SESSION['resultCompativel'] = $fachada->shieldGetCompativel($_SESSION['ID_Item']);
           $_SESSION['resultCompative2'] = $fachada->shieldGetCompativel($_SESSION['ID_Item2'] );
           echo "Quant array comp: ".count((array)$_SESSION['resultCompativel']);
            $_SESSION['projetosItem1'] = $fachada->buscarProjetosRelacionados($ID_Item);
           mostrarDivShield();

    }else if($_SESSION['componente1']['categoria'] == 'atuador'){
          $_SESSION['componente1'] = $fachada->exibirAtuador($ID_Item);
          $_SESSION['resultCompativel'] = $fachada->atuadorGetCompativel($_SESSION['ID_Item']);
           $_SESSION['projetosItem1'] = $fachada->buscarProjetosRelacionados($ID_Item);
         # $_SESSION['resultCompativel2'] = $fachada->atuadorGetCompativel($_SESSION['ID_Item2'] );
         mostrarDivAtuador();
    }
}

if(isset($_POST["ID_Item2"])){

    $result2 ='';
    $result3 ='';
    $result4 ='';
    $result = '';
    $recarregavel = '';
    $naoRecarregavel = '';

    #$_SESSION['resultCompativel2'] = array();
    #$_SESSION['resultCompativel'] = array();
   # echo "entrou";
    $ID_Item2 = $_POST["ID_Item2"];
    $_SESSION['ID_Item2'] = $ID_Item2 ;
    if($_SESSION['categoriaAtual'] == null){

        $arrayResult2  = $fachada->exibirItemPorID($ID_Item2);
        echo "entrou no primeiro IF: categoriaAtual: ".$arrayResult2['categoria']."<br> ID do Item pesquisado: ".$ID_Item2;
        $_SESSION['componente2'] = $arrayResult2;
        $_SESSION['categoriaAtual'] = $arrayResult2['categoria'];
    }else
    {
        $arrayResult2  = $fachada->exibirItemPorID($ID_Item2);
        $_SESSION['componente2'] = $arrayResult2;    
    }  

    #echo "categoria do componente2: ".$_SESSION['componente2']['categoria'];
    if($_SESSION['componente2']['categoria'] == 'microcontrolador'){
        
        $_SESSION['componente2'] = $fachada->exibirMicrocontrolador($ID_Item2);
        $_SESSION['projetosItem2'] = $fachada->buscarProjetosRelacionados($ID_Item2);
        $_SESSION['projetosItem1'] = $fachada->buscarProjetosRelacionados($_SESSION['ID_Item']);
        mostrarDivMicro();
    }else if($_SESSION['componente2']['categoria'] == 'bateria')
    {
          $_SESSION['componente2'] = $fachada->exibirBateria($ID_Item2);
          $_SESSION['projetosItem2'] = $fachada->buscarProjetosRelacionados($ID_Item2);
          $_SESSION['projetosItem1'] = $fachada->buscarProjetosRelacionados($_SESSION['ID_Item']);
          mostrarDivBateria(); 
    }else if($_SESSION['componente2']['categoria'] == 'sensor')
    {
          echo "<br>-item2 ID ITem 1: ".$_SESSION['ID_Item']."<br>";
          echo "<br>- ID ITem 2: ".$_SESSION['ID_Item2'];
          $_SESSION['componente2'] = $fachada->exibirSensor($ID_Item2);
          $_SESSION['resultCompativel2'] = $fachada->sensorGetCompativel($ID_Item2);
          $_SESSION['resultCompativel'] = $fachada->sensorGetCompativel($_SESSION['ID_Item'] );
          $_SESSION['projetosItem2'] = $fachada->buscarProjetosRelacionados($ID_Item2);
          $_SESSION['projetosItem1'] = $fachada->buscarProjetosRelacionados($_SESSION['ID_Item']);
          mostrarDivSensor();

    }else if($_SESSION['componente2']['categoria'] == 'shield'){
          $_SESSION['componente2'] = $fachada->exibirShield($ID_Item2);
          $_SESSION['resultCompativel2'] = $fachada->shieldGetCompativel($ID_Item2);
          $_SESSION['resultCompativel'] = $fachada->shieldGetCompativel($_SESSION['ID_Item'] );
          $_SESSION['projetosItem2'] = $fachada->buscarProjetosRelacionados($ID_Item2);
          $_SESSION['projetosItem1'] = $fachada->buscarProjetosRelacionados($_SESSION['ID_Item']);
          mostrarDivShield();
    }else if($_SESSION['componente2']['categoria'] == 'atuador'){
          $_SESSION['componente2'] = $fachada->exibirAtuador($ID_Item2);
          $_SESSION['resultCompativel2'] = $fachada->atuadorGetCompativel($ID_Item2);
          $_SESSION['resultCompativel'] = $fachada->atuadorGetCompativel($_SESSION['ID_Item'] );
          $_SESSION['projetosItem2'] = $fachada->buscarProjetosRelacionados($ID_Item2);
          $_SESSION['projetosItem1'] = $fachada->buscarProjetosRelacionados($_SESSION['ID_Item']);
          mostrarDivAtuador();
    }
}

function mostrarDivMicro(){
  $arraySegundoItem = null;
  $result = '';
  $result2 = '';
  $result3 = '';
  $result4 = '';
  $result5 = '';

      $result = '
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
           <td>'.$_SESSION['componente1']['primeiroNome'].' '.$_SESSION['componente1']['sobreNome'].'('.$_SESSION['componente1']['nomeUsuario'].')<b>  em:  </b> '.$_SESSION['componente1']['dataCadastro'].'
           </td>
           <td>'.$_SESSION['componente2']['primeiroNome'].' '.$_SESSION['componente2']['sobreNome'].'('.$_SESSION['componente2']['nomeUsuario'].')<b>  em:  </b> '.$_SESSION['componente2']['dataCadastro'].'
           </td>
         </tr>
          <tr class="table-primary">
            <th scope="row">Nome</th>
            <td>'.$_SESSION['componente1']['tipo'].'</td>
            <td>'.$_SESSION['componente2']['tipo'] .'</td>
          </tr>
          <tr>
            <th scope="row">Modelo</th>
            <td>'.$_SESSION['componente1']['nome'].'</td>
            <td>'.$_SESSION['componente2']['nome'].'</td>
          </tr>
          <tr class="table-primary" >
            <th scope="row">Temperatura de Operação</th>
            <td>'.$_SESSION['componente1']['temperatura_operacao'] .'</td>
            <td>'.$_SESSION['componente2']['temperatura_operacao'] .'</td>
          </tr>
          <tr>
            <th scope="row">Dimensões</th>
            <td>'.$_SESSION['componente1']['dimensao'] .' </td>
            <td>'. $_SESSION['componente2']['dimensao'].'</td>
          </tr>
          <tr  class="table-primary">
            <th scope="row">Preço Médio</th>
            <td>R$'. $_SESSION['componente1']['precoMedio'] .'</td>
            <td>R$'. $_SESSION['componente2']['precoMedio'].'  </td>
          </tr>
          <tr>
            <th scope="row">Linguagem de Programação</th>

            <td>'.substr($_SESSION['componente1']['linguagem_de_prograrmacao'],1).' </td>
            <td>'.substr($_SESSION['componente2']['linguagem_de_prograrmacao'],1).' </td>
          </tr>
          <tr  class="table-primary" >
            <th scope="row">Plataform de Desenvolvimento</th>
            <td>'.substr($_SESSION['componente1']['plataforma_de_desenvolvimento'],1).' 
            </td>
            <td>'.substr($_SESSION['componente2']['plataforma_de_desenvolvimento'],1).'
            </td>
          </tr>
          <tr>
            <th scope="row">DataSheet</th>
            <td>
               <a href="'.$_SESSION['componente1']['linkDataSheet'].'" class="btn button-link">
                 '.$_SESSION['componente1']['linkDataSheet'].'
               </a>
            </td>
            <td>
               <a href="'.$_SESSION['componente1']['linkDataSheet'].'" class="btn button-link">
                 '.$_SESSION['componente2']['linkDataSheet'].'
               </a>
            </td>
          </tr>
          <tr  class="table-primary">
            <th scope="row">Palavras-Chave</th>
            <td>
               '.$_SESSION['componente1']['palavraChave'].'
            </td>
            <td>
               '.$_SESSION['componente2']['palavraChave'] .'
            </td>
          </tr>
          <tr>
            <th scope="row">Desenho da pinagem</th>
            <td>
                <img src="'.$_SESSION['componente1']['img_legenda'].'" class="img mr-auto p-2 bd-highlight" width="600" height="700" align="center">
            </td>
            <td>
                <img src="'.$_SESSION['componente2']['img_legenda'].'" class="img mr-auto p-2 bd-highlight" width="600" height="700" align="center">
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
            <td>'.$_SESSION['componente1']['processador'].'</td>
            <td>'.$_SESSION['componente2']['processador'].'</td>
          </tr>
          <tr>
            <th scope="row">Tempo de Clock</th>
            <td>'.$_SESSION['componente1']['tempo_de_clock'].'</td>
            <td>'.$_SESSION['componente2']['tempo_de_clock'] .'</td>
          </tr>
          <tr class="table-primary" >
            <th scope="row">GPIOs-Analógicos</th>
            <td>'.$_SESSION['componente1']['GPIO_A'] .'</td>
            <td>'.$_SESSION['componente2']['GPIO_A'] .'</td>
          </tr>
          <tr>
            <th scope="row">GPIO-Digitais</th>
            <td>'.$_SESSION['componente1']['GPIO_D'] .'</td>
            <td>'.$_SESSION['componente2']['GPIO_D'].'</td>
          </tr>
          <tr  class="table-primary">
            <th scope="row">Memória RAM</th>
            <td>'.$_SESSION['componente1']['memoria_ram'].'</td>
            <td>'.$_SESSION['componente2']['memoria_ram'].'</td>
          </tr>
          <tr>
            <th scope="row">Memória Flhash</th>
            <td>'.$_SESSION['componente1']['memoria_flash'].'</td>
            <td>'.$_SESSION['componente2']['memoria_flash'].'</td>
          </tr>
          <tr  class="table-primary" >
            <th scope="row">Microcontrolador</th>
            <td>'.$_SESSION['componente1']['microcontrolador'].'</td>
             <td>'.$_SESSION['componente2']['microcontrolador'].'</td>
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
            <td>'.$_SESSION['componente1']['tensao_operacao'].'</td>
            <td>'.$_SESSION['componente2']['tensao_operacao'].'</td>
          </tr>
          <tr>
            <th scope="row">Tensão de entrada</th>
            <td>'.$_SESSION['componente1']['tensao_entrada'].'</td>
            <td>'.$_SESSION['componente2']['tensao_entrada'] .'</td>
          </tr>
        <tr class="table-primary">
            <th scope="row">Modo de Consumo</th>
            <td>'.$_SESSION['componente1']['modo_consumo'].'</td>
            <td>'.$_SESSION['componente2']['modo_consumo'].'</td>
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
            <td>'.substr($_SESSION['componente1']['sem_fio'],1).'</td>
            <td>'.substr($_SESSION['componente2']['sem_fio'],1).'</td>
          </tr>
          <tr>
            <th scope="row">Comunicação Serial</th>
            <td>'.substr($_SESSION['componente1']['serial_'],1).'</td>
            <td>'.substr($_SESSION['componente2']['serial_'],1).'</td>
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
            <td>'.substr($_SESSION['componente1']['interface_entrada'],1).'</td>
            <td>'.substr($_SESSION['componente2']['interface_entrada'],1).'</td>
          </tr>
          <tr>
            <th scope="row">Sensores</th>
            <td>'.substr($_SESSION['componente1']['sensores'],1).'></td>
            <td>'.substr($_SESSION['componente2']['sensores'],1).'</td>
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
              <th scope="col" >Componente 1</th>
              <th scope="col">Componente 2</th>
            </tr>
          </thead>
          <tr class="table-primary">
            <td>
                <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="10" cols="50" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  >'.$_SESSION['componente1']['infoAdicionais'].'</textarea>
            </td>
            <td>
                <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="10" cols="50" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  >'.$_SESSION['componente2']['infoAdicionais'].'</textarea>
            </td>
          </tr>
        </tbody>
      </table>

  <!--   =============================Projetos Relacionados===================   -->
  <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Projetos Relacionados</h4>
  <label><h5>Componente 1</h5></label>
    <div>
      <div class="row" align="center">
     ';
     while ($row =  mysqli_fetch_array($_SESSION['projetosItem1'],MYSQLI_ASSOC)){
     $textoDescritivo = substr($row['metodologia'], 0,20);
     $result2 .= '
                <div class="card col-md-2 ml-3" style="width: 20rem;">
                  <img class="card-img-top" width="100" height="100" src="'.$row['img_projeto'].'" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">'.$row['nome'].'</h5>
                    <p class="card-text">'.$textoDescritivo.'</p>
                    <form  class="" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                      <input type="hidden" name="ItemPesquisa" value="'.$row['ID_Projeto'].'">
                     <button type="submit" class="btn btn-primary">Ver o projeto</button>
                     </form>
                  </div>
                </div>          
          ';
           } mysqli_free_result($_SESSION['projetosItem1']);

           $result3.='
            </div>
        </div>
           <label><h5>Componente 2</h5></label>
          <div>
            <div class="row" align="center">
           ';

           while ($row2 =  mysqli_fetch_array($_SESSION['projetosItem2'],MYSQLI_ASSOC)){
          $textoDescritivo2 = substr($row2['metodologia'], 0,20);
          $result4 .='        
                <div class="card col-md-2 ml-3" style="width: 20rem;">
                  <img class="card-img-top" width="100" height="100" src="'.$row2['img_projeto'].'" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">'.$row2['nome'].'</h5>
                    <p class="card-text">'.$textoDescritivo2.'</p>
                    <form  class="" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                      <input type="hidden" name="ItemPesquisa" value="'.$row2['ID_Projeto'].'">
                     <button type="submit" class="btn btn-primary">Ver o projeto</button>
                     </form>
                  </div>
                </div>
          ';
        } mysqli_free_result($_SESSION['projetosItem2']);
        $result5 .= '              
        </div>
    </div> ';
    echo $result.$result2.$result3.$result4.$result5;    
}

function mostrarDivBateria(){
     $recarregavel ='';
     $naoRecarregavel = '';
     $recarregavel2 ='';
     $naoRecarregavel2 = '';
     $result3 = '';
     $result4='';
     $result5= '';
     $result6 = '';
     $result ='
           <table class="table table-striped">
           <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
             <thead>
               <tr>
                 <th scope="col"></th>
                 <th scope="col">Componente 1</th>
                 <th scope="col">Componente 2</th>
               </tr>
             </thead>
             <tbody>
              <tr>
                <th scope="row">Atualidado por:</th>
                <td>'.$_SESSION['componente1']['primeiroNome'].' '.$_SESSION['componente1']['sobreNome'].'('.$_SESSION['componente1']['nomeUsuario'].') <b>  em:  </b>'.$_SESSION['componente1']['dataCadastro'].' 
                </td>
                <td>'.$_SESSION['componente2']['primeiroNome'].' '.$_SESSION['componente2']['sobreNome'].'('.$_SESSION['componente2']['nomeUsuario'].') <b>  em:  </b>'.$_SESSION['componente2']['dataCadastro'].' 
                </td>
              </tr>
               <tr class="table-primary">
                 <th scope="row">Nome</th>
                 <td>'.$_SESSION['componente1']['nome'].'</td>
                 <td>'.$_SESSION['componente2']['nome'].'</td>
               </tr>
               <tr>
                 <th scope="row">Tipo</th>
                 <td>'.$_SESSION['componente1']['tipo'].'</td>
                 <td>'.$_SESSION['componente2']['tipo'].'</td>
               </tr>
               <tr class="table-primary" >
                 <th scope="row">Temperatura de Operação</th>
                 <td>'.$_SESSION['componente1']['temperatura_operacao'].'</td>
                 <td>'.$_SESSION['componente2']['temperatura_operacao'].'</td>
               </tr>
               <tr>
                 <th scope="row">Dimensões</th>
                 <td>'.$_SESSION['componente1']['dimensao'].'</td>
                 <td>'.$_SESSION['componente2']['dimensao'].'</td>
               </tr>
               <tr  class="table-primary">
                 <th scope="row">Peso</th>
                  <td>'.$_SESSION['componente1']['peso'].'</td>
                  <td>'.$_SESSION['componente2']['peso'].'</td>
               </tr>
               <tr>
                 <th scope="row">Tamanho</th>
                  <td>'.$_SESSION['componente1']['tamanho'].'</td>
                  <td>'.$_SESSION['componente2']['tamanho'].'</td>
               </tr>
               <tr  class="table-primary" >
                 <th scope="row">Preço Médio</th>
                 <td>R$: '.$_SESSION['componente1']['precoMedio'].'</td>
                 <td>R$: '.$_SESSION['componente2']['precoMedio'].'</td>
               </tr>
               <tr>
                 <th scope="row">DataSheet</th>
                 <td>
                    <a href="'.$_SESSION['componente1']['linkDataSheet'].'" class="btn button-link">
                      '.$_SESSION['componente1']['linkDataSheet'].'
                    </a>
                 </td>
                 <td>
                    <a href="'.$_SESSION['componente2']['linkDataSheet'].'" class="btn button-link">
                      '.$_SESSION['componente2']['linkDataSheet'].'
                    </a>
                 </td>
               </tr>
               <tr  class="table-primary">
                 <th scope="row">Palavras-Chave</th>
               <td>
                  '.$_SESSION['componente1']['palavraChave'].'
               </td>
               <td>
                  '.$_SESSION['componente2']['palavraChave'].'
               </td>
               </tr>
             </tbody>
           </table>
           <table class="table table-striped" >

          <!--   ============================= Informações Elétricas  ================================   -->
           
           <table class="table table-striped" >
           <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Elétricas</h4>
             <thead>
               <tr>
                 <th scope="col"></th>
                 <th scope="col">Componente 1</th>
                 <th scope="col">Componente 2</th>
               </tr>
             </thead>
             <tbody>
               <tr class="table-primary">
                 <th scope="row">Tensão de Operação (nominal)</th>
                 <td>'.$_SESSION['componente1']['tensao_nom'].'</td>
                 <td>'.$_SESSION['componente2']['tensao_nom'].'</td>
               </tr>
               <tr>
                 <th scope="row">Tipo de Carga</th>
                 <td>'.$_SESSION['componente1']['tipo_carga'].'</td>
                 <td>'.$_SESSION['componente2']['tipo_carga'].'</td>
               </tr>

               ';
    if ($_SESSION['componente1']['tipo_carga'] == "Recarregável"){
        $recarregavel = '
               <!--  Se recarregável  -->  
               <tr>
                 <th scope="row">Manutenção</th>
                 <td>'.$_SESSION['componente1']['manutencao'].'</td>
                 <td><h5> X </h5></td>
               </tr>
               <tr class="table-primary">
                 <th scope="row">Densidade</th>
                 <td>'.$_SESSION['componente1']['densidade'].'</td>
                 <td><h5> X </h5></td>
               </tr>
               <tr>
                 <th scope="row">Resistência Interna</th>
                 <td>'.$_SESSION['componente1']['resistencia_Int'].'</td>
                 <td><h5> X </h5></td>
               </tr>
               <tr class="table-primary">
                 <th scope="row">Ciclo de Vida</th>
                 <td>'.$_SESSION['componente1']['ciclo_de_vida'].'</td>
                 <td><h5> X </h5></td>
               </tr>
               <tr>
                 <th scope="row">Tempo para Carga Rápida</th>
                 <td>'.$_SESSION['componente1']['tempo_carga_rapida'].'</td>
                 <td><h5> X </h5></td>
               </tr>
               <tr class="table-primary">
                 <th scope="row">Tolerância para sobrecarga</th>
                  <td>'.$_SESSION['componente1']['tolerancia_sobrecarga'].'</td>
                  <td><h5> X </h5></td>
               </tr>
               <tr>
                 <th scope="row">Auto-Descarga Mensal</th>
                  <td>'.$_SESSION['componente1']['auto_desc_mensal'].'</td>
                  <td><h5> X </h5></td>
               </tr>
               <tr class="table-primary">
                 <th scope="row">Corrente de Carga</th>
                  <td>'.$_SESSION['componente1']['corrente_carga'].'</td>
                  <td><h5> X </h5></td>
               </tr>
               ';
        }
        else
        { 
          $naoRecarregavel ='
               <!--  Se não recarregável  --> 
                    <tr>
                     <th scope="row">Química Utilizada</th>
                      <td>'.$_SESSION['componente1']['quimica'].'</td>
                      <td><h5> X <h5> </td>
                   </tr>
                 </tbody>
               </table>
               <table class="table table-striped" >
                     <h5 class="mt-4 mb-4 ml-4 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-4" align="start">Capacidade de descarga</h5>
                    <thead>
                       <tr>
                         <th scope="col"></th>
                         <th scope="col">Componente 1</th>
                         <th scope="col">Componente 2</th>
                       </tr>
                   </thead>
                   <tbody>
                    <tr class="table-primary">
                      <th scope="row">Tempo Médio</th>
                       <td>'.$_SESSION['componente1']['tempo_medio'].'</td>
                       <td><h5> X <h5> </td>
                    </tr>
                     <tr>
                      <th scope="row">Resistor de Descarga</th>
                      <td>'.$_SESSION['componente1']['resistor_descarga'].'</td>
                      <td><h5> X <h5> </td>
                    </tr>
                     <tr class="table-primary">
                      <th scope="row">Voltagem Mínima</th>
                      <td>'.$_SESSION['componente1']['voltagem_minima'].'</td>
                      <td><h5> X <h5> </td>
                    </tr>
                ';
          }
          if ($_SESSION['componente2']['tipo_carga'] == "Recarregável")
          {
              $recarregavel2 = '
                     <!--  Se recarregável  -->  
                     <tr>
                       <th scope="row">Manutenção</th>
                       <td><h5> X </h5></td>
                       <td>'.$_SESSION['componente2']['manutencao'].'</td>
                     </tr>
                     <tr class="table-primary">
                       <th scope="row">Densidade</th>
                       <td><h5> X </h5></td>
                       <td>'.$_SESSION['componente2']['densidade'].'</td>
                     </tr>
                     <tr>
                       <th scope="row">Resistência Interna</th>
                       <td><h5> X </h5></td>
                       <td>'.$_SESSION['componente2']['resistencia_Int'].'</td>
                     </tr>
                     <tr class="table-primary">
                       <th scope="row">Ciclo de Vida</th>
                       <td><h5> X </h5></td>
                       <td>'.$_SESSION['componente2']['ciclo_de_vida'].'</td>
                     </tr>
                     <tr>
                       <th scope="row">Tempo para Carga Rápida</th>
                       <td><h5> X </h5></td>
                       <td>'.$_SESSION['componente2']['tempo_carga_rapida'].'</td>
                     </tr>
                     <tr class="table-primary">
                       <th scope="row">Tolerância para sobrecarga</th>
                        <td><h5> X </h5></td>
                        <td>'.$_SESSION['componente2']['tolerancia_sobrecarga'].'</td>
                     </tr>
                     <tr>
                       <th scope="row">Auto-Descarga Mensal</th>
                       <td><h5> X </h5></td>
                        <td>'.$_SESSION['componente2']['auto_desc_mensal'].'</td>
                     </tr>
                     <tr class="table-primary">
                       <th scope="row">Corrente de Carga</th>
                        <td><h5> X </h5></td>
                        <td>'.$_SESSION['componente2']['corrente_carga'].'</td>
                     </tr>
                     ';
              }
              else
              { 
                $naoRecarregavel2 ='
                     <!--  Se não recarregável  --> 
                          <tr>
                           <th scope="row">Química Utilizada</th>
                            <td><h5> X <h5> </td>
                            <td>'.$_SESSION['componente2']['quimica'].'</td>
                         </tr>
                       </tbody>
                     </table>
                     <table class="table table-striped" >
                           <h5 class="mt-4 mb-4 ml-4 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-4" align="start">Capacidade de descarga</h5>
                          <thead>
                            <tr>
                              <th scope="col"></th>
                              <th scope="col">Componente 1</th>
                              <th scope="col">Componente 2</th>
                            </tr>
                          </thead> 
                         <tbody>
                          <tr class="table-primary">
                            <th scope="row">Tempo Médio</th>
                             <td><h5> X <h5> </td>
                             <td>'.$_SESSION['componente2']['tempo_medio'].'</td>                            
                          </tr>
                           <tr>
                            <th scope="row">Resistor de Descarga</th>
                            <td><h5> X <h5> </td>
                            <td>'.$_SESSION['componente2']['resistor_descarga'].'</td>
                          </tr>
                           <tr class="table-primary">
                            <th scope="row">Voltagem Mínima</th>
                            <td><h5> X <h5> </td>
                            <td>'.$_SESSION['componente2']['voltagem_minima'].'</td>
                          </tr>
                      ';
                }

        $result2 =  ' 
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
           <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="10" cols="200" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  >'.$_SESSION['componente1']['infoAdicionais'].' </textarea>
       </td>
       <td>
           <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="10" cols="200" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  >'.$_SESSION['componente2']['infoAdicionais'].' </textarea>
       </td>
     </tr>
   </tbody>
 </table>             
  <!--   =============================Projetos Relacionados===================   -->
  <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Projetos Relacionados</h4>
  <label><h5>Componente 1</h5></label>
    <div>
      <div class="row" align="center">
     ';
     while ($row =  mysqli_fetch_array($_SESSION['projetosItem1'],MYSQLI_ASSOC)){
     $textoDescritivo = substr($row['metodologia'], 0,20);
     $result3 .= '
                <div class="card col-md-2 ml-3" style="width: 20rem;">
                  <img class="card-img-top" width="100" height="100" src="'.$row['img_projeto'].'" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">'.$row['nome'].'</h5>
                    <p class="card-text">'.$textoDescritivo.'</p>
                    <form  class="" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                      <input type="hidden" name="ItemPesquisa" value="'.$row['ID_Projeto'].'">
                     <button type="submit" class="btn btn-primary">Ver o projeto</button>
                     </form>
                  </div>
                </div>          
          ';
           } mysqli_free_result($_SESSION['projetosItem1']);

           $result4.='
            </div>
        </div>
           <label><h5>Componente 2</h5></label>
          <div>
            <div class="row" align="center">
           ';

           while ($row2 =  mysqli_fetch_array($_SESSION['projetosItem2'],MYSQLI_ASSOC)){
          $textoDescritivo2 = substr($row2['metodologia'], 0,20);
          $result5 .='        
                <div class="card col-md-2 ml-3" style="width: 20rem;">
                  <img class="card-img-top" width="100" height="100" src="'.$row2['img_projeto'].'" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">'.$row2['nome'].'</h5>
                    <p class="card-text">'.$textoDescritivo2.'</p>
                    <form  class="" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                      <input type="hidden" name="ItemPesquisa" value="'.$row2['ID_Projeto'].'">
                     <button type="submit" class="btn btn-primary">Ver o projeto</button>
                     </form>
                  </div>
                </div>
          ';
        } mysqli_free_result($_SESSION['projetosItem2']);
        $result6 .= '              
        </div>
    </div> ';

        echo $result.$recarregavel.$recarregavel2.$naoRecarregavel.$naoRecarregavel2.$result2.$result3.$result4.$result5.$result6;      
    }

function mostrarDivSensor(){
    
    $result2 = '';
    $result3 = '';
    $result5 = '';
    $result4 = '';
    $result6 = '';
    $result7 = '';
    $result8 = '';
    $result9 = '';
    $result = '
           <!--   ============================= Info gerais =======================================   -->
         <table class="table table-striped">
         <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
           <thead>
             <tr>
               <th scope="col"></th>
               <th scope="col">Componente 1</th>
               <th scope="col">Componente 2</th>
             </tr>
           </thead>
           <tbody>
            <tr>
              <th scope="row">Atualizado por:</th>
              <td>'.$_SESSION['componente1']['primeiroNome'].' '.$_SESSION['componente1']['sobreNome'].'('.$_SESSION['componente1']['nomeUsuario'].')<b>  em:  </b> <?php echo '.$_SESSION['componente1']['dataCadastro'].'
              </td>
              <td>'.$_SESSION['componente2']['primeiroNome'].' '.$_SESSION['componente2']['sobreNome'].'('.$_SESSION['componente2']['nomeUsuario'].')<b>  em:  </b> <?php echo '.$_SESSION['componente2']['dataCadastro'].'
              </td>
            </tr>
             <tr class="table-primary">
               <th scope="row">Nome</th>
                <td>'.$_SESSION['componente1']['nome'].'</td>
                <td>'.$_SESSION['componente2']['nome'].'</td>
             </tr>
             <tr>
               <th scope="row">Modelo</th>
               <td>'.$_SESSION['componente1']['tipo'].'</td>
               <td>'.$_SESSION['componente2']['tipo'].'</td>
             </tr>
             <tr class="table-primary" >
               <th scope="row">Temperatura de Operação</th>
               <td>'.$_SESSION['componente1']['temperaturaOperacao'].'</td>
               <td>'.$_SESSION['componente2']['temperaturaOperacao'].'</td>
             </tr>
             <tr>
               <th scope="row">Dimensões</th>
               <td>'.$_SESSION['componente1']['dimensao'].'</td>
               <td>'.$_SESSION['componente2']['dimensao'].'</td>
             </tr>
             <tr class="table-primary" >
               <th scope="row">Preço Médio</th>
               <td>R$:'.$_SESSION['componente1']['precoMedio'].'</td>
               <td>R$:'.$_SESSION['componente2']['precoMedio'].'</td>
             </tr>
             <tr >
               <th scope="row">DataSheet</th>
               <td>
                  <a href="'.$_SESSION['componente1']['linkDataSheet'].'" class="btn button-link" target="_blank">
                    '.$_SESSION['componente1']['linkDataSheet'].'
                  </a>
               </td>
               <td>
                  <a href="'.$_SESSION['componente2']['linkDataSheet'].'" class="btn button-link" target="_blank">
                    '.$_SESSION['componente2']['linkDataSheet'].'
                  </a>
               </td>
             </tr>
             <tr class="table-primary" >
               <th scope="row">Palavras-Chave</th>
                  <td>
                     '.$_SESSION['componente1']['palavraChave'].'
                  </td>
                  <td>
                     '.$_SESSION['componente2']['palavraChave'].'
                  </td>
             </tr>
             <tr>
               <th scope="row">Compatível com:</th>
               <td>
              ';

             # echo "count array compativel: ".count($_SESSION['resultCompativel']);
      while ($row =  mysqli_fetch_array($_SESSION['resultCompativel'],MYSQLI_ASSOC)) { #echo "Palavra  
                #echo "Dentro do primeiro while: ".$row ['componente1']['ID_Item'];
                 $result2 .= '    
                     <form method="POST" action="TelaExibirMicrocontrolador.php" data-toggle="validator" role="form" align="start" >
                       <input type="hidden" name="ItemPesquisa" id="cod_processo" value="'.$row['ID_Item'].'"/>
                       <input type="hidden" name="ItemAnterior" id="cod_processo" value="'.$_SESSION['componente1']['ID_Item'].'"/>  
                         <button  type="submit" class="btn btn-outline-primary border-0 " target="_blank">
                           <h6 style="text-align:center;">
                             <p>
                                -'.$row['nomeItem'].' 
                             </p>
                           </h6> 
                         </button>
                     </form>
                 ';
                 } mysqli_free_result($_SESSION['resultCompativel']);
             $result5 = '
               </td>
               <td>
                       ';
                #echo "count array compativel: ".count($_SESSION['resultCompativel2']);
               while ($row2 =  mysqli_fetch_array($_SESSION['resultCompativel2'],MYSQLI_ASSOC)) { #echo "Palavra  
                            #echo $_SESSION['componente1']['ID_Item'];
                          $result4 .= '    
                              <form method="POST" action="TelaExibirMicrocontrolador.php" data-toggle="validator" role="form" align="start" >
                                <input type="hidden" name="ItemPesquisa" id="cod_processo" value="'.$row2['ID_Item'].'"/>
                                <input type="hidden" name="ItemAnterior" id="cod_processo" value="'.$_SESSION['componente2']['ID_Item'].'"/>  
                                  <button  type="submit" class="btn btn-outline-primary border-0 " target="_blank">
                                    <h6 style="text-align:center;">
                                      <p>
                                         -'.$row2['nomeItem'].' 
                                      </p>
                                    </h6> 
                                  </button>
                              </form>
                          ';
                          } mysqli_free_result($_SESSION['resultCompativel2']);
                      $result3 = '
                  </td>
             </tr>
             <tr class="table-primary">
               <th scope="row">Função Principal</th>
               <td>
               '.$_SESSION['componente1']['funcao'].'
               </td>
               <td>
               '.$_SESSION['componente2']['funcao'].'
               </td>
             </tr>
           </tbody>
         </table>
         <table class="table table-striped" >

            <!--   ============================= Informações Elétricas  =======================================   -->
         <table class="table table-striped" >
         <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Elétricas</h4>
           <thead>
             <tr>
               <th scope="col"></th>
               <th scope="col">Componente 1</th>
               <th scope="col">Componente 2</th>
             </tr>
           </thead>
           <tbody>
             <tr class="table-primary">
               <th scope="row">Tensão Nominal (operação)</th>
               <td>'.$_SESSION['componente1']['tensaoOperacao'].'</td>
               <td>'.$_SESSION['componente2']['tensaoOperacao'].'</td>
             </tr>
             <tr >
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
           <thead>
             <tr>
               <th scope="col">Componente 1</th>
               <th scope="col">Componente 2</th>
             </tr>
           </thead>
           <tbody>
             <tr class="table-primary">
               <td>
                <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="15" cols="200" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  >'. $_SESSION['componente1']['infoAdicionais'].'</textarea>
               </td>
               <td>
                <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="15" cols="200" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  >'. $_SESSION['componente2']['infoAdicionais'].'</textarea>
               </td>
             </tr>
           </tbody>
         </table> 
   <!--   =============================Projetos Relacionados===================   -->
  <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Projetos Relacionados</h4>
  <label><h5>Componente 1</h5></label>
    <div>
      <div class="row" align="center">
     ';
     while ($row =  mysqli_fetch_array($_SESSION['projetosItem1'],MYSQLI_ASSOC)){
     $textoDescritivo = substr($row['metodologia'], 0,20);
     $result6 .= '
                <div class="card col-md-2 ml-3" style="width: 20rem;">
                  <img class="card-img-top" width="100" height="100" src="'.$row['img_projeto'].'" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">'.$row['nome'].'</h5>
                    <p class="card-text">'.$textoDescritivo.'</p>
                    <form  class="" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                      <input type="hidden" name="ItemPesquisa" value="'.$row['ID_Projeto'].'">
                     <button type="submit" class="btn btn-primary">Ver o projeto</button>
                     </form>
                  </div>
                </div>          
          ';
           } mysqli_free_result($_SESSION['projetosItem1']);

           $result7.='
            </div>
        </div>
           <label><h5>Componente 2</h5></label>
          <div>
            <div class="row" align="center">
           ';

           while ($row2 =  mysqli_fetch_array($_SESSION['projetosItem2'],MYSQLI_ASSOC)){
          $textoDescritivo2 = substr($row2['metodologia'], 0,20);
          $result8 .='        
                <div class="card col-md-2 ml-3" style="width: 20rem;">
                  <img class="card-img-top" width="100" height="100" src="'.$row2['img_projeto'].'" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">'.$row2['nome'].'</h5>
                    <p class="card-text">'.$textoDescritivo2.'</p>
                    <form  class="" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                      <input type="hidden" name="ItemPesquisa" value="'.$row2['ID_Projeto'].'">
                     <button type="submit" class="btn btn-primary">Ver o projeto</button>
                     </form>
                  </div>
                </div>
          ';
        } mysqli_free_result($_SESSION['projetosItem2']);
        $result9 .= '              
        </div>
    </div> ';
      echo $result.$result2.$result5.$result4.$result3.$result6.$result7.$result8.$result9;
    }

function mostrarDivShield(){     
  
  $result2 = '';
  $result3 = '';
  $result4 = '';
  $result5 = '';

  $result6 = '';
  $result7 = '';
  $result8 = '';
  $result9 = '';
  $result ='

       <table class="table table-striped">
       <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
         <thead>
           <tr>   
             <th scope="col" ></th>    
             <th scope="col" >Componente 1</th>
             <th scope="col">Componente 2</th>
           </tr>
         </thead>
         <tbody>
          <tr>
            <th scope="row">Atualidado por:</th>
            <td>'.$_SESSION['componente1']['primeiroNome'].' '.$_SESSION['componente1']['sobreNome'].'('.$_SESSION['componente1']['nomeUsuario'].')<b>  em:  </b> '.$_SESSION['componente1']['dataCadastro'].'
            </td>
            <td>'.$_SESSION['componente2']['primeiroNome'].' '.$_SESSION['componente2']['sobreNome'].'('.$_SESSION['componente2']['nomeUsuario'].')<b>  em:  </b> '.$_SESSION['componente2']['dataCadastro'].'
            </td>
          </tr>
           <tr class="table-primary">
             <th scope="row">Nome</th>
             <td>'.$_SESSION['componente1']['nome'].'</td>
             <td>'.$_SESSION['componente2']['nome'].'</td>
           </tr>
           <tr>
             <th scope="row">Modelo</th>
             <td>'.$_SESSION['componente1']['tipo'].'</td>
             <td>'.$_SESSION['componente2']['tipo'].'</td>
           </tr>
           <tr class="table-primary" >
             <th scope="row">Temperatura de Operação</th>
             <td>'.$_SESSION['componente1']['temperaturaOperacao'].'</td>
             <td>'.$_SESSION['componente2']['temperaturaOperacao'].'</td>
           </tr>
           <tr>
             <th scope="row">Dimensões</th>
             <td>'.$_SESSION['componente1']['dimensao'].'</td>
             <td>'.$_SESSION['componente2']['dimensao'].'</td>
           </tr>
           <tr  class="table-primary">
             <th scope="row">Peso</th>
             <td>'.$_SESSION['componente1']['peso'].'</td>
             <td>'.$_SESSION['componente2']['peso'].'</td>
           </tr>
           <tr >
             <th scope="row">Preço Médio</th>
             <td>R$'.$_SESSION['componente1']['precoMedio'].'</td>
             <td>R$'.$_SESSION['componente2']['precoMedio'].'</td>
           </tr>
           <tr class="table-primary" >
             <th scope="row">DataSheet</th>
             <td>
                <a href="'.$_SESSION['componente1']['linkDataSheet'].'" class="btn button-link" target="_blank">
                  '.$_SESSION['componente1']['linkDataSheet'].'
                </a>
             </td>
             <td>
                <a href="'.$_SESSION['componente2']['linkDataSheet'].'" class="btn button-link" target="_blank">
                  '.$_SESSION['componente2']['linkDataSheet'].'
                </a>
             </td>
           </tr>
           <tr >
             <th scope="row">Palavras-Chave</th>
             <td>'.$_SESSION['componente1']['palavraChave'].'</td>
             <td>'.$_SESSION['componente2']['palavraChave'].'</td>
           </tr>
           <tr  class="table-primary">
             <th scope="row">Função Principal</th>
              <td>'.$_SESSION['componente1']['funcao'].'</td>
              <td>'.$_SESSION['componente2']['funcao'].'</td>
           </tr>
           <tr>
             <th scope="row">Compatível com:</th>
             <!-- buscar os microcontroladores compatíveis com os IDs -->
            <td>
            ';


            while ($row =  mysqli_fetch_array($_SESSION['resultCompativel'],MYSQLI_ASSOC)) { #echo "Palavra  
              #echo $_SESSION['componente1']['ID_Item'];
            
             $result2 .='
                <form method="POST" action="TelaExibirMicrocontrolador.php" data-toggle="validator" role="form" align="start" >
                  <input type="hidden" name="ItemPesquisa" id="cod_processo" value="'.$row['ID_Item'].'"/>
                  <input type="hidden" name="ItemAnterior" id="cod_processo" value="'.$_SESSION['componente1']['ID_Item'].'"/>  
                    <button  type="submit" class="btn btn-outline-primary border-0 " target="_blank">  
                      <h6 style="text-align:center;">
                        <p>
                           -'.$row['nomeItem'].' 
                        </p>
                      </h6> 
                    </button>
                </form>
            '; 
          } mysqli_free_result($_SESSION['resultCompativel']); 
          $result3 ='
              </td>
              <td>
                ';
                while ($row2 =  mysqli_fetch_array($_SESSION['resultCompativel2'],MYSQLI_ASSOC)) { #echo "Palavra  
                  #echo $_SESSION['componente1']['ID_Item'];
                
                 $result4 .='
                    <form method="POST" action="TelaExibirMicrocontrolador.php" data-toggle="validator" role="form" align="start" >
                      <input type="hidden" name="ItemPesquisa" id="cod_processo" value="'.$row2['ID_Item'].'"/>
                      <input type="hidden" name="ItemAnterior" id="cod_processo" value="'.$_SESSION['componente2']['ID_Item'].'"/>  
                        <button  type="submit" class="btn btn-outline-primary border-0 " target="_blank">  
                          <h6 style="text-align:center;">
                            <p>
                               -'.$row2['nomeItem'].' 
                            </p>
                          </h6> 
                        </button>
                    </form>
                '; 
              } mysqli_free_result($_SESSION['resultCompativel2']); 
              $result5 ='
              </td>
           </tr>
         </tbody>
       </table>
       <table class="table table-striped" >

          <!--   ============================= Informações Elétricas  =======================================   -->
       <table class="table table-striped" >
       <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Elétricas</h4>
         <thead>
           <tr>     
             <th scope="col" ></th>  
             <th scope="col" >Componente 1</th>
             <th scope="col">Componente 2</th>
           </tr>
         </thead>
         <tbody>
           <tr class="table-primary">
             <th scope="row">Tensão de Operação (nominal)</th>
             <td>'.$_SESSION['componente1']['tensaoOperacao'].'</td>
             <td>'.$_SESSION['componente2']['tensaoOperacao'].'</td>
           </tr>
           <tr>
             <th scope="row">Modo de Consumo</th>
             <td>'.$_SESSION['componente1']['modo_consumo'].'</td>
             <td>'.$_SESSION['componente2']['modo_consumo'].'</td>
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
         <thead>
           <tr>       
             <th scope="col" >Componente 1</th>
             <th scope="col">Componente 2</th>
           </tr>
         </thead>
         <tbody>
           <tr class="table-primary">
             <td>
                 <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="15" cols="200" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  >'.$_SESSION['componente1']['infoAdicionais'].'</textarea>
             </td>
             <td>
                 <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="15" cols="200" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  >'.$_SESSION['componente2']['infoAdicionais'].'</textarea>
             </td>
           </tr>
         </tbody>
       </table>
    <!--   =============================Projetos Relacionados===================   -->
  <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Projetos Relacionados</h4>
  <label><h5>Componente 1</h5></label>
    <div>
      <div class="row" align="center">
     ';
     while ($row =  mysqli_fetch_array($_SESSION['projetosItem1'],MYSQLI_ASSOC)){
     $textoDescritivo = substr($row['metodologia'], 0,20);
     $result6 .= '
                <div class="card col-md-2 ml-3" style="width: 20rem;">
                  <img class="card-img-top" width="100" height="100" src="'.$row['img_projeto'].'" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">'.$row['nome'].'</h5>
                    <p class="card-text">'.$textoDescritivo.'</p>
                    <form  class="" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                      <input type="hidden" name="ItemPesquisa" value="'.$row['ID_Projeto'].'">
                     <button type="submit" class="btn btn-primary">Ver o projeto</button>
                     </form>
                  </div>
                </div>          
          ';
           } mysqli_free_result($_SESSION['projetosItem1']);

           $result7.='
            </div>
        </div>
           <label><h5>Componente 2</h5></label>
          <div>
            <div class="row" align="center">
           ';

           while ($row2 =  mysqli_fetch_array($_SESSION['projetosItem2'],MYSQLI_ASSOC)){
          $textoDescritivo2 = substr($row2['metodologia'], 0,20);
          $result8 .='        
                <div class="card col-md-2 ml-3" style="width: 20rem;">
                  <img class="card-img-top" width="100" height="100" src="'.$row2['img_projeto'].'" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">'.$row2['nome'].'</h5>
                    <p class="card-text">'.$textoDescritivo2.'</p>
                    <form  class="" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                      <input type="hidden" name="ItemPesquisa" value="'.$row2['ID_Projeto'].'">
                     <button type="submit" class="btn btn-primary">Ver o projeto</button>
                     </form>
                  </div>
                </div>
          ';
        } mysqli_free_result($_SESSION['projetosItem2']);
        $result9 .= '              
        </div>
    </div> ';

      echo $result.$result2.$result3.$result4.$result5.$result6.$result7.$result8.$result9;

    }

function mostrarDivAtuador(){

  $result2 = '';
  $result3 = '';
  $result4 = '';
  $result5 = '';

  $result6 = '';
  $result7 = '';
  $result8 = '';
  $result9 = '';
  $result ='';
      $result = '
              <!--   ============================= Info gerais =======================================   -->
            <table class="table table-striped">
            <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Gerais</h4>
            <thead>
              <tr>       
                <th scope="col" ></th>
                <th scope="col" >Componente 1</th>
                <th scope="col">Componente 2</th>
              </tr>
            </thead>
              <tbody>
               <tr>
                 <th scope="row">Atualizado por:</th>
                 <td>'.$_SESSION['componente1']['primeiroNome'].' '.$_SESSION['componente1']['sobreNome'].'('.$_SESSION['componente1']['nomeUsuario'].') <b>  em:  </b> '.$_SESSION['componente1']['dataCadastro'].'
                 </td>
                 <td>'.$_SESSION['componente2']['primeiroNome'].' '.$_SESSION['componente2']['sobreNome'].'('.$_SESSION['componente2']['nomeUsuario'].') <b>  em:  </b> '.$_SESSION['componente2']['dataCadastro'].'
                 </td>
               </tr>
                <tr class="table-primary">
                  <th scope="row">Nome</th>
                   <td>'.$_SESSION['componente1']['nome'].'</td>
                   <td>'.$_SESSION['componente2']['nome'].'</td>
                </tr>
                <tr>
                  <th scope="row">Modelo</th>
                  <td>'.$_SESSION['componente1']['tipo'].'</td>
                  <td>'.$_SESSION['componente2']['tipo'].'</td>
                </tr>
                <tr class="table-primary" >
                  <th scope="row">Temperatura de Operação</th>
                  <td>'.$_SESSION['componente1']['temperaturaOperacao'].'</td>
                  <td>'.$_SESSION['componente2']['temperaturaOperacao'].'</td>
                </tr>
                <tr>
                  <th scope="row">Dimensões</th>
                  <td>'.$_SESSION['componente1']['dimensao'].'</td>
                  <td>'.$_SESSION['componente2']['dimensao'].'</td>
                </tr>
                <tr class="table-primary" >
                  <th scope="row">Preço Médio</th>
                  <td>R$'.$_SESSION['componente1']['precoMedio'].'</td>
                  <td>R$'.$_SESSION['componente2']['precoMedio'].'</td>
                </tr>
                <tr >
                  <th scope="row">DataSheet</th>
                  <td>
                     <a href="'.$_SESSION['componente1']['linkDataSheet'].'" class="btn button-link" target="_blank">
                       '.$_SESSION['componente1']['linkDataSheet'].'
                     </a>
                  </td>
                  <td>
                     <a href="'.$_SESSION['componente2']['linkDataSheet'].'" class="btn button-link" target="_blank">
                       '.$_SESSION['componente2']['linkDataSheet'].'
                     </a>
                  </td>
                </tr>
                <tr class="table-primary" >
                  <th scope="row">Palavras-Chave</th>
                     <td>
                        '.$_SESSION['componente1']['palavraChave'].'
                     </td>
                     <td>
                        '.$_SESSION['componente2']['palavraChave'].'
                     </td>
                </tr>
                <tr >
                  <th scope="row">Cor</th>
                   <td>
                        '.$_SESSION['componente1']['cor'].'
                   </td>
                   <td>
                        '.$_SESSION['componente2']['cor'].'
                   </td>
                </tr>
                <tr  class="table-primary">
                  <th scope="row">Compatível com:</th>
                  <td>
                    ';
                    while ($row =  mysqli_fetch_array($_SESSION['resultCompativel'],MYSQLI_ASSOC)) {  
                     
                     $result2 .='   
                        <form method="POST" action="TelaExibirMicrocontrolador.php" data-toggle="validator" role="form" align="start" >
                          <input type="hidden" name="ItemPesquisa" id="cod_processo" value="'.$row['ID_Item'].'"/>
                          <input type="hidden" name="ItemAnterior" id="cod_processo" value="'.$_SESSION['componente1']['ID_Item'].'"/>  
                            <button  type="submit" class="btn btn-outline-primary border-0 " target="_blank">  
                              <h6 style="text-align:center;">
                                <p>
                                   -'.$row['nomeItem'].' 
                                </p>
                              </h6> 
                            </button>
                        </form>
                        ';
                    } mysqli_free_result($_SESSION['resultCompativel']);
            $result3 =' 
                  </td>
                        <td>
                          ';
                          while ($row =  mysqli_fetch_array($_SESSION['resultCompativel2'],MYSQLI_ASSOC)) {  
                           
                           $result4 .='   
                              <form method="POST" action="TelaExibirMicrocontrolador.php" data-toggle="validator" role="form" align="start" >
                                <input type="hidden" name="ItemPesquisa" id="cod_processo" value="'.$row['ID_Item'].'"/>
                                <input type="hidden" name="ItemAnterior" id="cod_processo" value="'.$_SESSION['componente1']['ID_Item'].'"/>  
                                  <button  type="submit" class="btn btn-outline-primary border-0 " target="_blank">  
                                    <h6 style="text-align:center;">
                                      <p>
                                         -'.$row['nomeItem'].' 
                                      </p>
                                    </h6> 
                                  </button>
                              </form>
                              ';
                          } mysqli_free_result($_SESSION['resultCompativel2']);
                  $result5 =' 
                        </td>
                </tr>
                <tr >
                  <th scope="row">Controlador</th>
                  <td>
                  '.$_SESSION['componente1']['controlador'].'
                  </td>
                  <td>
                  '.$_SESSION['componente2']['controlador'].'
                  </td>
                </tr>
              </tbody>
            </table>
            <table class="table table-striped" >

               <!--   ============================= Informações Elétricas  =======================================   -->
            <table class="table table-striped" >
            <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Informações Elétricas</h4>
            <thead>
              <tr>   
                 <th scope="col" ></th>    
                <th scope="col" >Componente 1</th>
                <th scope="col">Componente 2</th>
              </tr>
            </thead>
              <tbody>
                <tr class="table-primary">
                  <th scope="row">Tensão Nominal (operação)</th>
                  <td>'.$_SESSION['componente1']['tensaoOperacao'].'</td>
                  <td>'.$_SESSION['componente2']['tensaoOperacao'].'</td>
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
              <thead>
                <tr>       
                  <th scope="col" >Componente 1</th>
                  <th scope="col">Componente 2</th>
                </tr>
              </thead>
              <tbody>
                <tr class="table-primary">
                  <td>
                   <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="15" cols="200" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  > '.$_SESSION['componente1']['infoAdicionais'].'
                   </textarea>
                  </td>
                  <td>
                   <textarea class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="15" cols="200" style="resize: none; width:100%;background-color:#0000; border-color:#0000; "  > '.$_SESSION['componente2']['infoAdicionais'].'
                   </textarea>
                  </td>
                </tr>
              </tbody>
            </table>
    <!--   =============================Projetos Relacionados===================   -->
  <h4 class="mt-5 mb-4 ml-3 border border-primary border-top-0 border-right-0 rounded text-primary" id="list-item-2" align="start">Projetos Relacionados</h4>
  <label><h5>Componente 1</h5></label>
    <div>
      <div class="row" align="center">
     ';
     try{

     while ($row =  mysqli_fetch_array($_SESSION['projetosItem1'],MYSQLI_ASSOC)){
     $textoDescritivo = substr($row['metodologia'], 0,20);
     $result6 .= '
                <div class="card col-md-2 ml-3" style="width: 20rem;">
                  <img class="card-img-top" width="100" height="100" src="'.$row['img_projeto'].'" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">'.$row['nome'].'</h5>
                    <p class="card-text">'.$textoDescritivo.'</p>
                    <form  class="" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                      <input type="hidden" name="ItemPesquisa" value="'.$row['ID_Projeto'].'">
                     <button type="submit" class="btn btn-primary">Ver o projeto</button>
                     </form>
                  </div>
                </div>          
          ';
           } mysqli_free_result($_SESSION['projetosItem1']);
         }catch (Exception $e) { 
             
         } 
           $result7.='
            </div>
        </div>
           <label><h5>Componente 2</h5></label>
          <div>
            <div class="row" align="center">
           ';
           if(isset($_SESSION['projetosItem1'])){
           while ($row2 =  mysqli_fetch_array($_SESSION['projetosItem2'],MYSQLI_ASSOC)){
          $textoDescritivo2 = substr($row2['metodologia'], 0,20);
          $result8 .='        
                <div class="card col-md-2 ml-3" style="width: 20rem;">
                  <img class="card-img-top" width="100" height="100" src="'.$row2['img_projeto'].'" alt="Card image cap">
                  <div class="card-body">
                    <h5 class="card-title">'.$row2['nome'].'</h5>
                    <p class="card-text">'.$textoDescritivo2.'</p>
                    <form  class="" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
                      <input type="hidden" name="ItemPesquisa" value="'.$row2['ID_Projeto'].'">
                     <button type="submit" class="btn btn-primary">Ver o projeto</button>
                     </form>
                  </div>
                </div>
          ';
        } mysqli_free_result($_SESSION['projetosItem2']);
      }
        $result9 .= '              
        </div>
    </div> ';
      echo $result.$result2.$result3.$result4.$result5.$result6.$result7.$result8.$result9;
}
?>
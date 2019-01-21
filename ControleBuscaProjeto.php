<?php session_start();
include_once("conexao/Fachada.class.php");
include_once("conexao/MicrocontroladorVO.class.php");
$idItem ='';
$fachada = new Fachada;
$retorno = '';

if(isset($_POST["ID_Busca_Item"])){
$idItem = $_POST["ID_Busca_Item"];
echo "ID ITem:".$idItem;
}

$arrayResult  = $fachada->getItensGeral($idItem);
$countBusca =  mysqli_num_rows($arrayResult);

if($countBusca <=0 || $idItem == "" )
    {
      
          if(!isset($_POST["ID_Item"]) && !isset($_POST["ID_Excluir"]) && !isset($_POST["ID_Fechar"]) && !isset($_POST["ID_TirarDaLista"])){
           echo '
           <li class="list-group-item list-group-item-primary d-flex bd-highlight mt-2 ml-2 mb-2 mr-2 rounded" style="height: 60px;"> 
              <a href="#" id="ID_Nenhum" class="btn btn-link tamanhoBTNS mr-auto ml-3 mb-3 " align="center">   
              <h6 style="text-align:center;">
               Nada encontrado
             </h6> 
              </a>
          </li>';
          }
       
          # ($retorno);
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
             <li class="list-group-item list-group-item-primary d-flex bd-highlight mt-2 ml-2 mb-2 mr-2 rounded" style="height: 60px;"> 

                 <div class="row"">
                   <div class="col-md-10">
                      <h6 style="text-align:center;">
                        '.$nome.'
                      </h6>
                    </div>
                    <div class="col-md-2"">
                       <button type="button" id="'.$row['ID_Item'].':'.$row['nomeItem'].'" class="btn btn-primary" >Adicionar</button> 
                    </div>

                </div>
            </li>
            ';
          }
            
         }
         mysqli_free_result($arrayResult);
          #echo "Item pesquisa no Tela Exibir: ".$idItem."</br>"  <input type="hidden" name="ID_Item_Clicado" value="'.$row['ID_Item'].'"/>;
    } 


if(isset($_POST["ID_Item"]))
{
      $idItem_s =  (int) $_POST["ID_Item"]." - ".$_POST["Nome_Item"];
      $existe = false;
      
      foreach($_SESSION['Nome_Item'] as $list):
        #echo($list);
        if($_POST["Nome_Item"] == $list){
          $existe = true;
        }

      endforeach;

     if(!$existe){

      array_push($_SESSION["ID_Item"],$_POST["ID_Item"]);
      array_push($_SESSION["Nome_Item"],$_POST["Nome_Item"]);

      echo count($_SESSION['ID_Item']).' item adicionado(s)';
      foreach($_SESSION['Nome_Item'] as $list):

          echo '<li>'.$list.'</li>';

       endforeach; 
     }else
     {
      echo -1;
     }
} 


if(isset($_POST["ID_Fechar"]))
{       
        if($_POST["ID_Fechar"] == "ok"){
                      foreach(array_combine($_SESSION['Nome_Item'], $_SESSION['ID_Item']) as $nome => $id):
                       
                        echo'
                       <li class="list-group-item list-group-item-primary d-flex bd-highlight mt-2 mr-2 rounded" style="height: 60px;">
                           <h6 style="text-align:center;" mr-auto ml-3 mb-3 mt-3 " align="center">
                            '.$nome.'
                          </h6> 
                         <div>
                         <a href="#" id='.$id.' class="btn btn-danger mt-0 mr-0 ml-2"  data-toggle="modal" data-target="#ID_Modal_Excluir_Item">  
                           <svg id="i-trash" viewBox="0 0 33 30" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                               <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                           </svg> 
                         </a>
                         </div>
                       </li>';
                        
                        endforeach;  
            }
} 

if(isset($_POST["ID_Excluir"]))
{       
    $_SESSION['Excluir'] = $_POST["ID_Excluir"];
     echo'
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Não</button>
              <button id="bt_excluir" type="button" class="btn btn-danger" data-dismiss="modal">Sim</button>
            ';
}

if(isset($_POST["ID_TirarDaLista"]))
{       
        $novoArrayNome = array();
        $novoArrayID = array();
        #echo"Exlcuindo". $_SESSION['Excluir'] ;
      if(isset($_SESSION['ID_Item'])){
       # echo"quant ID_Item: ".count($_SESSION['ID_Item'])." - NomeItem".count($_SESSION['Nome_Item']);
        foreach(array_combine($_SESSION['Nome_Item'], $_SESSION['ID_Item']) as $nome => $id):
                
                if($_SESSION['Excluir'] != $id)
                {
                    array_push($novoArrayID,  $id);
                    array_push($novoArrayNome,  $nome);
                }

        endforeach;
      }
        $_SESSION['Nome_Item'] = $novoArrayNome;
        $_SESSION['ID_Item'] = $novoArrayID;

       foreach(array_combine($_SESSION['Nome_Item'], $_SESSION['ID_Item']) as $nome => $id):
                       
                        echo'
                       <li class="list-group-item list-group-item-primary d-flex bd-highlight mt-2 mr-2 rounded" style="height: 60px;">
                           <h6 style="text-align:center;" mr-auto ml-3 mb-3 mt-3 " align="center">
                            '.$nome.'
                          </h6> 
                         <div>
                         <a href="#" id='.$id.' class="btn btn-danger mt-0 mr-0 ml-2"  data-toggle="modal" data-target="#ID_Modal_Excluir_Item">  
                           <svg id="i-trash" viewBox="0 0 33 30" width="20" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                               <path d="M28 6 L6 6 8 30 24 30 26 6 4 6 M16 12 L16 24 M21 12 L20 24 M11 12 L12 24 M12 6 L13 2 19 2 20 6" />
                           </svg> 
                         </a>
                         </div>
                       </li>';
                        
      endforeach;  
}
?>
<?php 
include_once("conexao/Fachada.class.php");
$categoria = 'microcontrolador';
$fachada = new Fachada;

if (isset($_POST['categoria'])) {
          #echo "ID_Item".$idItem;
	$categoria = $_POST['categoria'];
	$result = '';
	if($categoria != 'projeto'){
		$arrayResult  = $fachada->getItenPorCategoria('',$categoria);  
        $result .='<div class="row" align="center" data-spy="scroll" data-offse="0" >';
        
         while ($row =  mysqli_fetch_array($arrayResult,MYSQLI_ASSOC)) {

         $textoDescritivo = substr($row['infoAdicionais'], 0,20);

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
         $result .='
          <div class="card col-md-2 ml-3" style="width: 150px; height: auto;">
            <img class="card-img-top" width="60" height="180" src="'.$row['img_componente'].'" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">'.$row['nomeItem'].'</h5>
              
              <p class="card-text">'.$textoDescritivo.'</p>
              
             <form  class="" method="POST" action="'.$linkCategoria.'" data-toggle="validator" role="form">
               <input type="hidden" name="ItemPesquisa" value="'.$row['ID_Item'].'" style="height: 50px; width: 100px;">
              <button type="submit" class="btn btn-primary">Ver o Item</button>
              </form>
            </div>
          </div>';
         } mysqli_free_result($arrayResult); 
         $result .= '
         </div>';
     	}else
     	{
     	$arrayResult  = $fachada->listarProjeto('');  
        $result .='<div class="row" align="center" data-spy="scroll" data-offse="0">';
        
         while ($row =  mysqli_fetch_array($arrayResult,MYSQLI_ASSOC)) {

         $textoDescritivo = substr($row['metodologia'], 0,20);
         $result .='
          <div class="card col-md-2 ml-3" style="width: 150px; height: auto;">
            <img class="card-img-top" width="60" height="180" src="'.$row['img_projeto'].'" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">'.$row['nome'].'</h5>
              
              <p class="card-text">'.$textoDescritivo.'</p>
              
             <form  class="" method="POST" action="TelaExibirProjeto.php" data-toggle="validator" role="form">
               <input type="hidden" name="ItemPesquisa" value="'.$row['ID_Projeto'].'" style="height: 50px; width: 100px;">
              <button type="submit" class="btn btn-primary">Ver o Item</button>
              </form>
            </div>
          </div>';
         } mysqli_free_result($arrayResult); 
         $result .= '
         </div>';
     	}

     	echo  $result;
}
?>
<?php 
session_start();
include_once("conexao/Fachada.class.php");

$ID_Usuario ='';
$ID_Projeto = '';
$comentario = '';
$fachada = new Fachada;
$retorno = '';
$imprimir = "";
$tipoAlert = "alert alert-success";
$labelAlerta = '';
$_SESSION["avaliou"] = false;

if(isset($_POST["ID_Usuario"])){
	
	$ID_Usuario = $_POST["ID_Usuario"];
	$ID_Projeto = $_POST["ID_Projeto"];
	$avaliacao = $_POST["Avaliacao"];
	$arrayResult  = $fachada->inserirAvaliacao($avaliacao, $ID_Usuario, $ID_Projeto);
	#$countBusca =  mysqli_num_rows($arrayResult);

	#echo "Valor do array result do inserir..".$arrayResult;
	if ($arrayResult == -1) {
		  $_SESSION["avaliou"] = true;
          $imprimir = "Obrigado por atualizar sua avaliação!";
          $tipoAlert = "alert alert-primary alert-dismissible fade show";
          $labelAlerta = 'Atualização Registrada!';
       }else if ($arrayResult == -2) {
          $imprimir = "Erro ao realizar a avaliãção!";
          $tipoAlert = "alert alert-danger";
          $labelAlerta = 'Erro! ';
       }else if($arrayResult == -3)
       {
         # header("Refresh: 0");
          $_SESSION["avaliou"] = true;
          $imprimir = "Obrigado por nos dar sua avaliação! :)";
          $tipoAlert = "alert alert-success";
          $labelAlerta = 'Avaliação Registrada! ';
       } 


    if(isset($_SESSION["avaliou"]) || !empty($_SESSION["avaliou"]))
    {
      #echo "Valor variável excluiu: ".$_SESSION["excluiu"];
       
       if($_SESSION["avaliou"] == true ){
       echo'
          <div class="'.$tipoAlert.'" id="alert" role="alert" align="center">
            <strong>'.$labelAlerta.'</strong> '.$imprimir.'
            <button type="button" class="close" data-dismiss="alert" arial-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
     	';
        $_SESSION["avaliou"] = false;
        }
    } else
    {
    	echo "Avaliou está vazio...";
    }       
}
?>      
<?php
include_once "Conexao.class.php";
include_once "AtuadorVO.class.php";


class AtuadorDAO{

   	function inserirAtuador($Atuador, $conn)
   	{
	 
	 #Informações gerais item
	 $nome         			= $Atuador->nome;
	 $dimensao  			= $Atuador->dimensao;
	 $precoMedio   			= $Atuador->precoMedio;
	 $infoGerais 			= $Atuador->infoGerais;
	 $linkDS      			= $Atuador->linkDS;
	 $img_componente   	    = $Atuador->img_componente;
	 $palavra_chave			= $Atuador->palavra_chave;

	 #informações  do modelo
	 $modelo				= $Atuador->modelo;	

	 #informações gerais do componente
	 $temperaturaOperacao   = $Atuador->temperaturaOperacao;
	 $tensaoOperacao 		= $Atuador->tensaoOperacao;
	 $compativel			= $Atuador->compativel;
	 $cor					= $Atuador->cor;
	 $controlador			= $Atuador->controlador;
	 	 
	 $conex = $conn->conexaoBD();
	 
	 $nomeItem = $nome." ". $modelo;
	 
  
   	  $resultadoItem = "INSERT INTO `item` (`ID_Item`, `nomeItem`,`categoria`, `palavraChave`, `dimensao`, `precoMedio`, `infoAdicionais`,`linkDataSheet`,`img_componente`) VALUES (NULL, '$nomeItem','atuador', '$palavra_chave', '$dimensao','$precoMedio','$infoGerais','$linkDS','$img_componente')";
	   $msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query. Tabela item: ". mysqli_error($conex));
	   $idItemReturn = mysqli_insert_id($conex);

	   $nomeUsuario = $_SESSION["nomeUser"];

	   $id_user_query = "SELECT ID_usuario FROM usuario where nomeUsuario = '$nomeUsuario'";
	   $id_user = mysqli_query($conex, $id_user_query);
	   $id_user = $id_user->fetch_row();

	   $id_item_query = "SELECT ID_Item FROM item where nomeItem = '$nomeItem'";
	   $id_item = mysqli_query($conex, $id_item_query);
	   $id_item = $id_item->fetch_row();

	   $cadastroItemQuery = "INSERT INTO `cadastro_item` (`ID_Cadastro`, `ID_Usuario_FK`, `ID_Item_FK`, `dataCadastro`) VALUES (NULL, '$id_user[0]', '$id_item[0]', NOW())";
 	   $resultadoCadastroItem = mysqli_query($conex, $cadastroItemQuery) or die ("O sistema não foi capaz de executar a query. Tabela cadastro_item". mysqli_error($conex)); 
 	  
 	   #or die ("O sistema não foi capaz de executar a query cadastro_item");

 	   #insere Atuador
 	   $AtuadorQuery = "INSERT INTO `atuador` (`ID_Atuador`,`nome`) VALUES (NULL, '$nome')";
 	   $resultadoAtuador = mysqli_query($conex, $AtuadorQuery)or die ("O sistema não foi capaz de executar a query. Tabela Atuador". mysqli_error($conex));

 	   #recupera ID_Atuador
 	   $id_Atuador_query = "SELECT ID_Atuador FROM atuador where nome = '$nome'";
	   $id_Atuador = mysqli_query($conex, $id_Atuador_query);
	   $id_Atuador = $id_Atuador->fetch_row();
 	   #insere na tabela item_Eum_Atuador
 	   $item_Eum_Atuador_query = "INSERT INTO `item_eum_atuador` (`ID_eUm`,`ID_Item_FK`,`ID_Atuador_FK`) VALUES (NULL, '$id_item[0]','$id_Atuador[0]')";
 	   $item_Eum_Atuador = mysqli_query($conex, $item_Eum_Atuador_query) or die ("O sistema não foi capaz de executar a query. Tabela item_eum_Atuador". mysqli_error($conex));

 	    #insere na tabela modelo_Atuador
 	   $modelo_query = "INSERT INTO `modelo_atuador` (`ID_Modelo_Atuador`,`ID_Atuador_FK`,`tipo`) VALUES (NULL,'$id_Atuador[0]','$modelo')";
 	   $modelo_Atuador = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a query. Tabela modelo_Atuador". mysqli_error($conex));

 	   #buscar ID_Modelo_Atuador
	   $id_modelo_query = "SELECT ID_Modelo_Atuador FROM modelo_atuador where tipo = '$modelo'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) ;
	   $id_modelo =  $id_modelo->fetch_row();

 	   foreach($compativel as $list):
	#   echo "ID do componente compativel:".$list;
	   $e_compativel_query = "INSERT INTO `atuador_e_compativel` (`ID_E_Comp`,`ID_Item_FK`,`ID_Atuador_FK`) VALUES (NULL,'$list','$id_item[0]')";
	   $e_compativel =  mysqli_query($conex, $e_compativel_query) or die ("O sistema não foi capaz de executar a query. Tabela Atuador_e_compativel". mysqli_error($conex));
	   
	   endforeach;

 	   $info_gerais_query = "INSERT INTO `info_gerais_atuadores` (`ID_IG_Atuador`,`ID_Modelo_FK`,`cor`,`controlador`,`tensaoOperacao`,`temperaturaOperacao`) 
 	   	   VALUES (NULL,'$id_modelo[0]','$cor','$controlador','$tensaoOperacao','$temperaturaOperacao')";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a query. Tabela info_gerais_atuadores". mysqli_error($conex));
   	  

 	   #echo "#Valor do ultimo ID Inserido: ". $idItemReturn;
	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoAtuador || !$item_Eum_Atuador	|| !$modelo_Atuador  || !$info_gerais)
	   {
		return 2;
	   }else
	   {
		return  $idItemReturn;
	   }

   	}

function editarAtuador($Atuador, $conn)
   	{
	 #Informações gerais
   	 	 #Informações gerais item
   	 $ID_item 				= $Atuador->ID_Item; 
		 $nome         			= $Atuador->nome;
	 $dimensao  			= $Atuador->dimensao;
	 $precoMedio   			= $Atuador->precoMedio;
	 $infoGerais 			= $Atuador->infoGerais;
	 $linkDS      			= $Atuador->linkDS;
	 $img_componente   	    = $Atuador->img_componente;
	 $palavra_chave			= $Atuador->palavra_chave;

	 #informações  do modelo
	 $modelo				= $Atuador->modelo;	

	 #informações gerais do componente
	 $temperaturaOperacao   = $Atuador->temperaturaOperacao;
	 $tensaoOperacao 		= $Atuador->tensaoOperacao;
	 $compativel			= $Atuador->compativel;
	 $cor					= $Atuador->cor;
	 $controlador			= $Atuador->controlador;
	 	 
	 
	 $conex = $conn->conexaoBD();
	 
	 $nomeItem = $nome." ". $modelo;

  	if(empty($img_componente)){

 		$resultadoItem = "UPDATE `item` SET `nomeItem` = '$nomeItem',`palavraChave` = '$palavra_chave', `dimensao` = '$dimensao', `precoMedio`='$precoMedio', `infoAdicionais`= '$infoGerais',`linkDataSheet`='$linkDS' WHERE `item`.`ID_Item` = '$ID_item'";
   	  
   	}else{
 		$resultadoItem = "UPDATE `item` SET `nomeItem` = '$nomeItem',`palavraChave` = '$palavra_chave', `dimensao` = '$dimensao', `precoMedio`='$precoMedio', `infoAdicionais`= '$infoGerais',`linkDataSheet`='$linkDS',`img_componente`='$img_componente' WHERE `item`.`ID_Item` = '$ID_item'";

   	}
	   $msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query na tabela item - ". mysqli_error($conex));

	   $idItemReturn = mysqli_insert_id($conex);

	   $nomeUsuario = $_SESSION["nomeUser"];

	   $id_user_query = "SELECT ID_usuario FROM usuario where nomeUsuario = '$nomeUsuario'";
	   $id_user = mysqli_query($conex, $id_user_query)  or die ("O sistema não foi capaz de executar a consulta na tabela usuario");
	   $id_user = $id_user->fetch_row();


	   $cadastroItemQuery = "UPDATE `cadastro_item` SET `dataCadastro` = NOW(), `ID_Usuario_FK`='$id_user[0]' WHERE `cadastro_item`.`ID_Item_FK` = '$ID_item'";
 	   $resultadoCadastroItem = mysqli_query($conex, $cadastroItemQuery)   or die ("O sistema não foi capaz de executar a consulta na tabela cadastro_item -". mysqli_error($conex));
 	 
 	    #recupera ID_Atuador
 	   $id_Atuador_query  = "SELECT ID_Atuador_FK FROM item_eum_atuador where `item_eum_atuador`.`ID_Item_FK` = '$ID_item'";
 	   $id_Atuador = mysqli_query($conex, $id_Atuador_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_eum_Atuador -". mysqli_error($conex));
 	   $id_Atuador = $id_Atuador->fetch_row();
 	   #insere Atuador

 	   $AtuadorQuery = "UPDATE `atuador` SET `nome` = '$nome' WHERE `Atuador`.`ID_Atuador` = '$id_Atuador[0]'";
 	   $resultadoAtuador = mysqli_query($conex, $AtuadorQuery)or die ("O sistema não foi capaz de executar a consulta na tabela Atuador -". mysqli_error($conex));  


 	    #insere na tabela modelo_Atuador
 	   $modelo_query = "UPDATE `modelo_atuador` SET `tipo` = '$modelo' WHERE `modelo_atuador`.`ID_Atuador_FK`= '$id_Atuador[0]'";
 	   $modelo_Atuador = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Atuador -". mysqli_error($conex));

 	   #buscar ID_Modelo_Atuador
	   $id_modelo_query = "SELECT ID_Modelo_Atuador FROM modelo_atuador where `modelo_Atuador`.`ID_atuador_FK` = '$id_Atuador[0]'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Atuador Select -". mysqli_error($conex));
	   $id_modelo =  $id_modelo->fetch_row();
		      
	   $dele_com_query = "DELETE FROM `atuador_e_compativel` WHERE `atuador_e_compativel`.`ID_Atuador_FK` = '$ID_item'";
	   $dele_com = mysqli_query($conex, $dele_com_query) or die ("O sistema não foi capaz de executar a query. Tabela Atuador_e_compativel". mysqli_error($conex));

 	   foreach($compativel as $list):
	   
	   #echo "ID do componente compativel:".$list;
	   $e_compativel_query = "INSERT INTO `atuador_e_compativel` (`ID_E_Comp`,`ID_Item_FK`,`ID_Atuador_FK`) VALUES (NULL,'$list','$ID_item')";
	   $e_compativel =  mysqli_query($conex, $e_compativel_query) or die ("O sistema não foi capaz de executar a query. Tabela Atuador_e_compativel". mysqli_error($conex));
	   
	   endforeach;
 	   
 	   $info_gerais_query = "UPDATE `info_gerais_atuadores` set `cor`='$cor',`controlador`='$controlador',`tensaoOperacao`='$tensaoOperacao',`temperaturaOperacao`='$temperaturaOperacao'
 	   	   WHERE `ID_Modelo_FK`='$id_modelo[0]'";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a query. Tabela info_gerais_Atuador". mysqli_error($conex));

	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoAtuador || !$modelo_Atuador || !$info_gerais)
	   {
		return -2;
	   }else
	   {
		return  $ID_item ;
	   }

   	}   	
function excluirAtuador($AtuadorID)
   	{

   	 $ID_item 				= $AtuadorID;	
	 $conn = New Conexao;
	 $conex = $conn->conexaoBD();

 	   $resultadoItem = "DELETE FROM `item` WHERE `item`.`ID_Item` = '$ID_item'";
	   $msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query na tabela item - ". mysqli_error($conex));

	   $idItemReturn = $ID_item;

	   $nomeUsuario = $_SESSION["nomeUser"];

	   $id_user_query = "SELECT ID_usuario FROM usuario where nomeUsuario = '$nomeUsuario'";
	   $id_user = mysqli_query($conex, $id_user_query)  or die ("O sistema não foi capaz de executar a consulta na tabela usuario");
	   $id_user = $id_user->fetch_row();


	   $cadastroItemQuery = "DELETE FROM `cadastro_item` WHERE `cadastro_item`.`ID_Item_FK` = '$ID_item'";
 	   $resultadoCadastroItem = mysqli_query($conex, $cadastroItemQuery)   or die ("O sistema não foi capaz de executar a consulta na tabela cadastro_item -". mysqli_error($conex));


 	   $id_Atuador_query  = "SELECT ID_Atuador_FK FROM item_eum_atuador where `item_eum_atuador`.`ID_Item_FK` = '$ID_item'";
 	   $id_Atuador = mysqli_query($conex, $id_Atuador_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_eum_Atuador -". mysqli_error($conex));
 	   $id_Atuador = $id_Atuador->fetch_row();

 	   $item_euma_query = "DELETE FROM `item_eum_atuador` WHERE `item_eum_atuador`.`ID_Item_FK` = '$ID_item'";
 	   $item_euma = mysqli_query($conex, $item_euma_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_euma_atuador -". mysqli_error($conex));
 	   #insere Atuador

 	   $AtuadorQuery = "DELETE FROM `atuador` WHERE `atuador`.`ID_Atuador` = '$id_Atuador[0]'";
 	   $resultadoAtuador = mysqli_query($conex, $AtuadorQuery)or die ("O sistema não foi capaz de executar a consulta na tabela Atuador -". mysqli_error($conex));  

 	   #buscar ID_Modelo_Atuador
	   $id_modelo_query = "SELECT ID_Modelo_Atuador FROM modelo_Atuador where `modelo_atuador`.`ID_Atuador_FK` = '$id_Atuador[0]'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Atuador Select -". mysqli_error($conex));
	   $id_modelo =  $id_modelo->fetch_row();


 	    #papaga na tabela modelo_Atuador
 	   $modelo_query = "DELETE FROM `modelo_atuador` WHERE `modelo_atuador`.`ID_Atuador_FK`= '$id_Atuador[0]'";
 	   $modelo_Atuador = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Atuador -". mysqli_error($conex));

 	   $e_compativel_query = "DELETE FROM `atuador_e_compativel` WHERE `atuador_e_compativel`.`ID_Atuador_FK`= '$id_Atuador[0]'";
 	   $e_compativel = mysqli_query($conex, $e_compativel_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Atuador -". mysqli_error($conex));


 	   $info_gerais_query = "DELETE FROM `info_gerais_atuadores` WHERE `info_gerais_atuadores`.`ID_Modelo_FK` = '$id_modelo[0]' ";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_gerais_atuadores -". mysqli_error($conex));

	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoAtuador || !$modelo_Atuador || !$info_gerais || !$e_compativel)
	   {
		return -2;
	   }else
	   {
		return  $ID_item ;
	   }

   	}   	
	function verificarExistenciaAtuador($Atuador){

		$nome = $Atuador->nome." ".$Atuador->modelo;
		#echo "Nome antes da verificação:".$nome;
		$resultado = "SELECT COUNT(*) FROM item where nomeItem LIKE '%$nome%'";
		#stristr($resultado, 'nome');

		$conn = New Conexao;

	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	   	$row = $busca_resultado->fetch_row();

	   	#echo "retorno:".$row[0];
	   	if ($row[0] > 0) {
	   	    return -1;
	   	} else {
	 	    return $this->inserirAtuador($Atuador, $conn);
	   	}
	}

	function verificarExistenciaAtuadorByID($Atuador){

		echo "ID do Atuador: ".$Atuador->ID_Item;
		$resultado = "SELECT COUNT(*) FROM item WHERE item.ID_Item ='$Atuador->ID_Item'";
		#stristr($resultado, 'nome');

		$conn = New Conexao;

	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	   	$row = $busca_resultado->fetch_row();
	   #	echo  "retorno da verificação: ".$row[0];
	   	if ($row[0] > 0) {
	   	    return $this->editarAtuador($Atuador, $conn);
	   	} else {
	 	    return -1;
	   	}
	}

	function AtuadorGetCompativel($itemAtual)
	{

		$resultado = "SELECT I.*
		    FROM item                   				 AS I  
			INNER JOIN atuador_e_compativel       		 AS COM ON COM.ID_Item_FK = I.ID_Item 
			WHERE COM.ID_Atuador_FK = '$itemAtual'";

			$conn = New Conexao;

	  	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	  	    if (!empty($busca_resultado)) {
	  	      #echo "IF 1: ".$row[0]['nomeItem'];
	  	      return $busca_resultado;
	  	    	   
	  	    } else {
	  	    	#echo 0;
	  	    	#echo "IF 2: ".$row[0]['nomeItem'];
	  	  	 return 0;
	  	    } 	

	}
	  	function exibirItem($itemAtual){

		
			$resultado = "SELECT I.*, EU.*,A.*
			FROM item                   				 AS I  
			INNER JOIN item_eum_atuador         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN atuador       					 AS A  ON A.ID_Atuador = EU.ID_Atuador_FK
			WHERE I.nomeItem LIKE '%$itemAtual%'";
	  		
	  		$conn = New Conexao;

	  	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	  	   	#$row = $busca_resultado->fetch_row();
	  	   	/* associative array */
	  	   	#$row = $busca_resultado->fetch_array(MYSQLI_BOTH);

	  	   #	echo $row[0];

	  	   	if (!empty($busca_resultado)) {
	  	   	    #echo "IF 1: ".$row[0]['nomeItem'];
	  	   	    return $busca_resultado;
	  	   	   
	  	   	} else {
	  	   		#echo 0;
	  	   		#echo "IF 2: ".$row[0]['nomeItem'];
	  	 	    return 0;
	  	   	}
	  	}
	  	function exibirAtuadorPorCategoria($nomeUser){

		
			$resultado = "SELECT U.*, I.*, A.*
			FROM usuario                      			 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_eum_atuador         		 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN atuador 			      			 AS A  ON A.ID_Atuador = EU.ID_Atuador_FK
			WHERE I.categoria = 'atuador' and U.nomeUsuario='$nomeUser'";
	  		

	  		$conn = New Conexao;

	  	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	  	   	#$row = $busca_resultado->fetch_row();
	  	   	/* associative array */
	  	   	#$row = $busca_resultado->fetch_array(MYSQLI_BOTH);

	  	   #	echo $row[0];

	  	   	if (!empty($busca_resultado)) {
	  	   	    #echo "IF 1: ".$row[0]['nomeItem'];
	  	   	    return $busca_resultado;
	  	   	   
	  	   	} else {
	  	   		#echo 0;
	  	   		#echo "IF 2: ".$row[0]['nomeItem'];
	  	 	    return 0;
	  	   	}
	  	}

	  	function getItens($itemAtual){

		
			$resultado = "SELECT I.*, EU.*,A.*
			FROM item                   				 AS I  
			INNER JOIN item_euma_Atuador         		 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN atuador       					 AS A  ON A.ID_Atuador = EU.ID_Atuador_FK
			WHERE I.ID_Item = '$itemAtual' and I.categoria = 'microcontrolador'";
	  		
	  		#echo "Consulta SQL: ".$resultado;

	  		$conn = New Conexao;

	  	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	  	   	#$row = $busca_resultado->fetch_row();
	  	   	/* associative array */
	  	   	$row = $busca_resultado->fetch_array(MYSQLI_BOTH);

	  	   #	echo $row[0];

	  	   	if ($row[0] > 0) {
	  	   	    return $row;
	  	   	  #  echo "IF 1: ".$row[0]['nomeItem'];
	  	   	} else {
	  	   		#echo 0;
	  	   		#echo "IF 2: ".$row[0]['nomeItem'];
	  	 	    return 0;
	  	   	}
	  	}
	    
  	function exibirAtuador($itemAtual){

  			$conn = New Conexao;

	  		$resultado = "SELECT U.*, CI.*,I.*, EU.*,A.*, MO.*, IG.*
			FROM 	   usuario                      	 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_eum_Atuador         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN atuador       					 AS A  ON A.ID_Atuador = EU.ID_Atuador_FK
			INNER JOIN modelo_Atuador          			 AS MO ON MO.ID_Atuador_FK = A.ID_Atuador
			INNER JOIN info_gerais_atuadores                AS IG ON IG.ID_Modelo_FK = MO.ID_Modelo_Atuador
			WHERE I.ID_Item = '$itemAtual'";
	   		

	  	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	  	   	#$row = $busca_resultado->fetch_row();
	  	   	/* associative array */
	  	   	$row = $busca_resultado->fetch_array(MYSQLI_BOTH);

	  	   #	echo $row[0];

	  	   	if ($row[0] > 0) {
	  	   	    # echo "Endereco IF 1: ".$row['img_componente'];
	  	   	    return $row;
	  	   	   
	  	   	} else {
	  	   		#echo 0;
	  	   		#echo "IF 2: ".$row['nomeItem'];
	  	 	    return 0;
	  	   	}
  	}
}

?>
   
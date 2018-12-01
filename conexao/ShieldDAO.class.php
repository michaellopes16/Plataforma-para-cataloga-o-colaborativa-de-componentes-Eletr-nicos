<?php
include_once "Conexao.class.php";
include_once "ShieldVO.class.php";


class ShieldDAO{

   	function inserirShield($Shield, $conn)
   	{
	 
	 #Informações gerais item
	 $nome         			= $Shield->nome;
	 $dimensao  			= $Shield->dimensao;
	 $precoMedio   			= $Shield->precoMedio;
	 $infoGerais 			= $Shield->infoGerais;
	 $linkDS      			= $Shield->linkDS;
	 $img_componente   	    = $Shield->img_componente;
	 $palavra_chave			= $Shield->palavra_chave;

	 #informações  do modelo
	 $modelo				= $Shield->modelo;	

	 #informações gerais do componente
	 $temperaturaOperacao   = $Shield->temperaturaOperacao;
	 $tensaoOperacao 		= $Shield->tensaoOperacao;
	 $funcao 				= $Shield->funcao;
	 $peso  				= $Shield->peso;
	 $compativel			= $Shield->compativel;
	 $modo_consumo			= $Shield->modo_consumo;
	 	 
	 $conex = $conn->conexaoBD();
	 
	 $nomeItem = $nome." ". $modelo;
	 
  
   	  $resultadoItem = "INSERT INTO `item` (`ID_Item`, `nomeItem`,`categoria`, `palavraChave`, `dimensao`, `precoMedio`, `infoAdicionais`,`linkDataSheet`,`img_componente`) VALUES (NULL, '$nomeItem','shield', '$palavra_chave', '$dimensao','$precoMedio','$infoGerais','$linkDS','$img_componente')";
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

 	   #insere Shield
 	   $ShieldQuery = "INSERT INTO `shield` (`ID_Shield`,`nome`) VALUES (NULL, '$nome')";
 	   $resultadoShield = mysqli_query($conex, $ShieldQuery)or die ("O sistema não foi capaz de executar a query. Tabela Shield". mysqli_error($conex));

 	   #recupera ID_Shield
 	   $id_Shield_query = "SELECT ID_Shield FROM shield where nome = '$nome'";
	   $id_Shield = mysqli_query($conex, $id_Shield_query);
	   $id_Shield = $id_Shield->fetch_row();
 	   #insere na tabela item_Eum_Shield
 	   $item_Eum_Shield_query = "INSERT INTO `item_eum_shield` (`ID_eUm`,`ID_Item_FK`,`ID_Shield_FK`) VALUES (NULL, '$id_item[0]','$id_Shield[0]')";
 	   $item_Eum_Shield = mysqli_query($conex, $item_Eum_Shield_query) or die ("O sistema não foi capaz de executar a query. Tabela item_eum_shield". mysqli_error($conex));

 	    #insere na tabela modelo_Shield
 	   $modelo_query = "INSERT INTO `modelo_shield` (`ID_Modelo_shield`,`ID_Shield_FK`,`tipo`) VALUES (NULL,'$id_Shield[0]','$modelo')";
 	   $modelo_Shield = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a query. Tabela modelo_Shield". mysqli_error($conex));

 	   #buscar ID_Modelo_Shield
	   $id_modelo_query = "SELECT ID_Modelo_shield FROM modelo_shield where tipo = '$modelo'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) ;
	   $id_modelo =  $id_modelo->fetch_row();

 	   foreach($compativel as $list):
	#   echo "ID do componente compativel:".$list;
	   $e_compativel_query = "INSERT INTO `shield_e_compativel` (`ID_E_Comp`,`ID_Item_FK`,`ID_Shield_FK`) VALUES (NULL,'$list','$id_item[0]')";
	   $e_compativel =  mysqli_query($conex, $e_compativel_query) or die ("O sistema não foi capaz de executar a query. Tabela shield_e_compativel". mysqli_error($conex));
	   
	   endforeach;

 	   $info_gerais_query = "INSERT INTO `info_gerais_Shield` (`ID_IG_Shield`,`ID_Modelo_FK`,`funcao`,`peso`,`temperaturaOperacao`,`tensaoOperacao`,`modo_consumo`) 
 	   	   VALUES (NULL,'$id_modelo[0]','$funcao','$peso','$temperaturaOperacao','$tensaoOperacao','$modo_consumo')";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a query. Tabela info_gerais_Shield". mysqli_error($conex));
   	  

 	   #echo "#Valor do ultimo ID Inserido: ". $idItemReturn;
	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoShield || !$item_Eum_Shield	|| !$modelo_Shield  || !$info_gerais)
	   {
		return 2;
	   }else
	   {
		return  $idItemReturn;
	   }

   	}

function editarShield($Shield, $conn)
   	{
	 #Informações gerais
   	 	 #Informações gerais item
   	 $ID_item 				= $Shield->ID_Item; 
	 $nome         			= $Shield->nome;
	 $dimensao  			= $Shield->dimensao;
	 $precoMedio   			= $Shield->precoMedio;
	 $infoGerais 			= $Shield->infoGerais;
	 $linkDS      			= $Shield->linkDS;
	 $img_componente   	    = $Shield->img_componente;
	 $palavra_chave			= $Shield->palavra_chave;

	 #informações  do modelo
	 $modelo				= $Shield->modelo;	

	 #informações gerais do componente
	 $temperaturaOperacao   = $Shield->temperaturaOperacao;
	 $tensaoOperacao 		= $Shield->tensaoOperacao;
	 $funcao 				= $Shield->funcao;
	 $peso  				= $Shield->peso;
	 $compativel			= $Shield->compativel;
	 $modo_consumo			= $Shield->modo_consumo;
	 	 
	 
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


	   $cadastroItemQuery = "UPDATE `cadastro_item` SET `dataCadastro` = NOW() WHERE `cadastro_item`.`ID_Item_FK` = '$ID_item'";
 	   $resultadoCadastroItem = mysqli_query($conex, $cadastroItemQuery)   or die ("O sistema não foi capaz de executar a consulta na tabela cadastro_item -". mysqli_error($conex));
 	 
 	    #recupera ID_Shield
 	   $id_Shield_query  = "SELECT ID_Shield_FK FROM item_eum_shield where `item_eum_shield`.`ID_Item_FK` = '$ID_item'";
 	   $id_Shield = mysqli_query($conex, $id_Shield_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_eum_Shield -". mysqli_error($conex));
 	   $id_Shield = $id_Shield->fetch_row();
 	   #insere Shield

 	   $ShieldQuery = "UPDATE `shield` SET `nome` = '$nome' WHERE `Shield`.`ID_Shield` = '$id_Shield[0]'";
 	   $resultadoShield = mysqli_query($conex, $ShieldQuery)or die ("O sistema não foi capaz de executar a consulta na tabela Shield -". mysqli_error($conex));  


 	    #insere na tabela modelo_Shield
 	   $modelo_query = "UPDATE `modelo_shield` SET `tipo` = '$modelo' WHERE `modelo_shield`.`ID_Shield_FK`= '$id_Shield[0]'";
 	   $modelo_Shield = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Shield -". mysqli_error($conex));

 	   #buscar ID_Modelo_Shield
	   $id_modelo_query = "SELECT ID_Modelo_Shield FROM modelo_shield where `modelo_Shield`.`ID_Shield_FK` = '$id_Shield[0]'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Shield Select -". mysqli_error($conex));
	   $id_modelo =  $id_modelo->fetch_row();
		      
	   $dele_com_query = "DELETE FROM `shield_e_compativel` WHERE `shield_e_compativel`.`ID_Shield_FK` = '$ID_item'";
	   $dele_com = mysqli_query($conex, $dele_com_query) or die ("O sistema não foi capaz de executar a query. Tabela shield_e_compativel". mysqli_error($conex));

 	   foreach($compativel as $list):
	   
	   #echo "ID do componente compativel:".$list;
	   $e_compativel_query = "INSERT INTO `shield_e_compativel` (`ID_E_Comp`,`ID_Item_FK`,`ID_Shield_FK`) VALUES (NULL,'$list','$ID_item')";
	   $e_compativel =  mysqli_query($conex, $e_compativel_query) or die ("O sistema não foi capaz de executar a query. Tabela shield_e_compativel". mysqli_error($conex));
	   
	   endforeach;
 	   
 	   $info_gerais_query = "UPDATE `info_gerais_Shield` set `funcao`='$funcao',`peso`='$peso',`temperaturaOperacao`='$temperaturaOperacao',`tensaoOperacao`='$tensaoOperacao', `modo_consumo` = '$modo_consumo'
 	   	   WHERE `ID_Modelo_FK`='$id_modelo[0]'";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a query. Tabela info_gerais_Shield". mysqli_error($conex));

	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoShield || !$modelo_Shield || !$info_gerais)
	   {
		return -2;
	   }else
	   {
		return  $ID_item ;
	   }

   	}   	
function excluirShield($ShieldID)
   	{

   	 $ID_item 				= $ShieldID;	
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


 	   $id_Shield_query  = "SELECT ID_Shield_FK FROM item_eum_shield where `item_eum_Shield`.`ID_Item_FK` = '$ID_item'";
 	   $id_Shield = mysqli_query($conex, $id_Shield_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_eum_Shield -". mysqli_error($conex));
 	   $id_Shield = $id_Shield->fetch_row();

 	   $item_euma_query = "DELETE FROM `item_eum_shield` WHERE `item_eum_Shield`.`ID_Item_FK` = '$ID_item'";
 	   $item_euma = mysqli_query($conex, $item_euma_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_euma_Shield -". mysqli_error($conex));
 	   #insere Shield

 	   $ShieldQuery = "DELETE FROM `shield` WHERE `Shield`.`ID_Shield` = '$id_Shield[0]'";
 	   $resultadoShield = mysqli_query($conex, $ShieldQuery)or die ("O sistema não foi capaz de executar a consulta na tabela Shield -". mysqli_error($conex));  

 	   #buscar ID_Modelo_Shield
	   $id_modelo_query = "SELECT ID_Modelo_Shield FROM modelo_Shield where `modelo_shield`.`ID_Shield_FK` = '$id_Shield[0]'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Shield Select -". mysqli_error($conex));
	   $id_modelo =  $id_modelo->fetch_row();


 	    #papaga na tabela modelo_Shield
 	   $modelo_query = "DELETE FROM `modelo_shield` WHERE `modelo_shield`.`ID_Shield_FK`= '$id_Shield[0]'";
 	   $modelo_Shield = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Shield -". mysqli_error($conex));


 	   $info_gerais_query = "DELETE FROM `info_gerais_shield` WHERE `info_gerais_Shield`.`ID_Modelo_FK` = '$id_modelo[0]' ";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_gerais_Shield -". mysqli_error($conex));

	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoShield || !$modelo_Shield || !$info_gerais)
	   {
		return -2;
	   }else
	   {
		return  $ID_item ;
	   }

   	}   	
	function verificarExistenciaShield($Shield){

		$nome = $Shield->nome." ".$Shield->modelo;
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
	 	    return $this->inserirShield($Shield, $conn);
	   	}
	}

	function verificarExistenciaShieldByID($Shield){

		echo "ID do Shield: ".$Shield->ID_Item;
		$resultado = "SELECT COUNT(*) FROM item WHERE item.ID_Item ='$Shield->ID_Item'";
		#stristr($resultado, 'nome');

		$conn = New Conexao;

	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	   	$row = $busca_resultado->fetch_row();
	   #	echo  "retorno da verificação: ".$row[0];
	   	if ($row[0] > 0) {
	   	    return $this->editarShield($Shield, $conn);
	   	} else {
	 	    return -1;
	   	}
	}

	function shieldGetCompativel($itemAtual)
	{

		$resultado = "SELECT I.*
		    FROM item                   				 AS I  
			INNER JOIN shield_e_compativel       		 AS COM ON COM.ID_Item_FK = I.ID_Item 
			WHERE COM.ID_Shield_FK = '$itemAtual'";

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

		
			$resultado = "SELECT I.*, EU.*,S.*
			FROM item                   				 AS I  
			INNER JOIN item_eum_shield         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN shield       					 AS S  ON S.ID_Shield = EU.ID_Shield_FK
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
	  	function exibirShieldPorCategoria($nomeUser){

		
			$resultado = "SELECT U.*, I.*, S.*
			FROM usuario                      			 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_eum_Shield         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN shield 			      			 AS S  ON S.ID_Shield = EU.ID_Shield_FK
			WHERE I.categoria = 'shield' and U.nomeUsuario='$nomeUser'";
	  		

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

		
			$resultado = "SELECT I.*, EU.*,S.*
			FROM item                   				 AS I  
			INNER JOIN item_euma_shield         		 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN shield       					 AS S  ON S.ID_Shield = EU.ID_Shield_FK
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
	    
  	function exibirShield($itemAtual){

  			$conn = New Conexao;

	  		$resultado = "SELECT U.*, CI.*,I.*, EU.*,S.*, MO.*, IG.*
			FROM 	   usuario                      	 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_eum_Shield         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN shield       					 AS S  ON S.ID_Shield = EU.ID_Shield_FK
			INNER JOIN modelo_shield          			 AS MO ON MO.ID_Shield_FK = S.ID_Shield
			INNER JOIN info_gerais_shield                AS IG ON IG.ID_Modelo_FK = MO.ID_Modelo_Shield
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
   
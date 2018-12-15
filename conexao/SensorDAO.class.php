<?php
include_once "Conexao.class.php";
include_once "SensorVO.class.php";


class SensorDAO{

   	function inserirSensor($Sensor, $conn)
   	{
	 
	 #Informações gerais item
	 $nome         			= $Sensor->nome;
	 $dimensao  			= $Sensor->dimensao;
	 $precoMedio   			= $Sensor->precoMedio;
	 $infoGerais 			= $Sensor->infoGerais;
	 $linkDS      			= $Sensor->linkDS;
	 $img_componente   	    = $Sensor->img_componente;
	 $palavra_chave			= $Sensor->palavra_chave;

	 #informações  do modelo
	 $modelo				= $Sensor->modelo;	

	 #informações gerais do componente
	 $temperaturaOperacao   = $Sensor->temperaturaOperacao;
	 $tensaoOperacao 		= $Sensor->tensaoOperacao;
	 $compativel			= $Sensor->compativel;
	 $tensaoSaida 			= $Sensor->tensaoSaida;
	 $funcao				= $Sensor->funcao;
	 	 
	 $conex = $conn->conexaoBD();
	 
	 $nomeItem = $nome." ". $modelo;
	 
  
   	  $resultadoItem = "INSERT INTO `item` (`ID_Item`, `nomeItem`,`categoria`, `palavraChave`, `dimensao`, `precoMedio`, `infoAdicionais`,`linkDataSheet`,`img_componente`) VALUES (NULL, '$nomeItem','sensor', '$palavra_chave', '$dimensao','$precoMedio','$infoGerais','$linkDS','$img_componente')";
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

 	   #insere Sensor
 	   $SensorQuery = "INSERT INTO `sensor` (`ID_Sensor`,`nome`) VALUES (NULL, '$nome')";
 	   $resultadoSensor = mysqli_query($conex, $SensorQuery)or die ("O sistema não foi capaz de executar a query. Tabela Sensor". mysqli_error($conex));

 	   #recupera ID_Sensor
 	   $id_Sensor_query = "SELECT ID_Sensor FROM sensor where nome = '$nome'";
	   $id_Sensor = mysqli_query($conex, $id_Sensor_query);
	   $id_Sensor = $id_Sensor->fetch_row();
 	   #insere na tabela item_Eum_Sensor
 	   $item_Eum_Sensor_query = "INSERT INTO `item_eum_sensor` (`ID_eUm`,`ID_Item_FK`,`ID_Sensor_FK`) VALUES (NULL, '$id_item[0]','$id_Sensor[0]')";
 	   $item_Eum_Sensor = mysqli_query($conex, $item_Eum_Sensor_query) or die ("O sistema não foi capaz de executar a query. Tabela item_eum_Sensor". mysqli_error($conex));

 	    #insere na tabela modelo_Sensor
 	   $modelo_query = "INSERT INTO `modelo_sensor` (`ID_Modelo_Sensor`,`ID_Sensor_FK`,`tipo`) VALUES (NULL,'$id_Sensor[0]','$modelo')";
 	   $modelo_Sensor = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a query. Tabela modelo_Sensor". mysqli_error($conex));

 	   #buscar ID_Modelo_Sensor
	   $id_modelo_query = "SELECT ID_Modelo_Sensor FROM modelo_sensor where tipo = '$modelo'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) ;
	   $id_modelo =  $id_modelo->fetch_row();

 	   foreach($compativel as $list):
	#   echo "ID do componente compativel:".$list;
	   $e_compativel_query = "INSERT INTO `sensor_e_compativel` (`ID_E_Comp`,`ID_Item_FK`,`ID_Sensor_FK`) VALUES (NULL,'$list','$id_item[0]')";
	   $e_compativel =  mysqli_query($conex, $e_compativel_query) or die ("O sistema não foi capaz de executar a query. Tabela Sensor_e_compativel". mysqli_error($conex));
	   
	   endforeach;

 	   $info_gerais_query = "INSERT INTO `info_gerais_sensor` (`ID_IG_Sensor`,`ID_Modelo_FK`,`tensaoSaida`,`funcao`,`tensaoOperacao`,`temperaturaOperacao`) 
 	   	   VALUES (NULL,'$id_modelo[0]','$tensaoSaida','$funcao','$tensaoOperacao','$temperaturaOperacao')";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a query. Tabela info_gerais_Sensor". mysqli_error($conex));
   	  

 	   #echo "#Valor do ultimo ID Inserido: ". $idItemReturn;
	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoSensor || !$item_Eum_Sensor	|| !$modelo_Sensor  || !$info_gerais)
	   {
		return 2;
	   }else
	   {
		return  $idItemReturn;
	   }

   	}

function editarSensor($Sensor, $conn)
   	{
	 #Informações gerais
   	 	 #Informações gerais item
   	 $ID_item 				= $Sensor->ID_Item; 
	 $nome         			= $Sensor->nome;
	 $dimensao  			= $Sensor->dimensao;
	 $precoMedio   			= $Sensor->precoMedio;
	 $infoGerais 			= $Sensor->infoGerais;
	 $linkDS      			= $Sensor->linkDS;
	 $img_componente   	    = $Sensor->img_componente;
	 $palavra_chave			= $Sensor->palavra_chave;

	 #informações  do modelo
	 $modelo				= $Sensor->modelo;	

	 #informações gerais do componente
	 $temperaturaOperacao   = $Sensor->temperaturaOperacao;
	 $tensaoOperacao 		= $Sensor->tensaoOperacao;
	 $compativel			= $Sensor->compativel;
	 $tensaoSaida			= $Sensor->tensaoSaida;
	 $funcao			    = $Sensor->funcao;
	 	 
	 
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
 	 
 	    #recupera ID_Sensor
 	   $id_Sensor_query  = "SELECT ID_Sensor_FK FROM item_eum_sensor where `item_eum_sensor`.`ID_Item_FK` = '$ID_item'";
 	   $id_Sensor = mysqli_query($conex, $id_Sensor_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_eum_Sensor -". mysqli_error($conex));
 	   $id_Sensor = $id_Sensor->fetch_row();
 	   #insere Sensor

 	   $SensorQuery = "UPDATE `sensor` SET `nome` = '$nome' WHERE `sensor`.`ID_Sensor` = '$id_Sensor[0]'";
 	   $resultadoSensor = mysqli_query($conex, $SensorQuery)or die ("O sistema não foi capaz de executar a consulta na tabela Sensor -". mysqli_error($conex));  


 	    #insere na tabela modelo_Sensor
 	   $modelo_query = "UPDATE `modelo_sensor` SET `tipo` = '$modelo' WHERE `modelo_sensor`.`ID_Sensor_FK`= '$id_Sensor[0]'";
 	   $modelo_Sensor = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Sensor -". mysqli_error($conex));

 	   #buscar ID_Modelo_Sensor
	   $id_modelo_query = "SELECT ID_Modelo_Sensor FROM modelo_sensor where `modelo_sensor`.`ID_Sensor_FK` = '$id_Sensor[0]'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Sensor Select -". mysqli_error($conex));
	   $id_modelo =  $id_modelo->fetch_row();
		      
	   $dele_com_query = "DELETE FROM `sensor_e_compativel` WHERE `sensor_e_compativel`.`ID_Sensor_FK` = '$ID_item'";
	   $dele_com = mysqli_query($conex, $dele_com_query) or die ("O sistema não foi capaz de executar a query. Tabela Sensor_e_compativel". mysqli_error($conex));

 	   foreach($compativel as $list):
	   
	   #echo "ID do componente compativel:".$list;
	   $e_compativel_query = "INSERT INTO `sensor_e_compativel` (`ID_E_Comp`,`ID_Item_FK`,`ID_Sensor_FK`) VALUES (NULL,'$list','$ID_item')";
	   $e_compativel =  mysqli_query($conex, $e_compativel_query) or die ("O sistema não foi capaz de executar a query. Tabela Sensor_e_compativel". mysqli_error($conex));
	   
	   endforeach;
 	   
 	   $info_gerais_query = "UPDATE `info_gerais_Sensor` set `tensaoSaida`='$tensaoSaida',`funcao`='$funcao',`tensaoOperacao`='$tensaoOperacao',`temperaturaOperacao`='$temperaturaOperacao'
 	   	   WHERE `ID_Modelo_FK`='$id_modelo[0]'";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a query. Tabela info_gerais_Sensor". mysqli_error($conex));

	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoSensor || !$modelo_Sensor || !$info_gerais)
	   {
		return -2;
	   }else
	   {
		return  $ID_item ;
	   }

   	}   	
function excluirSensor($SensorID)
   	{

   	 $ID_item 				= $SensorID;	
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


 	   $id_Sensor_query  = "SELECT ID_Sensor_FK FROM item_eum_sensor where `item_eum_sensor`.`ID_Item_FK` = '$ID_item'";
 	   $id_Sensor = mysqli_query($conex, $id_Sensor_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_eum_Sensor -". mysqli_error($conex));
 	   $id_Sensor = $id_Sensor->fetch_row();

 	   $item_euma_query = "DELETE FROM `item_eum_sensor` WHERE `item_eum_sensor`.`ID_Item_FK` = '$ID_item'";
 	   $item_euma = mysqli_query($conex, $item_euma_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_euma_Sensor -". mysqli_error($conex));
 	   #insere Sensor

 	   $SensorQuery = "DELETE FROM `sensor` WHERE `sensor`.`ID_Sensor` = '$id_Sensor[0]'";
 	   $resultadoSensor = mysqli_query($conex, $SensorQuery)or die ("O sistema não foi capaz de executar a consulta na tabela Sensor -". mysqli_error($conex));  

 	   #buscar ID_Modelo_Sensor
	   $id_modelo_query = "SELECT ID_Modelo_Sensor FROM modelo_sensor where `modelo_sensor`.`ID_Sensor_FK` = '$id_Sensor[0]'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Sensor Select -". mysqli_error($conex));
	   $id_modelo =  $id_modelo->fetch_row();


 	    #papaga na tabela modelo_Sensor
 	   $modelo_query = "DELETE FROM `modelo_sensor` WHERE `modelo_sensor`.`ID_Sensor_FK`= '$id_Sensor[0]'";
 	   $modelo_Sensor = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Sensor -". mysqli_error($conex));

 	   $e_compativel_query = "DELETE FROM `sensor_e_compativel` WHERE `sensor_e_compativel`.`ID_Sensor_FK`= '$id_Sensor[0]'";
 	   $e_compativel = mysqli_query($conex, $e_compativel_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_Sensor -". mysqli_error($conex));


 	   $info_gerais_query = "DELETE FROM `info_gerais_sensor` WHERE `info_gerais_sensor`.`ID_Modelo_FK` = '$id_modelo[0]' ";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_gerais_Sensores -". mysqli_error($conex));

	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoSensor || !$modelo_Sensor || !$info_gerais || !$e_compativel)
	   {
		return -2;
	   }else
	   {
		return  $ID_item ;
	   }

   	}   	
	function verificarExistenciaSensor($Sensor){

		$nome = $Sensor->nome." ".$Sensor->modelo;
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
	 	    return $this->inserirSensor($Sensor, $conn);
	   	}
	}

	function verificarExistenciaSensorByID($Sensor){

		#echo "ID do Sensor: ".$Sensor->ID_Item;
		$resultado = "SELECT COUNT(*) FROM item WHERE item.ID_Item ='$Sensor->ID_Item'";
		#stristr($resultado, 'nome');

		$conn = New Conexao;

	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	   	$row = $busca_resultado->fetch_row();
	   #	echo  "retorno da verificação: ".$row[0];
	   	if ($row[0] > 0) {
	   	    return $this->editarSensor($Sensor, $conn);
	   	} else {
	 	    return -1;
	   	}
	}

	function SensorGetCompativel($itemAtual)
	{

		$resultado = "SELECT I.*
		    FROM item                   				 AS I  
			INNER JOIN sensor_e_compativel       		 AS COM ON COM.ID_Item_FK = I.ID_Item 
			WHERE COM.ID_Sensor_FK = '$itemAtual'";

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
			INNER JOIN item_eum_sensor         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN sensor       					 AS S  ON S.ID_Sensor = EU.ID_Sensor_FK
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
	  	function exibirSensorPorCategoria($nomeUser){

		
			$resultado = "SELECT U.*, I.*, S.*
			FROM usuario                      			 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_eum_sensor         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN sensor 			      			 AS S  ON S.ID_Sensor = EU.ID_Sensor_FK
			WHERE I.categoria = 'sensor' and U.nomeUsuario='$nomeUser'";
	  		

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
			INNER JOIN item_eum_sensor       	  		 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN sensor       					 AS S  ON S.ID_Sensor = EU.ID_Sensor_FK
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
	    
  	function exibirSensor($itemAtual){

  			$conn = New Conexao;

	  		$resultado = "SELECT U.*, CI.*,I.*, EU.*,A.*, MO.*, IG.*
			FROM 	   usuario                      	 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_eum_sensor         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN sensor       					 AS A  ON A.ID_Sensor = EU.ID_Sensor_FK
			INNER JOIN modelo_sensor          			 AS MO ON MO.ID_Sensor_FK = A.ID_Sensor
			INNER JOIN info_gerais_sensor                AS IG ON IG.ID_Modelo_FK = MO.ID_Modelo_Sensor
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
   
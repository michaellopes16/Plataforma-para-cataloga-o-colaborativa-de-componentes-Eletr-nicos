<?php
include_once "Conexao.class.php";
include_once "BateriaVO.class.php";
class BateriaDAO{

   	function inserirBateria($bateria, $conn)
   	{
	 #Informações gerais
	 $img_componente   	    = $bateria->img_componente;
	 $nome         			= $bateria->nome;
	 $modelo				= $bateria->modelo;	
	 $temperaturaOperacao   = $bateria->temperaturaOperacao;
	 $linkDS      			= $bateria->linkDS;
	 $precoMedio   			= $bateria->precoMedio;
	 $dimensao  			= $bateria->dimensao;
	 $tamanho 				= $bateria->tamanho;
	 $peso  				= $bateria->peso;
	 $palavra_chave			= $bateria->palavra_chave;
	 $tipo_carga 			= $bateria->tipo_carga;	
	 $infoGerais 			= $bateria->infoGerais;
	 $tensao_nom 			= $bateria->tensao_nom;	

	 #Informações Elétricas se recaregável
	 $manutencao 			= $bateria->manutencao;
	 $densidade 			= $bateria->densidade;
	 $resistencia_int   	= $bateria->resistencia_int;
	 $ciclo_de_vida   		= $bateria->ciclo_de_vida;
	 $tempo_carga_rapida	= $bateria->tempo_carga_rapida;
	 $tolerancia_sobrecarga = $bateria->tolerancia_sobrecarga;
	 $auto_descarga_mensal  = $bateria->auto_descarga_mensal;
	 $corrente_carga		= $bateria->corrente_carga;
	
	#Informações Elétricas se não recaregável
	 $quimica	   			= $bateria->quimica;
	 $tempo_medio   		= $bateria->tempo_medio;
	 $resistor_descarga 	= $bateria->resistor_descarga;
	 $voltagem_minima		= $bateria->voltagem_minima;
	 
	 $conex = $conn->conexaoBD();
	 
	 $nomeItem = $nome." ". $modelo;
	 
  
   	$resultadoItem = "INSERT INTO `item` (`ID_Item`, `nomeItem`,`categoria`, `palavraChave`, `dimensao`, `precoMedio`, `infoAdicionais`,`linkDataSheet`,`img_componente`) VALUES (NULL, '$nomeItem','bateria', '$palavra_chave', '$dimensao','$precoMedio','$infoGerais','$linkDS','$img_componente')";
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

 	   #insere bateria
 	   $bateriaQuery = "INSERT INTO `bateria` (`ID_Bateria`,`nome`) VALUES (NULL, '$nome')";
 	   $resultadobateria = mysqli_query($conex, $bateriaQuery)or die ("O sistema não foi capaz de executar a query. Tabela bateria". mysqli_error($conex));

 	   #recupera ID_bateria
 	   $id_bateria_query = "SELECT ID_Bateria FROM bateria where nome = '$nome'";
	   $id_bateria = mysqli_query($conex, $id_bateria_query);
	   $id_bateria = $id_bateria->fetch_row();
 	   #insere na tabela item_Eum_bateria
 	   $item_Euma_bateria_query = "INSERT INTO `item_euma_bateria` (`ID_eUma_BT`,`ID_Item_FK`,`ID_Bateria_FK`) VALUES (NULL, '$id_item[0]','$id_bateria[0]')";
 	   $item_Euma_bateria = mysqli_query($conex, $item_Euma_bateria_query) or die ("O sistema não foi capaz de executar a query. Tabela item_euma_bateria". mysqli_error($conex));

 	    #insere na tabela modelo_bateria
 	   $modelo_query = "INSERT INTO `modelo_bateria` (`ID_Modelo_BT`,`ID_bateria_FK`,`tipo`) VALUES (NULL,'$id_bateria[0]','$modelo')";
 	   $modelo_bateria = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a query. Tabela modelo_bateria". mysqli_error($conex));

 	   #buscar ID_Modelo_bateria
	   $id_modelo_query = "SELECT ID_Modelo_BT FROM modelo_bateria where tipo = '$modelo'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) ;
	   $id_modelo =  $id_modelo->fetch_row();

	   if($tipo_carga == "Recarregável")
	   {
 	   
 	   $info_eletricas_r_query = "INSERT INTO `info_eletricas_bateria_r` (`ID_Info_Ele_BR`,`ID_Modelo_FK`,`manutencao`,`densidade`,`resistencia_Int`,`ciclo_de_vida`,`tempo_carga_rapida`,`tolerancia_sobrecarga`,`auto_desc_mensal`,`corrente_carga`) 
 	   	   VALUES (NULL,'$id_modelo[0]','$manutencao ','$densidade','$resistencia_int','$ciclo_de_vida','$tempo_carga_rapida','$tolerancia_sobrecarga','$auto_descarga_mensal','$corrente_carga')";
 	   $info_eletricas = mysqli_query($conex, $info_eletricas_r_query) or die ("O sistema não foi capaz de executar a query. Tabela info_eletricas_bateria_r". mysqli_error($conex));
	   
	   }else{
 	   
 	   $info_eletricas_nr_query = "INSERT INTO `info_eletricas_bateria_nr` (`ID_Info_Ele_BNR`,`ID_Modelo_FK`,`quimica`,`tempo_medio`,`resistor_descarga`,`voltagem_minima`) 
 	   	   VALUES (NULL,'$id_modelo[0]','$quimica ','$tempo_medio','$resistor_descarga','$voltagem_minima')";
 	   $info_eletricas = mysqli_query($conex, $info_eletricas_nr_query) or die ("O sistema não foi capaz de executar a query. Tabela info_eletricas_bateria_nr". mysqli_error($conex));
	   }
 	   
 	   $info_gerais_query = "INSERT INTO `info_gerais_bateria` (`ID_Info_Gerais_BT`,`ID_Modelo_FK`,`tamanho`,`peso`,`temperatura_operacao`,`tipo_carga`,`tensao_nom`) 
 	   	   VALUES (NULL,'$id_modelo[0]','$tamanho','$peso','$temperaturaOperacao','$tipo_carga','$tensao_nom')";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a query. Tabela info_gerais_bateria". mysqli_error($conex));
   	  

 	   #echo "#Valor do ultimo ID Inserido: ". $idItemReturn;
	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadobateria || !$item_Euma_bateria
	   	|| !$modelo_bateria || !$info_eletricas || !$info_gerais)
	   {
		return -2;
	   }else
	   {
		return  $idItemReturn;
	   }

   	}
function editarBateria($bateria, $conn)
   	{
	 #Informações gerais
   	 $ID_item 				= $bateria->ID_Item;	
	 $img_componente   	    = $bateria->img_componente;
	 $nome         			= $bateria->nome;
	 $modelo				= $bateria->modelo;	
	 $temperaturaOperacao   = $bateria->temperaturaOperacao;
	 $linkDS      			= $bateria->linkDS;
	 $precoMedio   			= $bateria->precoMedio;
	 $dimensao  			= $bateria->dimensao;
	 $tamanho 				= $bateria->tamanho;
	 $peso  				= $bateria->peso;
	 $palavra_chave			= $bateria->palavra_chave;
	 $tipo_carga 			= $bateria->tipo_carga;	
	 $infoGerais 			= $bateria->infoGerais;
	 $tensao_nom 			= $bateria->tensao_nom;	

	 #Informações Elétricas se recaregável
	 $manutencao 			= $bateria->manutencao;
	 $densidade 			= $bateria->densidade;
	 $resistencia_int   	= $bateria->resistencia_int;
	 $ciclo_de_vida   		= $bateria->ciclo_de_vida;
	 $tempo_carga_rapida	= $bateria->tempo_carga_rapida;
	 $tolerancia_sobrecarga = $bateria->tolerancia_sobrecarga;
	 $auto_descarga_mensal  = $bateria->auto_descarga_mensal;
	 $corrente_carga		= $bateria->corrente_carga;
	
	#Informações Elétricas se não recaregável
	 $quimica	   			= $bateria->quimica;
	 $tempo_medio   		= $bateria->tempo_medio;
	 $resistor_descarga 	= $bateria->resistor_descarga;
	 $voltagem_minima		= $bateria->voltagem_minima;

	 
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
 	 
 	    #recupera ID_bateria
 	   $id_bateria_query  = "SELECT ID_Bateria_FK FROM item_euma_bateria where `item_euma_bateria`.`ID_Item_FK` = '$ID_item'";
 	   $id_bateria = mysqli_query($conex, $id_bateria_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_eum_bateria -". mysqli_error($conex));
 	   $id_bateria = $id_bateria->fetch_row();
 	   #insere bateria

 	   $bateriaQuery = "UPDATE `bateria` SET `nome` = '$nome' WHERE `bateria`.`ID_Bateria` = '$id_bateria[0]'";
 	   $resultadobateria = mysqli_query($conex, $bateriaQuery)or die ("O sistema não foi capaz de executar a consulta na tabela bateria -". mysqli_error($conex));  


 	    #insere na tabela modelo_bateria
 	   $modelo_query = "UPDATE `modelo_bateria` SET `tipo` = '$modelo' WHERE `modelo_bateria`.`ID_bateria_FK`= '$id_bateria[0]'";
 	   $modelo_bateria = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_bateria -". mysqli_error($conex));

 	   #buscar ID_Modelo_bateria
	   $id_modelo_query = "SELECT ID_Modelo_BT FROM modelo_bateria where `modelo_bateria`.`ID_Bateria_FK` = '$id_bateria[0]'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_bateria Select -". mysqli_error($conex));
	   $id_modelo =  $id_modelo->fetch_row();
      

		if($tipo_carga == "Recarregável")
	   {
 	   
 	   $info_eletricas_r_query = 
 	   	"UPDATE `info_eletricas_bateria_r` 
 	   	SET	`manutencao`='$manutencao',`densidade`='$densidade',`resistencia_Int`='$resistencia_int'
 	   	,`ciclo_de_vida`='$ciclo_de_vida',`tempo_carga_rapida`='$tempo_carga_rapida'
 	   	,`tolerancia_sobrecarga`='$tolerancia_sobrecarga',`auto_desc_mensal`='$auto_descarga_mensal'
 	   	,`corrente_carga`='$corrente_carga' 
 	   	WHERE `ID_Modelo_FK`='$id_modelo[0]'";

 	   $info_eletricas = mysqli_query($conex, $info_eletricas_r_query) or die ("O sistema não foi capaz de executar a query. Tabela info_eletricas_bateria_r". mysqli_error($conex));
	   
	   }else{
 	   
 	   $info_eletricas_nr_query = "UPDATE `info_eletricas_bateria_nr`
 	   	SET `quimica`='$quimica',`tempo_medio`='$tempo_medio',`resistor_descarga`='$resistor_descarga',`voltagem_minima`='$voltagem_minima'
 	   	   WHERE `ID_Modelo_FK`='$id_modelo[0]'";
 	   $info_eletricas = mysqli_query($conex, $info_eletricas_nr_query) or die ("O sistema não foi capaz de executar a query. Tabela info_eletricas_bateria_nr". mysqli_error($conex));
	   }
 	   
 	   $info_gerais_query = "UPDATE `info_gerais_bateria` set `tamanho`='$tamanho',`peso`='$peso',`temperatura_operacao`='$temperaturaOperacao',`tipo_carga`='$tipo_carga',`tensao_nom`='$tensao_nom' 
 	   	   WHERE `ID_Modelo_FK`='$id_modelo[0]'";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a query. Tabela info_gerais_bateria". mysqli_error($conex));

	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadobateria || !$modelo_bateria || !$info_eletricas || !$info_gerais)
	   {
		return 2;
	   }else
	   {
		return  $ID_item ;
	   }

   	}   	
function excluirBateria($bateriaID)
   	{

   	 $ID_item 				= $bateriaID;	
	 $conn = New Conexao;
	 $conex = $conn->conexaoBD();

 	   $resultadoItem = "DELETE FROM `item` WHERE `item`.`ID_Item` = '$ID_item'";
	   $msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query na tabela item - ". mysqli_error($conex));

	   $idItemReturn = $ID_item;

	   $nomeUsuario = $_SESSION["nomeUser"];

	   $id_user_query = "SELECT ID_usuario FROM usuario where nomeUsuario = '$nomeUsuario'";
	   $id_user = mysqli_query($conex, $id_user_query)  or die ("O sistema não foi capaz de executar a consulta na tabela usuario");
	   $id_user = $id_user->fetch_row();

	   #$id_item_query = "SELECT ID_Item FROM item where nomeItem = '$nomeItem'";
	   #$id_item = mysqli_query($conex, $id_item_query);
	   #$id_item = $id_item->fetch_row();

	   $cadastroItemQuery = "DELETE FROM `cadastro_item` WHERE `cadastro_item`.`ID_Item_FK` = '$ID_item'";
 	   $resultadoCadastroItem = mysqli_query($conex, $cadastroItemQuery)   or die ("O sistema não foi capaz de executar a consulta na tabela cadastro_item -". mysqli_error($conex));
 	  
 	   #or die ("O sistema não foi capaz de executar a query cadastro_item");
 	  	#echo "ID Item: ". $ID_item;
 	    #recupera ID_bateria
 	   $id_bateria_query  = "SELECT ID_Bateria_FK FROM item_euma_bateria where `item_euma_bateria`.`ID_Item_FK` = '$ID_item'";
 	   $id_bateria = mysqli_query($conex, $id_bateria_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_eum_bateria -". mysqli_error($conex));
 	   $id_bateria = $id_bateria->fetch_row();

 	   $item_euma_query = "DELETE FROM `item_euma_bateria` WHERE `item_euma_bateria`.`ID_Item_FK` = '$ID_item'";
 	   $item_euma = mysqli_query($conex, $item_euma_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_euma_bateria -". mysqli_error($conex));
 	   #insere bateria

 	   $bateriaQuery = "DELETE FROM `bateria` WHERE `bateria`.`ID_Bateria` = '$id_bateria[0]'";
 	   $resultadobateria = mysqli_query($conex, $bateriaQuery)or die ("O sistema não foi capaz de executar a consulta na tabela bateria -". mysqli_error($conex));  

 	   #buscar ID_Modelo_bateria
	   $id_modelo_query = "SELECT ID_Modelo_BT FROM modelo_bateria where `modelo_bateria`.`ID_Bateria_FK` = '$id_bateria[0]'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_bateria Select -". mysqli_error($conex));
	   $id_modelo =  $id_modelo->fetch_row();

	   	$tipo_bt_query = "SELECT tipo FROM modelo_bateria where `modelo_bateria`.`ID_Bateria_FK` = '$id_bateria[0]'";
	   $tipo_bt = mysqli_query($conex, $tipo_bt_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_bateria Select -". mysqli_error($conex));
	   $tipo_bt =  $tipo_bt->fetch_row();

 	    #papaga na tabela modelo_bateria
 	   $modelo_query = "DELETE FROM `modelo_bateria` WHERE `modelo_bateria`.`ID_Bateria_FK`= '$id_bateria[0]'";
 	   $modelo_bateria = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_bateria -". mysqli_error($conex));

 	  if($tipo_bt[0]=="Recarregável"){
 	   $info_eletricas_query = "DELETE FROM `info_eletricas_bateria_r` WHERE `info_eletricas_bateria_r`.`ID_Modelo_FK`= '$id_modelo[0]' ";
 	   $info_eletricas = mysqli_query($conex, $info_eletricas_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_eletricas_bateria_r -". mysqli_error($conex));
	  }else
	  {
	   $info_eletricas_query = "DELETE FROM `info_eletricas_bateria_nr` WHERE `info_eletricas_bateria_nr`.`ID_Modelo_FK`= '$id_modelo[0]' ";
 	   $info_eletricas = mysqli_query($conex, $info_eletricas_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_eletricas_bateria_nr -". mysqli_error($conex));
	  }

 	   $info_gerais_query = "DELETE FROM `info_gerais_bateria` WHERE `info_gerais_bateria`.`ID_Modelo_FK` = '$id_modelo[0]' ";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_gerais_bateria -". mysqli_error($conex));

	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadobateria || !$modelo_bateria || !$info_eletricas || !$info_gerais)
	   {
		return 2;
	   }else
	   {
		return  $ID_item ;
	   }

   	}   	
	function verificarExistenciaBateria($bateria){

		$nome = $bateria->nome." ".$bateria->modelo;
		
		$resultado = "SELECT COUNT(*) FROM item where nomeItem LIKE '%$nome%'";
		#stristr($resultado, 'nome');

		$conn = New Conexao;

	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	   	$row = $busca_resultado->fetch_row();
	   	if ($row[0] > 0) {
	   	    return -1;
	   	} else {
	 	    return $this->inserirBateria($bateria, $conn);
	   	}
	}

	function verificarExistenciaBateriaByID($bateria){


		$resultado = "SELECT COUNT(*) FROM item WHERE item.ID_Item ='$bateria->ID_Item'";
		#stristr($resultado, 'nome');

		$conn = New Conexao;

	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	   	$row = $busca_resultado->fetch_row();
	   #	echo  "retorno da verificação: ".$row[0];
	   	if ($row[0] > 0) {
	   	    return $this->editarbateria($bateria, $conn);
	   	} else {
	 	    return 1;
	   	}
	}
	  	function exibirItem($itemAtual){

		
			$resultado = "SELECT I.*, EU.*,M.*
			FROM item                   				 AS I  
			INNER JOIN item_eum_bateria         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN bateria       			 AS M  ON M.ID_bateria = EU.ID_bateria_FK
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
	  	function exibirBateriaPorCategoria($nomeUser){

		
			$resultado = "SELECT U.*, I.*, B.*
			FROM usuario                      			 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_euma_bateria         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN bateria 			      			 AS B  ON B.ID_Bateria = EU.ID_bateria_FK
			WHERE I.categoria = 'bateria' and U.nomeUsuario='$nomeUser'";
	  		

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

		
			$resultado = "SELECT I.*, EU.*,M.*
			FROM item                   				 AS I  
			INNER JOIN item_euma_bateria         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN bateria       			 AS M  ON M.ID_bateria = EU.ID_bateria_FK
			WHERE I.ID_Item = '$itemAtual'";
	  		
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
	    
  	function exibirBateria($itemAtual){

  			$conn = New Conexao;

  			$rultTipoBateria = "SELECT MO.tipo
			FROM 	   usuario                      	 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_euma_bateria         		 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN bateria       					 AS B  ON B.ID_bateria = EU.ID_Bateria_FK
			INNER JOIN modelo_bateria          			 AS MO ON MO.ID_bateria_FK = B.ID_Bateria
			WHERE I.ID_Item = '$itemAtual'
			";

			$buscaResultTipo = mysqli_query($conn->{'conexaoBD'}(), $rultTipoBateria);
			$rowTipo = $buscaResultTipo->fetch_array(MYSQLI_BOTH);
			#echo "Resultado da busca por tipo:".$rowTipo['tipo'] ;

			if($rowTipo['tipo'] == "Recarregável"){
			#echo "ID de comparação: ".$itemAtual."</br>";
			$resultado = "SELECT U.*, CI.*,I.*, EU.*,B.*, MO.*, IG.*, IER.*
			FROM 	   usuario                      	 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_euma_bateria         		 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN bateria       					 AS B  ON B.ID_bateria = EU.ID_Bateria_FK
			INNER JOIN modelo_bateria          			 AS MO ON MO.ID_bateria_FK = B.ID_Bateria
			INNER JOIN info_gerais_bateria     			 AS IG ON IG.ID_Modelo_FK = MO.ID_Modelo_BT
			INNER JOIN info_eletricas_bateria_r		     AS IER ON IER.ID_Modelo_FK = MO.ID_Modelo_BT
			WHERE I.ID_Item = '$itemAtual'";

	  		}else{
	  		
	  		$resultado = "SELECT U.*, CI.*,I.*, EU.*,B.*, MO.*, IG.*, IENR.*
			FROM 	   usuario                      	 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_euma_bateria         		 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN bateria       					 AS B  ON B.ID_bateria = EU.ID_Bateria_FK
			INNER JOIN modelo_bateria          			 AS MO ON MO.ID_bateria_FK = B.ID_Bateria
			INNER JOIN info_gerais_bateria     			 AS IG ON IG.ID_Modelo_FK = MO.ID_Modelo_BT
			INNER JOIN info_eletricas_bateria_nr   		 AS IENR ON IENR.ID_Modelo_FK = MO.ID_Modelo_BT
			WHERE I.ID_Item = '$itemAtual'";
	  		}
	  		

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
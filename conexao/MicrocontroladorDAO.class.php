<?php
include_once "Conexao.class.php";
include_once "UsuarioVO.class.php";
class MicrocontroladorDAO{
	function inserirFavorito($idItem,$Usuario,$idProjeto)
	{
	  $conn = New Conexao;
	  $conex = $conn->{'conexaoBD'}();
	  $id_user_query = "SELECT ID_usuario FROM usuario where nomeUsuario = '$Usuario'";
	  $id_user = mysqli_query($conex, $id_user_query);
	  $id_user = $id_user->fetch_row();
	  echo "ID User".$id_user[0];

	  if($idItem != null){	
	   	$resultadoItem = "INSERT INTO `itens_favoritos` (`ID_Favoritos`, `ID_Usuario_FK`,`ID_Item_FK`) VALUES (NULL, '$id_user[0]','$idItem')";
		$msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query. Tabela itens_favoritos: ". mysqli_error($conex));
	  }else if($idProjeto != null)
	  {
		$resultadoItem = "INSERT INTO `projetos_favoritos` (`ID_Favoritos`, `ID_Usuario_FK`,`ID_Projeto_FK`) VALUES (NULL, '$id_user[0]','$idProjeto')";
		$msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query. Tabela itens_favoritos: ". mysqli_error($conex));

	  }
	   if(!$msg_resultadoItem)
	   {
	   	return -2;
	   }else
	   {
	   	return  0;
	   }
	}
	function exibirFavoritoPorUsuario($nomeUser){

	  		
	  		$resultado = "SELECT U.*, I.*, IFA.*
			FROM usuario                      			AS U 
			INNER JOIN itens_favoritos  		AS IFA ON IFA.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   		AS I  ON I.ID_Item = IFA.ID_Item_FK 
			WHERE U.nomeUsuario='$nomeUser'";
	  	  		
	  	  		#echo "Consulta SQL: ".$resultado;

	  	  		$conn = New Conexao;

	  	  	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	  	  	   	#$row = $busca_resultado->fetch_row();
	  	  	   	/* associative array */
	  	  	   	#$row = $busca_resultado->fetch_array(MYSQLI_ASSOC);

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
	function verificarExistenciaFavorito($idItem,$idUser,$idProjeto)
	{
	  $conn = New Conexao;
	  $conex = $conn->{'conexaoBD'}();
	 
	  
	  if($idItem != null){	
	   	$resultadoItem = "SELECT COUNT(*) FROM `itens_favoritos` WHERE `ID_Item_FK`= '$idItem' and `ID_Usuario_FK`='$idUser'";
		$msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query. Tabela itens_favoritos: ". mysqli_error($conex));
	  }else if($idProjeto != null)
	  {
		$resultadoItem = "SELECT COUNT(*) FROM `projetos_favoritos` WHERE `ID_Projeto_FK` = '$idProjeto' and `ID_Usuario_FK`='$idUser'";
		$msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query. Tabela projetos_favoritos: ". mysqli_error($conex));
	  }
	  	
	   
	   	$row = $msg_resultadoItem->fetch_row();
	   #	echo  "retorno da verificação: ".$row[0];
	   	echo "Retorno na verificação: ".$row[0];
	   	if ($row[0] > 0) {
	   		echo "De novo...".$row[0];
	   	    return -1;
	   }else
	   {
	   	return  $this->inserirFavorito($idItem,$idUser,$idProjeto);
	   }
	}
	function exibirFavoritos($idUser,$tipo)
	{
	  $conex = $conn->conexaoBD();
	  
	  if($tipo != "item"){	
	   	$resultadoItem = "SELECT * FROM `itens_favoritos` WHERE `ID_Item_FK` = '$idItem'";
		$msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query. Tabela itens_favoritos: ". mysqli_error($conex));
	  }else if($idProjeto != null)
	  {
		$resultadoItem = "SELECT * FROM `projetos_favoritos` WHERE `ID_Projeto_FK` = '$idItem'";
		$msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query. Tabela projetos_favoritos: ". mysqli_error($conex));
	  }
	   if(!$msg_resultadoItem)
	   {
	   	return -2;
	   }else
	   {
	   	return  $msg_resultadoItem;
	   }
	}
	function excluirFavorito($idItem,$tipo)
	{
	   $conn = New Conexao;
	  $conex = $conn->{'conexaoBD'}();;
	  $msg_resultadoItem ='';
	  if($tipo == 1){	
	   	$resultadoItem = "DELETE FROM `itens_favoritos` WHERE `ID_Item_FK` = '$idItem'";
		$msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query. Tabela itens_favoritos: ". mysqli_error($conex));
	  }else if($tipo == 2)
	  {
		$resultadoItem = "DELETE FROM `projetos_favoritos` WHERE `ID_Projeto_FK`='$idItem'";
		$msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query. Tabela itens_favoritos: ". mysqli_error($conex));
	  }
	   if(!$msg_resultadoItem)
	   {
	   	return -2;
	   }else
	   {
	   	return  -1;
	   }
	}
   	
   	function inserirMicro($micro, $conn)
   	{
	 #Informações gerais
	 $img_componente   	    = $micro->img_componente;
	 $nome         			= $micro->nome;
	 $modelo				= $micro->modelo;
	
	 $img_legenda   		= $micro->img_legenda;
	 $temperaturaOperacao   = $micro->temperaturaOperacao;
	 $palavra_chave 		= $micro->palavra_chave;
	 $plataformaDesenv  	= $micro->plataformaDesenv;
	 $linguagemUtilizada 	= $micro->linguagemUtilizada;
	
	 $linkDS      			= $micro->linkDS;
	 $precoMedio   			= $micro->precoMedio;
	 $dimensao  			= $micro->dimensao;

	 #Informações Técnicas

	 $processador 			= $micro->processador;
	 $memoriaRAM 			= $micro->memoriaRAM;
	 $memoriaFLASH   	    = $micro->memoriaFLASH;
	 $microcontrolador   	= $micro->microcontrolador;
	 $velo_clock			= $micro->velo_clock;
	 $GPIO_Ana  	   		= $micro->GPIO_Ana;
	 $GPIO_Dig   			= $micro->GPIO_Dig;
	 
	 #Informações Elétricas
	 $tensaoOperacao		= $micro->tensaoOperacao;
	 $tensaoEntrada	   		= $micro->tensaoEntrada;
	 $modoConsumo  			= $micro->modoConsumo;

	 #Interfaces de comunicação
	 $semFio   				= $micro->semFio;
	 $serial 				= $micro->serial;
	
	 #Componentes Adicionais
	 $enterEntrada			= $micro->enterEntrada;
	 $sensores   			= $micro->sensores;
	 $infoGerais 			= $micro->infoGerais;

	 
	 $conex = $conn->conexaoBD();
	 
	 $nomeItem = $nome." ". $modelo;
	 
  
   	$resultadoItem = "INSERT INTO `item` (`ID_Item`, `nomeItem`,`categoria`, `palavraChave`, `dimensao`, `precoMedio`, `infoAdicionais`,`linkDataSheet`,`img_componente`) VALUES (NULL, '$nomeItem','microcontrolador', '$palavra_chave', '$dimensao','$precoMedio','$infoGerais','$linkDS','$img_componente')";
	   $msg_resultadoItem = mysqli_query($conex, $resultadoItem)  or die ("O sistema não foi capaz de executar a query. Tabela item: ". mysqli_error($conex));
	   $idItemReturn = mysqli_insert_id($conex);

	   $nomeUsuario = $_SESSION["nomeUser"];

	   $id_user_query = "SELECT ID_usuario FROM usuario where nomeUsuario = '$nomeUsuario'";
	   $id_user = mysqli_query($conex, $id_user_query);
	   $id_user = $id_user->fetch_row();

	   $id_item_query = "SELECT ID_Item FROM item where nomeItem = '$nomeItem'";
	   $id_item = mysqli_query($conex, $id_item_query);
	   $id_item = $id_item->fetch_row();

	   echo "ID Usuario atual:".$id_user[0];

	   $cadastroItemQuery = "INSERT INTO `cadastro_item` (`ID_Cadastro`, `ID_Usuario_FK`, `ID_Item_FK`, `dataCadastro`) VALUES (NULL, '$id_user[0]', '$id_item[0]', NOW())";
 	   $resultadoCadastroItem = mysqli_query($conex, $cadastroItemQuery) or die ("O sistema não foi capaz de executar a query. Tabela cadastro_item". mysqli_error($conex)); 
 	  
 	   #or die ("O sistema não foi capaz de executar a query cadastro_item");

 	   #insere microcontrolador
 	   $microQuery = "INSERT INTO `microcontrolador` (`ID_Microcontrolador`,`tipo`) VALUES (NULL, '$nome')";
 	   $resultadoMicro = mysqli_query($conex, $microQuery)or die ("O sistema não foi capaz de executar a query. Tabela microcontrolador". mysqli_error($conex));

 	   #recupera ID_Microcontrolador
 	   $id_micro_query = "SELECT ID_Microcontrolador FROM microcontrolador where tipo = '$nome'";
	   $id_micro = mysqli_query($conex, $id_micro_query);
	   $id_micro = $id_micro->fetch_row();
 	   #insere na tabela item_Eum_micro
 	   $item_Eum_micro_query = "INSERT INTO `item_eum_micro` (`ID_eUm`,`ID_Item_FK`,`ID_Micro_FK`) VALUES (NULL, '$id_item[0]','$id_micro[0]')";
 	   $item_Eum_micro = mysqli_query($conex, $item_Eum_micro_query) or die ("O sistema não foi capaz de executar a query. Tabela item_eum_micro". mysqli_error($conex));

 	    #insere na tabela modelo_micro
 	   $modelo_query = "INSERT INTO `modelo_micro` (`ID_Modelo_Micro`,`ID_Microcontrolador_FK`,`nome`) VALUES (NULL,'$id_micro[0]','$modelo')";
 	   $modelo_micro = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a query. Tabela modelo_micro". mysqli_error($conex));

 	   #buscar ID_Modelo_Micro
	   $id_modelo_query = "SELECT ID_Modelo_Micro FROM modelo_micro where nome = '$modelo'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) ;
	   $id_modelo =  $id_modelo->fetch_row();

	  # echo "ID_item: ".$id_item[0] ." id_user: ".$id_user[0]. " ID_modelo: ".$id_modelo[0];
	   $ie = '';
 	   for ($i=0; $i < count($enterEntrada); $i++ ) {
 	   		$ie = $ie.",".$enterEntrada[$i];
 	   }
 	   $sen = '';
 	   for ($i=0; $i < count($sensores); $i++ ) {
 	   		$sen = $sen.",".$sensores[$i];
 	   }
      
 	   #insere na tabela info_componentes_adicionais_micro
 	   $info_adicionais_query = "INSERT INTO `info_componentes_adicionais_micro` (`ID_Infor_Compo_adicionais`,`ID_Modelo_FK`,`interface_entrada`,`sensores`) 
 	   	   VALUES (NULL,'$id_modelo[0]','$ie','$sen')";
 	   $info_adicionais = mysqli_query($conex, $info_adicionais_query) or die ("O sistema não foi capaz de executar a query. Tabela info_componentes_adicionais_micro". mysqli_error($conex));

 	   #insere na tabela info_tecnicas_micro
 	   $info_tecnicas_query = "INSERT INTO `info_tecnicas_micro` (`ID_Infor_Tecnicas`,`ID_Modelo_FK`,`memoria_ram`,`memoria_flash`,`processador`,`microcontrolador`,`tempo_de_clock`,`GPIO_A`,`GPIO_D`) 
 	   	   VALUES (NULL,'$id_modelo[0]','$memoriaRAM ','$memoriaFLASH','$processador','$microcontrolador','$velo_clock','$GPIO_Ana','$GPIO_Dig')";
 	   $info_tecnicas = mysqli_query($conex, $info_tecnicas_query) or die ("O sistema não foi capaz de executar a query. Tabela info_tecnicas_micro". mysqli_error($conex));


 	   $info_eletricas_query = "INSERT INTO `info_eletricas_micro` (`ID_Infor_Eletricas`,`ID_Modelo_FK`,`modo_consumo`,`tensao_operacao`,`tensao_entrada`) 
 	   	   VALUES (NULL,'$id_modelo[0]','$tensaoOperacao ','$tensaoEntrada','$modoConsumo')";
 	   $info_eletricas = mysqli_query($conex, $info_eletricas_query) or die ("O sistema não foi capaz de executar a query. Tabela info_eletricas_micro". mysqli_error($conex));

 	   $linguagensUtilizadas = '';
 	   for ($i=0; $i < count($linguagemUtilizada); $i++ ) {
 	   		$linguagensUtilizadas = $linguagensUtilizadas.",".$linguagemUtilizada[$i];
 	   }
   
   	   $plataformaD = '';
   	  
 	   for ($i=0; $i < count($plataformaDesenv); $i++ ) {
 	   		$plataformaD = $plataformaD.",".$plataformaDesenv[$i];
 	   }

 	   $info_gerais_query = "INSERT INTO `info_gerais_micro` (`ID_Infor_Gerais`,`ID_Modelo_FK`,`temperatura_operacao`,`linguagem_de_prograrmacao`,`plataforma_de_desenvolvimento`,`palavra_chave`,`img_legenda`) 
 	   	   VALUES (NULL,'$id_modelo[0]','$temperaturaOperacao','$linguagensUtilizadas','$plataformaD','$palavra_chave','$img_legenda')";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a query. Tabela info_gerais_micro". mysqli_error($conex));
   	   
   	   $semF = '';
   	  
 	   for ($i=0; $i < count($semFio); $i++ ) {
 	   		$semF = $semF.",".$semFio[$i];
 	   }
 	   $ser= '';
   	  
 	   for ($i=0; $i < count($serial); $i++ ) {
 	   		$ser = $ser.",".$serial[$i];
 	   }
 	   #insere na tabela modelo
 	   $info_comuni_query = "INSERT INTO `info_comunicacao_micro` (`ID_Infor_Comunicacao`,`ID_Modelo_FK`,`sem_fio`,`serial_`) 
 	   	   VALUES (NULL,'$id_modelo[0]','$semF','$ser')";
 	   $conex = $conn->conexaoBD();
 	   $info_comuni = mysqli_query($conex, $info_comuni_query) or die ("O sistema não foi capaz de executar a query. Tabela info_comunicacao_micro". mysqli_error($conex));

 	   #echo "#Valor do ultimo ID Inserido: ". $idItemReturn;
	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoMicro || !$item_Eum_micro
	   	|| !$modelo_micro || !$info_adicionais || !$info_tecnicas || !$info_eletricas || !$info_gerais || !$info_comuni)
	   {
		return -2;
	   }else
	   {
		return  $idItemReturn;
	   }

   	}
function editarMicro($micro, $conn)
   	{
	 #Informações gerais
   	 $ID_item 				= $micro->ID_Item;	
	 $img_componente   	    = $micro->img_componente;
	 $nome         			= $micro->nome;
	 $modelo				= $micro->modelo;
	
	 $img_legenda   		= $micro->img_legenda;
	 $temperaturaOperacao   = $micro->temperaturaOperacao;
	 $palavra_chave 		= $micro->palavra_chave;
	 $plataformaDesenv  	= $micro->plataformaDesenv;
	 $linguagemUtilizada 	= $micro->linguagemUtilizada;
	
	 $linkDS      			= $micro->linkDS;
	 $precoMedio   			= $micro->precoMedio;
	 $dimensao  			= $micro->dimensao;

	 #Informações Técnicas

	 $processador 			= $micro->processador;
	 $memoriaRAM 			= $micro->memoriaRAM;
	 $memoriaFLASH   	    = $micro->memoriaFLASH;
	 $microcontrolador   	= $micro->microcontrolador;
	 $velo_clock			= $micro->velo_clock;
	 $GPIO_Ana  	   		= $micro->GPIO_Ana;
	 $GPIO_Dig   			= $micro->GPIO_Dig;
	 
	 #Informações Elétricas
	 $tensaoOperacao		= $micro->tensaoOperacao;
	 $tensaoEntrada	   		= $micro->tensaoEntrada;
	 $modoConsumo  			= $micro->modoConsumo;

	 #Interfaces de comunicação
	 $semFio   				= $micro->semFio;
	 $serial 				= $micro->serial;
	
	 #Componentes Adicionais
	 $enterEntrada			= $micro->enterEntrada;
	 $sensores   			= $micro->sensores;
	 $infoGerais 			= $micro->infoGerais;

	 
	 $conex = $conn->conexaoBD();
	 
	 $nomeItem = $nome." ". $modelo;
	 
	#echo "</br><b>Endereco img:</b> ".$img_componente." - ".isset($img_componente) ." - ".empty($img_componente)  ;
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

	   #$id_item_query = "SELECT ID_Item FROM item where nomeItem = '$nomeItem'";
	   #$id_item = mysqli_query($conex, $id_item_query);
	   #$id_item = $id_item->fetch_row();

	   $cadastroItemQuery = "UPDATE `cadastro_item` SET `dataCadastro` = NOW() WHERE `cadastro_item`.`ID_Item_FK` = '$ID_item'";
 	   $resultadoCadastroItem = mysqli_query($conex, $cadastroItemQuery)   or die ("O sistema não foi capaz de executar a consulta na tabela cadastro_item -". mysqli_error($conex));
 	  
 	   #or die ("O sistema não foi capaz de executar a query cadastro_item");
 	  	#echo "ID Item: ". $ID_item;
 	    #recupera ID_Microcontrolador
 	   $id_micro_query  = "SELECT ID_Micro_FK FROM item_eum_micro where `item_eum_micro`.`ID_Item_FK` = '$ID_item'";
 	   $id_micro = mysqli_query($conex, $id_micro_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_eum_micro -". mysqli_error($conex));
 	   $id_micro = $id_micro->fetch_row();
 	   #insere microcontrolador
 	  # echo "Consulta: ".$id_micro_query;
 	  #echo "ID Micro: ".$id_micro[0];


 	   $microQuery = "UPDATE `microcontrolador` SET `tipo` = '$nome' WHERE `microcontrolador`.`ID_Microcontrolador` = '$id_micro[0]'";
 	   $resultadoMicro = mysqli_query($conex, $microQuery)or die ("O sistema não foi capaz de executar a consulta na tabela microcontrolador -". mysqli_error($conex));  


 	    #insere na tabela modelo_micro
 	   $modelo_query = "UPDATE `modelo_micro` SET `nome` = '$modelo' WHERE `modelo_micro`.`ID_Microcontrolador_FK`= '$id_micro[0]'";
 	   $modelo_micro = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_micro -". mysqli_error($conex));

 	   #buscar ID_Modelo_Micro
	   $id_modelo_query = "SELECT ID_Modelo_Micro FROM modelo_micro where `modelo_micro`.`ID_Microcontrolador_FK` = '$id_micro[0]'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_micro Select -". mysqli_error($conex));
	   $id_modelo =  $id_modelo->fetch_row();

	  # echo "ID_item: ".$id_item[0] ." id_user: ".$id_user[0]. " ID_modelo: ".$id_modelo[0];
	   $ie = '';
 	   for ($i=0; $i < count($enterEntrada); $i++ ) {
 	   		$ie = $ie.",".$enterEntrada[$i];
 	   }
 	   $sen = '';
 	   for ($i=0; $i < count($sensores); $i++ ) {
 	   		$sen = $sen.",".$sensores[$i];
 	   }
      
 	   #insere na tabela info_componentes_adicionais_micro
 	   $info_adicionais_query = "UPDATE `info_componentes_adicionais_micro` SET `interface_entrada`='$ie',`sensores`='$sen' WHERE `info_componentes_adicionais_micro`.`ID_Modelo_FK` = '$id_modelo[0]'";
 	   $info_adicionais = mysqli_query($conex, $info_adicionais_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_componentes_adicionais_micro -". mysqli_error($conex));

 	   #insere na tabela info_tecnicas_micro
 	   $info_tecnicas_query = "UPDATE `info_tecnicas_micro` SET `memoria_ram` = '$memoriaRAM' ,`memoria_flash`='$memoriaFLASH',`processador`='$processador',`microcontrolador`='$microcontrolador',`tempo_de_clock`='$velo_clock',`GPIO_A`='$GPIO_Ana',`GPIO_D`='$GPIO_Dig' WHERE `info_tecnicas_micro`.`ID_Modelo_FK` = '$id_modelo[0]'";
 	   $info_tecnicas = mysqli_query($conex, $info_tecnicas_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_tecnicas_micro -". mysqli_error($conex));


 	   $info_eletricas_query = "UPDATE `info_eletricas_micro` SET `modo_consumo`='$modoConsumo',`tensao_operacao` ='$tensaoOperacao ',`tensao_entrada`='$tensaoEntrada' WHERE `info_eletricas_micro`.`ID_Modelo_FK`= '$id_modelo[0]' ";
 	   $info_eletricas = mysqli_query($conex, $info_eletricas_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_eletricas_micro -". mysqli_error($conex));

 	   $linguagensUtilizadas = '';
 	   for ($i=0; $i < count($linguagemUtilizada); $i++ ) {
 	   		$linguagensUtilizadas = $linguagensUtilizadas.",".$linguagemUtilizada[$i];
 	   }
   
   	   $plataformaD = '';
   	  
 	   for ($i=0; $i < count($plataformaDesenv); $i++ ) {
 	   		$plataformaD = $plataformaD.",".$plataformaDesenv[$i];
 	   }

 	   if(empty($img_legenda)){
 		$info_gerais_query = "UPDATE `info_gerais_micro` SET `temperatura_operacao`='$temperaturaOperacao',`linguagem_de_prograrmacao`='$linguagensUtilizadas',`plataforma_de_desenvolvimento`='$plataformaD',`palavra_chave`='$palavra_chave' WHERE `info_gerais_micro`.`ID_Modelo_FK` = $id_modelo[0] ";
 	   }else{
 	   $info_gerais_query = "UPDATE `info_gerais_micro` SET `temperatura_operacao`='$temperaturaOperacao',`linguagem_de_prograrmacao`='$linguagensUtilizadas',`plataforma_de_desenvolvimento`='$plataformaD',`palavra_chave`='$palavra_chave',`img_legenda`='$img_legenda' WHERE `info_gerais_micro`.`ID_Modelo_FK` = $id_modelo[0] ";
 	   }
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_gerais_micro -". mysqli_error($conex));
   	   
   	   $semF = '';
   	  
 	   for ($i=0; $i < count($semFio); $i++ ) {
 	   		$semF = $semF.",".$semFio[$i];
 	   }
 	   $ser= '';
   	  
 	   for ($i=0; $i < count($serial); $i++ ) {
 	   		$ser = $ser.",".$serial[$i];
 	   }
 	   #insere na tabela modelo
 	   $info_comuni_query = "UPDATE `info_comunicacao_micro` SET `sem_fio`='$semF',`serial_`='$ser' WHERE `info_comunicacao_micro`.ID_Modelo_FK = '$id_modelo[0]' ";
 	   $conex = $conn->conexaoBD();
 	   $info_comuni = mysqli_query($conex, $info_comuni_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_comunicacao_micro -". mysqli_error($conex));

 	  # echo "#Valor do ultimo ID Atualidado: ". $ID_item ;
	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoMicro || !$modelo_micro || !$info_adicionais || !$info_tecnicas || !$info_eletricas || !$info_gerais || !$info_comuni)
	   {
		return 2;
	   }else
	   {
		return  $ID_item ;
	   }

   	}   	
function excluirMicro($microID)
   	{

   	 $ID_item 				= $microID;	
	 
	 
	 $conn = New Conexao;
	 $conex = $conn->conexaoBD();
	# $nomeItem = $nome." ". $modelo;
	 #echo "ID pra exlusão:". $ID_item ;
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
 	    #recupera ID_Microcontrolador
 	   $id_micro_query  = "SELECT ID_Micro_FK FROM item_eum_micro where `item_eum_micro`.`ID_Item_FK` = '$ID_item'";
 	   $id_micro = mysqli_query($conex, $id_micro_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_eum_micro -". mysqli_error($conex));
 	   $id_micro = $id_micro->fetch_row();

 	   $tem_umMicro_query  = "DELETE FROM item_eum_micro where `item_eum_micro`.`ID_Item_FK` = '$ID_item'";
 	   $tem_umMicro = mysqli_query($conex, $tem_umMicro_query) or die ("O sistema não foi capaz de executar a consulta na tabela item_eum_micro -". mysqli_error($conex));
 	   $tem_umMicro = $tem_umMicro->fetch_row();
 	   #insere microcontrolador
 	  # echo "Consulta: ".$id_micro_query;
 	  #echo "ID Micro: ".$id_micro[0];


 	   $microQuery = "DELETE FROM `microcontrolador` WHERE `microcontrolador`.`ID_Microcontrolador` = '$id_micro[0]'";
 	   $resultadoMicro = mysqli_query($conex, $microQuery)or die ("O sistema não foi capaz de executar a consulta na tabela microcontrolador -". mysqli_error($conex));  

	   #buscar ID_Modelo_Micro
	   $id_modelo_query = "SELECT ID_Modelo_Micro FROM modelo_micro where `modelo_micro`.`ID_Microcontrolador_FK` = '$id_micro[0]'";
	   $id_modelo = mysqli_query($conex, $id_modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_micro Select -". mysqli_error($conex));
	   $id_modelo =  $id_modelo->fetch_row();

 	    #insere na tabela modelo_micro
 	   $modelo_query = "DELETE FROM `modelo_micro` WHERE `modelo_micro`.`ID_Microcontrolador_FK`= '$id_micro[0]'";
 	   $modelo_micro = mysqli_query($conex, $modelo_query) or die ("O sistema não foi capaz de executar a consulta na tabela modelo_micro -". mysqli_error($conex));

 	   #insere na tabela info_componentes_adicionais_micro
 	   $info_adicionais_query = "DELETE FROM `info_componentes_adicionais_micro` WHERE `info_componentes_adicionais_micro`.`ID_Modelo_FK` = '$id_modelo[0]'";
 	   $info_adicionais = mysqli_query($conex, $info_adicionais_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_componentes_adicionais_micro -". mysqli_error($conex));

 	   $info_tecnicas_query = "DELETE FROM `info_tecnicas_micro` WHERE `info_tecnicas_micro`.`ID_Modelo_FK` = '$id_modelo[0]'";
 	   $info_tecnicas = mysqli_query($conex, $info_tecnicas_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_tecnicas_micro -". mysqli_error($conex));


 	   $info_eletricas_query = "DELETE FROM `info_eletricas_micro` WHERE `info_eletricas_micro`.`ID_Modelo_FK`= '$id_modelo[0]' ";
 	   $info_eletricas = mysqli_query($conex, $info_eletricas_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_eletricas_micro -". mysqli_error($conex));


 	   $info_gerais_query = "DELETE FROM `info_gerais_micro` WHERE `info_gerais_micro`.`ID_Modelo_FK` = '$id_modelo[0]' ";
 	   $info_gerais = mysqli_query($conex, $info_gerais_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_gerais_micro -". mysqli_error($conex));
   	   

 	   $info_comuni_query = "DELETE FROM `info_comunicacao_micro` WHERE `info_comunicacao_micro`.ID_Modelo_FK = '$id_modelo[0]' ";
 	   $conex = $conn->conexaoBD();
 	   $info_comuni = mysqli_query($conex, $info_comuni_query) or die ("O sistema não foi capaz de executar a consulta na tabela info_comunicacao_micro -". mysqli_error($conex));

 	  # echo "#Valor do ultimo ID Atualidado: ". $ID_item ;
	   if(!$msg_resultadoItem || !$resultadoCadastroItem || !$resultadoMicro || !$modelo_micro || !$info_adicionais || !$info_tecnicas || !$info_eletricas || !$info_gerais || !$info_comuni)
	   {
		return 2;
	   }else
	   {
		return  $ID_item ;
	   }

   	}   	
	function verificarExistenciaMicro($micro){

		$nome = $micro->nome." ".$micro->modelo;
		
		$resultado = "SELECT COUNT(*) FROM item where nomeItem LIKE '%$nome%'";
		#stristr($resultado, 'nome');

		$conn = New Conexao;

	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	   	$row = $busca_resultado->fetch_row();
	   #	echo  "retorno da verificação: ".$row[0];
	   	if ($row[0] > 0) {
	   	    return -1;
	   	} else {
	 	    return $this->inserirMicro($micro, $conn);
	   	}
	}

	function verificarExistenciaMicroByID($micro){

		#echo "ID item na verificação: ".$micro->ID_Item;
		
		$resultado = "SELECT COUNT(*) FROM item WHERE item.ID_Item ='$micro->ID_Item'";
		#stristr($resultado, 'nome');

		$conn = New Conexao;

	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	   	$row = $busca_resultado->fetch_row();
	   #	echo  "retorno da verificação: ".$row[0];
	   	if ($row[0] > 0) {
	   	    return $this->editarMicro($micro, $conn);
	   	} else {
	 	    return 1;
	   	}
	}
	function exibirItemPorID($itemAtual){
	
			$resultado = "SELECT * FROM item WHERE item.ID_Item = '$itemAtual'";
	  		
	  		#echo "Consulta SQL: ".$resultado;

	  		$conn = New Conexao;

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
	  	function exibirItem($itemAtual){

	  		$buscaArray = explode(' ', $itemAtual);
	  		#print_r($buscaArray);
	  		$resultado ='';
	  		$conn = New Conexao;
	  		$cont = 0;
	  		foreach ($buscaArray as $key) {
	  			if($key != ''){
	  				if($cont >= 1)
		  			{
		  				$resultado .= " union ";
		  			}
	  				$resultado .= "SELECT * FROM item WHERE nomeItem LIKE '%$key%'";
	  			}
	  			else{
	  			    if($cont == 0)
	  				{
	  					$resultado .= "SELECT * FROM item WHERE nomeItem LIKE '%$key%'";	
	  				}
	  			}
	  			$cont ++;
	  		}
	  		#echo "Consulta:". $resultado;
	  	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);


	  	   	#$row = $busca_resultado->fetch_row();
	  	   	/* associative array */
	  	   	#$row = $busca_resultado->fetch_array(MYSQLI_ASSOC);
	  	   #	echo $row[0];

	  	   	if (!empty($busca_resultado)) {
	  	   	    return $busca_resultado;
	  	   	   
	  	   	} else {
	  	 	    return 0;
	  	   	}
	  	}
	  	 function exibirItemPorPalavraChave($itemAtual){

	  	  	$buscaArray = explode(' ', $itemAtual);
	  		#print_r($buscaArray);
	  		$resultado ='';
	  		$conn = New Conexao;
	  		$cont = 0;
	  		foreach ($buscaArray as $key) {
	  			if($key != ''){
	  				if($cont >= 1)
		  			{
		  				$resultado .= " union ";
		  			}
	  				$resultado .= "SELECT * FROM item WHERE palavraChave LIKE '%$key%'";
	  			}else
	  			{
	  				if($cont == 0)
	  				{
	  					$resultado .= "SELECT * FROM item WHERE palavraChave LIKE '%$key%'";	
	  				}
	  			}
	  			$cont ++;
	  		}
	  			#echo "resultado: ". $resultado;
	  	  	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	  	  	   	#$row = $busca_resultado->fetch_row();
	  	  	   	/* associative array */
	  	  	   	#$row = $busca_resultado->fetch_array(MYSQLI_ASSOC);
	  	  	   #	echo $row[0];

	  	  	   	if (!empty($busca_resultado)) {
	  	  	   	    return $busca_resultado;
	  	  	   	   
	  	  	   	} else {
	  	  	 	    return 0;
	  	  	   	}
	  	  	}
	  	function exibirMicroPorCategoria($nomeUser){

		
			$resultado = "SELECT U.*, I.*, M.*
			FROM usuario                      			 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_eum_micro         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN microcontrolador       			 AS M  ON M.ID_Microcontrolador = EU.ID_Micro_FK
			WHERE I.categoria = 'Microcontrolador' and U.nomeUsuario='$nomeUser'";
	  		
	  		#echo "Consulta SQL: ".$resultado;

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

			$resultado = "SELECT * FROM item 
			 	 		  WHERE 
			   	 		  nomeItem LIKE '%$itemAtual%' and categoria = 'microcontrolador' ";
	  		$conn = New Conexao;

	  	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	  	   	#$row = $busca_resultado->fetch_row();
	  	   	/* associative array */
	  	   	if (!empty($busca_resultado)) {
	  	   	    #echo "IF 1: ".$row[0]['nomeItem'];
	  	   	    return $busca_resultado;
	  	   	   
	  	   	} else {
	  	   		#echo 0;
	  	   		#echo "IF 2: ".$row[0]['nomeItem'];
	  	 	    return 0;
	  	   	}
	  	}
	  	function getItenPorCategoria($itemAtual, $categoria){

			$resultado = "SELECT * FROM item 
			 	 		  WHERE 
			   	 		  nomeItem LIKE '%$itemAtual%' and categoria = '$categoria' ";
	  		$conn = New Conexao;

	  	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	  	   	#$row = $busca_resultado->fetch_row();
	  	   	/* associative array */
	  	   	if (!empty($busca_resultado)) {
	  	   	    #echo "IF 1: ".$row[0]['nomeItem'];
	  	   	    return $busca_resultado;
	  	   	   
	  	   	} else {
	  	   		#echo 0;
	  	   		#echo "IF 2: ".$row[0]['nomeItem'];
	  	 	    return 0;
	  	   	}
	  	}  	
	    
  	function exibirMicro($itemAtual){

			#echo "ID de comparação: ".$itemAtual."</br>";
			$resultado = "SELECT U.*, CI.*,I.*, EU.*,M.*, MO.*, IG.*,IT.*, IE.*, IC.*,IA.*
			FROM usuario                      			 AS U 
			INNER JOIN cadastro_item          			 AS CI ON CI.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN item                   			 AS I  ON I.ID_Item = CI.ID_Item_FK 
			INNER JOIN item_eum_micro         			 AS EU ON EU.ID_Item_FK = I.ID_Item
			INNER JOIN microcontrolador       			 AS M  ON M.ID_Microcontrolador = EU.ID_Micro_FK
			INNER JOIN modelo_micro          			 AS MO ON MO.ID_Microcontrolador_FK = M.ID_Microcontrolador
			INNER JOIN info_gerais_micro     			 AS IG ON IG.ID_Modelo_FK = MO.ID_Modelo_Micro
			INNER JOIN info_tecnicas_micro    			 AS IT ON IT.ID_Modelo_FK = MO.ID_Modelo_Micro
			INNER JOIN info_eletricas_micro   			 AS IE ON IE.ID_Modelo_FK = MO.ID_Modelo_Micro
			INNER JOIN info_comunicacao_micro 			 AS IC ON IC.ID_Modelo_FK = MO.ID_Modelo_Micro
			INNER JOIN info_componentes_adicionais_micro AS IA on IA.ID_Modelo_FK = MO.ID_Modelo_Micro
			WHERE I.ID_Item = '$itemAtual'";
	  		
	  		$conn = New Conexao;

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
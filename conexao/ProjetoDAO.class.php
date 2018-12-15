<?php
include_once "Conexao.class.php";
include_once "ProjetoVO.class.php";


class ProjetoDAO{

   	function inserirProjeto($Projeto, $conn)
   	{
	 
	 #Informações gerais item
	 $nome         			= $Projeto->nome;
	 $palavra_chave			= $Projeto->palavra_chave;
	 $img_projeto   	    = $Projeto->img_projeto;
	 $link_repo      		= $Projeto->link_repo;
	 $link_site 			= $Projeto->link_site;
	 $link_video 			= $Projeto->link_video;
	 $metodologia   		= $Projeto->metodologia;
	 $tem_item				= $Projeto->tem_item;	
	 $autor_principal       = $Projeto->autor_principal;
	 $email_autor_principal = $Projeto->email_autor_principal;
	 $nome_demais_autores   = $Projeto->nome_demais_autores;
	 $email_demais_autores  = $Projeto->email_demais_autores;
	 

	 $conex = $conn->conexaoBD();

	   $nomeUsuario = $_SESSION["nomeUser"];

	   $id_user_query = "SELECT ID_usuario FROM usuario where nomeUsuario = '$nomeUsuario'";
	   $id_user = mysqli_query($conex, $id_user_query);
	   $id_user = $id_user->fetch_row();
 	  
 	   #or die ("O sistema não foi capaz de executar a query cadastro_item");

 	   #insere Projeto
 	   $ProjetoQuery = 
 	   	"INSERT INTO `projeto` 
 	   	(`ID_Projeto`,`nome`,`autor_principal`,`email_autor_principal`,`nome_demais_autores`,`email_demais_autores`,`img_projeto`,`link_repo`,`link_site`,`link_video`,`palavra_chave`,`metodologia`)
 	   	 VALUES 
 	   	 (NULL, '$nome','$autor_principal','$email_autor_principal','$nome_demais_autores','$email_demais_autores','$img_projeto','$link_repo','$link_site','$link_video','$palavra_chave','$metodologia')";
 	   $resultadoProjeto = mysqli_query($conex, $ProjetoQuery)or die ("O sistema não foi capaz de executar a query. Tabela Projeto". mysqli_error($conex));
 	   $idItemReturn = mysqli_insert_id($conex);

 	   #recupera projeto
 	   $id_Projeto_query = "SELECT ID_Projeto FROM projeto where nome = '$nome'";
	   $id_Projeto = mysqli_query($conex, $id_Projeto_query);
	   $id_Projeto = $id_Projeto->fetch_row();
 	   #insere na tabela item_Eum_Projeto

 	   $projeto_tem_usuario_query = "INSERT INTO `projeto_tem_usuario` (`ID_PTU`,`ID_Projeto_FK`,`ID_Usuario_FK`,`data_insercao`) VALUES (NULL,'$id_Projeto[0]','$id_user[0]',NOW())";
	   $projeto_tem_usuario =  mysqli_query($conex, $projeto_tem_usuario_query) or die ("O sistema não foi capaz de executar a query. Tabela projeto_tem_usuario". mysqli_error($conex));

 	   foreach($tem_item as $list):
	#   echo "ID do componente compativel:".$list;
	   $e_compativel_query = "INSERT INTO `projeto_tem_item` (`ID_Tem_I`,`ID_Item_FK`,`ID_Projeto_FK`) VALUES (NULL,'$list','$id_Projeto[0]')";
	   $e_compativel =  mysqli_query($conex, $e_compativel_query) or die ("O sistema não foi capaz de executar a query. Tabela Projeto_e_compativel". mysqli_error($conex));
	   
	   endforeach;	  

 	   #echo "#Valor do ultimo ID Inserido: ". $idItemReturn;
	   if(!$id_user || !$resultadoProjeto || !$id_Projeto || !$e_compativel || !$projeto_tem_usuario)
	   {
		return -2;
	   }else
	   {
	   	echo "ID PRojeto inserido:".$id_Projeto[0];
		return  $idItemReturn;
	   }

   	}

function editarProjeto($Projeto, $conn)
   	{
	 #Informações gerais
   	 	 #Informações gerais item
   	 $ID_Projeto			= $Projeto->ID_Projeto;
	 $nome         			= $Projeto->nome;
	 $palavra_chave			= $Projeto->palavra_chave;
	 $img_projeto   	    = $Projeto->img_projeto;
	 $link_repo      		= $Projeto->link_repo;
	 $link_site 			= $Projeto->link_site;
	 $link_video 			= $Projeto->link_video;
	 $metodologia   		= $Projeto->metodologia;
	 $tem_item				= $Projeto->tem_item;	
	 $autor_principal       = $Projeto->autor_principal;
	 $email_autor_principal = $Projeto->email_autor_principal;
	 $nome_demais_autores   = $Projeto->nome_demais_autores;
	 $email_demais_autores  = $Projeto->email_demais_autores;
	 	 
	 
	 $conex = $conn->conexaoBD();

  	if(empty($img_projeto)){

 		$resultadoProjeto_query = "UPDATE `projeto` 
 		SET `nome` = '$nome',`autor_principal` = '$autor_principal', `email_autor_principal` = '$email_autor_principal', `nome_demais_autores`='$nome_demais_autores', `email_demais_autores`= '$email_demais_autores',`img_projeto`='$img_projeto',`link_repo`='$link_repo', `link_site`='$link_site',`link_video`='$link_video',`palavra_chave`='$palavra_chave',`metodologia`='$metodologia'
 		 WHERE `projeto`.`ID_Projeto` = '$ID_Projeto'";
   	  
   	}else{
 		$resultadoProjeto_query = "UPDATE `projeto` 
 		SET `nome` = '$nome',`autor_principal` = '$autor_principal', `email_autor_principal` = '$email_autor_principal', `nome_demais_autores`='$nome_demais_autores', `email_demais_autores`= '$email_demais_autores',`link_repo`='$link_repo', `link_site`='$link_site',`link_video`='$link_video ',`palavra_chave`='$palavra_chave',`metodologia`='$metodologia'
 		 WHERE `projeto`.`ID_Projeto` = '$ID_Projeto'";

   	}

   	$resultadoProjeto = mysqli_query($conex, $resultadoProjeto_query)or die ("O sistema não foi capaz de executar a query. Tabela Projeto". mysqli_error($conex));
	
	  	   $nomeUsuario = $_SESSION["nomeUser"];

	  	   $id_user_query = "SELECT ID_usuario FROM usuario where nomeUsuario = '$nomeUsuario'";
	  	   $id_user = mysqli_query($conex, $id_user_query);
	  	   $id_user = $id_user->fetch_row();
	   	   #insere na tabela item_Eum_Projeto

	   	   $projeto_tem_usuario_query = "UPDATE `projeto_tem_usuario` SET `ID_Usuario_FK`='$id_user[0]',`data_insercao`=NOW() WHERE `projeto_tem_usuario`.`ID_Projeto_FK`='$ID_Projeto'";
	  	   $projeto_tem_usuario =  mysqli_query($conex, $projeto_tem_usuario_query) or die ("O sistema não foi capaz de executar a query. Tabela projeto_tem_usuario". mysqli_error($conex));

	  	   $dele_com_query = "DELETE FROM `projeto_tem_item` WHERE `projeto_tem_item`.`ID_Projeto_FK` = '$ID_Projeto'";
	  	   $dele_com = mysqli_query($conex, $dele_com_query) or die ("O sistema não foi capaz de executar a query. Tabela projeto_tem_item". mysqli_error($conex));

	   	   foreach($tem_item as $list):
	  	#   echo "ID do componente compativel:".$list;
	  	   $e_compativel_query = "INSERT INTO `projeto_tem_item` (`ID_Tem_I`,`ID_Item_FK`,`ID_Projeto_FK`) VALUES (NULL,'$list','$ID_Projeto')";
	  	   $e_compativel =  mysqli_query($conex, $e_compativel_query) or die ("O sistema não foi capaz de executar a query. Tabela Projeto_e_compativel". mysqli_error($conex));
	  	   
	  	   endforeach;	

	   if(!$resultadoProjeto || !$projeto_tem_usuario || !$dele_com || !$e_compativel)
	   {
		return -2;
	   }else
	   {
		return  $ID_Projeto ;
	   }

   	}   	
function excluirProjeto($ProjetoID)
   	{

   	 $ID_Projeto			= $ProjetoID;	
	 $conn = New Conexao;
	 $conex = $conn->conexaoBD();


	 $comentarios_projeto_query = "DELETE FROM `comentarios_projetos` WHERE `comentarios_projetos`.`ID_Projeto_FK`= '$ID_Projeto'";
	 $comentarios_projeto = mysqli_query($conex, $comentarios_projeto_query) or die ("O sistema não foi capaz de executar a consulta na tabela comentarios_projeto -". mysqli_error($conex));

 	 $ProjetoQuery = "DELETE FROM `Projeto` WHERE `Projeto`.`ID_Projeto` = '$ID_Projeto'";
 	 $resultadoProjeto = mysqli_query($conex, $ProjetoQuery)or die ("O sistema não foi capaz de executar a consulta na tabela Projeto -". mysqli_error($conex)); 

	 $projeto_tem_usuarioQuery = "DELETE FROM `projeto_tem_usuario` WHERE `projeto_tem_usuario`.`ID_Projeto_FK` = '$ID_Projeto'";
 	 $projeto_tem_usuario = mysqli_query($conex, $projeto_tem_usuarioQuery)   or die ("O sistema não foi capaz de executar a consulta na tabela projeto_tem_usuario -". mysqli_error($conex));

 	    #papaga na tabela modelo_Projeto
 	 $projeto_tem_item_query = "DELETE FROM `projeto_tem_item` WHERE `projeto_tem_item`.`ID_Projeto_FK`= '$ID_Projeto'";
 	 $projeto_tem_item = mysqli_query($conex, $projeto_tem_item_query) or die ("O sistema não foi capaz de executar a consulta na tabela projeto_tem_item -". mysqli_error($conex));

	   if(!$resultadoProjeto || !$projeto_tem_usuario || !$projeto_tem_item || !$comentarios_projeto)
	   {
		return -2;
	   }else
	   {
		return  $ID_Projeto ;
	   }

   	}   	
	function verificarExistenciaProjeto($Projeto){

		$nome = $Projeto->nome;
		#echo "Nome antes da verificação:".$nome;
		$resultado = "SELECT COUNT(*) FROM projeto where nome LIKE '%$nome%'";
		#stristr($resultado, 'nome');

		$conn = New Conexao;

	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	   	$row = $busca_resultado->fetch_row();

	   	#echo "retorno:".$row[0];
	   	if ($row[0] > 0) {
	   	    return -1;
	   	} else {
	 	    return $this->inserirProjeto($Projeto, $conn);
	   	}
	}

	function verificarExistenciaProjetoByID($Projeto){

		echo "ID do Projeto: ".$Projeto->ID_Projeto;
		$resultado = "SELECT COUNT(*) FROM projeto WHERE projeto.ID_Projeto ='$Projeto->ID_Projeto'";
		#stristr($resultado, 'nome');

		$conn = New Conexao;

	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	   	$row = $busca_resultado->fetch_row();
	   #	echo  "retorno da verificação: ".$row[0];
	   	if ($row[0] > 0) {
	   	    return $this->editarProjeto($Projeto, $conn);
	   	} else {
	 	    return -1;
	   	}
	}

	function ProjetoGetCompativel($itemAtual)
	{

		$resultado = "SELECT I.*
		    FROM item                   				 AS I  
			INNER JOIN projeto_tem_item      			 AS PTI ON PTI.ID_Item_FK = I.ID_Item 
			WHERE PTI.ID_Projeto_FK = '$itemAtual'";

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
	function listarProjetoPorPalavraChave($itemAtual){

			$resultado = "SELECT * FROM  projeto     
			WHERE palavra_chave LIKE '%$itemAtual%'";
			
			$conn = New Conexao;
			$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado) or die("Erro ao executar query na tabela projeto");

	  	   	#$row = $busca_resultado->fetch_row();
	  	   	/* associative array */
	  	   #	$row = $busca_resultado->fetch_array(MYSQLI_BOTH);
	  	   	#echo "<br>Quantidade de linhas retornadas.".count($row[0]);
	  	   #echo "<br>No listar projetos".$row['nome'];
	  	   	if (!empty($busca_resultado)) {
	  	   	    return $busca_resultado;
	  	   	   
	  	   	} else {
	  	 	    return 0;
	  	   	}
	}

	function listarProjeto($itemAtual){

			$resultado = "SELECT * FROM  projeto     
			WHERE nome LIKE '%$itemAtual%'";
			
			$conn = New Conexao;
			$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado) or die("Erro ao executar query na tabela projeto");

	  	   	#$row = $busca_resultado->fetch_row();
	  	   	/* associative array */
	  	   #	$row = $busca_resultado->fetch_array(MYSQLI_BOTH);
	  	   	#echo "<br>Quantidade de linhas retornadas.".count($row[0]);
	  	   #echo "<br>No listar projetos".$row['nome'];
	  	   	if (!empty($busca_resultado)) {
	  	   	    return $busca_resultado;
	  	   	   
	  	   	} else {
	  	 	    return 0;
	  	   	}
	  	}
	  	  	function exibirProjetoFavoritosPorUsuario($nomeUser){
		
	  			$resultado = "SELECT U.*, I.*, PFA.* 
	  				FROM usuario AS U 
	  				INNER JOIN projetos_favoritos AS PFA ON PFA.ID_Usuario_FK = U.ID_Usuario 
	  				INNER JOIN projeto AS I ON I.ID_Projeto = PFA.ID_Projeto_FK 
	  				WHERE U.nomeUsuario='$nomeUser'";
	  	  		

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
	  	function exibirProjetoPorUsuario($nomeUser){

		
			$resultado = "SELECT U.*, P.*, PTU.*
			FROM usuario                      			AS U 
			INNER JOIN projeto_tem_usuario       		AS PTU ON PTU.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN Projeto                   		AS P  ON P.ID_Projeto = PTU.ID_Projeto_FK 
			WHERE U.nomeUsuario='$nomeUser'";
	  		

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

	  	function getItensGeral($itemAtual){

		$resultado = "SELECT * FROM item 
			 	 		  WHERE 
			   	 		  nomeItem LIKE '%$itemAtual%'";
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
	    
  	function exibirProjeto($itemAtual){

  			$conn = New Conexao;

	  		$resultado = "SELECT U.*, PTU.*,P.*
			FROM 	   usuario                      	 AS U 
			INNER JOIN projeto_tem_usuario       		 AS PTU ON PTU.ID_Usuario_FK = U.ID_Usuario 
			INNER JOIN projeto   			      		 AS P ON P.ID_Projeto = PTU.ID_Projeto_FK
			WHERE P.ID_Projeto = '$itemAtual'";
	   		

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
  	function excluirComentario($ID_Comentario)
  	  	{			
  	  			$conn = New Conexao;
  	  			$conex = $conn->conexaoBD();
  				
  				$resultado = "DELETE
  	  						 FROM comentarios_projetos 
  	  						 where ID_Comentarios = '$ID_Comentario'
  	  						 ";
  	  			
  				#echo "Passando pelo buscar comentario";
  	  			$busca_resultado = mysqli_query($conex, $resultado);
  	  			  			  	   	#$row = $busca_resultado->fetch_row();
  	  			  	   	/* associative array */
  	  			if (!$busca_resultado) {
  	  			  	return -2;
  	  			} else {
  	  			  
  	  			  return  1;
  	  	  	   	}
  	}
  	function buscarComentario($id_Projeto)
  	{			
  			$conn = New Conexao;
  			$conex = $conn->conexaoBD();
			
			$resultado = "SELECT C.*,U.*
  						 FROM comentarios_projetos as C 
  						 INNER JOIN usuario AS U ON U.ID_Usuario = C.ID_Usuario_FK	
  						 where C.ID_Projeto_FK = '$id_Projeto'
  						 order by C.dataComentario desc
  						 ";
  			
			#echo "Passando pelo buscar comentario";
  			$busca_resultado = mysqli_query($conex, $resultado);
  			  			  	   	#$row = $busca_resultado->fetch_row();
  			  	   	/* associative array */
  			if (!empty($busca_resultado)) {
  			  	return $busca_resultado;
  			} else {
  			  return 0;
  	  	   	}
  	}
  	function buscarProjetosRelacionados($ID_Item)
  	  	{			
  	  			$conn = New Conexao;
  	  			$conex = $conn->conexaoBD();
  				
  			$resultado = "SELECT P.*, PI.ID_Item_FK, AVG(AV.avaliacao) as mediaAvaliacao 
				FROM projeto as P 
			    INNER JOIN avaliacao_projeto as AV on AV.ID_Projeto_FK = P.ID_Projeto 
				INNER JOIN projeto_tem_item as PI on PI.ID_Projeto_FK = P.ID_Projeto
				WHERE PI.ID_Item_FK = '$ID_Item' 
				group by P.ID_Projeto 
				ORDER by mediaAvaliacao DESC
				limit 3";
  	  			
  				#echo "Passando pelo buscar comentario";
  	  			$busca_resultado = mysqli_query($conex, $resultado);
  	  			  			  	   	#$row = $busca_resultado->fetch_row();
  	  			  	   	/* associative array */
  	  			if (!empty($busca_resultado)) {
  	  			  	return $busca_resultado;
  	  			} else {
  	  			  return 0;
  	  	  	   	}
  	  	}


	function atualizarComentario($comentario,$ID_Comentario, $ID_Usuario, $ID_Projeto)
	{
		$conn = New Conexao;
		$conex = $conn->conexaoBD();


  		$comentario_query = "UPDATE `comentarios_projetos` SET `dataComentario`=NOW(),`descricao`='$comentario'
  			WHERE `ID_Comentarios` = '$ID_Comentario'	
  		";
  		$comentario =  mysqli_query($conex, $comentario_query) or die ("O sistema não foi capaz de executar a query. Tabela comentarios_projetos". mysqli_error($conex));
		
		if($comentario)
  		{
  		
  		  $resultado = "SELECT C.*,U.*
  						 FROM comentarios_projetos as C 
  						 INNER JOIN usuario AS U ON U.ID_Usuario = C.ID_Usuario_FK	
  						 where C.ID_Projeto_FK = '$ID_Projeto'
  						 order by C.dataComentario desc
  						 ";
  			

  			$busca_resultado = mysqli_query($conex, $resultado);

  			  	   	#$row = $busca_resultado->fetch_row();
  			  	   	/* associative array */
  			if (!empty($busca_resultado)) {
  			  	return $busca_resultado;
  			} else {
  			  return 0;
  	  	   	}

  		}else
  		{
  			return -1;
  		}


	}
  	function inserirComentario($comentario, $id_User, $id_Projeto)
  	{
		$conn = New Conexao;
		$conex = $conn->conexaoBD();
  		
  		$comentario_query = "INSERT INTO `comentarios_projetos` (`ID_Comentarios`,`ID_Projeto_FK`,`ID_Usuario_FK`,`dataComentario`,`descricao`) VALUES (NULL,'$id_Projeto','$id_User',NOW(),'$comentario')";
  		$comentario =  mysqli_query($conex, $comentario_query) or die ("O sistema não foi capaz de executar a query. Tabela comentarios_projetos". mysqli_error($conex));

  		#echo "Tá inserindo o comantário...";
  		if($comentario)
  		{
  		
  			$resultado = "SELECT C.*,U.*
  						 FROM comentarios_projetos as C 
  						 INNER JOIN usuario AS U ON U.ID_Usuario = C.ID_Usuario_FK	
  						 where C.ID_Projeto_FK = '$id_Projeto'
						 order by C.dataComentario desc
  						 ";
  			

  			$busca_resultado = mysqli_query($conex, $resultado);

  			  	   	#$row = $busca_resultado->fetch_row();
  			  	   	/* associative array */
  			if (!empty($busca_resultado)) {
  			  	return $busca_resultado;
  			} else {
  			  return 0;
  	  	   	}

  		}else
  		{
  			return -1;
  		}
  	}

  	  	function inserirAvaliacao($avaliacao, $ID_Usuario, $ID_Projeto)
  	  	{
  			$conn = New Conexao;
  			$conex = $conn->conexaoBD();
  			$return = -2;
  	  		
  			$verificar_query = " SELECT COUNT(*) FROM `avaliacao_projeto` WHERE `ID_Usuario_FK`= '$ID_Usuario' and `ID_Projeto_FK`= '$ID_Projeto'
  				";
  			$verificar =  mysqli_query($conex, $verificar_query) or die ("O sistema não foi capaz de executar a verificação. Tabela avaliacao_projeto". mysqli_error($conex));
  			$jaExiste = $verificar->fetch_row();	

  			if($jaExiste[0]>0)
  			{
				$return = $this->atualizarAvaliacao($avaliacao, $ID_Usuario, $ID_Projeto);
  			}
  			else
  			{
  	  		$avaliacao_query = "INSERT INTO `avaliacao_projeto` (`ID_Avaliacao`,`ID_Projeto_FK`,`ID_Usuario_FK`,`dataComentario`,`avaliacao`) VALUES (NULL,'$ID_Projeto','$ID_Usuario',NOW(),'$avaliacao')";
  	  		$avaliacao =  mysqli_query($conex, $avaliacao_query) or die ("O sistema não foi capaz de executar a inserção. Tabela avaliacao_projeto". mysqli_error($conex));
  	  		$busca_resultado = mysqli_query($conex, $avaliacao);

  	  			if (!$busca_resultado) {
  	  			  	$return  = -3;
  	  			} else {
  	  			  $return -2;
  	  	  	   	}
			}

			return $return;
		  	   	#$row = $busca_resultado->fetch_row();
  	  			  	   	/* associative array */
  	  			
  	  	}
  	  	  	function atualizarAvaliacao($avaliacao, $ID_Usuario, $ID_Projeto)
  	  	  	{
  	  			$conn = New Conexao;
  	  			$conex = $conn->conexaoBD();
  	  	  		
  	  	  		$avaliacao_query = "UPDATE `avaliacao_projeto` SET `dataComentario`=NOW(), `avaliacao` = '$avaliacao' WHERE `ID_Projeto_FK`='$ID_Projeto' and `ID_Usuario_FK`='$ID_Usuario'";

  	  	  		$avaliacao =  mysqli_query($conex, $avaliacao_query) or die ("O sistema não foi capaz de executar a Atuazação! Tabela avaliacao_projeto". mysqli_error($conex));

  	  	  			$busca_resultado = mysqli_query($conex, $avaliacao);

  	  	  			  	   	#$row = $busca_resultado->fetch_row();
  	  	  			  	   	/* associative array */
  	  	  			if (!$busca_resultado) {
  	  	  			  	return -1;
  	  	  			} else {
  	  	  			  return -2;
  	  	  	  	   	}
  	  	  	}
}

?>
   
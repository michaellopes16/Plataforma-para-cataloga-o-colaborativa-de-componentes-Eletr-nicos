<?php
include_once("UsuarioVO.class.php");
include_once("UsuarioDAO.class.php");
include_once("MicrocontroladorDAO.class.php");
include_once("MicrocontroladorVO.class.php");
include_once("BateriaDAO.class.php");
include_once("BateriaVO.class.php");
include_once("ShieldDAO.class.php");
include_once("ShieldVO.class.php");
include_once("AtuadorDAO.class.php");
include_once("AtuadorVO.class.php");
include_once("SensorDAO.class.php");
include_once("SensorVO.class.php");
include_once("ProjetoDAO.class.php");
include_once("ProjetoVO.class.php");

class Fachada{

	function inserirUsuario($usuario){

		$cadastro = new UsuarioDAO();
		return $cadastro->verificarNomeUsuario($usuario);
	#$cadastro ->{'verificarUsuario'}();
	}
	function getIdUsuario($usuario){

		$cadastro = new UsuarioDAO();
		return $cadastro->getIdUsuario($usuario);
	#$cadastro ->{'verificarUsuario'}();
	}
	
	function logarUsuario($usuario){

	  $logar = new UsuarioDAO();
	  return $logar->verificarUsuario($usuario);
	#$cadastro ->{'verificarUsuario'}();
	}

	function inserirMicrocontrolador($micro){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->verificarExistenciaMicro($micro);
	#$cadastro ->{'verificarUsuario'}();
	}

	function atualizarMicrocontrolador($micro){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->verificarExistenciaMicroByID($micro);
	#$cadastro ->{'verificarUsuario'}();
	}
	function excluirMicrocontrolador($micro){
	#echo " ta entrando na exlcusão: ". $micro."</br>";
	$resultado = new MicrocontroladorDAO();
	return $resultado->excluirMicro($micro);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirMicrocontrolador($idItem){
	
	$resultado = new MicrocontroladorDAO();
	$retorno = $resultado->exibirMicro($idItem);
	#echo "Retorno na fachada: ".$retorno['img_componente'];
	return $retorno;
	#$cadastro ->{'verificarUsuario'}();
	}
	function getItenPorCategoria($itemAtual, $categoria)
	{
		$resultado = new MicrocontroladorDAO();
		return $resultado->getItenPorCategoria($itemAtual, $categoria);

	}
	function exibirItemPorID($itemAutal){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->exibirItemPorID($itemAutal);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirItem($itemAutal){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->exibirItem($itemAutal);
	#$cadastro ->{'verificarUsuario'}();
	}
	function exibirItemPorPalavraChave($itemAutal){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->exibirItemPorPalavraChave($itemAutal);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirMicroPorCategoria($nomeUser){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->exibirMicroPorCategoria($nomeUser);
	#$cadastro ->{'verificarUsuario'}();
	}
	function getItens($nomeUser){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->getItens($nomeUser);
	#$cadastro ->{'verificarUsuario'}();
	}

#====================== Parte relacionada a Bateria ========================================#

	function inserirBateria($bateria){
	
	$resultado = new BateriaDAO();
	return $resultado->verificarExistenciaBateria($bateria);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirBateria($idItem){
	
	$resultado = new BateriaDAO();
	$retorno = $resultado->exibirBateria($idItem);
	#echo "Retorno na fachada: ".$retorno['img_componente'];
	return $retorno;
	#$cadastro ->{'verificarUsuario'}();
	}
	function atualizarBateria($bateria){
	
	$resultado = new BateriaDAO();
	return $resultado->verificarExistenciaBateriaByID($bateria);
	#$cadastro ->{'verificarUsuario'}();
	}
	function excluirBateria($bateria){
	#echo " ta entrando na exlcusão: ". $bateria."</br>";
	$resultado = new BateriaDAO();
	return $resultado->excluirBateria($bateria);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirBateriaPorCategoria($nomeUser){
	
	$resultado = new BateriaDAO();
	return $resultado->exibirBateriaPorCategoria($nomeUser);
	#$cadastro ->{'verificarUsuario'}();
	}

#====================== Parte relacionada ao Shield  ========================================#

	function inserirShield($Shield){
	
	$resultado = new ShieldDAO();
	return $resultado->verificarExistenciaShield($Shield);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirShield($idItem){
	#echo " Retorno na fachada: antes: ". $idItem."</br>";
	$resultado = new ShieldDAO();
	$retorno = $resultado->exibirShield($idItem);
	#echo " Retorno na fachada:: ". $resultado['nomeItem']."</br>";
	#echo "Retorno na fachada: ".$retorno['img_componente'];
	return $retorno;
	#$cadastro ->{'verificarUsuario'}();
	}
	function atualizarShield($bateria){
	
	$resultado = new ShieldDAO();
	return $resultado->verificarExistenciaShieldByID($bateria);
	#$cadastro ->{'verificarUsuario'}();
	}
	function excluirShield($Shield){

	$resultado = new ShieldDAO();
	
	return $resultado->excluirShield($Shield);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirShieldPorCategoria($nomeUser){
	
	$resultado = new ShieldDAO();
	return $resultado->exibirShieldPorCategoria($nomeUser);
	#$cadastro ->{'verificarUsuario'}();
	}

	function shieldGetCompativel($ID_Shield){
	$resultado = new ShieldDAO();
	
	return $resultado->shieldGetCompativel($ID_Shield);
	}
#====================== Parte relacionada ao Atuador  ==================#	
	function inserirAtuador($Atuador){
	
	$resultado = new AtuadorDAO();
	return $resultado->verificarExistenciaAtuador($Atuador);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirAtuador($idItem){
	#echo " Retorno na fachada: antes: ". $idItem."</br>";
	$resultado = new AtuadorDAO();
	$retorno = $resultado->exibirAtuador($idItem);
	#echo " Retorno na fachada:: ". $resultado['nomeItem']."</br>";
	#echo "Retorno na fachada: ".$retorno['img_componente'];
	return $retorno;
	#$cadastro ->{'verificarUsuario'}();
	}
	function atualizarAtuador($bateria){
	
	$resultado = new AtuadorDAO();
	return $resultado->verificarExistenciaAtuadorByID($bateria);
	#$cadastro ->{'verificarUsuario'}();
	}
	function excluirAtuador($Atuador){

	$resultado = new AtuadorDAO();
	
	return $resultado->excluirAtuador($Atuador);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirAtuadorPorCategoria($nomeUser){
	
	$resultado = new AtuadorDAO();
	return $resultado->exibirAtuadorPorCategoria($nomeUser);
	#$cadastro ->{'verificarUsuario'}();
	}

	function AtuadorGetCompativel($ID_Atuador){
	$resultado = new AtuadorDAO();
	
	return $resultado->atuadorGetCompativel($ID_Atuador);
	}

	#====================== Parte relacionada ao Sensor  ==================#	
	function inserirSensor($Sensor){
	
	$resultado = new SensorDAO();
	return $resultado->verificarExistenciaSensor($Sensor);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirSensor($idItem){
	#echo " Retorno na fachada: antes: ". $idItem."</br>";
	$resultado = new SensorDAO();
	$retorno = $resultado->exibirSensor($idItem);
	#echo " Retorno na fachada:: ". $resultado['nomeItem']."</br>";
	#echo "Retorno na fachada: ".$retorno['img_componente'];
	return $retorno;
	#$cadastro ->{'verificarUsuario'}();
	}
	function atualizarSensor($bateria){
	
	$resultado = new SensorDAO();
	return $resultado->verificarExistenciaSensorByID($bateria);
	#$cadastro ->{'verificarUsuario'}();
	}
	function excluirSensor($Sensor){

	$resultado = new SensorDAO();
	
	return $resultado->excluirSensor($Sensor);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirSensorPorCategoria($nomeUser){
	
	$resultado = new SensorDAO();
	return $resultado->exibirSensorPorCategoria($nomeUser);
	#$cadastro ->{'verificarUsuario'}();
	}

	function sensorGetCompativel($ID_Sensor){
	$resultado = new SensorDAO();
	
	return $resultado->sensorGetCompativel($ID_Sensor);
	}
#====================== Parte relacionada ao Projeto  ==================#	
	function inserirProjeto($Projeto){
	
	$resultado = new ProjetoDAO();
	return $resultado->verificarExistenciaProjeto($Projeto);
	#$cadastro ->{'verificarUsuario'}();
	}
	function buscarProjetosRelacionados($ID_Item){
	
		$resultado = new ProjetoDAO();
		return $resultado->buscarProjetosRelacionados($ID_Item);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirProjeto($idItem){
	#echo " Retorno na fachada: antes: ". $idItem."</br>";
	$resultado = new ProjetoDAO();
	$retorno = $resultado->exibirProjeto($idItem);
	#echo " Retorno na fachada:: ". $resultado['nomeItem']."</br>";
	#echo "Retorno na fachada: ".$retorno['img_componente'];
	return $retorno;
	#$cadastro ->{'verificarUsuario'}();
	}

	function listarProjetoPorPalavraChave($nomeItem)
	{

	$resultado = new ProjetoDAO();
	$retorno = $resultado->listarProjetoPorPalavraChave($nomeItem);
	#echo " Retorno na fachada:: ". $resultado[0]['nome']."</br>";
	#echo "Retorno na fachada: ".$retorno['img_componente'];
	return $retorno;
	#$cadastro ->{'verificarUsuario'}();
	}
	function listarProjeto($nomeItem)
	{

	$resultado = new ProjetoDAO();
	$retorno = $resultado->listarProjeto($nomeItem);
	#echo " Retorno na fachada:: ". $resultado[0]['nome']."</br>";
	#echo "Retorno na fachada: ".$retorno['img_componente'];
	return $retorno;
	#$cadastro ->{'verificarUsuario'}();
	}
	function atualizarProjeto($bateria){
	
	$resultado = new ProjetoDAO();
	return $resultado->verificarExistenciaProjetoByID($bateria);
	#$cadastro ->{'verificarUsuario'}();
	}
	function excluirProjeto($Projeto){

	$resultado = new ProjetoDAO();
	
	return $resultado->excluirProjeto($Projeto);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirProjetoPorUsuario($nomeUser){
	
	$resultado = new ProjetoDAO();
	return $resultado->exibirProjetoPorUsuario($nomeUser);
	#$cadastro ->{'verificarUsuario'}();
	}

	function projetoGetCompativel($ID_Projeto){
	$resultado = new ProjetoDAO();
	
	return $resultado->projetoGetCompativel($ID_Projeto);
	}	

	function getItensGeral($nomeUser){
	
	$resultado = new ProjetoDAO();
	return $resultado->getItensGeral($nomeUser);
	#$cadastro ->{'verificarUsuario'}();
	}
	function inserirAvaliacao($avaliacao, $ID_Usuario, $ID_Projeto){
	
	$resultado = new ProjetoDAO();
	return $resultado->inserirAvaliacao($avaliacao, $ID_Usuario, $ID_Projeto);
	#$cadastro ->{'verificarUsuario'}();
	}
	function inserirComentario($comentario, $id_User, $id_Projeto){
	
	$resultado = new ProjetoDAO();
	return $resultado->inserirComentario($comentario, $id_User, $id_Projeto);
	#$cadastro ->{'verificarUsuario'}();
	}

	function atualizarComentario($comentario,$ID_Comentario, $ID_Usuario, $ID_Projeto){
	
	$resultado = new ProjetoDAO();
	return $resultado->atualizarComentario($comentario,$ID_Comentario, $ID_Usuario, $ID_Projeto);
	#$cadastro ->{'verificarUsuario'}();
	}
	function excluirComentario($ID_Comentario){
	
	#echo "Tá entrando na fachada...";
	$resultado = new ProjetoDAO();
	return $resultado->excluirComentario($ID_Comentario);
	#$cadastro ->{'verificarUsuario'}();
	}

	function buscarComentario($ID_Projeto){
	
	#echo "Tá entrando na fachada...";
	$resultado = new ProjetoDAO();
	return $resultado->buscarComentario($ID_Projeto);
	#$cadastro ->{'verificarUsuario'}();
	}


	function exibirFavoritoPorUsuario($nomeUser){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->exibirFavoritoPorUsuario($nomeUser);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirProjetoFavoritosPorUsuario($nomeUser){
	
	$resultado = new ProjetoDAO();
	return $resultado->exibirProjetoFavoritosPorUsuario($nomeUser);
	#$cadastro ->{'verificarUsuario'}();
	}

	function inserirFavorito($idItem,$idUser,$idProjeto){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->verificarExistenciaFavorito($idItem,$idUser,$idProjeto);
	#$cadastro ->{'verificarUsuario'}();
	}
	function excluirFavorito($itemAtual,$tipo){
	#echo " ta entrando na exlcusão: ". $micro."</br>";
	$resultado = new MicrocontroladorDAO();
	return $resultado->excluirFavorito($itemAtual,$tipo);
	#$cadastro ->{'verificarUsuario'}();
	}
}
?>
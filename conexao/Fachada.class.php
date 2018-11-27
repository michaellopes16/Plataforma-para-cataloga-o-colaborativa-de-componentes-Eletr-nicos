<?php
include_once("UsuarioVO.class.php");
include_once("UsuarioDAO.class.php");
include_once("MicrocontroladorDAO.class.php");
include_once("MicrocontroladorVO.class.php");
include_once("BateriaDAO.class.php");
include_once("BateriaVO.class.php");

class Fachada{

	function inserirUsuario($usuario){

		$cadastro = new UsuarioDAO();
		return $cadastro->verificarNomeUsuario($usuario);
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

	function exibirItem($itemAutal){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->exibirItem($itemAutal);
	#$cadastro ->{'verificarUsuario'}();
	}

	function exibirMicroPorCategoria($nomeUser){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->exibirMicroPorCategoria($nomeUser);
	#$cadastro ->{'verificarUsuario'}();
	}

#====================== Parte relacionada a Bateria =============================================#

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
	
}
?>
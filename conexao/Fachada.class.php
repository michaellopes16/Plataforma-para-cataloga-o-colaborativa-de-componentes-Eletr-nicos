<?php
include_once("UsuarioVO.class.php");
include_once("UsuarioDAO.class.php");
include_once("MicrocontroladorDAO.class.php");
include_once("MicrocontroladorVO.class.php");

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
	function exibirMicrocontrolador($idItem){
	
	$resultado = new MicrocontroladorDAO();
	return $resultado->exibirMicro($idItem);
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
}
?>
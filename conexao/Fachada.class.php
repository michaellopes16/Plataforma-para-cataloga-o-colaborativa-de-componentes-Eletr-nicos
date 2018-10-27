<?php
include_once("UsuarioVO.class.php");
include_once("CadastrarUsuario.class.php");

class Fachada{

	function inserirUsuario($usuario){

		$cadastro = new CadastrarUsuario();
		 return $cadastro->verificarUsuario($usuario);
	#$cadastro ->{'verificarUsuario'}();

	}
}
?>
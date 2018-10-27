<?php

	include_once "Conexao.class.php";

	extract($_POST);
	echo "$nomeUsuario";
	$resultado = "SELECT nomeUsuario FROM usuario where nomeUsuario='$nomeUsuario'";

   	$busca_resultado = mysqli_query($conn, $resultado);

   	if($busca_resultado)
	{
			echo 0;
	}else
	{
		echo 1;

	}
?>
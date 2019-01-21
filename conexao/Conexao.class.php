<?php
class Conexao{
 function conexaoBD(){

		$servidor  = "localhost";
		$usuario = "root";
		$senha = "";
		$dataBase = "cadastro"; 

		$conn = mysqli_connect($servidor,$usuario,$senha,$dataBase);

		if (mysqli_connect_errno($conn)) {
			echo "Aconteceu o seguinte erro: " . mysqli_connect_error();
		} else {
			#echo "Conexao OK!";
			return $conn;
		}
	}

	function desconect() {
		if ($conn) {
			mysqli_close($conn);
		}
	}
}
?>
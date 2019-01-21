<?php
include_once "Conexao.class.php";
include_once "UsuarioVO.class.php";

class UsuarioDAO{

   	function inserirUsuario($usuario, $conn)
   	{

	 $nome         = $usuario->nome;
	 $primeiroNome = $usuario->primeiroNome;
	 $sobreNome    = $usuario->sobreNome;
	 $email        = $usuario->email;
	 $senha        = $usuario->senha;

   	   $resultado2 = "INSERT INTO `usuario` (`ID_Usuario`, `nomeUsuario`, `primeiroNome`, `sobreNome`, `email`, `senha`) VALUES (NULL, '$nome', '$primeiroNome', '$sobreNome', '$email', '$senha')";
	   $conex = $conn->conexaoBD();

	   $msg_resultado = mysqli_query($conex, $resultado2);
	   echo "Valor retorno: ".$msg_resultado;
	   if(!$msg_resultado )
	   {
		#echo "Ocorreu um errooooo". mysqli_error($conex);
		#echo 2;
		return 2;
	   }else
	   {
		return 3;
	   }

   	}

	function verificarNomeUsuario($usuario){

		$nome = $usuario->nome;
		
		$resultado = "SELECT COUNT(*) FROM usuario where nomeUsuario='$nome'";
		
		$conn = New Conexao;

	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

	   	$row = $busca_resultado->fetch_row();

	   	if ($row[0] > 0) {
	   	    return 1;
	   	} else {
	 	    return $this->inserirUsuario($usuario, $conn);
	   	}
	}
  	function verificarUsuario($usuario){

  		$nome = $usuario->nome;
  		$senha = $usuario->senha;
  		
  		$resultado = "SELECT COUNT(*) FROM usuario where nomeUsuario='$nome' AND senha='$senha'";
  		
  		$conn = New Conexao;

  	   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

  	   	$row = $busca_resultado->fetch_row();

  	   	echo $row[0];

  	   	if ($row[0] > 0) {
  	   	    return 1;
  	   	    echo 1;
  	   	} else {
  	   		echo 0;
  	 	    return 0;
  	   	}
  	 }
  	 function getIdUsuario($usuario){
  	 	
  	 	$conn = New Conexao;
  	 	$resultado = "SELECT ID_Usuario FROM usuario where nomeUsuario='$usuario'";
  	 	
  	    $busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

    	$busca_resultado = $busca_resultado->fetch_row();

    	#echo "Resultado do ID usuario no DAO: ".$busca_resultado[0];

  	    	if ($busca_resultado) {
  	    	    return $busca_resultado ;
  	    	    
  	    	} else {
  	    		
  	  	    return 0;
  	    	}
  	  }
  }
?>  
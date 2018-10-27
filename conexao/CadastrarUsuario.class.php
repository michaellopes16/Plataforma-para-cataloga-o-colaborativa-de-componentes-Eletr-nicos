<?php
include_once "Conexao.class.php";
include_once "UsuarioVO.class.php";

class CadastrarUsuario{

   	function inserirUsuario($usuario, $conn)
   	{

	 $nome         = $usuario->nome;
	 $primeiroNome = $usuario->primeiroNome;
	 $sobreNome    = $usuario->sobreNome;
	 $email        = $usuario->email;
	 $senha        = $usuario->senha;

   	   $resultado2 = "INSERT INTO `usuario` (`ID_Usuario`, `nomeUsuario`, `primeiroNome`, `sobreNome`, `email`, `senha`) VALUES (NULL, '$nome', '$primeiroNome', '$sobreNome', '$email', '$senha')";
	   $conex = $conn->conexaoBD();
	   #$conn->{'conexaoBD'}()
	   $msg_resultado = mysqli_query($conex, $resultado2);
	   if(!$msg_resultado )
	   {
		echo "Ocorreu um errooooo". mysqli_error($conex);
		echo 2;
		return 2;
	   }else
	   {
		# echo "Deu certoooooo!".$msg_resultado ;
		echo 3;
		return 3;
	   }

   	}

function verificarUsuario($usuario){
	//require_once ("conexao.php"); 
	#$nome = $_POST['nomeUsuario'];
	#$primeiroNome = $_POST['primeiroNome'];
	#$sobreNome = $_POST['sobreNome'];
	#$email = $_POST['email'];
	#$senha = $_POST['senha'];

	$nome = $usuario->nome;
	
	$resultado = "SELECT COUNT(*) FROM usuario where nomeUsuario='$nome'";
	
	$conn = New Conexao;

   	$busca_resultado = mysqli_query($conn->{'conexaoBD'}(), $resultado);

   	$row = $busca_resultado->fetch_row();

   	if ($row[0] > 0) {
   	    $alerta =("E-mail (".$usuario->email.") já existente.");
   	   # echo $alerta;
   	    echo 1;
   	    return 1;
   	} else {
 	     # echo "Resultado da busca: ".$row[0] ;
 	      return $this->inserirUsuario($usuario, $conn);
   	}
}


  }

?>
   
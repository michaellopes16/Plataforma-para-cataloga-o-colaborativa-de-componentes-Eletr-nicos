
<?php

    include_once("conexao/Fachada.class.php");
    include_once("conexao/UsuarioVO.class.php");

	$nome = $_POST['nomeUsuario'];
	$primeiroNome = $_POST['primeiroNome'];
	$sobreNome = $_POST['sobreNome'];
	$email = $_POST['email'];
	$senha = $_POST['senha'];

	$imprimir = '';
	$tipoAlert = 'sucess';
	$labelAlerta = '';
	$labelLink = '';
	$Link = 'TelaCadastro.html';

	$usuario = new UsuarioVO();

	$usuario->nome = $nome;
	$usuario->primeiroNome = $primeiroNome;
	$usuario->sobreNome = $sobreNome;
	$usuario->email = $email;
	$usuario->senha = $senha;

	$fachada = new Fachada();

	$result = $fachada->inserirUsuario($usuario);
	#echo "Resultado: ".$result;

	if ($result == 1) {
		$imprimir = "Usuário Já cadastrado!";
		$tipoAlert = "alert alert-warning alert-dismissible fade show";
		$labelAlerta = 'Atenção! ';
		$labelLink = 'Tente outro nome de usuario';
	}else if ($result == 2) {

		$imprimir = "Erro ao cadastrar!";
		$tipoAlert = "alert alert-danger";
		$labelAlerta = 'Erro! ';
		$labelLink = 'Tente novamente';
	}else
	{
		$imprimir = "Usuário cadastrado com sucesso!";
		$tipoAlert = "alert alert-success";
		$labelAlerta = 'Sucesso! ';
		$labelLink = 'Logar no sistema!';
		$Link = 'TelaLogin.html';
	}
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="bootstrap/compiler/style.css">

      <title>Eletronics Component Catalog DMI</title>
  </head>
  <body>
      <div class="container mt-2 ml-5" align="start">
        <img src="img/logo2.png" class="img" align="center">
      </div>

       <nav class="navbar navbar-expand-lg bg-gradient-primary  ">
         <a href="index.html" class="btn btn-primary mr-2"> 
           <svg  id="i-home" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
               <path d="M12 20 L12 30 4 30 4 12 16 2 28 12 28 30 20 30 20 20 Z" />
           </svg>   
           Início
         </a>

       </nav>
 <!-- ====================== Fim do menu e início do alert ==================================   -->

<div class="<?php echo($tipoAlert) ?>" role="alert" align="center">
  <strong><?php echo($labelAlerta) ?></strong> <?php echo($imprimir) ?>
  <a href="<?php echo($Link) ?>" class="alert-link"><?php echo($labelLink) ?></a>
</div>

<!-- ======================== Fim do  alert =============++++++++++++++=====================   -->
    <script src="bootstrap/js/validator.min.js"></script>
    <script src="jquery/dist/jQuery.js"></script>
    <script src="popper.js/dist/umd/popper.js"></script>
    <script src="bootstrap/dist/js/bootstrap.js"></script>
  </body>
</html>
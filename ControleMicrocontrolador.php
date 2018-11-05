
<?php

    include_once("conexao/Fachada.class.php");
    include_once("conexao/MicrocontroladorVO.class.php");
 	session_start();
 	#Informações gerais

	if(isset($_FILES['imgComponente'])) { 

	$extensaoI1 =  strtolower(substr($_FILES['imgComponente']['name'],-4));// pega a extensão do arquivo
	$novo_nome = md5(time()). $extensaoI1 ;
	$diretorioIMG = "upload/";
	$caminho_img_componente = $diretorioIMG."componente_".$novo_nome;

	move_uploaded_file($_FILES['imgComponente']['tmp_name'], $caminho_img_componente); 
	}else { 
  		echo"Você não realizou o upload de forma satisfatória."; 
	} 

	if(isset($_FILES['imgLegenda'])) { 

	$extensaoI2 =  strtolower(substr($_FILES['imgLegenda']['name'],-4));// pega a extensão do arquivo
	$novo_nome2 = md5(time()). $extensaoI2;
	$diretorioIMG = "upload/";
	$caminho_img_legenda = $diretorioIMG."legenda_".$novo_nome2;
	
	move_uploaded_file($_FILES['imgLegenda']['tmp_name'],$caminho_img_legenda); 
	}else { 
  		echo"Você não realizou o upload de forma satisfatória."; 
	} 
	
	$nome 			 	 = $_POST['nome'];
	$modelo			 	 = $_POST['modelo'];
	$temperatura_ope  	 = $_POST['temperatura_ope'];
	$link_DS 		 	 = $_POST['link_DS'];
	$palavra_chave	 	 = $_POST['palavra_chave'];
	$precoMedio 	  	 = $_POST['preco_medio'];
	$dimensao		  	 = $_POST['dimensao'];
	$plataforma_desen 	 = $_POST['plataforma_desen'];
	$linguagemUtilizada  = $_POST['linguagem_utili'];
	#echo "linguagemUtilizada :".$linguagemUtilizada ;

	 #Informações Técnicas
	$processador	  = $_POST['processador'];
	$memoria_RAM	  = $_POST['memoria_RAM'];
	$memoria_FLASH	  = $_POST['memoria_FLASH'];
	$microcontrolador = $_POST['microcontrolador'];
	$vel_clock  	  = $_POST['vel_clock'];
	$GPIO_A			  = $_POST['GPIO_A'];
	$GPIO_D			  = $_POST['GPIO_D'];

	#Informações Elétricas
	$tensao_Ope		  = $_POST['tensao_Ope'];
	$tensao_Entr	  = $_POST['tensao_Entr'];
	$modo_consumo  	  = $_POST['modo_consumo'];

	 #Interfaces de comunicação
	$sem_fio		  = $_POST['sem_fio'];
	$serial			  = $_POST['serial'];

 	#Componentes Adicionais
	$inter_E		  = $_POST['inter_E'];
	$sensores 		  = $_POST['sensores'];
	$infoGerais		  = $_POST['info_add'];

	$imprimir = '';
	$tipoAlert = 'sucess';
	$labelAlerta = '';
	$labelLink = '';
	$Link = 'TelaInserirMicrocontrolador.php';

	$micro = new MicrocontroladorVO();

	#Informações gerais
	 $micro->img_componente   		= $caminho_img_componente;
	 $micro->img_legenda 	  		= $caminho_img_legenda;
	 $micro->nome 			        = $nome;
	 $micro->modelo			 	    = $modelo;
	 $micro->temperaturaOperacao    = $temperatura_ope;
	 $micro->linkDS      			= $link_DS;
	 $micro->palavra_chave 			= $palavra_chave;
	 $micro->precoMedio   			= $precoMedio;
	 $micro->dimensao  				= $dimensao;
	 $micro->plataformaDesenv  		= $plataforma_desen;
	 $micro->linguagemUtilizada 	= $linguagemUtilizada;


	 #Informações Técnicas

	 $micro->processador 			= $processador;
	 $micro->memoriaRAM 			= $memoria_RAM;
	 $micro->memoriaFLASH   	    = $memoria_FLASH;
	 $micro->microcontrolador   	= $microcontrolador;
	 $micro->velo_clock				= $vel_clock;
	 $micro->GPIO_Ana  	   			= $GPIO_A;
	 $micro->GPIO_Dig   			= $GPIO_D;
	 
	 #Informações Elétricas
	 $micro->tensaoOperacao			= $tensao_Ope;
	 $micro->tensaoEntrada	   		= $tensao_Entr;
	 $micro->modoConsumo  			= $modo_consumo;

	 #Interfaces de comunicação
	 $micro->semFio   				= $sem_fio;
	 $micro->serial 				= $serial;
	
	 #Componentes Adicionais
	 $micro->enterEntrada			= $inter_E;
	 $micro->sensores   			= $sensores;
	 $micro->infoGerais 			= $infoGerais;
	
	$fachada = new Fachada();

	$result = $fachada->inserirMicrocontrolador($micro);
	#echo "Resultado: ".$result;
	#echo $result."Tá retornando isso!";
	if ($result == 1) {
		$imprimir = "Item Já cadastrado!";
		$tipoAlert = "alert alert-warning alert-dismissible fade show";
		$labelAlerta = 'Atenção! ';
		$labelLink = 'Tente cadastrar um item novo';
	}else if ($result == 2) {

		$imprimir = "Erro ao inserir item!";
		$tipoAlert = "alert alert-danger";
		$labelAlerta = 'Erro! ';
		$labelLink = 'Tente novamente';
	}else
	{
		$imprimir = " Componente cadastrado com sucesso!";
		$tipoAlert = "alert alert-success";
		$labelAlerta = 'Sucesso! ';
		$labelLink = 'Visualizar!';
		$Link = 'TelaExibirMicrocontrolador.php';
		$_SESSION["itemAtual"] = $result;

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
 
<!--   ============================ Cabeçalho ===============================================--> 

<div class="container d-flex bd-highlight mb-3">
  <img src="img/logo2.png" class="img mr-auto p-2 bd-highlight" align="center">
      <?php 
        if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
          if($_SESSION["logado"] == 1){ ?>
            <div class="container mb-5">
                 <div class="d-flex flex-row-reverse mb-4">
                    
                    <a href="TelaLogin.php" class="btn btn-primary p-2 bd-highlight tamanhoBTNS ml-4">
                      <svg id="i-signout" viewBox="0 0 30 30" width="25" height="20"fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                          <path d="M28 16 L8 16 M20 8 L28 16 20 24 M11 28 L3 28 3 4 11 4"  />
                      </svg>
                    Sair
                    </a>
                     <div>
                         <svg align="center" id="i-user" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" />
                          </svg>
                        <label class=" bd-highlight mt mr-3">
                        <h4><?php echo $_SESSION["nomeUser"];  ?></h4> 
                        </label>
                    </div>
                </div> 
            </div> 
      <?php }else{
              ?>
               <div class="container mb-4 ">
                      <div class="d-flex flex-row-reverse">
                          <a href="TelaLogin.php" class="btn btn-primary mr-2">Entrar</a>
                      </div> 
                </div>
                <?php
            }
      }else{ ?>
            <div class="container mb-4 ">
                  <div class="d-flex flex-row-reverse">
                      <a href="TelaLogin.php" class="btn btn-primary mr-2">Entrar</a>
                  </div> 
            </div>      
      <?php }?>
</div>

       <nav class="navbar navbar-expand-lg bg-gradient-primary d-flex bd-highlight mb-3 ">
         <a href="index.php" class="btn btn-primary mr-0  p-2 bd-highlight"> 
           <svg  id="i-home" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
               <path d="M12 20 L12 30 4 30 4 12 16 2 28 12 28 30 20 30 20 20 Z" />
           </svg>   
           Início
         </a>
         <?php 
       if(isset($_SESSION['logado']) && !empty($_SESSION['logado'])){
         if($_SESSION["logado"] == 1){ ?>
         <a href="TelaGerenciarComponentes.php" class="btn btn-primary mr-0 ml-2  p-2 bd-highlight"> 
           <svg  id="i-portfolio" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
               <path d="M29 17 L29 28 3 28 3 17 M2 8 L30 8 30 16 C30 16 24 20 16 20 8 20 2 16 2 16 L2 8 Z M16 22 L16 18 M20 8 C20 8 20 4 16 4 12 4 12 8 12 8" />
           </svg>   
           Gerenciar
         </a>
          <?php } }?>
         <a href="#" class="btn btn-primary  mr-2 ml-2 mr-auto p-2 bd-highlight">
          <svg  id="i-star" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
              <path d="M16 2 L20 12 30 12 22 19 25 30 16 23 7 30 10 19 2 12 12 12 Z" />
          </svg>  
         Favoritos</a>
         <form class="form-inline">
           <input class="form-control ml-4 mr-2" type="search" placeholder="Buscar...">
           <a href="TelaFavoritos.php" class="btn btn-primary p-2 ml-2 bd-highlight">
            <svg  id="i-star" viewBox="0 0 30 30" width="25" height="20" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
               <circle cx="14" cy="14" r="12" />
                <path d="M23 23 L30 30"  />
            </svg>  
           Buscar</a>
         </form> 
       </nav>

<!--   ===================  Início do corpo principal=======================================   -->

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
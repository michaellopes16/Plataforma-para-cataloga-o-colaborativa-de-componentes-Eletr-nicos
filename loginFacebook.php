<?php 
session_start();
# se não tiver usuário com o mesmo email, inserir informações do 
# Facebook



# $result = 1 caso já exista. 2 se der erro, e outro caso dê certo o cadastro
#============================================

#unset($_SESSION['face_access_token']);
require_once'lib/Facebook/autoload.php';
    include_once("conexao/Fachada.class.php");
    include_once("conexao/UsuarioVO.class.php");

$usuario = new UsuarioVO();
$fachada = new Fachada();
$fb = new \Facebook\Facebook([
  'app_id' => '717491938635527',
  'app_secret' => '6af92b068d844581033c47c7bb055063',
  'default_graph_version' => 'v2.10',
  //'default_access_token' => '{access-token}', // optional
]);

$helper = $fb->getRedirectLoginHelper();
if (isset($_GET['state'])) { $helper->getPersistentDataHandler()->set('state', $_GET['state']); }
//var_dump($helper);
$permissions = ['email']; // Optional permissions

try {
	if(isset($_SESSION['face_access_token'])){
		$accessToken = $_SESSION['face_access_token'];
	}else{
		$accessToken = $helper->getAccessToken();
	}
	
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

if (! isset($accessToken)) {
	$url_login = 'http://localhost/mlb/loginFacebook.php';
	$loginUrl = $helper->getLoginUrl($url_login, $permissions);
}else{
	$url_login = 'http://localhost/mlb/loginFacebook.php';
	$loginUrl = $helper->getLoginUrl($url_login, $permissions);
	//UsuÃ¡rio ja autenticado
	if(isset($_SESSION['face_access_token'])){
		$fb->setDefaultAccessToken($_SESSION['face_access_token']);
	}//UsuÃ¡rio nÃ£o estÃ¡ autenticado
	else{
		$_SESSION['face_access_token'] = (string) $accessToken;
		$oAuth2Client = $fb->getOAuth2Client();
		$_SESSION['face_access_token'] = (string) $oAuth2Client->getLongLivedAccessToken($_SESSION['face_access_token']);
		$fb->setDefaultAccessToken($_SESSION['face_access_token']);	
	}

	try {
		// Returns a `Facebook\FacebookResponse` object
		$response = $fb->get('/me?fields=name, picture, email');
		$user = $response->getGraphUser();
		#var_dump($user);
		if($_SESSION['logado'] == false){
			$_SESSION['logado'] = true;		
			$_SESSION['nomeUser'] = strstr($user['email'], '@', true);
			echo "Nome Usuario:". $_SESSION['nomeUser']. "Logado?".$_SESSION['logado'];	
			$usuario->nome = strstr($user['email'], '@', true);
			$usuario->primeiroNome = strstr($user['name']," ",true);
			$usuario->sobreNome = strstr($user['name']," ");
			$usuario->email = $user['email'];
			$usuario->senha = substr($user['id'], 0, 2);
			#echo "Email usuario: ".$usuario->email;

			$result = $fachada->inserirUsuario($usuario);
			header("Location: TelaGerenciarComponentes.php");	
		}
					
		
	} catch(Facebook\Exceptions\FacebookResponseException $e) {
		echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
	}
}

 ?>


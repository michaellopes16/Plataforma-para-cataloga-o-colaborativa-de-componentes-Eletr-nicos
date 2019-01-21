<?php 
session_start();
include_once("conexao/Fachada.class.php");

$ID_Usuario ='';
$ID_Projeto = '';
$comentario = '';
$fachada = new Fachada;
$retorno = '';
if(isset($_POST["TextComentario"])){
	
	$ID_Usuario    = $_POST["ID_Usuario"];
	$ID_Comentario = $_POST["ID_Comentario"];
	$ID_Projeto    = $_POST["ID_Projeto"];
	$comentario    = $_POST["TextComentario"];
	$resul = '';
	$resul2 = '';
	$arrayResult   = $fachada->atualizarComentario($comentario,$ID_Comentario, $ID_Usuario, $ID_Projeto);
	$countBusca    =  mysqli_num_rows($arrayResult);


   $comentarios = $fachada->buscarComentario($ID_Projeto);
   while ($row =  mysqli_fetch_array($comentarios,MYSQLI_ASSOC)) {

   	 $idBtEditar = "BT_Editar_comentario:".$row['ID_Comentarios'].":".$row['ID_Usuario_FK'].":".$ID_Projeto ;
   	 $idBtSalvar = "BT_Salvar_comentario:".$row['ID_Comentarios'].":".$row['ID_Usuario_FK'].":".$ID_Projeto ;		 
   	# echo "ID comentários na edição: ".$row['ID_Comentarios'];
  		 $resul .= ' 
  		 		<div>
		        <svg align="center" id="i-user" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
		               <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" />
		         </svg>
		       <strong>'.$row['nomeUsuario'].'</strong>: Data:'.$row['dataComentario'].'</label>
		       </div>
		       <textarea id='.$row['ID_Comentarios'].'" class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="5" style="resize: none;">'.$row['descricao'].'  
		       </textarea>
		       ';
  	 if($ID_Usuario  == $row['ID_Usuario_FK']){
		       $resul .='
		       <button type="button" id="'.$idBtEditar.'" class="btn btn-link">Editar</button>
		       
		       <button type="button" id="BT_Excluir_comentario:'.$row['ID_Comentarios'].'" class="btn btn-link">Excluir</button>

		       <button type="button" id="'.$idBtSalvar.'" class="btn btn-link" style="display: none;" >Salvar</button>

		      ';
          } 
      }mysqli_free_result($comentarios);

      echo $resul.$resul2;

}
if(isset($_POST["ID_Comentario_Excluir"])){
	$arrayResult   = $fachada->excluirComentario($_POST["ID_Comentario_Excluir"]);
	$ID_Projeto = $_POST["ID_Projeto"];
	$comentarios = $fachada->buscarComentario($ID_Projeto);
	$countBusca    =  mysqli_num_rows($comentarios);

	echo "Linhas retorno: ".$countBusca  ;
if($arrayResult == 1){

	$resul = '';
	$resul2 = '';
   while ($row =  mysqli_fetch_array($comentarios,MYSQLI_ASSOC)) {

   	 $idBtEditar = "BT_Editar_comentario:".$row['ID_Comentarios'].":".$row['ID_Usuario_FK'].":".$ID_Projeto ;
   	 $idBtSalvar = "BT_Salvar_comentario:".$row['ID_Comentarios'].":".$row['ID_Usuario_FK'].":".$ID_Projeto ;
   	 $idBtExcluir = "BT_Excluir_comentario:".$row['ID_Comentarios'].":".$row['ID_Usuario_FK'].":".$ID_Projeto;
   	 #echo "ID Botão Excluir: ".$idBtExcluir;
 	  $resul .=  '
 	  	 		<div>
		        <svg align="center" id="i-user" viewBox="0 0 32 32" width="32" height="32" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
		               <path d="M22 11 C22 16 19 20 16 20 13 20 10 16 10 11 10 6 12 3 16 3 20 3 22 6 22 11 Z M4 30 L28 30 C28 21 22 20 16 20 10 20 4 21 4 30 Z" />
		         </svg>
		       <strong>'.$row['nomeUsuario'].'</strong>: Data:'.$row['dataComentario'].'</label>
		       </div>
		       <textarea id='.$row['ID_Comentarios'].'" class="form-control" align="start" readonly="readonly" name="info_add" id="ID_Campo_Ind_Add" rows="5" style="resize: none;">'.$row['descricao'].'  
		       </textarea>
		      ';
		echo "</br>ID do usuario no excluir: ".$_SESSION["ID_Usuario"];    
		if($_SESSION["ID_Usuario"] == $row['ID_Usuario_FK']){
		      $resul .=' 
		       <button type="button" id="'.$idBtEditar.'" class="btn btn-link">Editar</button>
		       
		       <button type="button" id="'.$idBtExcluir.'" class="btn btn-link">Excluir</button>

		       <button type="button" id="'.$idBtSalvar.'" class="btn btn-link" style="display: none;" >Salvar</button>
		
        ';
    		}
         } mysqli_free_result($comentarios);

         echo $resul;
	 }
}
?>
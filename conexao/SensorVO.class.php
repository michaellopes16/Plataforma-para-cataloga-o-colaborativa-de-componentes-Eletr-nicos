<?php
class SensorVO
{
	#Informações gerais item
	public $ID_Item;
	public $nome;
	public $palavra_chave;
	public $dimensao;
	public $precoMedio;
	public $infoGerais;
	public $linkDS;
	public $img_componente;

	#informações  do modelo
	public $modelo;

	#informações gerais do componente
	public $temperaturaOperacao;
	public $tensaoOperacao;
	public $compativel;
	public $tensaoSaida;
	public $funsao;	
}
?>
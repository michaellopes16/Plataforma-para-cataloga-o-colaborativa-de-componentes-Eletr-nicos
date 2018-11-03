<?php

class MicrocontroladorVO
{

	#Informações gerais
	public $nome;
	public $modelo;
	public $temperaturaOperacao;
	public $linkDS;
	public $precoMedio;
	public $dimensao;
	public $plataformaDesenv;
	public $linguagemUtilizada;
	public $palavra_chave;
	public $img_componente;
	public $img_legenda;

	#Informações Técnicas
	public $processador;
	public $memoriaRAM;
	public $memoriaFLASH;
	public $microcontrolador;
	public $velo_clock;
	public $GPIO_Ana;
	public $GPIO_Dig;

	#Informações Elétricas
	public $tensaoOperacao;
	public $tensaoEntrada;
	public $modoConsumo;

	#Interfaces de comunicação
	public $semFio;
	public $serial;

	#Componentes Adicionais
	public $enterEntrada;
	public $sensores;
	public $infoGerais;
}



?>
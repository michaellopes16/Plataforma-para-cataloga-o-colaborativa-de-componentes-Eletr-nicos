<?php
class BateriaVO
{

	#Informações gerais
	public $ID_Item;
	public $nome;
	public $modelo;
	public $temperaturaOperacao;
	public $linkDS;
	public $precoMedio;
	public $dimensao;
	public $tamanho;
	public $peso;
	public $palavra_chave;
	public $img_componente;
	public $tipo_carga;
	public $infoGerais;
	public $tensao_nom;

	#Informações Elétricas se Recaregável
	public $manutencao;
	public $densidade;
	public $resistencia_int;
	public $ciclo_de_vida;
	public $tempo_carga_rapida;
	public $tolerancia_sobrecarga;
	public $auto_descarga_mensal;	
	public $corrente_carga;

	#Informações Elétricas se Não Recaregável
	public $quimica;
	public $tempo_medio;
	public $resistor_descarga;
	public $voltagem_minima;	
}
?>
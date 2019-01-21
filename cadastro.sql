-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 06-Jan-2019 às 16:09
-- Versão do servidor: 5.7.23
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catalo62_cadastro`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `atuador`
--

DROP TABLE IF EXISTS `atuador`;
CREATE TABLE IF NOT EXISTS `atuador` (
  `ID_Atuador` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_Atuador`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atuador`
--

INSERT INTO `atuador` (`ID_Atuador`, `nome`) VALUES
(7, 'LED'),
(8, 'Motor de Passo NEMA ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `atuador_e_compativel`
--

DROP TABLE IF EXISTS `atuador_e_compativel`;
CREATE TABLE IF NOT EXISTS `atuador_e_compativel` (
  `ID_E_Comp` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Item_FK` int(3) NOT NULL,
  `ID_Atuador_FK` int(3) NOT NULL,
  PRIMARY KEY (`ID_E_Comp`),
  KEY `ID_Item_FK` (`ID_Item_FK`),
  KEY `ID_Atuador_FK` (`ID_Atuador_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `atuador_e_compativel`
--

INSERT INTO `atuador_e_compativel` (`ID_E_Comp`, `ID_Item_FK`, `ID_Atuador_FK`) VALUES
(19, 2, 14),
(18, 1, 14),
(27, 2, 15),
(26, 1, 15),
(28, 1, 24),
(29, 2, 24);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacao_projeto`
--

DROP TABLE IF EXISTS `avaliacao_projeto`;
CREATE TABLE IF NOT EXISTS `avaliacao_projeto` (
  `ID_Avaliacao` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Projeto_FK` int(3) NOT NULL,
  `ID_Usuario_FK` int(3) NOT NULL,
  `dataComentario` datetime DEFAULT NULL,
  `avaliacao` int(5) DEFAULT NULL,
  PRIMARY KEY (`ID_Avaliacao`),
  KEY `ID_Projeto_FK` (`ID_Projeto_FK`),
  KEY `ID_Usuario_FK` (`ID_Usuario_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `avaliacao_projeto`
--

INSERT INTO `avaliacao_projeto` (`ID_Avaliacao`, `ID_Projeto_FK`, `ID_Usuario_FK`, `dataComentario`, `avaliacao`) VALUES
(36, 6, 20, '2018-12-13 21:13:29', 5),
(37, 3, 20, '2018-12-14 20:41:21', 4),
(38, 3, 13, '2018-12-21 20:35:26', 5),
(39, 6, 13, '2018-12-13 21:55:07', 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `bateria`
--

DROP TABLE IF EXISTS `bateria`;
CREATE TABLE IF NOT EXISTS `bateria` (
  `ID_Bateria` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  UNIQUE KEY `ID_Bateria` (`ID_Bateria`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `bateria`
--

INSERT INTO `bateria` (`ID_Bateria`, `nome`) VALUES
(1, 'Bateria 9V'),
(2, 'Bateria / Pilha Samsung Original');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_item`
--

DROP TABLE IF EXISTS `cadastro_item`;
CREATE TABLE IF NOT EXISTS `cadastro_item` (
  `ID_Cadastro` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Usuario_FK` int(3) NOT NULL,
  `ID_Item_FK` int(3) NOT NULL,
  `dataCadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_Cadastro`),
  KEY `ID_Usuario_FK` (`ID_Usuario_FK`),
  KEY `ID_Item_FK` (`ID_Item_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cadastro_item`
--

INSERT INTO `cadastro_item` (`ID_Cadastro`, `ID_Usuario_FK`, `ID_Item_FK`, `dataCadastro`) VALUES
(26, 20, 28, '2018-12-13 15:29:29'),
(2, 13, 2, '2018-11-29 23:20:00'),
(3, 13, 3, '2018-12-01 19:19:27'),
(4, 13, 4, '2018-12-01 19:19:48'),
(16, 13, 16, '2018-12-01 20:44:32'),
(20, 13, 15, '2018-12-01 21:23:43'),
(21, 13, 20, '2018-12-06 19:41:25'),
(19, 13, 19, '2018-12-08 14:08:09'),
(23, 13, 22, '2018-12-18 15:23:13'),
(24, 13, 23, '2018-12-18 15:22:18'),
(25, 13, 24, '2018-12-06 20:43:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `comentarios_projetos`
--

DROP TABLE IF EXISTS `comentarios_projetos`;
CREATE TABLE IF NOT EXISTS `comentarios_projetos` (
  `ID_Comentarios` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Projeto_FK` int(3) NOT NULL,
  `ID_Usuario_FK` int(3) NOT NULL,
  `dataComentario` datetime DEFAULT NULL,
  `descricao` text,
  PRIMARY KEY (`ID_Comentarios`),
  KEY `ID_Projeto_FK` (`ID_Projeto_FK`),
  KEY `ID_Usuario_FK` (`ID_Usuario_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `comentarios_projetos`
--

INSERT INTO `comentarios_projetos` (`ID_Comentarios`, `ID_Projeto_FK`, `ID_Usuario_FK`, `dataComentario`, `descricao`) VALUES
(14, 13, 13, '2018-12-04 21:08:52', ' LEgal mano  \n         asdasd'),
(13, 13, 13, '2018-12-04 21:07:18', ' LEgal mano  asdasdasd\n         '),
(12, 6, 13, '2018-12-04 17:30:07', ' Top mastaer'),
(11, 3, 13, '2018-12-04 22:09:23', 'Pronto.... Espero nÃ£o ter mais trabalho com isso\n         '),
(15, 13, 11, '2018-12-04 21:09:38', ' LEgal mano  asfasfasfa\n         '),
(16, 13, 11, '2018-12-04 21:53:07', ' LEgal mano  asdasdasd\n         '),
(17, 13, 11, '2018-12-04 21:54:31', ' LEgal mano  \n         TEste'),
(32, 3, 13, '2018-12-05 00:46:56', ' Bora veeeeeeeeeeeeeeeeeeeeee'),
(33, 3, 13, '2018-12-21 00:31:45', 'ComentÃ¡rio 1\n\n           '),
(35, 6, 13, '2018-12-05 00:55:07', ' Bom todo!'),
(39, 6, 13, '2018-12-13 17:01:13', ' BOm');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_componentes_adicionais_micro`
--

DROP TABLE IF EXISTS `info_componentes_adicionais_micro`;
CREATE TABLE IF NOT EXISTS `info_componentes_adicionais_micro` (
  `ID_Infor_Compo_adicionais` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Modelo_FK` int(3) DEFAULT NULL,
  `interface_entrada` varchar(50) DEFAULT NULL,
  `sensores` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Infor_Compo_adicionais`),
  KEY `ID_Modelo_FK` (`ID_Modelo_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_componentes_adicionais_micro`
--

INSERT INTO `info_componentes_adicionais_micro` (`ID_Infor_Compo_adicionais`, `ID_Modelo_FK`, `interface_entrada`, `sensores`) VALUES
(3, 3, ',Micro USB', ',Nenhum'),
(2, 2, ',Micro USB,HDMI,Ethernet', ',Nenhum');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_comunicacao_micro`
--

DROP TABLE IF EXISTS `info_comunicacao_micro`;
CREATE TABLE IF NOT EXISTS `info_comunicacao_micro` (
  `ID_Infor_Comunicacao` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Modelo_FK` int(3) DEFAULT NULL,
  `sem_fio` varchar(50) DEFAULT NULL,
  `serial_` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Infor_Comunicacao`),
  KEY `ID_Modelo_FK` (`ID_Modelo_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_comunicacao_micro`
--

INSERT INTO `info_comunicacao_micro` (`ID_Infor_Comunicacao`, `ID_Modelo_FK`, `sem_fio`, `serial_`) VALUES
(1, 1, ',Nenhuma', ',I2C,UART'),
(2, 2, ',Bluethoth,WI-FI', ',I2C,UART'),
(3, 3, ',Nenhuma', ',I2C,UART');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_eletricas_bateria_nr`
--

DROP TABLE IF EXISTS `info_eletricas_bateria_nr`;
CREATE TABLE IF NOT EXISTS `info_eletricas_bateria_nr` (
  `ID_Info_Ele_BNR` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Modelo_FK` int(3) NOT NULL,
  `quimica` varchar(30) DEFAULT NULL,
  `tempo_medio` varchar(30) DEFAULT NULL,
  `resistor_descarga` varchar(30) DEFAULT NULL,
  `voltagem_minima` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_Info_Ele_BNR`),
  KEY `ID_Modelo_FK` (`ID_Modelo_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_eletricas_bateria_nr`
--

INSERT INTO `info_eletricas_bateria_nr` (`ID_Info_Ele_BNR`, `ID_Modelo_FK`, `quimica`, `tempo_medio`, `resistor_descarga`, `voltagem_minima`) VALUES
(1, 1, 'NÃ£o sei ', '3', '5', '5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_eletricas_bateria_r`
--

DROP TABLE IF EXISTS `info_eletricas_bateria_r`;
CREATE TABLE IF NOT EXISTS `info_eletricas_bateria_r` (
  `ID_Info_Ele_BR` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Modelo_FK` int(3) NOT NULL,
  `manutencao` varchar(30) DEFAULT NULL,
  `densidade` varchar(30) DEFAULT NULL,
  `resistencia_Int` varchar(30) DEFAULT NULL,
  `ciclo_de_vida` varchar(30) DEFAULT NULL,
  `tempo_carga_rapida` varchar(30) DEFAULT NULL,
  `tolerancia_sobrecarga` varchar(30) DEFAULT NULL,
  `auto_desc_mensal` varchar(30) DEFAULT NULL,
  `corrente_carga` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`ID_Info_Ele_BR`),
  KEY `ID_Modelo_FK` (`ID_Modelo_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_eletricas_bateria_r`
--

INSERT INTO `info_eletricas_bateria_r` (`ID_Info_Ele_BR`, `ID_Modelo_FK`, `manutencao`, `densidade`, `resistencia_Int`, `ciclo_de_vida`, `tempo_carga_rapida`, `tolerancia_sobrecarga`, `auto_desc_mensal`, `corrente_carga`) VALUES
(1, 2, '12 ', '23', '12', '23', '23', '12', '1', '2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_eletricas_micro`
--

DROP TABLE IF EXISTS `info_eletricas_micro`;
CREATE TABLE IF NOT EXISTS `info_eletricas_micro` (
  `ID_Infor_Eletricas` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Modelo_FK` int(3) NOT NULL,
  `modo_consumo` varchar(15) DEFAULT NULL,
  `tensao_operacao` varchar(15) DEFAULT NULL,
  `tensao_entrada` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`ID_Infor_Eletricas`),
  KEY `ID_Modelo_FK` (`ID_Modelo_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_eletricas_micro`
--

INSERT INTO `info_eletricas_micro` (`ID_Infor_Eletricas`, `ID_Modelo_FK`, `modo_consumo`, `tensao_operacao`, `tensao_entrada`) VALUES
(3, 3, '5V   ', '5V -12V', 'normal'),
(2, 2, '12V ', '5V -12V', 'BLE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_gerais_atuadores`
--

DROP TABLE IF EXISTS `info_gerais_atuadores`;
CREATE TABLE IF NOT EXISTS `info_gerais_atuadores` (
  `ID_IG_Atuador` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Modelo_FK` int(3) NOT NULL,
  `cor` varchar(50) DEFAULT NULL,
  `controlador` varchar(150) DEFAULT NULL,
  `tensaoOperacao` varchar(150) DEFAULT NULL,
  `temperaturaOperacao` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ID_IG_Atuador`),
  KEY `ID_Modelo_FK` (`ID_Modelo_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_gerais_atuadores`
--

INSERT INTO `info_gerais_atuadores` (`ID_IG_Atuador`, `ID_Modelo_FK`, `cor`, `controlador`, `tensaoOperacao`, `temperaturaOperacao`) VALUES
(3, 7, 'RBG', 'ABCD', '3.3V', '-25 CÂº a 75 CÂº'),
(4, 8, 'Outra', '', '5VDC', '---');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_gerais_bateria`
--

DROP TABLE IF EXISTS `info_gerais_bateria`;
CREATE TABLE IF NOT EXISTS `info_gerais_bateria` (
  `ID_Info_Gerais_BT` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Modelo_FK` int(3) NOT NULL,
  `tamanho` varchar(30) DEFAULT NULL,
  `peso` varchar(30) DEFAULT NULL,
  `temperatura_operacao` varchar(30) DEFAULT NULL,
  `tipo_carga` varchar(30) DEFAULT NULL,
  `tensao_nom` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Info_Gerais_BT`),
  KEY `ID_Modelo_FK` (`ID_Modelo_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_gerais_bateria`
--

INSERT INTO `info_gerais_bateria` (`ID_Info_Gerais_BT`, `ID_Modelo_FK`, `tamanho`, `peso`, `temperatura_operacao`, `tipo_carga`, `tensao_nom`) VALUES
(1, 1, 'AA', '20g', '-25 CÂº a 75 CÂº', 'NÃ£o RecaregÃ¡vel', '9V'),
(2, 2, 'AABB', '25g', '-40Â°C atÃ© +85 Â°C', 'RecarregÃ¡vel', '3.3V');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_gerais_micro`
--

DROP TABLE IF EXISTS `info_gerais_micro`;
CREATE TABLE IF NOT EXISTS `info_gerais_micro` (
  `ID_Infor_Gerais` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Modelo_FK` int(3) NOT NULL,
  `temperatura_operacao` varchar(100) DEFAULT NULL,
  `linguagem_de_prograrmacao` varchar(50) DEFAULT NULL,
  `plataforma_de_desenvolvimento` varchar(50) DEFAULT NULL,
  `palavra_chave` varchar(50) DEFAULT NULL,
  `img_legenda` varchar(70) NOT NULL,
  PRIMARY KEY (`ID_Infor_Gerais`),
  KEY `ID_Modelo_FK` (`ID_Modelo_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_gerais_micro`
--

INSERT INTO `info_gerais_micro` (`ID_Infor_Gerais`, `ID_Modelo_FK`, `temperatura_operacao`, `linguagem_de_prograrmacao`, `plataforma_de_desenvolvimento`, `palavra_chave`, `img_legenda`) VALUES
(15, 3, '-25 CÂº a 75 CÂº', ',C', ',Arduino', 'Arduino,Uno,R3', 'upload/legenda_da90329631fb6d168b69178de8798ce4.png'),
(14, 2, '-25 CÂº a 75 CÂº', ',C#,Java Script', ',Arduino', 'Raspberry, Pi zero, Wi-fi, baixo consumo', 'upload/legenda_b4a06bb867bbe43405a5e72be111e870.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_gerais_sensor`
--

DROP TABLE IF EXISTS `info_gerais_sensor`;
CREATE TABLE IF NOT EXISTS `info_gerais_sensor` (
  `ID_IG_Sensor` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Modelo_FK` int(3) NOT NULL,
  `tensaoSaida` varchar(150) DEFAULT NULL,
  `funcao` varchar(150) DEFAULT NULL,
  `tensaoOperacao` varchar(150) DEFAULT NULL,
  `temperaturaOperacao` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`ID_IG_Sensor`),
  KEY `ID_Modelo_FK` (`ID_Modelo_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_gerais_sensor`
--

INSERT INTO `info_gerais_sensor` (`ID_IG_Sensor`, `ID_Modelo_FK`, `tensaoSaida`, `funcao`, `tensaoOperacao`, `temperaturaOperacao`) VALUES
(3, 4, '3,3V', 'Sensor de temperatura', '3,3V / 5V', '20 e 80Â°C.'),
(4, 5, '', 'Testar distancia entre pontos', '3,3V - 5,5V', '-0ÂºC Ã  +65ÂºC');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_gerais_shield`
--

DROP TABLE IF EXISTS `info_gerais_shield`;
CREATE TABLE IF NOT EXISTS `info_gerais_shield` (
  `ID_IG_Shield` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Modelo_FK` int(3) NOT NULL,
  `funcao` varchar(100) DEFAULT NULL,
  `peso` varchar(100) DEFAULT NULL,
  `temperaturaOperacao` varchar(30) NOT NULL,
  `tensaoOperacao` varchar(30) NOT NULL,
  `modo_consumo` varchar(400) NOT NULL,
  PRIMARY KEY (`ID_IG_Shield`),
  KEY `ID_Modelo_FK` (`ID_Modelo_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_gerais_shield`
--

INSERT INTO `info_gerais_shield` (`ID_IG_Shield`, `ID_Modelo_FK`, `funcao`, `peso`, `temperaturaOperacao`, `tensaoOperacao`, `modo_consumo`) VALUES
(1, 1, 'Uso de Rede de telefonia celulares 3G / GSM', '20g', '-40Â°C atÃ© +85 Â°C', '3,3V / 5V', 'Baixo consumo de PotÃªncia - 1.5mA (em modo sleep)'),
(6, 7, 'Wifi', '', '', '5VDC ', 'Em torno de 180mA (Wireless LAN, pode ser diferente dependendo do USB dongle)');

-- --------------------------------------------------------

--
-- Estrutura da tabela `info_tecnicas_micro`
--

DROP TABLE IF EXISTS `info_tecnicas_micro`;
CREATE TABLE IF NOT EXISTS `info_tecnicas_micro` (
  `ID_Infor_Tecnicas` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Modelo_FK` int(3) DEFAULT NULL,
  `memoria_ram` varchar(100) DEFAULT NULL,
  `memoria_flash` varchar(100) DEFAULT NULL,
  `processador` varchar(100) DEFAULT NULL,
  `microcontrolador` varchar(100) DEFAULT NULL,
  `tempo_de_clock` int(5) DEFAULT NULL,
  `GPIO_A` int(5) DEFAULT NULL,
  `GPIO_D` int(5) DEFAULT NULL,
  PRIMARY KEY (`ID_Infor_Tecnicas`),
  KEY `ID_Modelo_FK` (`ID_Modelo_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `info_tecnicas_micro`
--

INSERT INTO `info_tecnicas_micro` (`ID_Infor_Tecnicas`, `ID_Modelo_FK`, `memoria_ram`, `memoria_flash`, `processador`, `microcontrolador`, `tempo_de_clock`, `GPIO_A`, `GPIO_D`) VALUES
(3, 3, '24 bytes ', '60', 'Uma ai', 'ATMega', 86, 6, 13),
(2, 2, '80 ', '60', 'Uma ai', 'nÃ£o tem', 86, 5, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `ID_Item` int(3) NOT NULL AUTO_INCREMENT,
  `nomeItem` varchar(300) DEFAULT NULL,
  `categoria` varchar(50) DEFAULT NULL,
  `palavraChave` varchar(300) DEFAULT NULL,
  `dimensao` varchar(30) DEFAULT NULL,
  `precoMedio` varchar(15) DEFAULT NULL,
  `infoAdicionais` text,
  `linkDataSheet` varchar(300) DEFAULT NULL,
  `img_componente` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Item`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item`
--

INSERT INTO `item` (`ID_Item`, `nomeItem`, `categoria`, `palavraChave`, `dimensao`, `precoMedio`, `infoAdicionais`, `linkDataSheet`, `img_componente`) VALUES
(28, 'Arduino Uno R3', 'microcontrolador', 'Arduino,Uno,R3', '10x20x30', '60,00', 'TEste', 'www.arduino.cc', 'upload/componente_da90329631fb6d168b69178de8798ce4.png'),
(2, 'Raspy Pi zero', 'microcontrolador', 'Raspberry, Pi zero, Wi-fi, baixo consumo', '10x20x30', '250,00', 'asdasdasdasd', 'www.raspberry.com', 'upload/componente_b4a06bb867bbe43405a5e72be111e870.jpg'),
(3, 'Bateria 9V NÃ£o RecaregÃ¡vel', 'bateria', 'Bateria, 9V, nÃ£o recarregÃ¡vel, comum', '10x20x30', '7,00', ' Sadasdasd ehehehe', 'www.duracel.com', 'upload/componente_3b17bf0d67d865608d1d1aee2bbadc4a.jpg'),
(4, 'Shield 3G com GPS SIM5320E', 'shield', 'Shield 3G, GPS,  SIM5320E, ArduÃ­no', '10x20x30', '.400,00', '                                             Este shield fornece uma maneira de usar a rede de telefones celulares 3G / GSM para receber dados de um local remoto. Ele possui integrados a ele as tecnologias 3G, GSM e GPRS com as quais vocÃª pode fazer uma ligaÃ§Ã£o, enviar e receber mensagens SMS e atÃ© mesmo usar a internet de um chip de celular. E para completar ele ainda possui integrado a ele um mÃ³dulo GPS para geolocalizaÃ§Ã£o e rastreamento de seu projeto. Todas estas funÃ§Ãµes juntas sÃ£o incrivelmente Ãºteis para diversas aplicaÃ§Ãµes. Este shield Ã© Quad-Band e trabalha nas seguintes frequÃªncias: EGSM 900MHz/DCS 1800MHz e GSM850 MHz/PCS 1900MHz . NÃ£o Ã© necessÃ¡rio alterar a banda de frequÃªncia para funcionar, ele vai configurado em modo All Band o que faz com que ele funcione em qualquer lugar do mundo.\r\na\r\n\r\nEste mÃ³dulo GSM / GPRS Ã© comandado atravÃ©s de comandos AT (GSM07.07 ,07.05 e SIMCOM). O shield ainda inclui uma antena de alto ganho onboard e utiliza um chip SIM5320 da SIMCom. Este mÃ³dulo possui um padrÃ£o de interface industrial.\r\n\r\nIMPORTANTE: \r\n\r\nComo o mÃ³dulo SIM5320 pode consumir atÃ© 2A MÃ¡ximo, este shield deve operar com alimentaÃ§Ã£o externa de  9VDC conectada em sua placa Arduino.\r\n\r\nCaso vocÃª esteja utilizando-o com Arduino MEGA2560 vocÃª deve connectar os pinos RX e TX do meio aos pinos RX1 e TX1 do Arduino MEGA2560 e alterar as configuraÃ§Ãµes em seu cÃ³digo.\r\n\r\nEste shield Ã© Quad-Band GSM-GPRS e Dual-Band 3G, sendo assim verifique a frequencia de atuaÃ§Ã£o HSPDA de sua operadora 3G em sua regiÃ£o se Ã© compatÃ­vel com as frequencias do shield.                                 :)       ', 'www.duracel.com', 'upload/componente_14297682aa26ee7af014ab16403202a4.jpg'),
(15, 'LED 50x50', 'atuador', 'LED, 50x50, RBG', '10x5', '0,25', '                                             Teste                                       ', 'http://www.baudaeletronica.com.br/shield-3g-gps-gsm-gprs.html', 'upload/componente_a922fb31be98494830d1bd740c804ed2.jpg'),
(19, 'Sensor Termico Temperatura Termistor Arduino K275 Lm393 Pic', 'sensor', 'Sensor, Termico, Temperatura', '32x14x6mm', '8,00', '                              O Sensor De Temperatura Termistor Arduino K275 Ã© um mÃ³dulo eletrÃ´nico utilizado como chave tÃ©rmica de seguranÃ§a em diversos tipos de projetos que demandam maior cuidado e proteÃ§Ã£o de determinados circuitos e/ou ambientes.\r\n- Muito eficiente, o MÃ³dulo Chave TÃ©rmica K275 Ã© composto por um pequeno NTC, um comparador LM393 e um potenciÃ´metro, onde permite ao projetista ajustar e selecionar determinada temperatura entre 20 e 80Â°C.\r\n- O Sensor De Temperatura Termistor Arduino K275 possui funcionamento simplificado e funcional, sendo que quando atingir a temperatura prÃ© ajustada ele vai variar sua saÃ­da (0 ou 1) ou vice versa, conforme for sua programaÃ§Ã£o, permitindo saber quando a temperatura de um circuito atinge o parÃ¢metro escolhido.\r\n- Muito prÃ¡tico, Sensor De Temperatura Termistor pode ser utilizado em conjunto com o Arduino, ou mesmo, dispensar o microcontrolador e utilizar diretamente junto a um mÃ³dulo relÃ©, por explo.                          ', 'https://produto.mercadolivre.com.br/MLB-925613765-sensor-termico-temperatura-termistor-arduino-k275-lm393-pic-_JM?quantity=1', 'upload/componente_65b5ca19052026eb7ef848d1ce050773.jpg'),
(20, 'Bateria / Pilha Samsung Original RecarregÃ¡vel', 'bateria', 'Bateria, Litium, recarregÃ¡vel', '20x20x30', '35,00', 'Teste para comparaÃ§Ã£o', 'www.duracel.com', 'upload/componente_572db92836e3623a3964c7a59d4cbcdb.jpg'),
(22, 'WiFi Shield para Arduino PHPoC ', 'shield', 'Shield Arduino, WiFi, Modulo WIFI', '', '.160,00', '               PHPoC WiFi Shield para Arduino Ã© uma placa que faz com que seu arduino se conecte rede Wi-Fi. Encaixe essa placa sobre o arduino e conecte um dongle WiFi. Depois de uma simples configuraÃ§Ã£o de rede, o Arduino estarÃ¡ conectado a Internet.\r\n\r\nA funÃ§Ã£o de rede neste shield Ã© baseada no protocolo TCP/IP usando um intÃ©rprete PHPoC. O shield pode ser facilmente acessado por uma biblioteca Phpoc. A bilbioteca Phpoc Ã© muito similar as bibliotecas WIFI. Portanto, os cÃ³digos fonte que existem nas bibliotecas Ethernet ou WIFI podem ser usadas apenas mudando alguma linhas. Ela Reduz ensaios e erros de experiÃªncias que eram usadas com shield WIFI.\r\n\r\nAlÃ©m disso a biblioteca Phpoc possui uma grande faixa de aplicaÃ§Ã£o pois suporta uma variedade de API (e.g. SSL, SSH, TELNET, Web socket, ESMTP, entre outros) ausentes das bibliotecas existentes.             ', 'https://www.phpoc.com/support/manual/p4s-347_user_manual/contents.php?id=overview', 'upload/componente_0b52ffdb0cc603bf8d225580a40a9a5a.jpg'),
(23, 'Sensor de DistÃ¢ncia XL MaxSonar EZ0/MB1200 - MaxBotix', 'sensor', 'Sensor de distÃ¢ncia, sensor ultrassÃ´nico', '2.2 x 2.0 x 1.5 cm', '.440,00', '               O Sensor XL-MaxSonar EZ0 oferece o mais largo e sensÃ­vel feixe ultrassÃ´nico de detecÃ§Ã£o. Possui corrente de consumo baixÃ­ssima. O XL MaxSonar EZ0 Ã© uma excelente escolha para detecÃ§Ã£o geral de objetos e pessoas. Ele Ã© capaz de detectar objetos de 0 a 7,65m. Objetos entre 0 e 25cm sÃ£o lidos como 25cm.\r\n\r\nO sensor EZ0 MB1200 junta potÃªncia acÃºstica em conjunto com um ganho continuamente variÃ¡vel, calibragem automÃ¡tica em tempo real, anÃ¡lise da assinatura digital das formas de onda e algoritmos de rejeiÃ§Ã£o de ruÃ­dos resultam em leituras de distÃ¢ncia virtualmente livres de ruÃ­dos para a maioria das aplicaÃ§Ãµes mesmo na presenÃ§a vÃ¡rias fontes de ruÃ­do elÃ©trico ou acÃºstico.\r\n\r\n \r\n\r\nDados TÃ©cnicos:\r\n\r\n- ResoluÃ§Ã£o de 1cm\r\n- FrequÃªncia de leitura: 10Hz\r\n- TrÃªs saÃ­das: analÃ³gica, RS232, largura de Pulso\r\n- Longa faixa de detecÃ§Ã£o: 0 a 7,65m\r\n- Sensor ultrasÃ´nico de 42 kHz\r\n- Sem Ã¡reas mortas (detecÃ§Ã£o de 0 atÃ© 25cm sÃ£o lidas como 25cm)\r\n- TensÃ£o de operaÃ§Ã£o: 3,3V - 5,5V\r\n- Baixo consumo de corrente: 3,4mA\r\n- Temperatura de operaÃ§Ã£o: -0ÂºC Ã  +65ÂºC\r\n- DimensÃµes: 2.2 x 2.0 x 1.5 cm\r\n- Peso: 4,3g             ', 'https://www.baudaeletronica.com.br/Documentos/I2CXL-MaxSonar-EZ_Datasheet.pdf', 'upload/componente_c7cfa9c023764420f7dbcad91ab9eb26.jpg'),
(24, 'Motor de Passo NEMA  4 - 42 kgf.cm / 4,20A', 'atuador', 'Motor de Passo, Motor ', '----', '315,00', 'Um motor de passo Ã© um dispositivo eletromecÃ¢nico que converte pulsos de energia elÃ©trica em movimentos discretos. O eixo do motor gira em â€œpassosâ€ quando pulsos elÃ©tricos sÃ£o aplicados na sequÃªncia correta. A rotaÃ§Ã£o do motor tem relaÃ§Ã£o direta com esses pulsos, a velocidade do motor de passo Ã© definida pela frequÃªncia com que esses pulsos sÃ£o enviados e o nÃºmero de voltas do eixo Ã© definida pela quantidade de pulsos.\r\n\r\nO dispositivo que faz o controle desses pulsos elÃ©tricos que sÃ£o enviados para o motor Ã© chamado driver, ou seja para o funcionamento do motor de passo Ã© necessÃ¡rio usar junto um gerador de pulsos e um driver.\r\n\r\nUm motor de passo pode ser uma boa escolha onde hÃ¡ necessidade de um movimento controlado. Podem ser utilizados onde Ã© preciso controlar o Ã¢ngulo de rotaÃ§Ã£o, velocidade, posiÃ§Ã£o e sincronismo. Por conta do seu modo de funcionamento, os motores de passo se estabeleceram em uma grande gama de aplicaÃ§Ãµes, como: Routers CNC, MÃ¡quinas de Corte a Plasma, MÃ¡quinas de Corte a Laser, Rotuladoras Sleeve, Rotuladoras Autoadesivo, MÃ¡quinas de serigrafia, MÃ¡quinas Hot Stamp, Controle de VÃ¡lvulas, Dosadores por Rosca, Mesas de Posicionamento, BraÃ§os Manipuladores, atuadores lineares etc.\r\n\r\nMotor de Passo Nema 34 AK34/42F8FN1.8 Ã© uma soluÃ§Ã£o que oferece o melhor custo benefÃ­cio quando se necessita de movimentaÃ§Ãµes com posicionamento preciso. Dada a sua robustez possui baixÃ­ssimo Ã­ndice de manutenÃ§Ã£o. Otimizado para trabalhar com resoluÃ§Ãµes de micropasso que garante uma precisÃ£o maior ao sistema de movimentaÃ§Ã£o.', 'https://www.baudaeletronica.com.br/Documentos/AK34-42F8FN1.8.pdf', 'upload/componente_e75df8e37b87fe3f7217e5ccd37e03a9.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_euma_bateria`
--

DROP TABLE IF EXISTS `item_euma_bateria`;
CREATE TABLE IF NOT EXISTS `item_euma_bateria` (
  `ID_eUma_BT` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Item_FK` int(3) NOT NULL,
  `ID_Bateria_FK` int(3) NOT NULL,
  PRIMARY KEY (`ID_eUma_BT`),
  KEY `ID_Item_FK` (`ID_Item_FK`),
  KEY `ID_Bateria_FK` (`ID_Bateria_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item_euma_bateria`
--

INSERT INTO `item_euma_bateria` (`ID_eUma_BT`, `ID_Item_FK`, `ID_Bateria_FK`) VALUES
(1, 3, 1),
(2, 20, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_eum_atuador`
--

DROP TABLE IF EXISTS `item_eum_atuador`;
CREATE TABLE IF NOT EXISTS `item_eum_atuador` (
  `ID_eUm` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Item_FK` int(3) NOT NULL,
  `ID_Atuador_FK` int(3) NOT NULL,
  PRIMARY KEY (`ID_eUm`),
  KEY `ID_Item_FK` (`ID_Item_FK`),
  KEY `ID_Atuador_FK` (`ID_Atuador_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item_eum_atuador`
--

INSERT INTO `item_eum_atuador` (`ID_eUm`, `ID_Item_FK`, `ID_Atuador_FK`) VALUES
(7, 15, 7),
(8, 24, 8);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_eum_micro`
--

DROP TABLE IF EXISTS `item_eum_micro`;
CREATE TABLE IF NOT EXISTS `item_eum_micro` (
  `ID_eUm` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Item_FK` int(3) NOT NULL,
  `ID_Micro_FK` int(3) NOT NULL,
  PRIMARY KEY (`ID_eUm`),
  KEY `ID_Item_FK` (`ID_Item_FK`),
  KEY `ID_Micro_FK` (`ID_Micro_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item_eum_micro`
--

INSERT INTO `item_eum_micro` (`ID_eUm`, `ID_Item_FK`, `ID_Micro_FK`) VALUES
(3, 28, 22),
(2, 2, 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_eum_sensor`
--

DROP TABLE IF EXISTS `item_eum_sensor`;
CREATE TABLE IF NOT EXISTS `item_eum_sensor` (
  `ID_eUm` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Item_FK` int(3) NOT NULL,
  `ID_Sensor_FK` int(3) NOT NULL,
  PRIMARY KEY (`ID_eUm`),
  KEY `ID_Item_FK` (`ID_Item_FK`),
  KEY `ID_Sensor_FK` (`ID_Sensor_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item_eum_sensor`
--

INSERT INTO `item_eum_sensor` (`ID_eUm`, `ID_Item_FK`, `ID_Sensor_FK`) VALUES
(2, 17, 2),
(4, 19, 4),
(5, 23, 5);

-- --------------------------------------------------------

--
-- Estrutura da tabela `item_eum_shield`
--

DROP TABLE IF EXISTS `item_eum_shield`;
CREATE TABLE IF NOT EXISTS `item_eum_shield` (
  `ID_eUm` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Item_FK` int(3) NOT NULL,
  `ID_Shield_FK` int(3) NOT NULL,
  PRIMARY KEY (`ID_eUm`),
  KEY `ID_Item_FK` (`ID_Item_FK`),
  KEY `ID_Shield_FK` (`ID_Shield_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `item_eum_shield`
--

INSERT INTO `item_eum_shield` (`ID_eUm`, `ID_Item_FK`, `ID_Shield_FK`) VALUES
(1, 4, 1),
(7, 22, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens_favoritos`
--

DROP TABLE IF EXISTS `itens_favoritos`;
CREATE TABLE IF NOT EXISTS `itens_favoritos` (
  `ID_Favoritos` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Usuario_FK` int(3) NOT NULL,
  `ID_Item_FK` int(3) NOT NULL,
  PRIMARY KEY (`ID_Favoritos`),
  KEY `ID_Item_FK` (`ID_Item_FK`),
  KEY `ID_Usuario_FK` (`ID_Usuario_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `itens_favoritos`
--

INSERT INTO `itens_favoritos` (`ID_Favoritos`, `ID_Usuario_FK`, `ID_Item_FK`) VALUES
(40, 13, 28),
(43, 20, 2),
(39, 13, 4),
(41, 13, 2),
(42, 20, 28),
(36, 13, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `microcontrolador`
--

DROP TABLE IF EXISTS `microcontrolador`;
CREATE TABLE IF NOT EXISTS `microcontrolador` (
  `ID_Microcontrolador` int(3) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`ID_Microcontrolador`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `microcontrolador`
--

INSERT INTO `microcontrolador` (`ID_Microcontrolador`, `tipo`) VALUES
(22, 'Arduino'),
(21, 'Raspy');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo_atuador`
--

DROP TABLE IF EXISTS `modelo_atuador`;
CREATE TABLE IF NOT EXISTS `modelo_atuador` (
  `ID_Modelo_Atuador` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Atuador_FK` int(3) NOT NULL,
  `tipo` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_Modelo_Atuador`),
  KEY `ID_Atuador_FK` (`ID_Atuador_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelo_atuador`
--

INSERT INTO `modelo_atuador` (`ID_Modelo_Atuador`, `ID_Atuador_FK`, `tipo`) VALUES
(7, 7, '50x50'),
(8, 8, '4 - 42 kgf.cm / 4,20A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo_bateria`
--

DROP TABLE IF EXISTS `modelo_bateria`;
CREATE TABLE IF NOT EXISTS `modelo_bateria` (
  `ID_Modelo_BT` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Bateria_FK` int(3) NOT NULL,
  `tipo` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_Modelo_BT`),
  KEY `ID_Bateria_FK` (`ID_Bateria_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelo_bateria`
--

INSERT INTO `modelo_bateria` (`ID_Modelo_BT`, `ID_Bateria_FK`, `tipo`) VALUES
(1, 1, 'NÃ£o RecaregÃ¡vel'),
(2, 2, 'RecarregÃ¡vel');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo_micro`
--

DROP TABLE IF EXISTS `modelo_micro`;
CREATE TABLE IF NOT EXISTS `modelo_micro` (
  `ID_Modelo_Micro` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Microcontrolador_FK` int(3) DEFAULT NULL,
  `nome` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`ID_Modelo_Micro`),
  KEY `ID_Microcontrolador_FK` (`ID_Microcontrolador_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelo_micro`
--

INSERT INTO `modelo_micro` (`ID_Modelo_Micro`, `ID_Microcontrolador_FK`, `nome`) VALUES
(3, 22, 'Uno R3'),
(2, 21, 'Pi zero');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo_sensor`
--

DROP TABLE IF EXISTS `modelo_sensor`;
CREATE TABLE IF NOT EXISTS `modelo_sensor` (
  `ID_Modelo_Sensor` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Sensor_FK` int(3) NOT NULL,
  `tipo` varchar(150) NOT NULL,
  PRIMARY KEY (`ID_Modelo_Sensor`),
  KEY `ID_Sensor_FK` (`ID_Sensor_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelo_sensor`
--

INSERT INTO `modelo_sensor` (`ID_Modelo_Sensor`, `ID_Sensor_FK`, `tipo`) VALUES
(4, 4, 'K275 Lm393 Pic'),
(5, 5, 'MaxSonar EZ0/MB1200 - MaxBotix');

-- --------------------------------------------------------

--
-- Estrutura da tabela `modelo_shield`
--

DROP TABLE IF EXISTS `modelo_shield`;
CREATE TABLE IF NOT EXISTS `modelo_shield` (
  `ID_Modelo_shield` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Shield_FK` int(3) NOT NULL,
  `tipo` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Modelo_shield`),
  KEY `ID_Shield_FK` (`ID_Shield_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modelo_shield`
--

INSERT INTO `modelo_shield` (`ID_Modelo_shield`, `ID_Shield_FK`, `tipo`) VALUES
(1, 1, 'SIM5320E'),
(7, 7, 'PHPoC ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

DROP TABLE IF EXISTS `projeto`;
CREATE TABLE IF NOT EXISTS `projeto` (
  `ID_Projeto` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(300) NOT NULL,
  `autor_principal` varchar(300) DEFAULT NULL,
  `email_autor_principal` varchar(300) DEFAULT NULL,
  `nome_demais_autores` varchar(600) NOT NULL,
  `email_demais_autores` varchar(600) NOT NULL,
  `img_projeto` varchar(300) DEFAULT NULL,
  `link_repo` varchar(300) NOT NULL,
  `link_site` varchar(300) DEFAULT NULL,
  `link_video` varchar(300) NOT NULL,
  `palavra_chave` varchar(300) NOT NULL,
  `media_avaliacao` int(10) DEFAULT '0',
  `metodologia` text,
  PRIMARY KEY (`ID_Projeto`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projeto`
--

INSERT INTO `projeto` (`ID_Projeto`, `nome`, `autor_principal`, `email_autor_principal`, `nome_demais_autores`, `email_demais_autores`, `img_projeto`, `link_repo`, `link_site`, `link_video`, `palavra_chave`, `media_avaliacao`, `metodologia`) VALUES
(3, 'SKETCHUMENT', 'Felipe CalegÃ¡rio ', 'calegario@cin.ufpe.br', 'Giordano Cabral, Geber Ramalho', 'grec@cin.ufpe.br, geber@cin.ufpe.br', 'upload/componente_10da461080d1e28fe963fceca7b6ed60.jpg', 'https://github.com/michaellopes16/Plataforma-para-cataloga-o-colaborativa-de-componentes-Eletr-nicos', 'http://www.mustic.info/project/sketchument/', 'https://www.youtube.com/watch?v=6lnilz-bem8 ', 'SKETCHUMENT, DMI, Mustic', 0, '  TEste'),
(6, 'ViolÃ£o LED', 'Girordano Cabral     ', 'grec@cin.ufpe.br', 'Geber Ramalho', 'geber@cin.ufpe.br', 'upload/componente_de00e839d59f16cc3d0305ddac498736.jpg', 'https://github.com/michaellopes16/Plataforma-para-cataloga-o-colaborativa-de-componentes-Eletr-nicos', 'http://www.mustic.info/project/sketchument/', 'https://www.youtube.com/watch?v=6lnilz-bem8     ', 'ViolÃ£o LED, Arduino, Wifi', 0, '          Teste5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `projetos_favoritos`
--

DROP TABLE IF EXISTS `projetos_favoritos`;
CREATE TABLE IF NOT EXISTS `projetos_favoritos` (
  `ID_Favoritos` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Usuario_FK` int(3) NOT NULL,
  `ID_Projeto_FK` int(3) NOT NULL,
  PRIMARY KEY (`ID_Favoritos`),
  KEY `ID_Item_FK` (`ID_Projeto_FK`),
  KEY `ID_Usuario_FK` (`ID_Usuario_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projetos_favoritos`
--

INSERT INTO `projetos_favoritos` (`ID_Favoritos`, `ID_Usuario_FK`, `ID_Projeto_FK`) VALUES
(23, 13, 3),
(22, 13, 6),
(20, 13, 20),
(21, 13, 28),
(24, 20, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_tem_item`
--

DROP TABLE IF EXISTS `projeto_tem_item`;
CREATE TABLE IF NOT EXISTS `projeto_tem_item` (
  `ID_Tem_I` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Item_FK` int(3) NOT NULL,
  `ID_Projeto_FK` int(3) NOT NULL,
  PRIMARY KEY (`ID_Tem_I`),
  KEY `ID_Item_FK` (`ID_Item_FK`),
  KEY `ID_Projeto_FK` (`ID_Projeto_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projeto_tem_item`
--

INSERT INTO `projeto_tem_item` (`ID_Tem_I`, `ID_Item_FK`, `ID_Projeto_FK`) VALUES
(34, 28, 6),
(23, 2, 3),
(22, 15, 3),
(33, 3, 6),
(32, 22, 6),
(31, 2, 6);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto_tem_usuario`
--

DROP TABLE IF EXISTS `projeto_tem_usuario`;
CREATE TABLE IF NOT EXISTS `projeto_tem_usuario` (
  `ID_PTU` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Projeto_FK` int(3) NOT NULL,
  `ID_Usuario_FK` int(3) NOT NULL,
  `data_insercao` datetime DEFAULT NULL,
  PRIMARY KEY (`ID_PTU`),
  KEY `ID_Projeto_FK` (`ID_Projeto_FK`),
  KEY `ID_Usuario_FK` (`ID_Usuario_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `projeto_tem_usuario`
--

INSERT INTO `projeto_tem_usuario` (`ID_PTU`, `ID_Projeto_FK`, `ID_Usuario_FK`, `data_insercao`) VALUES
(3, 3, 13, '2018-12-04 17:30:51'),
(6, 6, 13, '2018-12-18 15:25:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sensor`
--

DROP TABLE IF EXISTS `sensor`;
CREATE TABLE IF NOT EXISTS `sensor` (
  `ID_Sensor` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(300) NOT NULL,
  PRIMARY KEY (`ID_Sensor`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sensor`
--

INSERT INTO `sensor` (`ID_Sensor`, `nome`) VALUES
(4, 'Sensor Termico Temperatura Termistor Arduino'),
(5, 'Sensor de DistÃ¢ncia XL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sensor_e_compativel`
--

DROP TABLE IF EXISTS `sensor_e_compativel`;
CREATE TABLE IF NOT EXISTS `sensor_e_compativel` (
  `ID_E_Comp` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Item_FK` int(3) NOT NULL,
  `ID_Sensor_FK` int(3) NOT NULL,
  PRIMARY KEY (`ID_E_Comp`),
  KEY `ID_Item_FK` (`ID_Item_FK`),
  KEY `ID_Sensor_FK` (`ID_Sensor_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `sensor_e_compativel`
--

INSERT INTO `sensor_e_compativel` (`ID_E_Comp`, `ID_Item_FK`, `ID_Sensor_FK`) VALUES
(12, 28, 23),
(11, 2, 23);

-- --------------------------------------------------------

--
-- Estrutura da tabela `shield`
--

DROP TABLE IF EXISTS `shield`;
CREATE TABLE IF NOT EXISTS `shield` (
  `ID_Shield` int(3) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Shield`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `shield`
--

INSERT INTO `shield` (`ID_Shield`, `nome`) VALUES
(1, 'Shield 3G com GPS'),
(7, 'WiFi Shield para Arduino');

-- --------------------------------------------------------

--
-- Estrutura da tabela `shield_e_compativel`
--

DROP TABLE IF EXISTS `shield_e_compativel`;
CREATE TABLE IF NOT EXISTS `shield_e_compativel` (
  `ID_E_Comp` int(3) NOT NULL AUTO_INCREMENT,
  `ID_Item_FK` int(3) NOT NULL,
  `ID_Shield_FK` int(3) NOT NULL,
  PRIMARY KEY (`ID_E_Comp`),
  KEY `ID_Item_FK` (`ID_Item_FK`),
  KEY `ID_SHield_FK` (`ID_Shield_FK`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `shield_e_compativel`
--

INSERT INTO `shield_e_compativel` (`ID_E_Comp`, `ID_Item_FK`, `ID_Shield_FK`) VALUES
(6, 2, 7),
(8, 2, 8),
(13, 2, 4),
(17, 28, 22);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `ID_Usuario` int(3) NOT NULL AUTO_INCREMENT,
  `nomeUsuario` varchar(50) DEFAULT NULL,
  `primeiroNome` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `sobreNome` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `email` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `senha` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`ID_Usuario`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`ID_Usuario`, `nomeUsuario`, `primeiroNome`, `sobreNome`, `email`, `senha`) VALUES
(1, 'Teste123', 'Teste', 'SobrenomeTeste', 'teste@gmail.com', '123456'),
(2, 'michaellb', 'Michael', 'Bastos', 'michaellb16@asd', '123'),
(4, 'michaellb162', 'Michael', 'Bastos', 'm@l', '123'),
(18, 'micha', 'Michael Lopes', '', 'micha@windowslive.com', ''),
(20, 'michaellb16', 'Michael', ' Lopes', 'michaellb16@windowslive.com', '1939334252782241'),
(11, 'michaellb16123', 'Michael', 'Bastos', 'michaellb17@gmail.com', '123'),
(13, 'mlb16', 'Michael', 'Bastos', 'michaellb17@gmail.com', '123'),
(16, 'michaellb', '', '', '', '090865'),
(17, 'mick2', 'MICHAEL', 'BASTOS', 'michaellb17@gmail.com', '123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

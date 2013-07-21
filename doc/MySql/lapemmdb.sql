-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 
-- Versão do Servidor: 5.5.24-log
-- Versão do PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `lapemmdb`
--
CREATE DATABASE `lapemmdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `lapemmdb`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionalidade`
--

CREATE TABLE IF NOT EXISTS `funcionalidade` (
  `ide_funcionalidade` int(11) NOT NULL AUTO_INCREMENT,
  `nom_funcionalidade` varchar(60) NOT NULL,
  `des_funcionalidade` text NOT NULL,
  `des_status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ide_funcionalidade`),
  UNIQUE KEY `nom_funcionalidade_UNIQUE` (`nom_funcionalidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `funcionalidade`
--

INSERT INTO `funcionalidade` (`ide_funcionalidade`, `nom_funcionalidade`, `des_funcionalidade`, `des_status`) VALUES
(1, 'Usuario_listar', 'Lista de Usuarios', 'A'),
(2, 'Usuario_cadastrar', 'Cadastro de Usuarios', 'A'),
(3, 'Usuario_editar', 'Edição de Usuarios', 'A'),
(4, 'Integrante_listar', 'Lista de Integrantes', 'A'),
(5, 'Integrante_cadastrar', 'Cadastro de Integrantes', 'A'),
(6, 'Integrante_editar', 'Edição de Integrantes', 'A'),
(7, 'Perfil_listar', 'Lista de Perfis', 'A'),
(8, 'Perfil_cadastrar', 'Cadastro de Perfis', 'A'),
(9, 'Perfil_editar', 'Edição de Perfis', 'A'),
(10, 'Funcionalidade_listar', 'Lista Funcionalidades', 'A'),
(11, 'Funcionalidade_cadastrar', 'Cadastro de Funcionalidades', 'A'),
(12, 'Funcionalidade_editar', 'Edição de Funcionalidades', 'A'),
(13, 'LinhaDePesquisa_listar', 'Lista de Linha de Pesquisa', 'A'),
(14, 'LinhaDePesquisa_cadastrar', 'Cadastro de Linha de Pesquisa', 'A'),
(15, 'LinhaDePesquisa_editar', 'Edição da Linha de Pesquisa', 'A'),
(16, 'Projeto_listar', 'Lista de Projetos', 'A'),
(17, 'Projeto_cadastrar', 'Cadastro de Projetos', 'A'),
(18, 'Projeto_editar', 'Edição de projetos', 'A'),
(19, 'Publicacao_cadastrar', 'Cadastro de Publicação', 'A'),
(20, 'Publicacao_editar', 'Edição de Publicação', 'A'),
(21, 'Publicacao_listar', 'Listar Publicação', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `integrante`
--

CREATE TABLE IF NOT EXISTS `integrante` (
  `ide_integrante` int(11) NOT NULL AUTO_INCREMENT,
  `num_cpf` varchar(45) NOT NULL,
  `nom_integrante` varchar(120) NOT NULL,
  `dat_nascimnto` varchar(8) NOT NULL,
  `des_email` varchar(120) NOT NULL,
  `ide_titulacao` int(11) NOT NULL,
  `des_lattes` varchar(150) DEFAULT NULL,
  `nom_foto` varchar(115) DEFAULT NULL,
  `des_telefone` varchar(10) DEFAULT NULL,
  `des_celular` varchar(10) DEFAULT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` int(11) NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` int(11) DEFAULT NULL,
  `des_status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ide_integrante`),
  UNIQUE KEY `nom_integrante_UNIQUE` (`nom_integrante`),
  UNIQUE KEY `num_cpf_UNIQUE` (`num_cpf`),
  UNIQUE KEY `des_email_UNIQUE` (`des_email`),
  KEY `fk_integrante_titulacao1_idx` (`ide_titulacao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `integrante`
--

INSERT INTO `integrante` (`ide_integrante`, `num_cpf`, `nom_integrante`, `dat_nascimnto`, `des_email`, `ide_titulacao`, `des_lattes`, `nom_foto`, `des_telefone`, `des_celular`, `ide_usuario_criador`, `dat_criacao`, `ide_usuario_atualizador`, `dat_atualizacao`, `des_status`) VALUES
(1, '01337940593', 'IGOR DA HORA SANTOS', '19850213', 'igordahora@gmail.com', 1, 'http://www.lattes.com.br?lattes=3', NULL, '7133079472', '7186220139', 1, 1373232547, 1, 1373232704, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `linhadepesquisa`
--

CREATE TABLE IF NOT EXISTS `linhadepesquisa` (
  `ide_linhadepesquisa` int(11) NOT NULL AUTO_INCREMENT,
  `nom_linha` varchar(120) NOT NULL,
  `des_linha` varchar(250) NOT NULL,
  `pub_linha` text NOT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` int(11) NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` int(11) DEFAULT NULL,
  `des_status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ide_linhadepesquisa`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `linhadepesquisa`
--

INSERT INTO `linhadepesquisa` (`ide_linhadepesquisa`, `nom_linha`, `des_linha`, `pub_linha`, `ide_usuario_criador`, `dat_criacao`, `ide_usuario_atualizador`, `dat_atualizacao`, `des_status`) VALUES
(1, 'Estudo fitoquímico e avaliação da atividade biológica', 'Estudo fitoquímico e avaliação da atividade biológica', '<div align="justify"><font face="arial" size="3"><u><b>Objetivo</b></u><br><br>Estabelecer a composição química de micro moléculas presentes em plantas que apresentem as seguintes atividades biológicas:<br></font><blockquote><font face="arial" size="3">a) Atividade antifúngica e / ou antibacteriana ou moduladora da resistência.<br></font></blockquote><blockquote><font face="arial" size="3">b) Capazes de atuar promovendo o crescimento ou diferenciação sobre cultura de astrócitos e glioblastomas. <br></font></blockquote><blockquote><font face="arial" size="3">c) Avaliar a influência de extratos e substâncias isoladas na atividade da Pgp. Buscando de identificar produtos naturais capazes de afetar a farmacocinética de seus substratos.</font><br></blockquote></div>', 1, 1373339368, 1, 1373340937, 'A'),
(2, 'Planejamento de fármacos contra doenças tropicais', 'Planejamento de fármacos contra doenças tropicais', '<div align="justify"><font size="3"><u><b>Objetivo</b></u><br><br>Utilizar ferramentas computacionais para racionalizar as relações estrutura atividade de moléculas bioativas consideradas candidatas a protótipos de novos fármacos contra doenças tropicais. Os conjuntos de inibidores identificados, contendo os dados de estrutura e atividade inibitória correspondentes, organizados e classificados, serão a base científica para os estudos de modelagem molecular e o desenvolvimento de modelos de QSAR e QSAR-3D preditivos.<br></font></div>', 1, 1373340928, NULL, NULL, 'A'),
(3, 'Técnicas computacionais no planejamento de Fármacos', 'Técnicas computacionais no planejamento de Fármacos', '<div align="justify"><font size="3"><u><b>Objetivo<br><br></b></u></font><div align="justify"><blockquote><font size="3">a) Predição da estrutura de proteínas e de complexos moleculares;</font><br><br><font size="3">b) Desenho computacional de fármacos para inibição de enzimas no combate à esquistossomose, leishmaniose, doença de chagas e doença do sono.</font><br></blockquote></div></div>', 1, 1373341021, 1, 1373341100, 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE IF NOT EXISTS `perfil` (
  `ide_perfil` int(11) NOT NULL AUTO_INCREMENT,
  `nom_perfil` varchar(50) NOT NULL,
  `des_perfil` text NOT NULL,
  `des_status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ide_perfil`),
  UNIQUE KEY `nome_perfil_UNIQUE` (`nom_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`ide_perfil`, `nom_perfil`, `des_perfil`, `des_status`) VALUES
(1, 'ADMINISTRADOR', 'Adm', 'A');

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil__funcionalidade`
--

CREATE TABLE IF NOT EXISTS `perfil__funcionalidade` (
  `ide_perfil` int(11) NOT NULL,
  `ide_funcionalidade` int(11) NOT NULL,
  PRIMARY KEY (`ide_perfil`,`ide_funcionalidade`),
  KEY `fk_perfil_has_funcionalidade_funcionalidade1_idx` (`ide_funcionalidade`),
  KEY `fk_perfil_has_funcionalidade_perfil_idx` (`ide_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfil__funcionalidade`
--

INSERT INTO `perfil__funcionalidade` (`ide_perfil`, `ide_funcionalidade`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21);

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil__responsabilidade`
--

CREATE TABLE IF NOT EXISTS `perfil__responsabilidade` (
  `ide_perfil` int(11) NOT NULL,
  `ide_perfil_responsavel` int(11) NOT NULL,
  PRIMARY KEY (`ide_perfil`,`ide_perfil_responsavel`),
  KEY `fk_perfil_has_perfil_perfil2_idx` (`ide_perfil_responsavel`),
  KEY `fk_perfil_has_perfil_perfil1_idx` (`ide_perfil`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfil__responsabilidade`
--

INSERT INTO `perfil__responsabilidade` (`ide_perfil`, `ide_perfil_responsavel`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `projeto`
--

CREATE TABLE IF NOT EXISTS `projeto` (
  `ide_projeto` int(11) NOT NULL AUTO_INCREMENT,
  `ide_linhadepesquisa` int(11) NOT NULL,
  `nom_projeto` varchar(120) NOT NULL,
  `des_projeto` varchar(250) NOT NULL,
  `pub_projeto` text NOT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` int(11) NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` int(11) DEFAULT NULL,
  `des_status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ide_projeto`,`ide_linhadepesquisa`),
  KEY `fk_projeto_linhadepesquisa1_idx` (`ide_linhadepesquisa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `publicacao`
--

CREATE TABLE IF NOT EXISTS `publicacao` (
  `ide_publicacao` int(11) NOT NULL AUTO_INCREMENT,
  `ide_tipo_publicacao` int(11) NOT NULL,
  `des_publicacao` text,
  `nom_titulo` varchar(120) NOT NULL,
  `dat_publicacao` varchar(8) NOT NULL,
  `nom_autor` varchar(120) NOT NULL,
  `pub_referencia` varchar(120) DEFAULT NULL,
  `link_referencia` varchar(300) DEFAULT NULL,
  `path_imagem` varchar(120) DEFAULT NULL,
  `path_arquivo` varchar(120) DEFAULT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ide_usuario_atualizacao` int(11) DEFAULT NULL,
  `dat_atualizacao` int(11) DEFAULT NULL,
  `des_status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ide_publicacao`),
  KEY `fk_publicacao_tipo_publicacao1_idx` (`ide_tipo_publicacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_publicacao`
--

CREATE TABLE IF NOT EXISTS `tipo_publicacao` (
  `ide_tipo_publicacao` int(11) NOT NULL AUTO_INCREMENT,
  `nom_tipo_publicacao` varchar(120) NOT NULL,
  `path_imagem` varchar(120) NOT NULL,
  PRIMARY KEY (`ide_tipo_publicacao`),
  UNIQUE KEY `nom_tipo_publicacao_UNIQUE` (`nom_tipo_publicacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `titulacao`
--

CREATE TABLE IF NOT EXISTS `titulacao` (
  `ide_titulacao` int(11) NOT NULL AUTO_INCREMENT,
  `nom_titulacao` varchar(80) NOT NULL,
  `des_titulacao` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ide_titulacao`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `titulacao`
--

INSERT INTO `titulacao` (`ide_titulacao`, `nom_titulacao`, `des_titulacao`) VALUES
(1, 'Aluno', 'Aluno');

-- --------------------------------------------------------

--
-- Estrutura da tabela `token`
--

CREATE TABLE IF NOT EXISTS `token` (
  `ide_token` int(11) NOT NULL AUTO_INCREMENT,
  `des_token` varchar(200) NOT NULL,
  `data_validade` int(11) NOT NULL,
  `des_senha_autenticacao` varchar(32) NOT NULL,
  `tentativas` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ide_token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `ide_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nom_usuario` varchar(80) NOT NULL,
  `email` varchar(120) NOT NULL,
  `des_senha` varchar(32) NOT NULL,
  `avatar` varchar(115) DEFAULT NULL,
  `ide_perfil` int(11) NOT NULL,
  `num_acessos` int(11) DEFAULT '0',
  `try_logon` int(11) DEFAULT '0',
  `dat_try_logon` int(11) DEFAULT '0',
  `dat_ultimo_acesso` int(11) DEFAULT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` int(11) NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` int(11) DEFAULT NULL,
  `des_status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ide_usuario`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `fk_usuario_perfil1_idx` (`ide_perfil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`ide_usuario`, `nom_usuario`, `email`, `des_senha`, `avatar`, `ide_perfil`, `num_acessos`, `try_logon`, `dat_try_logon`, `dat_ultimo_acesso`, `ide_usuario_criador`, `dat_criacao`, `ide_usuario_atualizador`, `dat_atualizacao`, `des_status`) VALUES
(1, 'IGOR DA HORA SANTOS', 'igordahora@gmail.com', 'dcb15ce9052a80a2d6537fcd2f8f0768', NULL, 1, 21, 0, 0, 1374357250, 1, 0, NULL, NULL, 'A'),
(2, 'EDISON', 'edison@capacidadeevolutiva.com.br', 'd71bb00a7e194c13110cad3aece8ed7f', NULL, 1, 0, 0, 0, NULL, 1, 1372902569, 1, 1372903314, 'A');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `integrante`
--
ALTER TABLE `integrante`
  ADD CONSTRAINT `fk_integrante_titulacao1` FOREIGN KEY (`ide_titulacao`) REFERENCES `titulacao` (`ide_titulacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `perfil__funcionalidade`
--
ALTER TABLE `perfil__funcionalidade`
  ADD CONSTRAINT `fk_perfil_has_funcionalidade_funcionalidade1` FOREIGN KEY (`ide_funcionalidade`) REFERENCES `funcionalidade` (`ide_funcionalidade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_perfil_has_funcionalidade_perfil` FOREIGN KEY (`ide_perfil`) REFERENCES `perfil` (`ide_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `perfil__responsabilidade`
--
ALTER TABLE `perfil__responsabilidade`
  ADD CONSTRAINT `fk_perfil_has_perfil_perfil1` FOREIGN KEY (`ide_perfil`) REFERENCES `perfil` (`ide_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_perfil_has_perfil_perfil2` FOREIGN KEY (`ide_perfil_responsavel`) REFERENCES `perfil` (`ide_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `projeto`
--
ALTER TABLE `projeto`
  ADD CONSTRAINT `fk_projeto_linhadepesquisa1` FOREIGN KEY (`ide_linhadepesquisa`) REFERENCES `linhadepesquisa` (`ide_linhadepesquisa`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `publicacao`
--
ALTER TABLE `publicacao`
  ADD CONSTRAINT `fk_publicacao_tipo_publicacao1` FOREIGN KEY (`ide_tipo_publicacao`) REFERENCES `tipo_publicacao` (`ide_tipo_publicacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`ide_perfil`) REFERENCES `perfil` (`ide_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

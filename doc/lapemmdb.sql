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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `funcionalidade`
--

INSERT INTO `funcionalidade` (`ide_funcionalidade`, `nom_funcionalidade`, `des_funcionalidade`, `des_status`) VALUES
(1, 'Usuario_listar', 'Lista de Usuarios', 'A'),
(2, 'Usuario_cadastrar', 'Cadastro de Usuarios', 'A'),
(3, 'Usuario_editar', 'Edição de Usuarios', 'A');

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
  `des_lattes` varchar(150) DEFAULT NULL,
  `ide_titualacao` int(11) NOT NULL,
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
  KEY `fk_integrante_titulacao1_idx` (`ide_titualacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `linhadepesquisa`
--

CREATE TABLE IF NOT EXISTS `linhadepesquisa` (
  `ide_linhadepesquisa` int(11) NOT NULL AUTO_INCREMENT,
  `nom_linha` varchar(120) NOT NULL,
  `des_linha` text NOT NULL,
  `ide_usuario_criador` int(11) NOT NULL,
  `dat_criacao` int(11) NOT NULL,
  `ide_usuario_atualizador` int(11) DEFAULT NULL,
  `dat_atualizacao` int(11) DEFAULT NULL,
  `des_status` char(1) NOT NULL DEFAULT 'A',
  PRIMARY KEY (`ide_linhadepesquisa`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(1, 3);

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
  `des_projeto` text NOT NULL,
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
-- Estrutura da tabela `titulacao`
--

CREATE TABLE IF NOT EXISTS `titulacao` (
  `ide_titualacao` int(11) NOT NULL AUTO_INCREMENT,
  `nom_titualcao` varchar(80) NOT NULL,
  `des_titualcao` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`ide_titualacao`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
(1, 'IGOR DA HORA SANTOS', 'igordahora@gmail.com', 'dcb15ce9052a80a2d6537fcd2f8f0768', NULL, 1, 4, 0, 0, 1373155413, 1, 0, NULL, NULL, 'A'),
(2, 'EDISON', 'edison@capacidadeevolutiva.com.br', 'd71bb00a7e194c13110cad3aece8ed7f', NULL, 1, 0, 0, 0, NULL, 1, 1372902569, 1, 1372903314, 'A');

--
-- Restrições para as tabelas dumpadas
--

--
-- Restrições para a tabela `integrante`
--
ALTER TABLE `integrante`
  ADD CONSTRAINT `fk_integrante_titulacao1` FOREIGN KEY (`ide_titualacao`) REFERENCES `titulacao` (`ide_titualacao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
-- Restrições para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_perfil1` FOREIGN KEY (`ide_perfil`) REFERENCES `perfil` (`ide_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

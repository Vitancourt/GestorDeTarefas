-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 26/04/2017 às 12:05
-- Versão do servidor: 5.7.17-0ubuntu0.16.04.2
-- Versão do PHP: 7.0.15-0ubuntu0.16.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- -----------------------------------------------------
-- Schema txai
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema txai
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `txai` DEFAULT CHARACTER SET latin1 COLLATE latin1_bin ;
USE `txai` ;

--
-- Banco de dados: `txai`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbTarefa`
--

CREATE TABLE `tbTarefa` (
  `id` int(11) NOT NULL,
  `descricao` varchar(200) COLLATE latin1_bin NOT NULL,
  `data` date NOT NULL,
  `feito` int(11) NOT NULL,
  `tbUsuario_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbUsuario`
--

CREATE TABLE `tbUsuario` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) COLLATE latin1_bin NOT NULL,
  `senha` varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Fazendo dump de dados para tabela `tbUsuario`
--

INSERT INTO `tbUsuario` (`id`, `usuario`, `senha`) VALUES
(1, 'txai', 'e10adc3949ba59abbe56e057f20f883e');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tbTarefa`
--
ALTER TABLE `tbTarefa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tbTarefa_tbUsuario_idx` (`tbUsuario_id`);

--
-- Índices de tabela `tbUsuario`
--
ALTER TABLE `tbUsuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tbTarefa`
--
ALTER TABLE `tbTarefa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de tabela `tbUsuario`
--
ALTER TABLE `tbUsuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tbTarefa`
--
ALTER TABLE `tbTarefa`
  ADD CONSTRAINT `fk_tbTarefa_tbUsuario` FOREIGN KEY (`tbUsuario_id`) REFERENCES `tbUsuario` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

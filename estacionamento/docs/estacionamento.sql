-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 27/07/2019 às 17:19
-- Versão do servidor: 10.3.15-MariaDB
-- Versão do PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estacionamento`
--
CREATE DATABASE IF NOT EXISTS `estacionamento` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `estacionamento`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE `clientes` (
  `cliente_id` int(11) NOT NULL,
  `cliente_nome` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_telefone` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_email` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopping_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `clientes`:
--   `shopping_id`
--       `shoppings` -> `shopping_id`
--

--
-- Despejando dados para a tabela `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `cliente_nome`, `cliente_telefone`, `cliente_email`, `shopping_id`) VALUES
(1, 'Francisco das Chagas', '99999999999', 'francisco@exemplo.com.br', 1),
(2, 'Saulo Silva', '99999999999', 'saulo@exemplo.com.br', 1),
(3, 'José Edcarlos', '99999999999', 'edcarlos@exemplo.com.br', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `shoppings`
--

DROP TABLE IF EXISTS `shoppings`;
CREATE TABLE `shoppings` (
  `shopping_id` int(11) NOT NULL,
  `shopping_nome` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopping_endereco` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `shoppings`:
--

--
-- Despejando dados para a tabela `shoppings`
--

INSERT INTO `shoppings` (`shopping_id`, `shopping_nome`, `shopping_endereco`) VALUES
(1, 'Shopping Iguatemi Fortaleza', 'Av. Washington Soares, 85 - Edson Queiroz, Fortaleza - CE, 60810-060'),
(2, 'Shopping Parangaba', 'Rua Germano Franck, 300 - Parangaba, Fortaleza - CE, 06074-020');

-- --------------------------------------------------------

--
-- Estrutura para tabela `vagas`
--

DROP TABLE IF EXISTS `vagas`;
CREATE TABLE `vagas` (
  `vaga_id` int(11) NOT NULL,
  `vaga_numero` int(11) NOT NULL,
  `vaga_disponibilidade` enum('desocupada','ocupada') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'desocupada',
  `vaga_modalidade` enum('livre','idoso','gestante','pcd') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'livre',
  `cliente_id` int(11) DEFAULT NULL,
  `shopping_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `vagas`:
--   `cliente_id`
--       `clientes` -> `cliente_id`
--   `shopping_id`
--       `shoppings` -> `shopping_id`
--

--
-- Despejando dados para a tabela `vagas`
--

INSERT INTO `vagas` (`vaga_id`, `vaga_numero`, `vaga_disponibilidade`, `vaga_modalidade`, `cliente_id`, `shopping_id`) VALUES
(1, 1, 'ocupada', 'livre', 1, 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`),
  ADD KEY `fkClienteShopping` (`shopping_id`);

--
-- Índices de tabela `shoppings`
--
ALTER TABLE `shoppings`
  ADD PRIMARY KEY (`shopping_id`);

--
-- Índices de tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`vaga_id`),
  ADD KEY `fkVagaCliente` (`cliente_id`),
  ADD KEY `fkVagaShopping` (`shopping_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `shoppings`
--
ALTER TABLE `shoppings`
  MODIFY `shopping_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `vaga_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fkClienteShopping` FOREIGN KEY (`shopping_id`) REFERENCES `shoppings` (`shopping_id`);

--
-- Restrições para tabelas `vagas`
--
ALTER TABLE `vagas`
  ADD CONSTRAINT `fkVagaCliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkVagaShopping` FOREIGN KEY (`shopping_id`) REFERENCES `shoppings` (`shopping_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

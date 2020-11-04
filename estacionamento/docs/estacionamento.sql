-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 04-Nov-2020 às 03:23
-- Versão do servidor: 8.0.22
-- versão do PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `getenv('DB_NAME')`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `cliente_id` int NOT NULL,
  `cliente_nome` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_telefone` varchar(11) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cliente_email` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopping_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `cliente_nome`, `cliente_telefone`, `cliente_email`, `shopping_id`) VALUES
(1, 'Francisco das Chagas', '99999999999', 'francisco@exemplo.com.br', 1),
(2, 'Saulo Silva', '99999999999', 'saulo@exemplo.com.br', 1),
(3, 'José Edcarlos', '99999999999', 'edcarlos@exemplo.com.br', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `shoppings`
--

CREATE TABLE `shoppings` (
  `shopping_id` int NOT NULL,
  `shopping_nome` varchar(70) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `shopping_endereco` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `shoppings`
--

INSERT INTO `shoppings` (`shopping_id`, `shopping_nome`, `shopping_endereco`) VALUES
(1, 'Shopping Iguatemi Fortaleza', 'Avenida Washington Soares, 85 - Edson Queiroz, Fortaleza - CE'),
(2, 'Shopping Parangaba', 'Rua Germano Franck, 300 - Parangaba, Fortaleza - CE'),
(3, 'Shopping RioMar Fortaleza', 'Rua Desembargador Lauro Nogueira, 1500 - Papicu, Fortaleza - CE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vagas`
--

CREATE TABLE `vagas` (
  `vaga_id` int NOT NULL,
  `vaga_numero` int NOT NULL,
  `vaga_disponibilidade` enum('desocupada','ocupada') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'desocupada',
  `vaga_modalidade` enum('livre','idoso','gestante','pcd') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'livre',
  `cliente_id` int DEFAULT NULL,
  `shopping_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `vagas`
--

INSERT INTO `vagas` (`vaga_id`, `vaga_numero`, `vaga_disponibilidade`, `vaga_modalidade`, `cliente_id`, `shopping_id`) VALUES
(1, 1, 'ocupada', 'livre', 1, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`cliente_id`),
  ADD KEY `fkClienteShopping` (`shopping_id`);

--
-- Índices para tabela `shoppings`
--
ALTER TABLE `shoppings`
  ADD PRIMARY KEY (`shopping_id`);

--
-- Índices para tabela `vagas`
--
ALTER TABLE `vagas`
  ADD PRIMARY KEY (`vaga_id`),
  ADD KEY `fkVagaCliente` (`cliente_id`),
  ADD KEY `fkVagaShopping` (`shopping_id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `cliente_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `shoppings`
--
ALTER TABLE `shoppings`
  MODIFY `shopping_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `vagas`
--
ALTER TABLE `vagas`
  MODIFY `vaga_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `clientes`
--
ALTER TABLE `clientes`
  ADD CONSTRAINT `fkClienteShopping` FOREIGN KEY (`shopping_id`) REFERENCES `shoppings` (`shopping_id`);

--
-- Limitadores para a tabela `vagas`
--
ALTER TABLE `vagas`
  ADD CONSTRAINT `fkVagaCliente` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`cliente_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fkVagaShopping` FOREIGN KEY (`shopping_id`) REFERENCES `shoppings` (`shopping_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

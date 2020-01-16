-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 16/01/2020 às 10:43
-- Versão do servidor: 5.7.28-0ubuntu0.18.04.4
-- Versão do PHP: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ceu`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_atividade`
--

CREATE TABLE `tb_atividade` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `qntd_part` int(11) NOT NULL,
  `inscricao` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `valor` float NOT NULL DEFAULT '0',
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `carga_hr` int(11) NOT NULL,
  `data_inicio` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `data_fim` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `tb_atividade`:
--   `id_evento`
--       `tb_evento` -> `id`
--

--
-- Fazendo dump de dados para tabela `tb_atividade`
--

INSERT INTO `tb_atividade` (`id`, `id_evento`, `nome`, `qntd_part`, `inscricao`, `valor`, `tipo`, `carga_hr`, `data_inicio`, `data_fim`, `data_cadastro`) VALUES
(5, 18, 'Um atividade TESTT', 20, 'pago', 100, 'Exposicao', 20, '20/11/2019', '26/11/2019', '2019-12-03 15:23:33'),
(6, 19, 'Um atividade TESTT', 50, 'pago', 2, 'Curso', 20, '05/12/2019', '05/12/2019', '2019-12-04 20:44:39'),
(12, 22, 'Um atividade TESTT', 20, 'pago', 50, 'Conferência', 20, '18/12/2019', '20/12/2019', '2019-12-17 13:34:50'),
(14, 23, 'Um atividade TESTT', 20, 'gratis', 0, 'Curso', 20, '19/12/2019', '21/12/2019', '2019-12-18 17:12:35'),
(15, 23, 'Um atividade TESTT', 100, 'pago', 2, 'Aula', 20, '27/12/2019', '28/12/2019', '2019-12-18 17:26:50'),
(28, 8, 'Outra atividade fofolinha', 20, 'pago', 14, 'Oficina', 50, '13/01/2020', '21/01/2020', '2020-01-10 19:24:15'),
(29, 26, 'teste', 20, 'pago', 2, 'Palestra', 20, '14/01/2020', '18/01/2020', '2020-01-13 15:17:56');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_cupom`
--

CREATE TABLE `tb_cupom` (
  `id` int(11) NOT NULL,
  `id_atividade` int(11) NOT NULL,
  `codigo` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `valor` float DEFAULT '0',
  `porcentagem` int(11) DEFAULT '0',
  `qntd` int(11) NOT NULL,
  `validade` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `tb_cupom`:
--   `id_atividade`
--       `tb_atividade` -> `id`
--

--
-- Fazendo dump de dados para tabela `tb_cupom`
--

INSERT INTO `tb_cupom` (`id`, `id_atividade`, `codigo`, `valor`, `porcentagem`, `qntd`, `validade`) VALUES
(7, 12, 'CUPOMSOMAISDESCONTOL', 0, 80, 3, '17/12/2019'),
(9, 5, 'UMCUPOM', 20, NULL, 2, 'data'),
(18, 14, 'PIPRIPRI', 20, 0, 20, '19/12/2019'),
(19, 15, 'UMTESTE', 0, 20, 20, '19/12/2019'),
(20, 28, 'USHUSHSHUSH', 20, 0, 20, '28/01/2020');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_evento`
--

CREATE TABLE `tb_evento` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `preco_evento` float(5,2) NOT NULL DEFAULT '0.00',
  `qntd_part` int(11) NOT NULL,
  `data_inicio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data_fim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `endereco` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `num_usuario_cads` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `tb_evento`:
--   `id_usuario`
--       `tb_usuario` -> `id`
--

--
-- Fazendo dump de dados para tabela `tb_evento`
--

INSERT INTO `tb_evento` (`id`, `id_usuario`, `nome`, `email`, `descricao`, `tipo`, `area`, `preco_evento`, `qntd_part`, `data_inicio`, `data_fim`, `endereco`, `bairro`, `estado`, `cidade`, `cep`, `data_cadastro`, `num_usuario_cads`) VALUES
(5, 1, 'Teste Palestra', 'lucianolps08@gmail.com', 'Um teste de um evento de uma palestra', '', 'palestra', 10.00, 100, '24/11/2019', '25/11/2019', '', '', 'PI', 'Piripiri', '64260000', '2019-11-24 23:33:40', 4),
(7, 1, 'Teste Minicurso', 'lucianolps08@gmail.com', 'Um teste de um evento de um Minicurso', '', 'minicurso', 2.00, 20, '24/11/2019', '30/11/2019', '', '', 'PI', 'Piripiri', '64260000', '2019-11-24 23:35:36', 3),
(8, 8, 'Evento direito', 'lucianolps08@gmail.com', 'Um evento destinado a teste para meios e afins', '', 'palestra', 2.00, 50, '29/11/2019', '30/11/2019', '', '', 'PI', 'Piripiri', '64260000', '2019-11-29 17:30:07', 3),
(13, 8, 'teste ww', 'lucianolps07@gmail.com', 'descricao', 'palestra', 'palestra', 2.00, 50, '31/12/2019', '01/01/2020', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', '64260000', '2019-12-03 11:30:28', 1),
(14, 8, 'teste ww', 'lucianolps07@gmail.com', 'descricao', 'palestra', 'palestra', 2.00, 50, '31/12/2019', '01/01/2020', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', '64260000', '2019-12-03 11:38:17', 0),
(15, 8, 'teste ww', 'lucianolps07@gmail.com', 'descricao', 'palestra', 'palestra', 2.00, 50, '31/12/2019', '01/01/2020', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', '64260000', '2019-12-03 11:38:22', 0),
(16, 8, 'meu pe', 'lucianolps07@gmail.com', 'uma descricao', 'Palestra', 'Computação', 2.00, 50, '01/01/2020', '03/01/2020', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', '64260', '2019-12-03 11:39:25', 0),
(17, 8, 'teste', 'lucianolps07@gmail.com', 'descricao', 'Palestra', 'Computação', 2.00, 20, '03/12/2019', '04/12/2019', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', '64260', '2019-12-03 15:12:45', 0),
(18, 8, 'um evento topppen', 'lucianolps07@gmail.com', 'uma descricao toppen', 'Palestra', 'Computação', 2.00, 50, '03/12/2019', '04/12/2019', 'Rua Desembargador Berilo Mota', 'ItararÃ©', 'PI', 'Teresina', '64078213', '2019-12-03 15:21:37', 0),
(19, 8, 'Um evento mt trem', 'lucianolps07@gmail.com', 'Um descricao trem boum', 'Palestra', 'Computação', 2.00, 20, '20/12/2019', '22/12/2019', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', '64260', '2019-12-04 20:43:14', 1),
(20, 1, 'um evento feliz', 'lucianolps07@gmail.com', 'um descricao feliz', 'Palestra', 'Computação', 0.00, 20, '07/12/2019', '09/12/2019', 'Rua Capitão Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', '64260', '2019-12-07 12:51:44', 1),
(21, 1, 'Teste inicio', 'lucianolps07@gmail.com', 'um teste inicio', 'Palestra', 'Computação', 0.00, 10, '08/12/2019', '10/12/2019', 'Rua Capitão Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', '64260000', '2019-12-07 12:52:42', 0),
(22, 8, 'Um evento massa', 'lucianolps07@gmail.com', 'Um descricao massa', 'Palestra', 'Computação', 0.00, 20, '18/12/2019', '19/12/2019', 'Rua Capitão Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', '64260', '2019-12-17 13:34:20', 0),
(23, 11, 'Um teste evento', 'lucianolps22@gmail.com', 'uma descricao', 'Palestra', 'Computação', 0.00, 20, '19/12/2019', '20/12/2019', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', '64260000', '2019-12-18 16:54:32', 0),
(25, 8, 'Um teste do controller', 'lucianolps07@gmail.com', 'umsdmakm', 'Minicurso', 'Computação', 20.00, 20, '10/01/2020', '21/01/2020', 'Rua CapitÃ£o Manoel de Oliveira', '865', 'PI', 'Piripiri', '64260-000', '2020-01-09 17:17:16', 0),
(26, 14, 'Teste', 'teste12345@teste.ur', 'testetete', 'Minicurso', 'ComputaÃ§Ã£o', 0.00, 20, '14/01/2020', '20/01/2020', 'rua teste', 'teste', 'PI', 'LuÃ­s Correia', '64220000', '2020-01-13 15:14:12', 0),
(27, 15, 'um evento teste', 'email@email.com.ira', 'uma descricao', 'Palestra', 'ComputaÃ§Ã£o', 0.00, 20, '15/01/2020', '21/01/2020', 'rua da praia', 'praia', 'PI', 'LuÃ­s Correia', '64220000', '2020-01-13 15:29:36', 0),
(28, 1, 'testeEventoNova', 'lucianolps07@gmail.com', 'uma desc', 'Palestra', 'ComputaÃ§Ã£o', 0.00, 20, '15/01/2020', '16/01/2020', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', '64260-000', '2020-01-14 11:00:40', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_inscricao`
--

CREATE TABLE `tb_inscricao` (
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `tb_inscricao`:
--   `id_evento`
--       `tb_evento` -> `id`
--   `id_usuario`
--       `tb_usuario` -> `id`
--

--
-- Fazendo dump de dados para tabela `tb_inscricao`
--

INSERT INTO `tb_inscricao` (`id_evento`, `id_usuario`) VALUES
(5, 10),
(7, 10),
(7, 1),
(21, 1),
(19, 1),
(20, 8),
(8, 8),
(17, 8),
(5, 8),
(13, 8),
(7, 18);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_inscricao_atividade`
--

CREATE TABLE `tb_inscricao_atividade` (
  `id_atividade` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `tb_inscricao_atividade`:
--   `id_atividade`
--       `tb_atividade` -> `id`
--   `id_evento`
--       `tb_evento` -> `id`
--   `id_usuario`
--       `tb_usuario` -> `id`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuario`
--

CREATE TABLE `tb_usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cep` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `tb_usuario`:
--

--
-- Fazendo dump de dados para tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id`, `nome`, `usuario`, `email`, `senha`, `estado`, `cidade`, `cep`) VALUES
(1, 'Luciano', 'lps08', 'lucianolps08@gmail.com', '1234', 'PI', 'Piripiri', '64260000'),
(8, 'Luciano', '123', 'lucianolps07@gmail.com', '1234', 'PI', 'Piripiri', '64260'),
(9, 'Luciano', 'lps18', 'lucianolps18@gmail.com', '1234', 'PI', 'Piripiri', '64260'),
(10, 'Luciano', 'lps10', 'lucianolps10@gmail.com', '1234', 'PI', 'Piripiri', '64260000'),
(11, 'Luciano', 'lps22', 'lucianolps22@gmail.com', '1234', 'PI', 'Piripiri', '64260000'),
(13, 'Controller', 'teste', 'control@teste.com', '1234', 'PI', 'Piripiri', '64260-000'),
(14, 'testett', 'teste', 'teste12345@teste.ur', '1234', 'PI', 'LuÃ­s Correia', '64220000'),
(15, 'nome', 'usuario', 'email@email.com.ira', '1234', 'PI', 'LuÃ­s Correia', '64220000'),
(16, 'testeNome', 'teste', 'testenome@teste.com', '1234', 'PI', 'Piripiri', '64260000'),
(17, 'um teste', 'teste', 'testeoutro@teste.iu', '1234', 'PI', 'Piripiri', '64260000'),
(18, 'umteste', 'teset', 'testett@teste.com', '1234', 'PI', 'Piripiri', '64260000');

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tb_atividade`
--
ALTER TABLE `tb_atividade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Índices de tabela `tb_cupom`
--
ALTER TABLE `tb_cupom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_atividade` (`id_atividade`);

--
-- Índices de tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_inscricao`
--
ALTER TABLE `tb_inscricao`
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_inscricao_atividade`
--
ALTER TABLE `tb_inscricao_atividade`
  ADD KEY `id_atividade` (`id_atividade`),
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_atividade`
--
ALTER TABLE `tb_atividade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT de tabela `tb_cupom`
--
ALTER TABLE `tb_cupom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT de tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tb_atividade`
--
ALTER TABLE `tb_atividade`
  ADD CONSTRAINT `tb_atividade_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `tb_evento` (`id`);

--
-- Restrições para tabelas `tb_cupom`
--
ALTER TABLE `tb_cupom`
  ADD CONSTRAINT `tb_cupom_ibfk_1` FOREIGN KEY (`id_atividade`) REFERENCES `tb_atividade` (`id`);

--
-- Restrições para tabelas `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD CONSTRAINT `tb_evento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`);

--
-- Restrições para tabelas `tb_inscricao`
--
ALTER TABLE `tb_inscricao`
  ADD CONSTRAINT `tb_inscricao_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `tb_evento` (`id`),
  ADD CONSTRAINT `tb_inscricao_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`);

--
-- Restrições para tabelas `tb_inscricao_atividade`
--
ALTER TABLE `tb_inscricao_atividade`
  ADD CONSTRAINT `tb_inscricao_atividade_ibfk_1` FOREIGN KEY (`id_atividade`) REFERENCES `tb_atividade` (`id`),
  ADD CONSTRAINT `tb_inscricao_atividade_ibfk_2` FOREIGN KEY (`id_evento`) REFERENCES `tb_evento` (`id`),
  ADD CONSTRAINT `tb_inscricao_atividade_ibfk_3` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

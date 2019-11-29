-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Nov-2019 às 17:11
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
-- Estrutura da tabela `tb_evento`
--
-- Criação: 19-Nov-2019 às 14:54
-- Última actualização: 19-Nov-2019 às 16:04
--

CREATE TABLE `tb_evento` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `preco_evento` float(5,2) NOT NULL DEFAULT 0.00,
  `qntd_part` int(11) NOT NULL,
  `data_inicio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data_fim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cep` int(11) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `tb_evento`:
--   `id_usuario`
--       `tb_usuario` -> `id`
--

--
-- Extraindo dados da tabela `tb_evento`
--

INSERT INTO `tb_evento` (`id`, `id_usuario`, `nome`, `email`, `descricao`, `preco_evento`, `qntd_part`, `data_inicio`, `data_fim`, `estado`, `cidade`, `cep`, `data_cadastro`) VALUES
(3, 1, 'tesste', 'lucianolps08@gmail.com', 'ljdcçolaskjdçaljkdlaçkjdçlkasjdaksdnhjwkwiljudqwoçopidjkqmdod okjqpokiqopkqop', 0.00, 20, '12/11/2019', '16/11/2019', 'PI', 'Piripiri', 64260000, '2019-11-19 12:00:21'),
(4, 1, 'bomba', 'lucianolps08@gmail.com', 'uma bomba', 0.00, 100, '20/11/2019', '23/11/2019', 'PI', 'Piripiri', 64260000, '2019-11-19 12:01:15'),
(8, 1, 'carroTunado', 'lucianolps08@gmail.com', 'um carro', 100.00, 10, '14/11/2019', '15/11/2019', 'PI', 'Piripiri', 64260000, '2019-11-19 12:08:10'),
(9, 1, 'carroHumilde', 'lucianolps08@gmail.com', 'um carro', 0.00, 10, '14/11/2019', '15/11/2019', 'PI', 'Piripiri', 64260000, '2019-11-19 12:08:51'),
(11, 1, 'sprint', 'lucianolps08@gmail.com', 'Uma apresentação de uma sprint', 500.00, 20, '19/11/2019', '19/11/2019', 'PI', 'Piripiri', 64260000, '2019-11-19 13:04:23');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
--
-- Criação: 12-Nov-2019 às 11:50
--

CREATE TABLE `tb_usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `cep` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `tb_usuario`:
--

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id`, `nome`, `usuario`, `email`, `senha`, `estado`, `cidade`, `cep`) VALUES
(1, 'Luciano', 'lps08', 'lucianolps08@gmail.com', '1234', 'PI', 'Piripiri', 64260000),
(4, 'teste1212', 'teste11', 'teste1212@teste.com', 'teste12', 'PI', 'Piripiri', 64260000);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD CONSTRAINT `tb_evento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

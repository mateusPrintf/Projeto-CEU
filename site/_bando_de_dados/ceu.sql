-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: 04-Dez-2019 às 21:00
-- Versão do servidor: 5.7.28-0ubuntu0.18.04.4
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ceu`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_atividade`
--

CREATE TABLE `tb_atividade` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `qntd_part` int(11) NOT NULL,
  `inscricao` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL DEFAULT '0',
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `carga_hr` int(11) NOT NULL,
  `data_inicio` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `data_fim` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `tb_atividade`:
--   `id_evento`
--       `tb_evento` -> `id`
--

--
-- Extraindo dados da tabela `tb_atividade`
--

INSERT INTO `tb_atividade` (`id`, `id_evento`, `nome`, `qntd_part`, `inscricao`, `valor`, `tipo`, `carga_hr`, `data_inicio`, `data_fim`, `data_cadastro`) VALUES
(1, 8, 'Meu pé', 20, 'gratis', 0, 'exposicao', 0, '29/11/2019', '26/11/2019', '2019-12-01 15:05:09'),
(2, 8, 'teste atividade', 20, 'pago', 2, 'aula', 0, '29/11/2019', '26/11/2019', '2019-12-01 15:07:40'),
(3, 8, 'Uma atividade', 50, 'pago', 10, 'ConferÃªncia', 0, '23/11/2019', '09/11/2019', '2019-12-02 15:20:50'),
(4, 8, 'testesets', 50, 'gratis', 0, 'Palestra', 20, 'dta', 'dta', '2019-12-03 09:37:48'),
(5, 18, 'Uma atividade toppen', 20, 'pago', 100, 'Exposicao', 20, '20/11/2019', '26/11/2019', '2019-12-03 15:23:33'),
(6, 19, 'Uma atividade trem boum', 50, 'pago', 2, 'Curso', 20, '05/12/2019', '05/12/2019', '2019-12-04 20:44:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cupom`
--

CREATE TABLE `tb_cupom` (
  `id` int(11) NOT NULL,
  `id_atividade` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `tb_cupom`:
--   `id_atividade`
--       `tb_atividade` -> `id`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_evento`
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
  `cep` int(11) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `num_usuario_cads` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `tb_evento`:
--   `id_usuario`
--       `tb_usuario` -> `id`
--

--
-- Extraindo dados da tabela `tb_evento`
--

INSERT INTO `tb_evento` (`id`, `id_usuario`, `nome`, `email`, `descricao`, `tipo`, `area`, `preco_evento`, `qntd_part`, `data_inicio`, `data_fim`, `endereco`, `bairro`, `estado`, `cidade`, `cep`, `data_cadastro`, `num_usuario_cads`) VALUES
(5, 1, 'Teste Palestra', 'lucianolps08@gmail.com', 'Um teste de um evento de uma palestra', '', 'palestra', 10.00, 100, '24/11/2019', '25/11/2019', '', '', 'PI', 'Piripiri', 64260000, '2019-11-24 23:33:40', 2),
(7, 1, 'Teste Minicurso', 'lucianolps08@gmail.com', 'Um teste de um evento de um Minicurso', '', 'minicurso', 2.00, 20, '24/11/2019', '30/11/2019', '', '', 'PI', 'Piripiri', 64260000, '2019-11-24 23:35:36', 2),
(8, 8, 'Evento direito', 'lucianolps08@gmail.com', 'Um evento destinado a teste para meios e afins', '', 'palestra', 2.00, 50, '29/11/2019', '30/11/2019', '', '', 'PI', 'Piripiri', 64260000, '2019-11-29 17:30:07', 0),
(13, 8, 'teste ww', 'lucianolps07@gmail.com', 'descricao', 'palestra', 'palestra', 2.00, 50, '31/12/2019', '01/01/2020', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', 64260000, '2019-12-03 11:30:28', 0),
(14, 8, 'teste ww', 'lucianolps07@gmail.com', 'descricao', 'palestra', 'palestra', 2.00, 50, '31/12/2019', '01/01/2020', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', 64260000, '2019-12-03 11:38:17', 0),
(15, 8, 'teste ww', 'lucianolps07@gmail.com', 'descricao', 'palestra', 'palestra', 2.00, 50, '31/12/2019', '01/01/2020', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', 64260000, '2019-12-03 11:38:22', 0),
(16, 8, 'meu pe', 'lucianolps07@gmail.com', 'uma descricao', 'Palestra', 'ComputaÃ§Ã£o', 2.00, 50, '01/01/2020', '03/01/2020', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', 64260, '2019-12-03 11:39:25', 0),
(17, 8, 'teste', 'lucianolps07@gmail.com', 'descricao', 'Palestra', 'ComputaÃ§Ã£o', 2.00, 20, '03/12/2019', '04/12/2019', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', 64260, '2019-12-03 15:12:45', 0),
(18, 8, 'um evento topppen', 'lucianolps07@gmail.com', 'uma descricao toppen', 'Palestra', 'ComputaÃ§Ã£o', 2.00, 50, '03/12/2019', '04/12/2019', 'Rua Desembargador Berilo Mota', 'ItararÃ©', 'PI', 'Teresina', 64078213, '2019-12-03 15:21:37', 0),
(19, 8, 'Um evento mt trem', 'lucianolps07@gmail.com', 'Um descriÃ§Ã£o trem boum', 'Palestra', 'ComputaÃ§Ã£o', 2.00, 20, '20/12/2019', '22/12/2019', 'Rua CapitÃ£o Manoel de Oliveira, 865', 'Recreio', 'PI', 'Piripiri', 64260, '2019-12-04 20:43:14', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_inscricoes`
--

CREATE TABLE `tb_inscricoes` (
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELATIONS FOR TABLE `tb_inscricoes`:
--   `id_evento`
--       `tb_evento` -> `id`
--   `id_usuario`
--       `tb_usuario` -> `id`
--

--
-- Extraindo dados da tabela `tb_inscricoes`
--

INSERT INTO `tb_inscricoes` (`id_evento`, `id_usuario`) VALUES
(5, 1),
(5, 10),
(7, 10),
(7, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario`
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
-- RELATIONS FOR TABLE `tb_usuario`:
--

--
-- Extraindo dados da tabela `tb_usuario`
--

INSERT INTO `tb_usuario` (`id`, `nome`, `usuario`, `email`, `senha`, `estado`, `cidade`, `cep`) VALUES
(1, 'Luciano', 'lps08', 'lucianolps08@gmail.com', '1234', 'PI', 'Piripiri', 64260000),
(8, 'Luciano', '123', 'lucianolps07@gmail.com', '1234', 'PI', 'Piripiri', 64260),
(9, 'Luciano', 'lps18', 'lucianolps18@gmail.com', '1234', 'PI', 'Piripiri', 64260),
(10, 'Luciano', 'lps10', 'lucianolps10@gmail.com', '1234', 'PI', 'Piripiri', 64260000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_atividade`
--
ALTER TABLE `tb_atividade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Indexes for table `tb_cupom`
--
ALTER TABLE `tb_cupom`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_atividade` (`id_atividade`);

--
-- Indexes for table `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `tb_inscricoes`
--
ALTER TABLE `tb_inscricoes`
  ADD KEY `id_evento` (`id_evento`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indexes for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_atividade`
--
ALTER TABLE `tb_atividade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tb_cupom`
--
ALTER TABLE `tb_cupom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tb_evento`
--
ALTER TABLE `tb_evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_atividade`
--
ALTER TABLE `tb_atividade`
  ADD CONSTRAINT `tb_atividade_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `tb_evento` (`id`);

--
-- Limitadores para a tabela `tb_cupom`
--
ALTER TABLE `tb_cupom`
  ADD CONSTRAINT `tb_cupom_ibfk_1` FOREIGN KEY (`id_atividade`) REFERENCES `tb_atividade` (`id`);

--
-- Limitadores para a tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD CONSTRAINT `tb_evento_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`);

--
-- Limitadores para a tabela `tb_inscricoes`
--
ALTER TABLE `tb_inscricoes`
  ADD CONSTRAINT `tb_inscricoes_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `tb_evento` (`id`),
  ADD CONSTRAINT `tb_inscricoes_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tb_usuario` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

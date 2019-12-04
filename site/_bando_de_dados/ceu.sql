-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Dez-2019 às 16:36
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
-- Estrutura da tabela `tb_atividade`
--

CREATE TABLE `tb_atividade` (
  `id` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  `nome` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `qntd_part` int(11) NOT NULL,
  `inscricao` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `valor` int(11) NOT NULL DEFAULT 0,
  `tipo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `data_inicio` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `data_fim` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `tb_atividade`:
--   `id_evento`
--       `tb_evento` -> `id`
--

--
-- Extraindo dados da tabela `tb_atividade`
--

INSERT INTO `tb_atividade` (`id`, `id_evento`, `nome`, `qntd_part`, `inscricao`, `valor`, `tipo`, `data_inicio`, `data_fim`, `data_cadastro`) VALUES
(1, 8, 'Meu pé', 20, 'gratis', 0, 'Exposicao', '29/11/2019', '26/11/2019', '2019-12-01 15:05:09'),
(2, 8, 'teste atividade', 20, 'pago', 2, 'Aula', '29/11/2019', '26/11/2019', '2019-12-01 15:07:40'),
(4, 5, 'Uma atividade', 20, 'gratis', 0, 'Aula', 'Uma data', 'Uma data', '2019-12-02 12:24:56'),
(5, 5, 'Teste atividade', 10, 'pago', 2, 'Palestra', 'Uma data', 'Uma data', '2019-12-02 12:28:27');

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
  `area` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `preco_evento` float(5,2) NOT NULL DEFAULT 0.00,
  `qntd_part` int(11) NOT NULL,
  `data_inicio` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `data_fim` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cep` int(11) NOT NULL,
  `data_cadastro` datetime NOT NULL DEFAULT current_timestamp(),
  `num_usuario_cads` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `tb_evento`:
--   `id_usuario`
--       `tb_usuario` -> `id`
--

--
-- Extraindo dados da tabela `tb_evento`
--

INSERT INTO `tb_evento` (`id`, `id_usuario`, `nome`, `email`, `descricao`, `area`, `preco_evento`, `qntd_part`, `data_inicio`, `data_fim`, `estado`, `cidade`, `cep`, `data_cadastro`, `num_usuario_cads`) VALUES
(5, 1, 'Teste Palestra', 'lucianolps08@gmail.com', 'Um teste de um evento de uma palestra', 'palestra', 10.00, 100, '24/11/2019', '25/11/2019', 'PI', 'Piripiri', 64260000, '2019-11-24 23:33:40', 2),
(7, 1, 'Teste Minicurso', 'lucianolps08@gmail.com', 'Um teste de um evento de um Minicurso', 'minicurso', 2.00, 20, '24/11/2019', '30/11/2019', 'PI', 'Piripiri', 64260000, '2019-11-24 23:35:36', 2),
(8, 8, 'Evento direito', 'lucianolps08@gmail.com', 'Um evento destinado a teste para meios e afins', 'palestra', 2.00, 50, '29/11/2019', '30/11/2019', 'PI', 'Piripiri', 64260000, '2019-11-29 17:30:07', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_inscricoes`
--

CREATE TABLE `tb_inscricoes` (
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- RELACIONAMENTOS PARA TABELAS `tb_inscricoes`:
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
-- RELACIONAMENTOS PARA TABELAS `tb_usuario`:
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
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tb_atividade`
--
ALTER TABLE `tb_atividade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_evento` (`id_evento`);

--
-- Índices para tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices para tabela `tb_inscricoes`
--
ALTER TABLE `tb_inscricoes`
  ADD KEY `id_evento` (`id_evento`),
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
-- AUTO_INCREMENT de tabela `tb_atividade`
--
ALTER TABLE `tb_atividade`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tb_evento`
--
ALTER TABLE `tb_evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `tb_usuario`
--
ALTER TABLE `tb_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tb_atividade`
--
ALTER TABLE `tb_atividade`
  ADD CONSTRAINT `tb_atividade_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `tb_evento` (`id`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

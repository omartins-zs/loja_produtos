-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 25-Jun-2020 às 19:58
-- Versão do servidor: 10.4.6-MariaDB
-- versão do PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `infoprodutos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `credencias_mp`
--

CREATE TABLE `credencias_mp` (
  `id` int(11) NOT NULL,
  `client_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `client_secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `credencias_mp`
--

INSERT INTO `credencias_mp` (`id`, `client_id`, `client_secret`) VALUES
(1, '000000000', 'fffffffffffffffffffffffffff');

-- --------------------------------------------------------

--
-- Estrutura da tabela `credencias_whatsapp`
--

CREATE TABLE `credencias_whatsapp` (
  `id` int(11) NOT NULL,
  `client_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `device` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `credencias_whatsapp`
--

INSERT INTO `credencias_whatsapp` (`id`, `client_id`, `secret`, `device`) VALUES
(1, 'cid5e7058f3d7eec', 'sec5e7058f3d7eee4.898888125e7058f3d7fcf4.72594098', '5e705a0fd4e5f');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `id` int(11) NOT NULL,
  `iduser` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `valor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `data` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hash` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`id`, `iduser`, `produto`, `valor`, `reference`, `status`, `data`, `hash`) VALUES
(25, 2, 1, '50,00', 'f5634d9915bb022feee9ca587dcfeb2894a4c56e', 'approved', '22/03/2020', '45bb79250f981f48007311429ae5557c'),
(26, 3, 2, '10,00', 'ff7358ee56d0ab04fe69291dd3a246e279796cb3', 'pending', '22/03/2020', '41796085e5712a5e4c96ea6ca9e0bc72c4cf09c6'),
(27, 2, 2, '10,00', '94050ba38ad2d6313c98c3c8610ad65734faf55b', 'pending', '22/03/2020', '5bfa5c4c4000264e90c7e39a78d01b1804cf1078'),
(28, 2, 1, '50,00', 'aafa22dce75c4f55ba0a10db1b16128273ac2dbc', 'pending', '22/03/2020', '23363c36f4e5e293939dc0655e63387022b3e92a'),
(29, 2, 1, '50,00', 'f39d5d5e0bc5f021ad30d4c62e177f9495074549', 'pending', '31/05/2020', '7e786c8df4888a2e18b2108da0313f753855f1a1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `valor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hash_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `img` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `valor`, `nome`, `hash_file`, `name_file`, `img`) VALUES
(1, '50,00', 'Livro Harry Potter', 'dsfdsfdsvstsad', '45bb79250f981f48007311429ae5557c.pdf', 'imagem.jpeg'),
(2, '10,00', 'Imagem Teste', 'rrrrrrrrrrrrrrr', 'af540623fc6147dd964cbb0e154eb332.zip', 'img.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `smtp`
--

CREATE TABLE `smtp` (
  `id` int(11) NOT NULL,
  `host` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `port` int(11) NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `certified` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `smtp`
--

INSERT INTO `smtp` (`id`, `host`, `username`, `password`, `port`, `email`, `certified`) VALUES
(1, 'mail.provedor.com', 'localhost@provedor.com', 'senha', 587, 'localhost@provedor.com', 'tls');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `whatsapp` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `whatsapp`, `senha`) VALUES
(2, 'Rafael teste', 'mail@gmail.com', '554598339113', '123123'),
(3, 'Teste', 'dfdfds@gmail.com', '55454545454545', '123123');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `credencias_mp`
--
ALTER TABLE `credencias_mp`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `credencias_whatsapp`
--
ALTER TABLE `credencias_whatsapp`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `smtp`
--
ALTER TABLE `smtp`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `credencias_mp`
--
ALTER TABLE `credencias_mp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `credencias_whatsapp`
--
ALTER TABLE `credencias_whatsapp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `smtp`
--
ALTER TABLE `smtp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
